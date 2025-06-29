<!DOCTYPE html>
<html>

<head>
    <title>Order Confirmation</title>
</head>

<body>
    <h1>Order Confirmation - #{{ $order->id }}</h1>

    <p>Dear {{ $order->buyer->first_name }},</p>

    <p>Thank you for your order! We're excited to confirm that your order has been placed successfully.</p>

    <h3>Order Details:</h3>
    <ul>
        <li><strong>Product:</strong> {{ $order->product->name }}</li>
        <li><strong>Quantity:</strong> {{ $order->quantity }} {{ $order->product->unit }}</li>
        <li><strong>Unit Price:</strong> ${{ number_format($order->unit_price, 2) }}</li>
        <li><strong>Total Price:</strong> ${{ number_format($order->total_price, 2) }}</li>
        <li><strong>Status:</strong> {{ ucfirst($order->status) }}</li>
    </ul>

    <h3>Farmer Information:</h3>
    <p><strong>Farm:</strong> {{ $order->farmer->farm_name }}</p>
    <p><strong>Location:</strong> {{ $order->farmer->farm_location }}</p>

    <p>The farmer has been notified of your order and will begin processing it shortly. You will receive updates as your
        order progresses.</p>

    <p>Thank you for supporting local agriculture!</p>
    <p> &copy; {{ now()->year }} FarmConnect Nigeria. All rights reserved.</p>
</body>

</html>
