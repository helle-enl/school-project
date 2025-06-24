<?php

namespace App\Http\Controllers;

use App\Models\FarmProduct;
use App\Models\FarmProductCategory;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class FarmProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        return view("farm-products.index")->with([
            'products' => FarmProduct::where('farmer_id', $request->user()->id)->orderBy('name')->paginate(6)
        ]);
    }

    public function all_categories(Request $request): View
    {
        // return view("farm-products.categories")->with([
        //     'categories' => FarmProductCategory::where('farmer_id', $request->user()->id)->orderBy('name')->paginate(10)
        // ]);
        return view("farm-products.categories")->with([
            'categories' => FarmProductCategory::where('farmer_id', $request->user()->id)->orderBy('name')->paginate(10)
        ]);
    }


    public function sales(FarmProduct $farmProduct)
    {
        $orders = $farmProduct->orders()->get();
        $unitsSold = $orders->sum('quantity');

        // return view('products.sales', [
        //     'product_id' => $productId,
        //     'units_sold' => $unitsSold,
        //     'orders' => $orders,
        // ]);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        return view("farm-products.create")->with([
            'categories' => FarmProductCategory::where('farmer_id', $request->user()->id)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create_category(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'farmer_id' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        // Update other fields
        $category = FarmProductCategory::create($validated);
        return redirect()->back()->with('success', 'Product Category created successfully!');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'farmer_id' => 'required|string|max:255',
            'category_id' => 'required|exists:farm_product_categories,id',
            'description' => 'nullable|string',
            'unit_of_measurement' => 'required|string|max:255',
            'unit_price' => 'required|string|max:20',
            'selling_price' => 'nullable|string|max:255',
            'total_stock' => 'nullable|string|max:255',
            'tags' => 'nullable|string|max:100',
            'status' => 'required|string|max:100',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,avif|max:2048',
        ]);




        // Handle file upload
        // if ($request->hasFile('product_image')) {
        //     $image = $request->file('product_image');
        //     $filename = time() . '_' . $image->getClientOriginalName();
        //     dd($filename);
        //     $path = $image->storeAs('/', $filename, 'public');

        //     $validated['product_image'] = $path;
        // }
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');

            if ($image->isValid()) {
                $filename = time() . '_' . $image->getClientOriginalName();
                $destination = public_path('product_images');

                // Move the file manually
                $image->move($destination, $filename);

                // Save relative path
                $validated['product_image'] = $filename;
            }
        }


        // Update other fields
        $product = FarmProduct::create($validated);
        return redirect()->route('farm-products.show', $product)->with('success', 'Product created successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Request $request, FarmProduct $farmProduct): View
    {
        // Basic sales data
        $totalUnitsSold = $farmProduct->orders->sum('quantity');
        $totalSales = $farmProduct->orders->sum('total_price');
        $totalRevenue = $totalSales; // Alias for consistency
        $totalCost = $farmProduct->unit_price * $totalUnitsSold;
        $totalProfit = ($totalSales - $totalCost);
        $netProfit = $totalProfit; // Alias for consistency

        // Calculate profit margin
        $profitMargin = $totalSales > 0 ? (($totalProfit / $totalSales) * 100) : 0;

        // Customer analytics
        $totalCustomers = $farmProduct->orders()
            ->distinct('buyer_id')
            ->count('buyer_id');

        $totalOrders = $farmProduct->orders->count();

        // Average order value
        $averageOrderValue = $totalOrders > 0 ? ($totalSales / $totalOrders) : 0;

        // Get top customers for this product
        $topCustomers = User::whereHas('orders', function ($query) use ($farmProduct) {
            $query->where('product_id', $farmProduct->id);
        })
            ->withCount(['orders as orders_count' => function ($query) use ($farmProduct) {
                $query->where('product_id', $farmProduct->id);
            }])
            ->withSum(['orders as total_spent' => function ($query) use ($farmProduct) {
                $query->where('product_id', $farmProduct->id);
            }], 'total_price')
            ->withSum(['orders as total_quantity' => function ($query) use ($farmProduct) {
                $query->where('product_id', $farmProduct->id);
            }], 'quantity')
            ->orderByDesc('total_spent')
            ->take(5)
            ->get();

        // Recent orders for this product
        $recentOrders = $farmProduct->orders()
            ->with('buyer')
            ->latest()
            ->take(10)
            ->get();

        // Calculate trends (comparing with previous month)
        $currentMonth = now()->startOfMonth();
        $previousMonth = now()->subMonth()->startOfMonth();

        $currentMonthSales = $farmProduct->orders()
            ->where('created_at', '>=', $currentMonth)
            ->sum('quantity');

        $previousMonthSales = $farmProduct->orders()
            ->whereBetween('created_at', [$previousMonth, $currentMonth])
            ->sum('quantity');

        $salesTrend = $previousMonthSales > 0 ?
            (($currentMonthSales - $previousMonthSales) / $previousMonthSales * 100) : 0;

        // Revenue trend
        $currentMonthRevenue = $farmProduct->orders()
            ->where('created_at', '>=', $currentMonth)
            ->sum('total_price');

        $previousMonthRevenue = $farmProduct->orders()
            ->whereBetween('created_at', [$previousMonth, $currentMonth])
            ->sum('total_price');

        $revenueTrend = $previousMonthRevenue > 0 ?
            (($currentMonthRevenue - $previousMonthRevenue) / $previousMonthRevenue * 100) : 0;

        // New customers this month
        $newCustomers = $farmProduct->orders()
            ->where('created_at', '>=', $currentMonth)
            ->distinct('buyer_id')
            ->count('buyer_id');

        // Repeat customers percentage
        $repeatCustomersCount = User::whereHas('orders', function ($query) use ($farmProduct) {
            $query->where('product_id', $farmProduct->id);
        })
            ->withCount(['orders as orders_count' => function ($query) use ($farmProduct) {
                $query->where('product_id', $farmProduct->id);
            }])
            ->having('orders_count', '>', 1)
            ->count();

        $repeatCustomers = $totalCustomers > 0 ?
            (($repeatCustomersCount / $totalCustomers) * 100) : 0;

        // Stock calculations
        $initialStock = $farmProduct->total_stock + $totalUnitsSold; // Estimated initial stock
        $stockValue = $farmProduct->total_stock * ($farmProduct->selling_price ?? $farmProduct->unit_price);

        // Performance metrics
        $conversionRate = 85; // This would need view/click tracking to calculate properly
        $demandScore = min((($totalUnitsSold / max($initialStock, 1)) * 100), 100);
        $stockTurnover = $initialStock > 0 ? ($totalUnitsSold / $initialStock) : 0;

        // Average rating (placeholder - would need a reviews system)
        $averageRating = 4.5; // Default rating
        $totalReviews = 0; // Default review count

        // Chart data for last 7 days
        $chartLabels = [];
        $chartData = [];
        $revenueData = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $chartLabels[] = $date->format('M j');

            $dayOrders = $farmProduct->orders()
                ->whereDate('created_at', $date)
                ->get();

            $chartData[] = $dayOrders->sum('quantity');
            $revenueData[] = $dayOrders->sum('total_price');
        }

        return view("farm-products.show")->with([
            'product' => $farmProduct,
            'categories' => FarmProductCategory::where('farmer_id', $request->user()->id)->get(),

            // Basic metrics
            'totalUnitsSold' => $totalUnitsSold,
            'totalSales' => $totalSales,
            'totalRevenue' => $totalRevenue,
            'totalCost' => $totalCost,
            'totalProfit' => $totalProfit,
            'netProfit' => $netProfit,
            'profitMargin' => round($profitMargin, 1),

            // Customer metrics
            'totalCustomers' => $totalCustomers,
            'totalOrders' => $totalOrders,
            'averageOrderValue' => $averageOrderValue,
            'topCustomers' => $topCustomers,
            'recentOrders' => $recentOrders,
            'newCustomers' => $newCustomers,
            'repeatCustomers' => round($repeatCustomers, 1),

            // Trends
            'salesTrend' => round($salesTrend, 1),
            'revenueTrend' => round($revenueTrend, 1),

            // Stock metrics
            'initialStock' => $initialStock,
            'stockValue' => number_format($stockValue, 2),

            // Performance metrics
            'conversionRate' => $conversionRate,
            'demandScore' => round($demandScore, 1),
            'stockTurnover' => round($stockTurnover, 1),
            'averageRating' => $averageRating,
            'totalReviews' => $totalReviews,

            // Chart data
            'chartLabels' => $chartLabels,
            'chartData' => $chartData,
            'revenueData' => $revenueData,
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, FarmProduct $farmProduct)
    {
        return view("farm-products.update")->with([
            'categories' => FarmProductCategory::where('farmer_id', $request->user()->id)->get(),
            'product' => $farmProduct,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FarmProduct $farmProduct)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'farmer_id' => 'required|string|max:255',
            'category_id' => 'required|exists:farm_product_categories,id',
            'description' => 'nullable|string',
            'unit_of_measurement' => 'required|string|max:255',
            'unit_price' => 'required|string|max:20',
            'selling_price' => 'nullable|string|max:255',
            'total_stock' => 'nullable|string|max:255',
            'tags' => 'nullable|string|max:100',
            'status' => 'required|string|max:100',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,avif|max:2048',
        ]);

        // Handle file upload
        // if ($request->hasFile('product_image')) {
        //     $image = $request->file('product_image');
        //     $filename = time() . '_' . $image->getClientOriginalName();
        //     $path = $image->storeAs('', $filename, 'product_images');

        //     // Optional: delete old image
        //     if ($farmProduct->product_image && Storage::disk('product_images')->exists($farmProduct->product_image)) {
        //         Storage::disk('product_images')->delete($farmProduct->product_image);
        //     }

        //     $validated['product_image'] = $path;
        // }

        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');

            if ($image->isValid()) {
                $filename = time() . '_' . $image->getClientOriginalName();
                $destination = public_path('product_images');

                // Delete old image if it exists
                if ($farmProduct->product_image) {
                    $oldPath = public_path('product_images/' . $farmProduct->product_image);
                    if (file_exists($oldPath)) {
                        @unlink($oldPath); // use @ to suppress warning if already gone
                    }
                }

                // Move new image
                $image->move($destination, $filename);

                // Save new filename
                $validated['product_image'] = $filename;
            }
        }




        // Update other fields
        $farmProduct->fill($validated);
        $farmProduct->save();
        return redirect()->back()->with('success', 'Product updated successfully!');
    }
    public function update_category(Request $request, FarmProductCategory $category): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        // Update other fields
        $category->update($validated);
        return redirect()->back()->with('success', 'Product Category updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FarmProduct $farmProduct)
    {
        $farmProduct->delete();
        return redirect()->route('farm-products.index')->with('success', 'Product deleted successfully!');
    }

    public function destroy_category(FarmProductCategory $category)
    {
        $category->delete();
        return redirect()->route('farm-products.index')->with('success', 'Category deleted successfully!');
    }
    /**
     * Get chart data for different time periods via AJAX
     */
    public function getChartData(Request $request, FarmProduct $farmProduct)
    {
        $period = $request->get('period', 7);
        $labels = [];
        $unitsData = [];
        $revenueData = [];

        for ($i = $period - 1; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $labels[] = $date->format($period <= 7 ? 'M j' : 'M j');

            $dayOrders = $farmProduct->orders()
                ->whereDate('created_at', $date)
                ->get();

            $unitsData[] = intval($dayOrders->sum('quantity'));
            $revenueData[] = floatval($dayOrders->sum('total_price'));
        }

        return response()->json([
            'labels' => $labels,
            'unitsData' => $unitsData,
            'revenueData' => $revenueData,
            'period' => $period,
            'success' => true
        ]);
    }

    /**
     * Update product stock via AJAX
     */
    public function updateStock(Request $request, FarmProduct $farmProduct)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'reason' => 'required|string|max:255'
        ]);

        try {
            $oldStock = $farmProduct->total_stock;
            $farmProduct->total_stock += $request->quantity;
            $farmProduct->save();

            // You could log this stock change to a separate table for audit trail
            // StockLog::create([
            //     'product_id' => $farmProduct->id,
            //     'farmer_id' => $farmProduct->farmer_id,
            //     'old_stock' => $oldStock,
            //     'quantity_change' => $request->quantity,
            //     'new_stock' => $farmProduct->total_stock,
            //     'reason' => $request->reason,
            //     'created_at' => now()
            // ]);

            return response()->json([
                'success' => true,
                'message' => 'Stock updated successfully',
                'new_stock' => $farmProduct->total_stock,
                'quantity_added' => $request->quantity
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update stock: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update product price via AJAX
     */
    public function updatePrice(Request $request, FarmProduct $farmProduct)
    {
        $request->validate([
            'price' => 'required|numeric|min:0',
            'reason' => 'required|string|max:255'
        ]);

        try {
            $oldPrice = $farmProduct->selling_price ?? $farmProduct->unit_price;
            $farmProduct->selling_price = $request->price;
            $farmProduct->save();

            // Calculate new profit margin
            $costPrice = $farmProduct->unit_price;
            $newMargin = $request->price > 0 ? (($request->price - $costPrice) / $request->price * 100) : 0;

            // You could log this price change to a separate table for audit trail
            // PriceLog::create([
            //     'product_id' => $farmProduct->id,
            //     'farmer_id' => $farmProduct->farmer_id,
            //     'old_price' => $oldPrice,
            //     'new_price' => $request->price,
            //     'reason' => $request->reason,
            //     'created_at' => now()
            // ]);

            return response()->json([
                'success' => true,
                'message' => 'Price updated successfully',
                'new_price' => $farmProduct->selling_price,
                'old_price' => $oldPrice,
                'new_margin' => round($newMargin, 2)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update price: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Toggle product status (active/inactive)
     */
    public function toggleStatus(Request $request, FarmProduct $farmProduct)
    {
        try {
            $newStatus = $farmProduct->status === 'active' ? 'inactive' : 'active';
            $farmProduct->status = $newStatus;
            $farmProduct->save();

            return response()->json([
                'success' => true,
                'message' => 'Product status updated successfully',
                'new_status' => $newStatus,
                'status_label' => ucfirst($newStatus)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update status: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Generate and export product report
     */
    public function exportReport(Request $request, FarmProduct $farmProduct)
    {
        try {
            // Gather all the data needed for the report
            $totalUnitsSold = $farmProduct->orders->sum('quantity');
            $totalRevenue = $farmProduct->orders->sum('total_price');
            $totalCost = $farmProduct->unit_price * $totalUnitsSold;
            $totalProfit = $totalRevenue - $totalCost;
            $profitMargin = $totalRevenue > 0 ? (($totalProfit / $totalRevenue) * 100) : 0;

            $totalCustomers = $farmProduct->orders()
                ->distinct('buyer_id')
                ->count('buyer_id');

            $totalOrders = $farmProduct->orders->count();
            $averageOrderValue = $totalOrders > 0 ? ($totalRevenue / $totalOrders) : 0;

            // Generate CSV content
            $filename = $farmProduct->name . '_report_' . date('Y-m-d') . '.csv';

            $headers = [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
                'Cache-Control' => 'no-cache, no-store, must-revalidate',
                'Pragma' => 'no-cache',
                'Expires' => '0'
            ];

            $callback = function () use ($farmProduct, $totalUnitsSold, $totalRevenue, $totalProfit, $profitMargin, $totalCustomers, $totalOrders, $averageOrderValue) {
                $file = fopen('php://output', 'w');

                // Add BOM for UTF-8
                fwrite($file, "\xEF\xBB\xBF");

                // Report header
                fputcsv($file, ['Product Performance Report']);
                fputcsv($file, ['Generated on: ' . date('Y-m-d H:i:s')]);
                fputcsv($file, ['']); // Empty row

                // Product Information
                fputcsv($file, ['PRODUCT INFORMATION']);
                fputcsv($file, ['Product Name', $farmProduct->name]);
                fputcsv($file, ['Category', $farmProduct->category->name ?? 'Uncategorized']);
                fputcsv($file, ['Current Price', '₦' . number_format($farmProduct->selling_price ?? $farmProduct->unit_price, 2)]);
                fputcsv($file, ['Unit of Measurement', $farmProduct->unit_of_measurement]);
                fputcsv($file, ['Current Stock', $farmProduct->total_stock]);
                fputcsv($file, ['Status', ucfirst($farmProduct->status ?? 'Active')]);
                fputcsv($file, ['']); // Empty row

                // Sales Performance
                fputcsv($file, ['SALES PERFORMANCE']);
                fputcsv($file, ['Total Units Sold', $totalUnitsSold]);
                fputcsv($file, ['Total Revenue', '₦' . number_format($totalRevenue, 2)]);
                fputcsv($file, ['Total Profit', '₦' . number_format($totalProfit, 2)]);
                fputcsv($file, ['Profit Margin', number_format($profitMargin, 2) . '%']);
                fputcsv($file, ['Total Orders', $totalOrders]);
                fputcsv($file, ['Total Customers', $totalCustomers]);
                fputcsv($file, ['Average Order Value', '₦' . number_format($averageOrderValue, 2)]);
                fputcsv($file, ['']); // Empty row

                // Recent Orders
                fputcsv($file, ['RECENT ORDERS']);
                fputcsv($file, ['Order ID', 'Customer', 'Quantity', 'Total Price', 'Status', 'Date']);

                $recentOrders = $farmProduct->orders()
                    ->with('buyer')
                    ->latest()
                    ->take(20)
                    ->get();

                foreach ($recentOrders as $order) {
                    fputcsv($file, [
                        '#' . $order->id,
                        ($order->buyer->first_name ?? '') . ' ' . ($order->buyer->last_name ?? ''),
                        $order->quantity,
                        '₦' . number_format($order->total_price, 2),
                        ucfirst($order->status ?? 'Pending'),
                        $order->created_at->format('Y-m-d H:i')
                    ]);
                }

                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to generate report: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Duplicate a product
     */
    public function duplicateProduct(Request $request, FarmProduct $farmProduct)
    {
        try {
            $newProduct = $farmProduct->replicate();
            $newProduct->name = $farmProduct->name . ' (Copy)';
            $newProduct->total_stock = 0; // Reset stock for duplicated product
            $newProduct->created_at = now();
            $newProduct->updated_at = now();
            $newProduct->save();

            return response()->json([
                'success' => true,
                'message' => 'Product duplicated successfully',
                'new_product_id' => $newProduct->id,
                'redirect_url' => route('farm-products.show', $newProduct)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to duplicate product: ' . $e->getMessage()
            ], 500);
        }
    }
}
