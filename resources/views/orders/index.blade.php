@extends('layouts.app')

@section('header')
    <div class="orders-header">
        <div class="header-content">
            <h2 class="page-title">
                <i class="fas fa-shopping-cart"></i>
                Manage Orders
            </h2>
            <p class="page-subtitle" style="color:white">View and manage all orders placed by customers</p>
        </div>
        <div class="header-actions">
            <button class="btn btn-secondary" id="filterToggle">
                <i class="fas fa-filter"></i>
                Filters
            </button>
        </div>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Custom styles for the orders page */

        .orders-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 30px 20px;
        }

        .orders-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(135deg, #2E7D32 0%, #4CAF50 100%);
            color: white;
            padding: 30px;
            border-radius: 0px;
            margin-bottom: 30px;
            box-shadow: 0 8px 32px rgba(46, 125, 50, 0.3);
        }

        .orders-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            margin-bottom: 40px;
        }

        @media (max-width: 768px) {
            .orders-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
        }



        .order-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
        }

        .order-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #4CAF50, #2196F3, #FF9800);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .order-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }

        .order-card:hover::before {
            opacity: 1;
        }

        .order-info {
            padding: 30px;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(248, 250, 252, 0.9));
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid rgba(76, 175, 80, 0.1);
        }

        .order-id-group {
            flex: 1;
        }

        .order-id {
            font-size: 1.8rem;
            font-weight: 700;
            background: linear-gradient(135deg, #2E7D32, #4CAF50);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 5px;
        }

        .order-date {
            font-size: 0.9rem;
            color: #666;
            font-weight: 500;
        }

        .order-status {
            padding: 8px 16px;
            border-radius: 25px;
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

        .order-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 25px;
        }

        .info-group {
            background: rgba(255, 255, 255, 0.7);
            padding: 20px;
            border-radius: 15px;
            border: 1px solid rgba(76, 175, 80, 0.1);
            transition: all 0.3s ease;
        }

        .info-group:hover {
            background: rgba(255, 255, 255, 0.9);
            transform: translateY(-2px);
        }

        .info-label {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #666;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .info-value {
            font-size: 1.1rem;
            font-weight: 600;
            color: #2E7D32;
            line-height: 1.3;
        }

        .buyer-info {
            grid-column: 1 / -1;
            background: linear-gradient(135deg, rgba(33, 150, 243, 0.1), rgba(100, 181, 246, 0.1));
            border: 1px solid rgba(33, 150, 243, 0.2);
        }

        .product-info {
            grid-column: 1 / -1;
            background: linear-gradient(135deg, rgba(76, 175, 80, 0.1), rgba(129, 199, 132, 0.1));
            border: 1px solid rgba(76, 175, 80, 0.2);
        }

        .order-summary {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(135deg, rgba(46, 125, 50, 0.1), rgba(76, 175, 80, 0.1));
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 20px;
            border: 2px solid rgba(76, 175, 80, 0.2);
        }

        .quantity-display {
            text-align: center;
        }

        .quantity-value {
            font-size: 2rem;
            font-weight: 700;
            color: #2E7D32;
            display: block;
        }

        .quantity-label {
            font-size: 0.8rem;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .total-display {
            text-align: right;
        }

        .total-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2E7D32;
            display: block;
        }

        .total-label {
            font-size: 0.8rem;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .order-actions {
            display: flex;
            gap: 15px;
            padding: 25px 30px;
            background: linear-gradient(135deg, rgba(248, 250, 252, 0.9), rgba(255, 255, 255, 0.9));
            border-top: 1px solid rgba(0, 0, 0, 0.05);
        }

        .order-actions a {
            /* padding: 8px 16px; */
            font-size: 0.85rem;
            font-weight: 600;
            border-radius: 6px;
            text-decoration: none;
            color: white;
            transition: background 0.2s ease;
            text-wrap: nowrap;
        }

        .btn {
            flex: 1;
            padding: 12px 20px;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            cursor: pointer;
            font-size: 0.95rem;
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

        .btn-info {
            background: linear-gradient(135deg, #2196F3, #1976D2);
            color: white;
            box-shadow: 0 4px 15px rgba(33, 150, 243, 0.3);
        }

        .btn-warning {
            background: linear-gradient(135deg, #FF9800, #F57C00);
            color: white;
            box-shadow: 0 4px 15px rgba(255, 152, 0, 0.3);
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .btn-info:hover {
            box-shadow: 0 8px 25px rgba(33, 150, 243, 0.4);
        }

        .btn-warning:hover {
            box-shadow: 0 8px 25px rgba(255, 152, 0, 0.4);
        }

        @media (max-width: 768px) {
            .order-content {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .buyer-info {
                grid-column: 1;
            }

            .order-summary {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            .order-actions {
                flex-direction: column;
                gap: 10px;
            }

        }
    </style>
@endsection

@section('content')
    <div class="orders-container">
        <!-- Search and Filter Section -->
        <div class="search-filter-section">
            <!-- Add search and filter functionality -->
        </div>

        <!-- Orders Grid -->
        <div class="orders-grid">
            @forelse($orders as $order)
                <div class="order-card">
                    <div class="order-info">
                        <div class="order-header">
                            <div class="order-id-group">
                                <div class="order-id">#{{ $order->id }}</div>
                                <div class="order-date">{{ $order->created_at->format('M j, Y g:i A') }}</div>
                            </div>
                            <div class="order-status status-{{ strtolower($order->status) }}">
                                {{ ucfirst($order->status) }}
                            </div>
                        </div>

                        <div class="order-content">
                            <div class="info-group buyer-info">
                                <div class="info-label">Customer</div>
                                <div class="info-value">
                                    {{ $order->buyer->first_name }} {{ $order->buyer->last_name }}<br>
                                    <span style="font-size: 0.9rem; color: #666;">{{ $order->buyer->email }}</span>
                                </div>
                            </div>

                            <div class="info-group product-info">
                                <div class="info-label">Product</div>
                                <div class="info-value">
                                    {{ $order->product->name }}<br>
                                    <span
                                        style="font-size: 0.9rem; color: #666;">₦{{ number_format($order->product->selling_price, 2) }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="order-summary">
                            <div class="quantity-display">
                                <span class="quantity-value">{{ $order->quantity }}</span>
                                <span class="quantity-label">Items</span>
                            </div>
                            <div class="total-display">
                                <span class="total-value">₦{{ number_format($order->total_price, 2) }}</span>
                                <span class="total-label">Total</span>
                            </div>
                        </div>
                    </div>

                    <div class="order-actions">
                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info">
                            <i class="fas fa-eye"></i>
                            View Details
                        </a>
                        <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i>
                            Edit Order
                        </a>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <h3>No Orders Found</h3>
                    <p>There are no orders to display at the moment.</p>
                </div>
            @endforelse

        </div>

        <!-- Pagination -->
        @if ($orders->hasPages())
            <div class="pagination-wrapper">
                {{ $orders->links('vendor.pagination.custom') }}
            </div>
        @endif
    </div>
@endsection

@section('scripts')
    <script>
        // Custom scripts for the orders page
        document.addEventListener('DOMContentLoaded', () => {
            const filterToggle = document.getElementById('filterToggle');
            const filtersPanel = document.querySelector('.search-filter-section');

            filterToggle.addEventListener('click', () => {
                filtersPanel.classList.toggle('active');
            });
        });
    </script>
@endsection
