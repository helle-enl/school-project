@extends('layouts.app')


@section('header')
    <div class="">
        <h2 class="page-title">
            <i class="fas fa-shopping-bag"></i>
            My Orders
        </h2>
        <p class="page-subtitle">Track and manage your purchases</p>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
        }

        .page-header {
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #2E7D32 0%, #4CAF50 100%);
            color: white;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 8px 32px rgba(46, 125, 50, 0.3);
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .page-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            font-weight: 300;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-primary {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            backdrop-filter: blur(10px);
        }

        .btn-primary:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .orders-grid {
            display: grid;
            gap: 25px;
            margin-bottom: 40px;
        }

        .order-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .order-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        }

        .order-header {
            background: linear-gradient(135deg, #2E7D32, #4CAF50);
            color: white;
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .order-id {
            font-size: 1.2rem;
            font-weight: 600;
        }

        .order-date {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .order-body {
            padding: 30px;
        }

        .order-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 25px;
        }

        .product-section {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .product-image {
            width: 80px;
            height: 80px;
            border-radius: 12px;
            background: linear-gradient(45deg, #4CAF50, #66BB6A);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            overflow: hidden;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-details h3 {
            color: #2E7D32;
            font-size: 1.3rem;
            margin-bottom: 5px;
        }

        .product-meta {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 5px;
        }

        .farmer-section {
            text-align: right;
        }

        .farmer-name {
            color: #2E7D32;
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 5px;
        }

        .farmer-location {
            color: #666;
            font-size: 0.9rem;
        }

        .order-summary {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .summary-item {
            text-align: center;
        }

        .summary-value {
            font-size: 1.3rem;
            font-weight: 700;
            color: #2E7D32;
            margin-bottom: 5px;
        }

        .summary-label {
            font-size: 0.8rem;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-pending {
            background: rgb(255, 193, 7);
            color: #f57c00;
        }

        .status-processing {
            background: rgba(33, 150, 243, 0.15);
            color: #1976d2;
        }

        .status-shipped {
            background: rgba(156, 39, 176, 0.15);
            color: #7b1fa2;
        }

        .status-delivered {
            background: rgba(76, 175, 80, 0.15);
            color: #388e3c;
        }

        .status-cancelled {
            background: rgba(244, 67, 54, 0.15);
            color: #d32f2f;
        }

        .order-actions {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
        }

        .btn-secondary {
            background: rgba(76, 175, 80, 0.1);
            color: #2E7D32;
            border: 1px solid rgba(76, 175, 80, 0.2);
        }

        .btn-secondary:hover {
            background: rgba(76, 175, 80, 0.2);
            transform: translateY(-1px);
        }

        .cancel-order {
            background: rgba(244, 67, 54, 0.1);
            color: #d32f2f;
            border: 1px solid rgba(244, 67, 54, 0.2);
        }

        .cancel-order:hover {
            background: rgba(244, 67, 54, 0.2);
            transform: translateY(-1px);
        }

        .empty-state {
            text-align: center;
            padding: 80px 20px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .empty-state i {
            font-size: 4rem;
            color: rgba(76, 175, 80, 0.3);
            margin-bottom: 20px;
        }

        .empty-state h3 {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 10px;
        }

        .empty-state p {
            color: #666;
            margin-bottom: 25px;
            line-height: 1.5;
        }

        /* Pagination */
        .pagination-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 40px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .page-header {
                flex-direction: column;
                gap: 20px;
                text-align: center;
            }

            .page-title {
                font-size: 2rem;
            }

            .order-info {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .farmer-section {
                text-align: left;
            }

            .order-summary {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .order-actions {
                flex-direction: column;
            }
        }
    </style>
@endsection

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        @if ($orders->count() > 0)
            <div class="orders-grid">
                @foreach ($orders as $order)
                    <div class="order-card">
                        <div class="order-header">
                            <div>
                                <div class="order-id">Order #{{ $order->id }}</div>
                                <div class="order-date">{{ $order->created_at->format('M j, Y \a\t g:i A') }}</div>
                            </div>
                            <span class="status-badge status-{{ strtolower($order->status) }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>

                        <div class="order-body">
                            <div class="order-info">
                                <div class="product-section">
                                    <div class="product-image">
                                        @if ($order->product->product_image)
                                            <img src="{{ asset('product_images/' . $order->product->product_image) }}"
                                                alt="{{ $order->product->name }}">
                                        @else
                                            <i class="fas fa-leaf"></i>
                                        @endif
                                    </div>
                                    <div class="product-details">
                                        <h3>{{ $order->product->name }}</h3>
                                        <div class="product-meta">
                                            <i class="fas fa-tag"></i>
                                            {{ $order->product->category->name ?? 'Uncategorized' }}
                                        </div>
                                        <div class="product-meta">
                                            <i class="fas fa-boxes"></i>
                                            {{ $order->quantity }} {{ $order->product->unit_of_measurement }}
                                        </div>
                                    </div>
                                </div>

                                <div class="farmer-section">
                                    <div class="farmer-name">
                                        <i class="fas fa-user"></i>
                                        {{ $order->product->farmer->farm_name ?? $order->product->farmer->first_name . ' ' . $order->product->farmer->last_name }}
                                    </div>
                                    <div class="farmer-location">
                                        <i class="fas fa-map-marker-alt"></i>
                                        {{ $order->product->farmer->farm_location ?? 'Nigeria' }}
                                    </div>
                                </div>
                            </div>

                            <div class="order-summary">
                                <div class="summary-item">
                                    <div class="summary-value">
                                        ₦{{ number_format($order->total_price) }}
                                    </div>
                                    <div class="summary-label">Total Amount</div>
                                </div>
                                <div class="summary-item">
                                    <div class="summary-value">
                                        {{ $order->quantity }} {{ $order->product->unit_of_measurement }}
                                    </div>
                                    <div class="summary-label">Quantity</div>
                                </div>
                                <div class="summary-item">
                                    <div class="summary-value">
                                        {{ $order->created_at->format('M j, Y') }}
                                    </div>
                                    <div class="summary-label">Order Date</div>
                                </div>
                            </div>

                            <div class="order-actions">
                                {{-- <a href="{{ route('buyer.orders.show', $order->id) }}" class="btn btn-secondary">
                                    <i class="fas fa-eye"></i>
                                    View Details
                                </a> --}}
                                @if (in_array($order->status, ['pending', 'processing']))
                                    <form action="{{ route('buyer.orders.cancel', $order->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn cancel-order">
                                            <i class="fas fa-times"></i>
                                            Cancel Order
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="pagination-wrapper">
                {{ $orders->links('custom.pagination') }}
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-shopping-cart"></i>
                <h3>No Orders Yet</h3>
                <p>You haven't placed any orders yet. Start shopping to see your order history here.</p>
                <a href="{{ route('products') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    Browse Products
                </a>
            </div>
        @endif
    </div>
@endsection
