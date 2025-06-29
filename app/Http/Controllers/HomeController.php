<?php

namespace App\Http\Controllers;

use App\Models\FarmProduct;
use App\Models\User;
use App\Models\ProductOrder;
use App\Models\FarmProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // Get most selling products (based on total quantity ordered)
        $mostSellingProducts = FarmProduct::select('farm_products.*', DB::raw('COALESCE(SUM(product_orders.quantity), 0) as total_sold'))
            ->leftJoin('product_orders', 'farm_products.id', '=', 'product_orders.product_id')
            ->where('farm_products.status', 'published')
            ->with(['farmer', 'category'])
            ->groupBy('farm_products.id')
            ->orderBy('total_sold', 'desc')
            ->limit(8)
            ->get();

        // Get featured farmers (those with most products or orders)
        $featuredFarmers = User::where('role', 'farmer')
            ->withCount(['farmProducts', 'farmerOrders'])
            ->orderBy('farm_products_count', 'desc')
            ->limit(6)
            ->get();

        // Get all available locations (distinct farmer locations)
        $locations = User::where('role', 'farmer')
            ->whereNotNull('farm_location')
            ->distinct()
            ->pluck('farm_location')
            ->filter()
            ->sort()
            ->values();

        // Get platform statistics
        $stats = [
            'farmers_count' => User::where('role', 'farmer')->count(),
            'products_count' => FarmProduct::where('status', 'published')->count(),
            'transactions_count' => ProductOrder::count(),
            'locations_count' => $locations->count()
        ];

        return view('welcome', compact('mostSellingProducts', 'featuredFarmers', 'locations', 'stats'));
    }

    public function searchProducts(Request $request)
    {
        $query = $request->get('query', '');
        $location = $request->get('location', '');

        $products = FarmProduct::query()
            ->where('status', 'published')
            ->when($query, function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                    ->orWhere('description', 'like', "%{$query}%")
                    ->orWhere('tags', 'like', "%{$query}%");
            })
            ->when($location, function ($q) use ($location) {
                $q->whereHas('farmer', function ($subQ) use ($location) {
                    $subQ->where('farm_location', 'like', "%{$location}%");
                });
            })
            ->with(['farmer', 'category'])
            ->paginate(12);

        return response()->json($products);
    }

    public function getFarmersByLocation(Request $request)
    {
        $location = $request->get('location', 'all');

        $farmers = User::where('role', 'farmer')
            ->when($location !== 'all', function ($q) use ($location) {
                $q->where('farm_location', 'like', "%{$location}%");
            })
            ->withCount('farmProducts')
            ->orderBy('farm_products_count', 'desc')
            ->limit(6)
            ->get();

        return response()->json($farmers);
    }

    public function allProducts(Request $request)
    {
        $query = FarmProduct::where('status', 'published')
            ->with(['farmer', 'category']);

        // Search functionality
        if ($request->has('search') && $request->search) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                    ->orWhere('description', 'like', "%{$searchTerm}%")
                    ->orWhere('tags', 'like', "%{$searchTerm}%");
            });
        }

        // Category filter
        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        // Location filter
        if ($request->has('location') && $request->location) {
            $query->whereHas('farmer', function ($q) use ($request) {
                $q->where('farm_location', 'like', "%{$request->location}%");
            });
        }

        // Price range filter
        if ($request->has('min_price') && $request->min_price) {
            $query->where(function ($q) use ($request) {
                $q->where('selling_price', '>=', $request->min_price)
                    ->orWhere(function ($subQ) use ($request) {
                        $subQ->whereNull('selling_price')
                            ->where('unit_price', '>=', $request->min_price);
                    });
            });
        }

        if ($request->has('max_price') && $request->max_price) {
            $query->where(function ($q) use ($request) {
                $q->where('selling_price', '<=', $request->max_price)
                    ->orWhere(function ($subQ) use ($request) {
                        $subQ->whereNull('selling_price')
                            ->where('unit_price', '<=', $request->max_price);
                    });
            });
        }

        // Sorting
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'price_low':
                $query->orderByRaw('COALESCE(selling_price, unit_price) ASC');
                break;
            case 'price_high':
                $query->orderByRaw('COALESCE(selling_price, unit_price) DESC');
                break;
            case 'popular':
                $query->withCount('orders')
                    ->orderBy('orders_count', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        $products = $query->paginate(12);

        // Get filter data
        $categories = FarmProductCategory::withCount('publishedProducts')
            ->orderBy('name')
            ->get();

        $locations = User::where('role', 'farmer')
            ->whereNotNull('farm_location')
            ->distinct()
            ->pluck('farm_location')
            ->filter()
            ->sort()
            ->values();

        return view('products', compact('products', 'categories', 'locations'));
    }

    public function viewProduct($id)
    {
        $product = FarmProduct::with(['farmer', 'category', 'orders'])
            ->findOrFail($id);

        // Get related products
        $relatedProducts = FarmProduct::where('status', 'published')
            ->where('id', '!=', $product->id)
            ->where(function ($q) use ($product) {
                $q->where('category_id', $product->category_id)
                    ->orWhereHas('farmer', function ($subQ) use ($product) {
                        $subQ->where('id', $product->farmer_id);
                    });
            })
            ->with(['farmer', 'category'])
            ->limit(4)
            ->get();

        return view('product-details', compact('product', 'relatedProducts'));
    }

    public function viewFarmer($id)
    {
        $farmer = User::where('role', 'farmer')
            ->with(['farmProducts' => function ($query) {
                $query->where('status', 'published')
                    ->with('category')
                    ->orderBy('created_at', 'desc');
            }])
            ->withCount([
                'farmProducts as total_products' => function ($query) {
                    $query->where('status', 'published');
                },
                'farmerOrders as total_orders',
                'farmerOrders as completed_orders' => function ($query) {
                    $query->where('status', 'delivered');
                }
            ])
            ->findOrFail($id);

        // Get farmer's product categories
        $categories = FarmProductCategory::whereHas('products', function ($query) use ($farmer) {
            $query->where('farmer_id', $farmer->id)
                ->where('status', 'published');
        })->withCount(['products' => function ($query) use ($farmer) {
            $query->where('farmer_id', $farmer->id)
                ->where('status', 'published');
        }])->get();

        // Get farmer's recent orders/reviews (optional)
        $recentOrders = ProductOrder::whereHas('product', function ($query) use ($farmer) {
            $query->where('farmer_id', $farmer->id);
        })->with(['product', 'buyer'])
            ->where('status', 'delivered')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('farmer-details', compact('farmer', 'categories', 'recentOrders'));
    }
}
