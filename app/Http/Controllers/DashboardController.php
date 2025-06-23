<?php

namespace App\Http\Controllers;

use App\Models\FarmProduct;
use App\Models\ProductOrder;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($user->role == 'farmer') {
            // Get date range from request or default to last 30 days
            $dateRange = $request->get('range', '30');
            $startDate = Carbon::now()->subDays($dateRange);

            $products = FarmProduct::with(['orders' => function ($query) use ($startDate) {
                $query->where('created_at', '>=', $startDate);
            }, 'category'])
                ->where('farmer_id', $user->id)
                ->get();

            // Enhanced metrics calculation
            $totalProducts = $products->count();
            $totalUnitsSold = 0;
            $totalSales = 0;
            $totalProfit = 0;
            $totalCost = 0;

            foreach ($products as $product) {
                $unitsSold = $product->orders->sum('quantity');
                $sales = $product->orders->sum('total_price');
                $cost = $product->unit_price * $unitsSold;

                $totalUnitsSold += $unitsSold;
                $totalSales += $sales;
                $totalCost += $cost;
                $totalProfit += ($sales - $cost);
            }

            // Calculate profit margin
            $profitMargin = $totalSales > 0 ? (($totalProfit / $totalSales) * 100) : 0;

            // Get unique customers count
            $totalCustomers = User::whereHas('orders', function ($query) use ($user, $startDate) {
                $query->whereHas('product', function ($q) use ($user) {
                    $q->where('farmer_id', $user->id);
                })->where('created_at', '>=', $startDate);
            })->distinct()->count('id');

            // Get average order value
            $averageOrderValue = $totalCustomers > 0 ? $totalSales / $totalCustomers : 0;

            // Enhanced daily sales data
            $dailyLabels = [];
            $dailyData = [];
            for ($i = 6; $i >= 0; $i--) {
                $date = Carbon::today()->subDays($i);
                $label = $date->format('D, M j');
                $sales = ProductOrder::whereDate('created_at', $date)
                    ->whereHas('product', fn($q) => $q->where('farmer_id', $user->id))
                    ->sum('total_price');
                $dailyLabels[] = $label;
                $dailyData[] = floatval($sales);
            }

            // Enhanced weekly sales data
            $weeklyLabels = [];
            $weeklyData = [];
            for ($i = 3; $i >= 0; $i--) {
                $start = Carbon::now()->startOfWeek()->subWeeks($i);
                $end = $start->copy()->endOfWeek();
                $label = $start->format('M j') . ' - ' . $end->format('j');
                $sales = ProductOrder::whereBetween('created_at', [$start, $end])
                    ->whereHas('product', fn($q) => $q->where('farmer_id', $user->id))
                    ->sum('total_price');
                $weeklyLabels[] = $label;
                $weeklyData[] = floatval($sales);
            }

            // Top selling products with category information
            $topSellingProducts = FarmProduct::where('farmer_id', $user->id)
                ->with('category')
                ->withSum('orders as units_sold', 'quantity')
                ->withSum('orders as total_sales', 'total_price')
                ->having('units_sold', '>', 0)
                ->orderByDesc('units_sold')
                ->take(10)
                ->get();

            // Top customers with detailed information
            $topCustomers = User::whereHas('orders.product', function ($q) use ($user) {
                $q->where('farmer_id', $user->id);
            })
                ->withCount(['orders as order_count' => function ($q) use ($user) {
                    $q->whereHas('product', fn($q2) => $q2->where('farmer_id', $user->id));
                }])
                ->withSum(['orders as total_spent' => function ($q) use ($user) {
                    $q->whereHas('product', fn($q2) => $q2->where('farmer_id', $user->id));
                }], 'total_price')
                ->having('total_spent', '>', 0)
                ->orderByDesc('total_spent')
                ->take(10)
                ->get();

            // Recent orders for activity feed
            $recentOrders = ProductOrder::whereHas('product', function ($q) use ($user) {
                $q->where('farmer_id', $user->id);
            })
                ->with(['product', 'buyer'])
                ->latest()
                ->take(5)
                ->get();

            // Low stock alerts
            $lowStockProducts = FarmProduct::where('farmer_id', $user->id)
                ->where('total_stock', '<=', 10)
                ->where('total_stock', '>', 0)
                ->orderBy('total_stock')
                ->take(5)
                ->get();

            return view('farmer-dashboard', compact(
                'products',
                'totalProducts',
                'totalUnitsSold',
                'totalSales',
                'totalProfit',
                'totalCost',
                'profitMargin',
                'totalCustomers',
                'averageOrderValue',
                'dailyLabels',
                'dailyData',
                'weeklyLabels',
                'weeklyData',
                'topSellingProducts',
                'topCustomers',
                'recentOrders',
                'lowStockProducts'
            ));
        } else {
            // Buyer dashboard
            $orders = ProductOrder::where('buyer_id', $user->id)
                ->with(['product', 'farmer'])
                ->latest()
                ->take(10)
                ->get();

            $totalOrders = ProductOrder::where('buyer_id', $user->id)->count();
            $totalSpent = ProductOrder::where('buyer_id', $user->id)->sum('total_price');
            $favoriteProducts = ProductOrder::where('buyer_id', $user->id)
                ->select('product_id', DB::raw('COUNT(*) as order_count'))
                ->groupBy('product_id')
                ->orderByDesc('order_count')
                ->with('product')
                ->take(5)
                ->get();

            return view('buyer-dashboard', compact(
                'orders',
                'totalOrders',
                'totalSpent',
                'favoriteProducts'
            ));
        }
    }

    /**
     * Get dashboard data via AJAX for dynamic updates
     */
    public function getDashboardData(Request $request)
    {
        $user = Auth::user();
        $period = $request->get('period', 'daily');
        $days = $request->get('days', 7);

        if ($user->role !== 'farmer') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $data = [];
        $labels = [];

        if ($period === 'daily') {
            for ($i = $days - 1; $i >= 0; $i--) {
                $date = Carbon::today()->subDays($i);
                $labels[] = $date->format('M j');
                $sales = ProductOrder::whereDate('created_at', $date)
                    ->whereHas('product', fn($q) => $q->where('farmer_id', $user->id))
                    ->sum('total_price');
                $data[] = floatval($sales);
            }
        } elseif ($period === 'weekly') {
            $weeks = intval($days / 7);
            for ($i = $weeks - 1; $i >= 0; $i--) {
                $start = Carbon::now()->startOfWeek()->subWeeks($i);
                $end = $start->copy()->endOfWeek();
                $labels[] = $start->format('M j') . ' - ' . $end->format('j');
                $sales = ProductOrder::whereBetween('created_at', [$start, $end])
                    ->whereHas('product', fn($q) => $q->where('farmer_id', $user->id))
                    ->sum('total_price');
                $data[] = floatval($sales);
            }
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data,
            'period' => $period
        ]);
    }

    /**
     * Export dashboard data to CSV
     */
    public function exportData(Request $request)
    {
        $user = Auth::user();

        if ($user->role !== 'farmer') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $products = FarmProduct::where('farmer_id', $user->id)
            ->with(['orders', 'category'])
            ->get();

        $filename = 'farm_dashboard_' . date('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($products) {
            $file = fopen('php://output', 'w');

            // CSV Headers
            fputcsv($file, [
                'Product Name',
                'Category',
                'Unit Price',
                'Units Sold',
                'Total Revenue',
                'Total Profit',
                'Profit Margin %',
                'Stock Remaining'
            ]);

            // CSV Data
            foreach ($products as $product) {
                $unitsSold = $product->orders->sum('quantity');
                $revenue = $product->orders->sum('total_price');
                $profit = $revenue - ($unitsSold * $product->unit_price);
                $profitMargin = $revenue > 0 ? (($profit / $revenue) * 100) : 0;

                fputcsv($file, [
                    $product->name,
                    $product->category->name ?? 'Uncategorized',
                    $product->selling_price ?? $product->unit_price,
                    $unitsSold,
                    $revenue,
                    $profit,
                    round($profitMargin, 2),
                    $product->total_stock
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
