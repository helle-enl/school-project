@extends('layouts.app')

@section('header')
    <div class="order-detail-header">
        <div class="header-navigation">
            <a href="{{ route('orders.index') }}" class="back-btn">
                <i class="fas fa-arrow-left"></i>
                Back to Orders
            </a>
            <div class="breadcrumb">
                <span>Orders</span>
                <i class="fas fa-chevron-right"></i>
                <span>Order #{{ $order->id }}</span>
            </div>
        </div>
        <div class="order-header-content">
            <div class="order-main-info">
                <div class="info-item">
                    <div class="info-label">Order ID</div>
                    <div class="info-value">#{{ $order->id }}</div>
                    <div class="info-sub">{{ $order->created_at->format('M j, Y g:i A') }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Customer</div>
                    <div class="info-value">{{ $order->buyer->first_name }} {{ $order->buyer->last_name }}</div>
                    <div class="info-sub">{{ $order->buyer->email }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Product</div>
                    <div class="info-value">{{ $order->product->name }}</div>
                    <div class="info-sub">₦{{ number_format($order->product->selling_price, 2) }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Quantity</div>
                    <div class="info-value">{{ $order->quantity }}</div>
                    <div class="info-sub">Items</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Total Amount</div>
                    <div class="info-value">₦{{ number_format($order->total_price, 2) }}</div>
                    <div class="info-sub">Final Price</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Status</div>
                    <div class="info-value">
                        <span class="status-badge status-{{ strtolower($order->status) }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="header-actions">
                <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i>
                    Edit Order
                </a>
            </div>
        </div>

    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Custom styles for the order details page */
        .order-detail-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px 20px;
            width: 100%
        }

        .order-detail-header {
            background: linear-gradient(135deg, #2E7D32 0%, #4CAF50 100%);
            color: white;
            padding: 40px;
            border-radius: 0px;
            margin-bottom: 40px;
            box-shadow: 0 15px 50px rgba(46, 125, 50, 0.3);
            position: relative;
            overflow: hidden;
        }

        .order-detail-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            0% {
                transform: translateX(-100%) translateY(-100%) rotate(45deg);
            }

            100% {
                transform: translateX(100%) translateY(100%) rotate(45deg);
            }
        }

        .header-navigation {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            position: relative;
            z-index: 2;
        }

        .back-btn {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 20px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            font-weight: 600;
        }

        .back-btn:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateX(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.95rem;
            opacity: 0.9;
            background: rgba(255, 255, 255, 0.1);
            padding: 8px 16px;
            border-radius: 20px;
            backdrop-filter: blur(10px);
        }

        .order-header-content {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 40px;
            align-items: start;
            position: relative;
            z-index: 2;
        }

        .order-main-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 25px;
            color: white;
        }

        .info-item {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            padding: 20px;
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .info-item:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-3px);
        }

        .info-label {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: 0.8;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .info-value {
            font-size: 1.2rem;
            font-weight: 700;
            line-height: 1.3;
        }

        .info-sub {
            font-size: 0.9rem;
            opacity: 0.8;
            margin-top: 4px;
            font-weight: 400;
        }

        .header-actions {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .btn {
            padding: 15px 25px;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            cursor: pointer;
            font-size: 0.95rem;
            white-space: nowrap;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn-warning {
            background: linear-gradient(135deg, #FF9800, #F57C00);
            color: white;
            box-shadow: 0 8px 25px rgba(255, 152, 0, 0.3);
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.2);
        }

        .btn-warning:hover {
            box-shadow: 0 12px 35px rgba(255, 152, 0, 0.4);
        }

        /* Detail Cards Section */
        .detail-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }

        .detail-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .detail-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #4CAF50, #2196F3);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .detail-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }

        .detail-card:hover::before {
            opacity: 1;
        }

        .card-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: #2E7D32;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-content {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-label {
            font-size: 0.9rem;
            color: #666;
            font-weight: 500;
        }

        .detail-value {
            font-size: 1rem;
            font-weight: 600;
            color: #2E7D32;
        }

        .status-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-pending {
            background: linear-gradient(135deg, #FF9800, #FFB74D);
            color: white;
        }

        .status-completed {
            background: linear-gradient(135deg, #4CAF50, #66BB6A);
            color: white;
        }

        .status-cancelled {
            background: linear-gradient(135deg, #F44336, #EF5350);
            color: white;
        }

        .price-highlight {
            font-size: 1.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #2E7D32, #4CAF50);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        @media (max-width: 768px) {
            .order-header-content {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .order-main-info {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
                gap: 15px;
            }

            .header-actions {
                flex-direction: row;
                justify-content: center;
            }

            .detail-cards {
                grid-template-columns: 1fr;
                gap: 20px;
            }
        }

        /* Action Section Styles */
        .action-section {
            margin-top: 40px;
        }

        .action-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }

        .action-buttons {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .action-btn {
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid rgba(76, 175, 80, 0.2);
            border-radius: 15px;
            padding: 20px;
            text-decoration: none;
            color: #2E7D32;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .action-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(76, 175, 80, 0.1), transparent);
            transition: left 0.5s;
        }

        .action-btn:hover::before {
            left: 100%;
        }

        .action-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
            border-color: #4CAF50;
        }

        .action-btn i {
            font-size: 1.5rem;
            margin-bottom: 5px;
        }

        .action-btn span {
            font-weight: 600;
            font-size: 1rem;
        }

        .action-btn small {
            font-size: 0.8rem;
            opacity: 0.7;
            text-align: center;
        }

        .btn-edit {
            border-color: rgba(255, 152, 0, 0.3);
            color: #FF9800;
        }

        .btn-edit:hover {
            border-color: #FF9800;
            background: rgba(255, 152, 0, 0.05);
        }

        .btn-print {
            border-color: rgba(33, 150, 243, 0.3);
            color: #2196F3;
        }

        .btn-print:hover {
            border-color: #2196F3;
            background: rgba(33, 150, 243, 0.05);
        }

        .btn-back {
            border-color: rgba(96, 125, 139, 0.3);
            color: #607D8B;
        }

        .btn-back:hover {
            border-color: #607D8B;
            background: rgba(96, 125, 139, 0.05);
        }

        .btn-complete {
            border-color: rgba(76, 175, 80, 0.3);
            color: #4CAF50;
        }

        .btn-complete:hover {
            border-color: #4CAF50;
            background: rgba(76, 175, 80, 0.05);
        }
    </style>
@endsection

@section('content')
    <div class="order-detail-container">
        <div class="detail-cards">
            <!-- Customer Information Card -->
            <div class="detail-card">
                <h3 class="card-title">
                    <i class="fas fa-user"></i>
                    Customer Information
                </h3>
                <div class="card-content">
                    <div class="detail-row">
                        <span class="detail-label">Full Name:</span>
                        <span class="detail-value">{{ $order->buyer->first_name }} {{ $order->buyer->last_name }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Email Address:</span>
                        <span class="detail-value">{{ $order->buyer->email }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Customer Since:</span>
                        <span class="detail-value">{{ $order->buyer->created_at->format('M j, Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Product Information Card -->
            <div class="detail-card">
                <h3 class="card-title">
                    <i class="fas fa-box"></i>
                    Product Details
                </h3>
                <div class="card-content">
                    <div class="detail-row">
                        <span class="detail-label">Product Name:</span>
                        <span class="detail-value">{{ $order->product->name }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Unit Price:</span>
                        <span class="detail-value">₦{{ number_format($order->product->selling_price, 2) }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Quantity Ordered:</span>
                        <span class="detail-value">{{ $order->quantity }}
                            {{ Str::plural('item', $order->quantity) }}</span>
                    </div>
                    @if (isset($order->product->description))
                        <div class="detail-row">
                            <span class="detail-label">Description:</span>
                            <span class="detail-value">{{ Str::limit($order->product->description, 50) }}</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Order Summary Card -->
            <div class="detail-card">
                <h3 class="card-title">
                    <i class="fas fa-receipt"></i>
                    Order Summary
                </h3>
                <div class="card-content">
                    <div class="detail-row">
                        <span class="detail-label">Order Date:</span>
                        <span class="detail-value">{{ $order->created_at->format('M j, Y g:i A') }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Order Status:</span>
                        <span class="detail-value">
                            <span class="status-badge status-{{ strtolower($order->status) }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Last Updated:</span>
                        <span class="detail-value">{{ $order->updated_at->format('M j, Y g:i A') }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Order Duration:</span>
                        <span class="detail-value">{{ $order->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>

            <!-- Payment Information Card -->
            {{-- <div class="detail-card">
                <h3 class="card-title">
                    <i class="fas fa-credit-card"></i>
                    Payment Information
                </h3>
                <div class="card-content">
                    <div class="detail-row">
                        <span class="detail-label">Subtotal:</span>
                        <span
                            class="detail-value">₦{{ number_format($order->product->selling_price * $order->quantity, 2) }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Tax & Fees:</span>
                        <span class="detail-value">₦0.00</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Discount:</span>
                        <span class="detail-value">₦0.00</span>
                    </div>
                    <div class="detail-row" style="border-top: 2px solid #4CAF50; padding-top: 15px; margin-top: 15px;">
                        <span class="detail-label" style="font-weight: 700; color: #2E7D32;">Total Amount:</span>
                        <span class="detail-value price-highlight">₦{{ number_format($order->total_price, 2) }}</span>
                    </div>
                </div>
            </div> --}}
        </div>

        <!-- Action Buttons Section -->
        <div class="action-section">
            <div class="action-card">
                <h3 class="card-title">
                    <i class="fas fa-cogs"></i>
                    Order Actions
                </h3>
                <div class="action-buttons">
                    <a href="{{ route('orders.edit', $order->id) }}" class="action-btn btn-edit">
                        <i class="fas fa-edit"></i>
                        <span>Edit Order</span>
                        <small>Modify order details</small>
                    </a>

                    <button class="action-btn btn-print" onclick="window.print()">
                        <i class="fas fa-print"></i>
                        <span>Print Order</span>
                        <small>Generate printable version</small>
                    </button>

                    <a href="{{ route('orders.index') }}" class="action-btn btn-back">
                        <i class="fas fa-arrow-left"></i>
                        <span>Back to Orders</span>
                        <small>Return to order list</small>
                    </a>

                    @if ($order->status !== 'completed')
                        <button class="action-btn btn-complete" onclick="updateOrderStatus('completed')">
                            <i class="fas fa-check-circle"></i>
                            <span>Mark Complete</span>
                            <small>Set order as completed</small>
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Custom scripts for the order details page
        document.addEventListener('DOMContentLoaded', function() {
            // Add smooth scrolling for better UX
            const cards = document.querySelectorAll('.detail-card');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
                card.classList.add('fade-in');
            });

            // Add print styles
            const printStyles = `
            @media print {
                .header-actions, .action-section, .back-btn { display: none !important; }
                .order-detail-header { background: #4CAF50 !important; -webkit-print-color-adjust: exact; }
                .detail-cards { grid-template-columns: 1fr 1fr !important; }
                body { font-size: 12px; }
            }
        `;
            const styleSheet = document.createElement('style');
            styleSheet.textContent = printStyles;
            document.head.appendChild(styleSheet);
        });

        // Function to update order status
        function updateOrderStatus(status) {
            if (confirm(`Are you sure you want to mark this order as ${status}?`)) {
                // Here you would typically make an AJAX request to update the status
                // For now, we'll just show an alert
                alert(`Order status will be updated to ${status}`);
                // You can implement the actual AJAX call here:
                // fetch(`/orders/{{ $order->id }}/status`, { method: 'PATCH', ... })
            }
        }

        // Add fade-in animation class
        const style = document.createElement('style');
        style.textContent = `
        .fade-in {
            animation: fadeInUp 0.6s ease forwards;
            opacity: 0;
            transform: translateY(20px);
        }
        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    `;
        document.head.appendChild(style);
    </script>
@endsection
