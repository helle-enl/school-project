<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Cancelled Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            text-align: center;
            padding: 20px 0;
        }

        .email-header h1 {
            color: #2E7D32;
            font-size: 24px;
            margin: 0;
        }

        .email-body {
            padding: 20px;
        }

        .email-body p {
            color: #333;
            font-size: 16px;
            line-height: 1.6;
        }

        .order-details {
            margin-top: 20px;
            padding: 15px;
            background-color: #f0f8ff;
            border-radius: 8px;
        }

        .order-details p {
            margin: 5px 0;
        }

        .email-footer {
            text-align: center;
            padding: 10px 0;
            color: #666;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Order Cancelled Notification</h1>
        </div>
        <div class="email-body">
            <p>Dear {{ $order->farmer->first_name }},</p>
            <p>We regret to inform you that the following order has been cancelled by the buyer:</p>
            <div class="order-details">
                <p><strong>Order ID:</strong> #{{ $order->id }}</p>
                <p><strong>Product:</strong> {{ $order->product->name }}</p>
                <p><strong>Quantity:</strong> {{ $order->quantity }}</p>
                <p><strong>Total Price:</strong> ₦{{ number_format($order->total_price) }}</p>
                <p><strong>Buyer:</strong> {{ $order->buyer->first_name }} {{ $order->buyer->last_name }}</p>
            </div>
            <p>Please update your records accordingly. If you have any questions or need further information, feel free
                to contact the buyer directly.</p>
        </div>
        <div class="email-footer">
            <p>&copy; {{ date('Y') }} FarmConnect Nigeria. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
