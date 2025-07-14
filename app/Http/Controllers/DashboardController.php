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

            // $products = FarmProduct::with(['orders' => function ($query) use ($startDate) {
            //     $query->where('created_at', '>=', $startDate);
            // }, 'category'])
            //     ->where('farmer_id', $user->id)
            //     ->get();

            $products = FarmProduct::with(['orders' => function ($query) use ($startDate) {
                // Only include confirmed/completed orders for accurate calculations
                $query->where('created_at', '>=', $startDate)
                    ->whereIn('status', ['confirmed', 'completed', 'shipped', 'delivered']);
            }, 'category'])
                ->where('farmer_id', $user->id)
                ->get();


            // Enhanced metrics calculation with proper profit calculation
            $totalProducts = $products->count();
            $totalUnitsSold = 0;
            $totalSales = 0;
            $totalProfit = 0;
            $totalCost = 0;
            $totalAvailableStock = 0;

            foreach ($products as $product) {
                // Only count confirmed/completed orders
                $confirmedOrders = $product->orders;
                $unitsSold = $confirmedOrders->sum('quantity');
                $sales = $confirmedOrders->sum('total_price');

                // Use unit_price as cost price (this is the farmer's cost)
                $costPrice = $product->unit_price;
                $sellingPrice = $product->selling_price ?? $product->unit_price;

                // Calculate cost and profit correctly
                $productCost = $costPrice * $unitsSold;
                $productProfit = $sales - $productCost;

                // Calculate available stock (total stock minus sold quantity)
                $availableStock = max(0, $product->total_stock - $unitsSold);

                $totalUnitsSold += $unitsSold;
                $totalSales += $sales;
                $totalCost += $productCost;
                $totalProfit += $productProfit;
                $totalAvailableStock += $availableStock;
            }

            // Calculate profit margin
            $profitMargin = $totalSales > 0 ? (($totalProfit / $totalSales) * 100) : 0;


            // Get unique customers count (only from confirmed orders)
            $totalCustomers = User::whereHas('orders', function ($query) use ($user, $startDate) {
                $query->whereHas('product', function ($q) use ($user) {
                    $q->where('farmer_id', $user->id);
                })
                    ->where('created_at', '>=', $startDate)
                    ->whereIn('status', ['confirmed', 'completed', 'shipped', 'delivered']);
            })->distinct()->count('id');

            // Get average order value (from confirmed orders only)
            $totalOrderCount = ProductOrder::whereHas('product', function ($q) use ($user) {
                $q->where('farmer_id', $user->id);
            })
                ->where('created_at', '>=', $startDate)
                ->whereIn('status', ['confirmed', 'completed', 'shipped', 'delivered'])
                ->count();

            $averageOrderValue = $totalOrderCount > 0 ? $totalSales / $totalOrderCount : 0;


            // Enhanced daily sales data (confirmed orders only)
            $dailyLabels = [];
            $dailyData = [];
            for ($i = 6; $i >= 0; $i--) {
                $date = Carbon::today()->subDays($i);
                $label = $date->format('D, M j');
                $sales = ProductOrder::whereDate('created_at', $date)
                    ->whereHas('product', fn($q) => $q->where('farmer_id', $user->id))
                    ->whereIn('status', ['confirmed', 'completed', 'shipped', 'delivered'])
                    ->sum('total_price');
                $dailyLabels[] = $label;
                $dailyData[] = floatval($sales);
            }

            // Enhanced weekly sales data (confirmed orders only)
            $weeklyLabels = [];
            $weeklyData = [];
            for ($i = 3; $i >= 0; $i--) {
                $start = Carbon::now()->startOfWeek()->subWeeks($i);
                $end = $start->copy()->endOfWeek();
                $label = $start->format('M j') . ' - ' . $end->format('j');
                $sales = ProductOrder::whereBetween('created_at', [$start, $end])
                    ->whereHas('product', fn($q) => $q->where('farmer_id', $user->id))
                    ->whereIn('status', ['confirmed', 'completed', 'shipped', 'delivered'])
                    ->sum('total_price');
                $weeklyLabels[] = $label;
                $weeklyData[] = floatval($sales);
            }



            // Top selling products with category information (confirmed orders only)
            // $topSellingProducts = FarmProduct::where('farmer_id', $user->id)
            //     ->with('category')
            //     ->withSum(['orders as units_sold' => function ($query) {
            //         $query->whereIn('status', ['confirmed', 'completed', 'shipped', 'delivered']);
            //     }], 'quantity')
            //     ->withSum(['orders as total_sales' => function ($query) {
            //         $query->whereIn('status', ['confirmed', 'completed', 'shipped', 'delivered']);
            //     }], 'total_price')
            //     ->having('units_sold', '>', 0)
            //     ->orderByDesc('units_sold')
            //     ->take(10)
            //     ->get();

            $topSellingProducts = FarmProduct::where('farmer_id', $user->id)
                ->with('category')
                ->withSum(['orders as units_sold' => function ($query) {
                    $query->whereIn('status', ['confirmed', 'completed', 'shipped', 'delivered']);
                }], 'quantity')
                ->withSum(['orders as total_sales' => function ($query) {
                    $query->whereIn('status', ['confirmed', 'completed', 'shipped', 'delivered']);
                }], 'total_price')
                ->whereHas('orders', function ($query) {
                    $query->whereIn('status', ['confirmed', 'completed', 'shipped', 'delivered']);
                }) // Ensures at least one order exists in those statuses
                ->orderByDesc('units_sold')
                ->take(10)
                ->get();


            // Top customers with detailed information (confirmed orders only)
            $topCustomers = User::whereHas('orders.product', function ($q) use ($user) {
                $q->where('farmer_id', $user->id);
            })
                ->whereHas('orders', function ($q) {
                    $q->whereIn('status', ['confirmed', 'completed', 'shipped', 'delivered']);
                })
                ->withCount(['orders as order_count' => function ($q) use ($user) {
                    $q->whereHas('product', fn($q2) => $q2->where('farmer_id', $user->id))
                        ->whereIn('status', ['confirmed', 'completed', 'shipped', 'delivered']);
                }])
                ->withSum(['orders as total_spent' => function ($q) use ($user) {
                    $q->whereHas('product', fn($q2) => $q2->where('farmer_id', $user->id))
                        ->whereIn('status', ['confirmed', 'completed', 'shipped', 'delivered']);
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

            // Low stock alerts - calculate available stock properly
            $lowStockProducts = FarmProduct::where('farmer_id', $user->id)
                ->get()
                ->map(function ($product) {
                    $soldQuantity = $product->orders()
                        ->whereIn('status', ['confirmed', 'completed', 'shipped', 'delivered'])
                        ->sum('quantity');
                    $availableStock = max(0, $product->total_stock - $soldQuantity);
                    $product->available_stock = $availableStock;
                    return $product;
                })
                ->filter(function ($product) {
                    return $product->available_stock <= 10 && $product->available_stock > 0;
                })
                ->sortBy('available_stock')
                ->take(5);


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
                'totalAvailableStock',  // Add this new variable
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
            // Enhanced Buyer dashboard
            $dateRange = $request->get('range', '30');
            $startDate = Carbon::now()->subDays($dateRange);

            // Get buyer's orders with relationships
            $orders = ProductOrder::where('buyer_id', $user->id)
                ->where('created_at', '>=', $startDate)
                ->with(['product.farmer', 'product.category'])
                ->orderBy('created_at', 'desc')
                ->get();

            // Calculate buyer metrics
            $totalOrders = $orders->count();
            $totalSpent = $orders->sum('total_price');
            $averageOrderValue = $totalOrders > 0 ? $totalSpent / $totalOrders : 0;

            // Order status breakdown
            $pendingOrders = $orders->where('status', 'pending')->count();
            $completedOrders = $orders->where('status', 'delivered')->count();
            $processingOrders = $orders->where('status', 'processing')->count();
            $cancelledOrders = $orders->where('status', 'cancelled')->count();

            // Get unique farmers bought from
            $totalFarmers = $orders->pluck('product.farmer_id')->unique()->count();

            // Monthly spending data
            $monthlyLabels = [];
            $monthlyData = [];
            for ($i = 5; $i >= 0; $i--) {
                $date = Carbon::now()->subMonths($i);
                $label = $date->format('M Y');
                $spent = ProductOrder::where('buyer_id', $user->id)
                    ->whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->sum('total_price');
                $monthlyLabels[] = $label;
                $monthlyData[] = floatval($spent);
            }

            // Weekly spending data
            $weeklyLabels = [];
            $weeklyData = [];
            for ($i = 6; $i >= 0; $i--) {
                $date = Carbon::today()->subDays($i);
                $label = $date->format('M j');
                $spent = ProductOrder::where('buyer_id', $user->id)
                    ->whereDate('created_at', $date)
                    ->sum('total_price');
                $weeklyLabels[] = $label;
                $weeklyData[] = floatval($spent);
            }

            // Top purchased products
            $topProducts = ProductOrder::where('buyer_id', $user->id)
                ->select('product_id', DB::raw('COUNT(*) as order_count'), DB::raw('SUM(total_price) as total_spent'), DB::raw('SUM(quantity) as total_quantity'))
                ->with('product.farmer')
                ->groupBy('product_id')
                ->orderByDesc('total_spent')
                ->take(10)
                ->get();

            // Favorite farmers (most purchased from)
            $favoriteFarmers = User::whereHas('farmProducts.orders', function ($q) use ($user) {
                $q->where('buyer_id', $user->id);
            })
                ->withCount(['farmProducts as products_bought' => function ($q) use ($user) {
                    $q->whereHas('orders', function ($subQ) use ($user) {
                        $subQ->where('buyer_id', $user->id);
                    });
                }])
                ->with(['farmProducts' => function ($q) use ($user) {
                    $q->whereHas('orders', function ($subQ) use ($user) {
                        $subQ->where('buyer_id', $user->id);
                    })->with('orders');
                }])
                ->get()
                ->map(function ($farmer) use ($user) {
                    $totalSpent = 0;
                    foreach ($farmer->farmProducts as $product) {
                        $totalSpent += $product->orders()->where('buyer_id', $user->id)->sum('total_price');
                    }
                    $farmer->total_spent = $totalSpent;
                    return $farmer;
                })
                ->where('total_spent', '>', 0)
                ->sortByDesc('total_spent')
                ->take(10);


            // Recent orders for activity
            $recentOrders = ProductOrder::where('buyer_id', $user->id)
                ->with(['product.farmer'])
                ->latest()
                ->take(5)
                ->get();

            // Category spending breakdown
            $categorySpending = ProductOrder::where('buyer_id', $user->id)
                ->join('farm_products', 'product_orders.product_id', '=', 'farm_products.id')
                ->join('farm_product_categories', 'farm_products.category_id', '=', 'farm_product_categories.id')
                ->select('farm_product_categories.name as category_name', DB::raw('SUM(product_orders.total_price) as total_spent'))
                ->groupBy('farm_product_categories.id', 'farm_product_categories.name')
                ->orderByDesc('total_spent')
                ->take(5)
                ->get();

            return view('buyer-dashboard', compact(
                'orders',
                'totalOrders',
                'totalSpent',
                'averageOrderValue',
                'pendingOrders',
                'completedOrders',
                'processingOrders',
                'cancelledOrders',
                'totalFarmers',
                'monthlyLabels',
                'monthlyData',
                'weeklyLabels',
                'weeklyData',
                'topProducts',
                'favoriteFarmers',
                'recentOrders',
                'categorySpending'
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
                    ->whereIn('status', ['confirmed', 'completed', 'shipped', 'delivered'])
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
                    ->whereIn('status', ['confirmed', 'completed', 'shipped', 'delivered'])
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
