<!DOCTYPE html>
<html>

<head>
    <title>New Order Received</title>
</head>

<body>
    <h1>New Order Received - #{{ $order->id }}</h1>

    <p>Dear {{ $order->farmer->first_name }},</p>

    <p>Great news! You have received a new order for your product.</p>

    <h3>Order Details:</h3>
    <ul>
        <li><strong>Product:</strong> {{ $order->product->name }}</li>
        <li><strong>Quantity:</strong> {{ $order->quantity }} {{ $order->product->unit }}</li>
        <li><strong>Unit Price:</strong> ${{ number_format($order->unit_price, 2) }}</li>
        <li><strong>Total Amount:</strong> ${{ number_format($order->total_price, 2) }}</li>
    </ul>

    <h3>Buyer Information:</h3>
    <p><strong>Name:</strong> {{ $order->buyer->first_name }} {{ $order->buyer->last_name }}</p>
    <p><strong>Email:</strong> {{ $order->buyer->email }}</p>
    <p><strong>WhatsApp:</strong> {{ $order->buyer->whatsapp_number }}</p>

    <p>Please log in to your dashboard to view the full order details and update the order status as you process it.</p>

    <p>Thank you for being part of our agricultural marketplace!</p>
    <p> &copy; {{ now()->year }} FarmConnect Nigeria. All rights reserved.</p>
</body>

</html>
