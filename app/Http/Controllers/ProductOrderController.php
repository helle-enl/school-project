<?php

namespace App\Http\Controllers;

use App\Models\ProductOrder;
use App\Models\FarmProduct;
use Illuminate\Http\Request;

class ProductOrderController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'buyer_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:farm_products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = FarmProduct::findOrFail($validated['product_id']);

        $order = ProductOrder::create([
            'buyer_id' => $validated['buyer_id'],
            'farmer_id' => $product->farmer_id,
            'product_id' => $product->id,
            'quantity' => $validated['quantity'],
            'unit_price' => $product->selling_price ?? $product->unit_price,
            'total_price' => ($product->selling_price ?? $product->unit_price) * $validated['quantity'],
            'status' => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'data' => $order,
        ]);
    }

    public function productSales($productId)
    {
        $orders = ProductOrder::where('product_id', $productId)->get();
        $unitsSold = $orders->sum('quantity');

        return view('products.sales', [
            'product_id' => $productId,
            'units_sold' => $unitsSold,
            'orders' => $orders,
        ]);
    }
}
