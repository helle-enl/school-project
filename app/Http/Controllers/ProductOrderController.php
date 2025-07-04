<?php

namespace App\Http\Controllers;

use App\Models\ProductOrder;
use App\Models\FarmProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmationMail;
use App\Mail\NewOrderNotificationMail;
use App\Mail\OrderCancelledNotificationMail;
use App\Models\User;


class ProductOrderController extends Controller
{

    public function store(Request $request)
    {
        $validated = $request->validate([
            'buyer_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:farm_products,id',
            'quantity' => 'required|integer|min:1',
            'note' => 'nullable|string',
            'tracking_number' => 'nullable|string',
            'shipping_address' => 'nullable|string',
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

        // Send confirmation email to buyer
        Mail::to($order->buyer->email)->send(new OrderConfirmationMail($order));

        // Send notification email to farmer
        Mail::to($order->farmer->email)->send(new NewOrderNotificationMail($order));

        return redirect()->route('dashboard')->with([
            'success' => 'Your Order has been received and will be processed shortly',
            'data' => $order,
        ]);
        // return response()->json([
        //     'success' => true,
        //     'data' => $order,
        // ]);
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

    public function index(Request $request)
    {
        $orders = ProductOrder::where('farmer_id', $request->user()->id)->orderBy('created_at')->paginate(6);

        return view('orders.index', [
            'orders' => $orders,
        ]);
    }

    public function show($id)
    {
        $order = ProductOrder::findOrFail($id);

        return view('orders.show', [
            'order' => $order,
        ]);
    }

    public function edit($id)
    {
        $order = ProductOrder::findOrFail($id);

        return view('orders.edit', [
            'order' => $order,
        ]);
    }

    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            'note' => 'nullable|string',
            'tracking_number' => 'nullable|string',
            'shipping_address' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled,completed',
        ]);

        $order = ProductOrder::findOrFail($id);
        $order->update($validated);

        return redirect()->route('orders.show', $order->id)
            ->with('success', 'Order updated successfully');
    }

    public function destroy($id)
    {
        $order = ProductOrder::findOrFail($id);
        $order->delete();

        return redirect()->route('orders.index')
            ->with('success', 'Order deleted successfully');
    }

    /**
     * Display buyer's orders
     */
    public function buyerIndex(Request $request)
    {
        $orders = ProductOrder::where('buyer_id', $request->user()->id)
            ->with(['product.farmer', 'product.category'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('buyer.orders.index', compact('orders'));
    }

    /**
     * Show specific order for buyer
     */
    public function buyerShow(Request $request, $id)
    {
        $order = ProductOrder::where('buyer_id', $request->user()->id)
            ->where('id', $id)
            ->with(['product.farmer', 'product.category'])
            ->firstOrFail();

        return view('buyer.orders.show', compact('order'));
    }

    /**
     * Cancel order (buyer only)
     */
    public function buyerCancel(Request $request, $id)
    {
        $order = ProductOrder::where('buyer_id', $request->user()->id)
            ->where('id', $id)
            ->firstOrFail();

        // Only allow cancellation of pending or processing orders
        if (!in_array($order->status, ['pending', 'processing'])) {
            return redirect()->back()->with('error', 'This order cannot be cancelled.');
        }

        $order->update(['status' => 'cancelled']);

        // Send notification email to farmer
        Mail::to($order->farmer->email)->send(new OrderCancelledNotificationMail($order));

        return redirect()->route('buyer.orders.index')
            ->with('success', 'Order has been cancelled successfully.');
    }
}
