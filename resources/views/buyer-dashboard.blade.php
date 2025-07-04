@extends('layouts.app')

@section('header')
    <div class="dashboard-header">
        <div class="header-content">
            <h2 class="dashboard-title">
                <i class="fas fa-shopping-cart"></i>
                Dashboard
                </hz>
                <p class="dashboard-subtitle" style="color: white">Track your purchases and discover new products</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('products') }}" class="btn btn-primary">
                <i class="fas fa-search"></i>
                Browse Products
            </a>
        </div>
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

        .dashboard-header {
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


        .dashboard-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .dashboard-subtitle {
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

        .dashboard-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }

        .dashboard-boxes {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }

        .dashboard-box {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .dashboard-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #4CAF50, #81C784);
        }

        .box-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #4CAF50, #81C784);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            color: white;
            font-size: 1.5rem;
        }

        .dashboard-box p {
            font-size: 2.2rem;
            font-weight: 700;
            color: #2E7D32;
            margin-bottom: 8px;
        }

        .box-trend {
            font-size: 0.9rem;
            color: #4CAF50;
            display: flex;
            align-items: center;
            gap: 5px;
        }



        .dashboard-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        }


        .dashboard-box h4 {
            font-size: 1.1rem;
            margin-bottom: 10px;
            color: #666;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }



        .chart-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            margin: 30px 0;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .chart-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #2E7D32;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .data-table {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            margin: 30px 0;
        }

        .table-header {
            background: linear-gradient(135deg, #2E7D32, #4CAF50);
            color: white;
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        th {
            background: rgba(76, 175, 80, 0.1);
            color: #2E7D32;
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        tbody tr:hover {
            background: rgba(76, 175, 80, 0.05);
            transform: scale(1.01);
        }


        .table-title {
            font-size: 1.3rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 16px 30px;
            text-align: left;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }


        tbody tr {
            transition: all 0.3s ease;
        }



        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-pending {
            background: rgba(255, 193, 7, 0.1);
            color: #f57c00;
        }

        .status-processing {
            background: rgba(33, 150, 243, 0.1);
            color: #1976d2;
        }

        .status-delivered {
            background: rgba(76, 175, 80, 0.1);
            color: #388e3c;
        }

        .status-cancelled {
            background: rgba(244, 67, 54, 0.1);
            color: #d32f2f;
        }

        .progress-bar {
            width: 100%;
            height: 6px;
            background: rgba(76, 175, 80, 0.2);
            border-radius: 3px;
            overflow: hidden;
            margin-top: 10px;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #4CAF50, #81C784);
            border-radius: 3px;
            transition: width 0.3s ease;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #666;
        }

        .empty-state i {
            font-size: 4rem;
            color: #ccc;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .dashboard-header {
                flex-direction: column;
                gap: 20px;
                text-align: center;
            }

            .dashboard-title {
                font-size: 2rem;
            }

            .dashboard-boxes {
                grid-template-columns: 1fr;
            }

            .chart-header {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }

            th,
            td {
                padding: 12px 15px;
                font-size: 0.9rem;
            }
        }

        @media (max-width: 480px) {
            .dashboard-container {
                padding: 15px;
            }

            .dashboard-header {
                padding: 20px;
                margin-bottom: 20px;
            }

            .dashboard-title {
                font-size: 1.8rem;
            }

            .chart-container,
            .data-table {
                margin: 20px 0;
                padding: 20px;
            }
        }

        /* Additional Buyer Dashboard Styles */
        .badge {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .order-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .order-image {
            width: 45px;
            height: 45px;
            background: #f5f5f5;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .order-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .order-image i {
            color: #4CAF50;
            font-size: 1.2rem;
        }

        .farmer-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .farmer-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #4CAF50, #81C784);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 0.9rem;
        }

        .price-tag {
            font-weight: 600;
            color: #2E7D32;
            font-size: 1.1rem;
        }

        .order-image i {
            color: #4CAF50;
            font-size: 1.2rem;
        }

        .metric-value {
            font-size: 1.2rem;
            font-weight: 700;
            color: #2E7D32;
        }

        .category-badge {
            background: rgba(76, 175, 80, 0.1);
            color: #2E7D32;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 500;
        }


        .chart-container canvas {
            height: 400px !important;
        }

        @media (max-width: 1024px) {
            .chart-container canvas {
                height: 300px !important;
            }
        }

        @media (max-width: 768px) {
            .chart-container canvas {
                height: 250px !important;
            }
        }
    </style>


    <style>
        /* Additional styles for buyer dashboard components */
        .category-badge {
            background: rgba(76, 175, 80, 0.1);
            ;
            color: #4CAF50;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .metric-value {
            font-size: 1.2rem;
            font-weight: 700;
            color: #4CAF50;
        }

        /* Enhanced hover effects for buyer dashboard */
        .data-table table tbody tr:hover {
            background: rgba(76, 175, 80, 0.03);
            box-shadow: 0 2px 8px rgba(76, 175, 80, 0.1);
        }

        /* Accessibility improvements */
        .dashboard-box:focus,
        .btn:focus {
            outline: 2px solid #4CAF50;
            outline-offset: 2px;
        }

        /* Enhanced micro-interactions */
        .dashboard-box::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(76, 175, 80, 0.05), transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none;
        }

        /* Enhanced button styling for buyer dashboard */
        .btn-primary {
            background: linear-gradient(135deg, #4CAF50, #66BB6A);
            border: none;
            color: white;
            font-weight: 600;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #2E7D32, #4CAF50);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(76, 175, 80, 0.3);
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

        /* Enhanced empty state styling */
        .empty-state i {
            font-size: 3.5rem;
            color: rgba(76, 175, 80, 0.3);
            margin-bottom: 16px;
        }

        /* Alert styles */
        .alert-success {
            background: rgba(76, 175, 80, 0.1);
            color: #2E7D32;
            border-left: 4px solid #4CAF50;
        }

        .alert-info {
            background: rgba(76, 175, 80, 0.1);
            color: #2E7D32;
            border-left: 4px solid #4CAF50;
        }

        /* Order timeline styling */
        .timeline-item::before {
            background: #4CAF50;
            box-shadow: 0 0 0 2px #4CAF50;
        }

        /* Chart container specific styling */
        .chart-container canvas {
            height: 350px !important;
        }

        @media (max-width: 1024px) {
            .chart-container canvas {
                height: 280px !important;
            }

            .table-header {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }
        }

        @media (max-width: 768px) {
            .chart-container canvas {
                height: 220px !important;
            }

            .order-info,
            .farmer-info {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }

            .farmer-avatar,
            .order-image {
                width: 35px;
                height: 35px;
            }

            table {
                font-size: 0.85rem;
            }

            th,
            td {
                padding: 8px 6px;
            }
        }

        /* Loading states */
        .loading-skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 4px;
        }

        @keyframes loading {
            0% {
                background-position: 200% 0;
            }

            100% {
                background-position: -200% 0;
            }
        }

        /* Status badge specific colors for buyer dashboard */
        .status-pending {
            background: rgba(255, 193, 7, 0.15);
            color: #f57c00;
            border: 1px solid rgba(255, 193, 7, 0.3);
        }

        .status-processing {
            background: rgba(33, 150, 243, 0.15);
            color: #1976d2;
            border: 1px solid rgba(33, 150, 243, 0.3);
        }

        .status-delivered {
            background: rgba(76, 175, 80, 0.15);
            color: #388e3c;
            border: 1px solid rgba(76, 175, 80, 0.3);
        }

        .status-cancelled {
            background: rgba(244, 67, 54, 0.15);
            color: #d32f2f;
            border: 1px solid rgba(244, 67, 54, 0.3);
        }

        /* Accessibility improvements */
        .dashboard-box:focus,
        .btn:focus {
            outline: 2px solid #4CAF50;
            outline-offset: 2px;
        }

        /* Print styles */
        @media print {

            .dashboard-header,
            .btn {
                display: none !important;
            }

            .dashboard-container {
                max-width: none;
                padding: 0;
            }

            .dashboard-box,
            .chart-container,
            .data-table {
                break-inside: avoid;
                box-shadow: none;
                border: 1px solid #ddd;
            }
        }

        /* Smooth transitions for all interactive elements */
        * {
            transition: all 0.2s ease-in-out;
        }

        /* Enhanced micro-interactions */
        .dashboard-box::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255, 107, 53, 0.05), transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none;
        }

        .dashboard-box:hover::after {
            opacity: 1;
        }

        /* Success/Error states */
        .alert {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success {
            background: rgba(76, 175, 80, 0.1);
            color: #2E7D32;
            border-left: 4px solid #4CAF50;
        }

        .alert-error {
            background: rgba(244, 67, 54, 0.1);
            color: #c62828;
            border-left: 4px solid #f44336;
        }

        .alert-info {
            background: rgba(76, 175, 80, 0.1);
            ;
            color: #4CAF50;
            border-left: 4px solid #4CAF50;
        }

        /* Enhanced empty state styling */
        .empty-state {
            padding: 50px 20px;
            text-align: center;
            color: #666;
        }

        .empty-state i {
            font-size: 3.5rem;
            color: rgba(255, 107, 53, 0.3);
            margin-bottom: 16px;
        }

        .empty-state h4 {
            font-size: 1.3rem;
            color: #333;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .empty-state p {
            color: #666;
            margin-bottom: 20px;
            line-height: 1.5;
        }


        /* Table enhancements */
        .table-actions {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .btn-secondary {
            background: rgba(76, 175, 80, 0.1);
            ;
            color: #4CAF50;
            border: 1px solid rgba(255, 107, 53, 0.2);
        }

        .btn-secondary:hover {
            background: rgba(255, 107, 53, 0.2);
            transform: translateY(-1px);
        }

        /* Order timeline styling (if needed for order details) */
        .order-timeline {
            position: relative;
            padding-left: 30px;
        }

        .order-timeline::before {
            content: '';
            position: absolute;
            left: 15px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #e5e7eb;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 20px;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -19px;
            top: 6px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #4CAF50;
            border: 2px solid white;
            box-shadow: 0 0 0 2px #4CAF50;
        }

        /* Responsive grid improvements */
        @media (max-width: 480px) {
            .dashboard-boxes {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .dashboard-box {
                padding: 20px;
            }

            .box-icon {
                width: 50px;
                height: 50px;
                font-size: 1.3rem;
            }

            .dashboard-box h4 {
                font-size: 1rem;
            }

            .dashboard-box p {
                font-size: 1.8rem;
            }
        }
    </style>
@endsection
@section('content')
    <div class="dashboard-container">
        <!-- KPI Cards -->
        <div class="dashboard-boxes">
            <div class="dashboard-box">
                <div class="box-icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <h4>Total Orders</h4>
                <p>{{ $totalOrders }}</p>
                <div class="box-trend">
                    <i class="fas fa-arrow-up"></i>
                    <span>All time orders</span>
                </div>
            </div>

            <div class="dashboard-box">
                <div class="box-icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <h4>Total Spent</h4>
                <p>₦{{ number_format($totalSpent, 2) }}</p>
                <div class="box-trend">
                    <i class="fas fa-arrow-up"></i>
                    <span>Total purchases</span>
                </div>
            </div>

            <div class="dashboard-box">
                <div class="box-icon">
                    <i class="fas fa-calculator"></i>
                </div>
                <h4>Average Order</h4>
                <p>₦{{ number_format($averageOrderValue, 2) }}</p>
                <div class="box-trend">
                    <i class="fas fa-chart-line"></i>
                    <span>Per order value</span>
                </div>
            </div>

            <div class="dashboard-box">
                <div class="box-icon">
                    <i class="fas fa-user-friends"></i>
                </div>
                <h4>Farmers Bought From</h4>
                <p>{{ $totalFarmers }}</p>
                <div class="box-trend">
                    <i class="fas fa-handshake"></i>
                    <span>Unique farmers</span>
                </div>
            </div>

            <div class="dashboard-box">
                <div class="box-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <h4>Pending Orders</h4>
                <p>{{ $pendingOrders }}</p>
                <div class="box-trend">
                    <i class="fas fa-hourglass-half"></i>
                    <span>Awaiting processing</span>
                </div>
            </div>
        </div>

        <!-- Order Status Overview -->
        <div class="chart-container">
            <div class="chart-header">
                <h3 class="chart-title">
                    <i class="fas fa-chart-pie"></i>
                    Order Status Overview
                </h3>
            </div>
            <canvas id="orderStatusChart"></canvas>
        </div>

        <!-- Monthly Spending Chart -->
        <div class="chart-container">
            <div class="chart-header">
                <h3 class="chart-title">
                    <i class="fas fa-calendar-alt"></i>
                    Monthly Spending Trends
                </h3>
            </div>
            <canvas id="monthlySpendingChart"></canvas>
        </div>

        <!-- Weekly Spending Chart -->
        <div class="chart-container">
            <div class="chart-header">
                <h3 class="chart-title">
                    <i class="fas fa-calendar-week"></i>
                    Weekly Spending Activity
                </h3>
            </div>
            <canvas id="weeklySpendingChart"></canvas>
        </div>

        <!-- Top Purchased Products -->
        <div class="data-table">
            <div class="table-header">
                <h3 class="table-title">
                    <i class="fas fa-star"></i>
                    Most Purchased Products
                </h3>
                <span class="badge">{{ count($topProducts) }} products</span>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product</th>
                        <th>Orders</th>
                        <th>Total Quantity</th>
                        <th>Total Spent</th>
                        <th>Farmer</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($topProducts as $index => $orderData)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <div class="order-info">
                                    <div class="order-image">
                                        @if ($orderData->product->product_image)
                                            <img src="{{ asset('product_images/' . $orderData->product->product_image) }}"
                                                alt="{{ $orderData->product->name }}">
                                        @else
                                            <i class="fas fa-leaf"></i>
                                        @endif
                                    </div>
                                    <div>
                                        <strong>{{ $orderData->product->name }}</strong>
                                        <small style="display: block; color: #666;">
                                            {{ $orderData->product->category->name ?? 'Uncategorized' }}
                                        </small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="metric-value" style="font-size: 1.2rem;">{{ $orderData->order_count }}</span>
                            </td>
                            <td>
                                <span class="metric-value" style="font-size: 1.2rem;">
                                    {{ $orderData->total_quantity }}
                                    {{ $orderData->product->unit_of_measurement ?? 'units' }}
                                </span>
                            </td>
                            <td>
                                <span class="price-tag">₦{{ number_format($orderData->total_spent, 2) }}</span>
                            </td>
                            <td>
                                <div class="farmer-info">
                                    <div class="farmer-avatar">
                                        {{ strtoupper(substr($orderData->product->farmer->first_name ?? 'F', 0, 1)) }}{{ strtoupper(substr($orderData->product->farmer->last_name ?? 'A', 0, 1)) }}
                                    </div>
                                    <div>
                                        <strong>{{ $orderData->product->farmer->farm_name ?? $orderData->product->farmer->first_name . ' ' . $orderData->product->farmer->last_name }}</strong>
                                        <small
                                            style="display: block; color: #666;">{{ $orderData->product->farmer->farm_location ?? 'Nigeria' }}</small>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <i class="fas fa-shopping-cart"></i>
                                    <h4>No purchases yet</h4>
                                    <p>Start shopping to see your favorite products here.</p>
                                    <a href="{{ route('products') }}" class="btn btn-primary" style="margin-top: 15px;">
                                        <i class="fas fa-search"></i>
                                        Browse Products
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Favorite Farmers -->
        <div class="data-table">
            <div class="table-header">
                <h3 class="table-title">
                    <i class="fas fa-heart"></i>
                    Favorite Farmers
                </h3>
                <span class="badge">{{ count($favoriteFarmers) }} farmers</span>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Farmer</th>
                        <th>Products Bought</th>
                        <th>Total Spent</th>
                        <th>Farm Type</th>
                        <th>Location</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($favoriteFarmers as $index => $farmer)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <div class="farmer-info">
                                    <div class="farmer-avatar">
                                        {{ strtoupper(substr($farmer->first_name ?? 'F', 0, 1)) }}{{ strtoupper(substr($farmer->last_name ?? 'A', 0, 1)) }}
                                    </div>
                                    <div>
                                        <strong>{{ $farmer->farm_name ?? $farmer->first_name . ' ' . $farmer->last_name }}</strong>
                                        <small style="display: block; color: #666;">{{ $farmer->email }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="metric-value"
                                    style="font-size: 1.2rem;">{{ $farmer->products_bought ?? 0 }}</span>
                            </td>
                            <td>
                                <span class="price-tag">₦{{ number_format($farmer->total_spent ?? 0, 2) }}</span>
                            </td>
                            <td>
                                <span class="category-badge" style="background: rgba(76, 175, 80, 0.1);; color: #4CAF50;">
                                    {{ $farmer->farm_type ? ucfirst($farmer->farm_type) : 'Mixed' }}
                                </span>
                            </td>
                            <td>{{ $farmer->farm_location ?? 'Nigeria' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <i class="fas fa-user-friends"></i>
                                    <h4>No farmers yet</h4>
                                    <p>Your favorite farmers will appear here after making purchases.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Recent Orders -->
        <div class="data-table">
            <div class="table-header">
                <h3 class="table-title">
                    <i class="fas fa-history"></i>
                    Recent Orders
                </h3>
                <span class="badge">Last {{ count($recentOrders) }} orders</span>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($recentOrders as $order)
                        <tr>
                            <td>
                                <strong style="color: #4CAF50;">#{{ $order->id }}</strong>
                            </td>
                            <td>
                                <div class="order-info">
                                    <div class="order-image">
                                        @if ($order->product->product_image)
                                            <img src="{{ asset('product_images/' . $order->product->product_image) }}"
                                                alt="{{ $order->product->name }}">
                                        @else
                                            <i class="fas fa-leaf"></i>
                                        @endif
                                    </div>
                                    <div>
                                        <strong>{{ $order->product->name }}</strong>
                                        <small style="display: block; color: #666;">
                                            from
                                            {{ $order->product->farmer->farm_name ?? $order->product->farmer->first_name }}
                                        </small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="metric-value" style="font-size: 1.1rem;">
                                    {{ $order->quantity }} {{ $order->product->unit_of_measurement ?? 'units' }}
                                </span>
                            </td>
                            <td>
                                <span class="price-tag">₦{{ number_format($order->total_price, 2) }}</span>
                            </td>
                            <td>
                                <span class="status-badge status-{{ strtolower($order->status) }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td>
                                <span style="color: #666;">{{ $order->created_at->format('M j, Y') }}</span>
                                <small
                                    style="display: block; color: #999;">{{ $order->created_at->diffForHumans() }}</small>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <i class="fas fa-receipt"></i>
                                    <h4>No orders yet</h4>
                                    <p>Your recent orders will appear here once you start purchasing.</p>
                                    <a href="{{ route('products') }}" class="btn btn-primary" style="margin-top: 15px;">
                                        <i class="fas fa-shopping-cart"></i>
                                        Start Shopping
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Category Spending Breakdown -->
        @if ($categorySpending->count() > 0)
            <div class="data-table">
                <div class="table-header">
                    <h3 class="table-title">
                        <i class="fas fa-chart-pie"></i>
                        Spending by Category
                    </h3>
                    <span class="badge">{{ count($categorySpending) }} categories</span>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Category</th>
                            <th>Total Spent</th>
                            <th>Percentage</th>
                            <th>Spending Level</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categorySpending as $index => $category)
                            @php
                                $maxSpent = $categorySpending->max('total_spent') ?: 1;
                                $percentage = $maxSpent > 0 ? ($category->total_spent / $maxSpent) * 100 : 0;
                                $totalPercentage = $totalSpent > 0 ? ($category->total_spent / $totalSpent) * 100 : 0;
                            @endphp
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <span class="category-badge"
                                        style="background: rgba(76, 175, 80, 0.1);; color: #4CAF50;">
                                        {{ $category->category_name }}
                                    </span>
                                </td>
                                <td>
                                    <span class="price-tag">₦{{ number_format($category->total_spent, 2) }}</span>
                                </td>
                                <td>
                                    <strong style="color: #4CAF50;">{{ number_format($totalPercentage, 1) }}%</strong>
                                </td>
                                <td>
                                    <div class="progress-bar">
                                        <div class="progress-fill" style="width: {{ $percentage }}%"></div>
                                    </div>
                                    <small style="color: #666;">{{ number_format($percentage, 1) }}% of top
                                        category</small>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <!-- Order Summary by Status -->
        <div class="dashboard-boxes" style="margin-top: 40px;">
            <div class="dashboard-box">
                <div class="box-icon" style="background: linear-gradient(135deg, #f39c12, #e67e22);">
                    <i class="fas fa-hourglass-half"></i>
                </div>
                <h4>Pending Orders</h4>
                <p>{{ $pendingOrders }}</p>
                <div class="box-trend">
                    <i class="fas fa-clock"></i>
                    <span>Awaiting processing</span>
                </div>
            </div>

            <div class="dashboard-box">
                <div class="box-icon" style="background: linear-gradient(135deg, #3498db, #2980b9);">
                    <i class="fas fa-cogs"></i>
                </div>
                <h4>Processing Orders</h4>
                <p>{{ $processingOrders }}</p>
                <div class="box-trend">
                    <i class="fas fa-spinner"></i>
                    <span>Being prepared</span>
                </div>
            </div>

            <div class="dashboard-box">
                <div class="box-icon" style="background: linear-gradient(135deg, #27ae60, #2ecc71);">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h4>Completed Orders</h4>
                <p>{{ $completedOrders }}</p>
                <div class="box-trend">
                    <i class="fas fa-thumbs-up"></i>
                    <span>Successfully delivered</span>
                </div>
            </div>

            <div class="dashboard-box">
                <div class="box-icon" style="background: linear-gradient(135deg, #e74c3c, #c0392b);">
                    <i class="fas fa-times-circle"></i>
                </div>
                <h4>Cancelled Orders</h4>
                <p>{{ $cancelledOrders }}</p>
                <div class="box-trend">
                    <i class="fas fa-ban"></i>
                    <span>Cancelled orders</span>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Order Status Pie Chart
    const orderStatusCtx = document.getElementById('orderStatusChart').getContext('2d');
    const orderStatusChart = new Chart(orderStatusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Pending', 'Processing', 'Delivered', 'Cancelled'],
            datasets: [{
                data: [{{ $pendingOrders }}, {{ $processingOrders }}, {{ $completedOrders }}, {{ $cancelledOrders }}],
                backgroundColor: [
                    '#f39c12',
                    '#3498db',
                    '#4CAF50',
                    '#e74c3c'
                ],
                borderWidth: 0,
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        usePointStyle: true,
                        font: {
                            weight: 'bold'
                        }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(46, 125, 50, 0.9)',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    borderColor: '#4CAF50',
                    borderWidth: 1,
                    cornerRadius: 8,
                    displayColors: true,
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = context.parsed || 0;
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = total > 0 ? ((value / total) * 100).toFixed(1) : 0;
                            return `${label}: ${value} orders (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });

    // Monthly Spending Chart
    const monthlySpendingCtx = document.getElementById('monthlySpendingChart').getContext('2d');
    const monthlySpendingChart = new Chart(monthlySpendingCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($monthlyLabels) !!},
            datasets: [{
                label: 'Monthly Spending (₦)',
                data: {!! json_encode($monthlyData) !!},
                backgroundColor: function(context) {
                    const chart = context.chart;
                    const { ctx, chartArea } = chart;
                    if (!chartArea) {
                        return null;
                    }
                    const gradient = ctx.createLinearGradient(0, chartArea.bottom, 0, chartArea.top);
                    gradient.addColorStop(0, 'rgba(76, 175, 80, 0.1)');
                    gradient.addColorStop(1, 'rgba(76, 175, 80, 0.8)');
                    return gradient;
                },
                borderColor: '#4CAF50',
                borderWidth: 2,
                borderRadius: 8,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        usePointStyle: true,
                        font: {
                            weight: 'bold'
                        }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(46, 125, 50, 0.9)',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    borderColor: '#4CAF50',
                    borderWidth: 1,
                    cornerRadius: 8,
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            return 'Spent: ₦' + context.parsed.y.toLocaleString();
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    },
                    ticks: {
                        callback: function(value) {
                            return '₦' + value.toLocaleString();
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    // Weekly Spending Chart
    const weeklySpendingCtx = document.getElementById('weeklySpendingChart').getContext('2d');
    const weeklySpendingChart = new Chart(weeklySpendingCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($weeklyLabels) !!},
            datasets: [{
                label: 'Daily Spending (₦)',
                data: {!! json_encode($weeklyData) !!},
                backgroundColor: 'rgba(76, 175, 80, 0.1)',
                borderColor: '#4CAF50',
                borderWidth: 3,
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#4CAF50',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 6,
                pointHoverRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        usePointStyle: true,
                        font: {
                            weight: 'bold'
                        }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(46, 125, 50, 0.9)',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    borderColor: '#4CAF50',
                    borderWidth: 1,
                    cornerRadius: 8,
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            return 'Spent: ₦' + context.parsed.y.toLocaleString();
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    },
                    ticks: {
                        callback: function(value) {
                            return '₦' + value.toLocaleString();
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            },
            interaction: {
                intersect: false,
                mode: 'index'
            }
        }
    });

    // Animate numbers on page load
    const animateNumbers = () => {
        const numbers = document.querySelectorAll('.dashboard-box p');
        numbers.forEach(number => {
            const target = parseInt(number.textContent.replace(/[₦,]/g, ''));
            if (target && !isNaN(target)) {
                let current = 0;
                const increment = target / 50;
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        current = target;
                        clearInterval(timer);
                    }
                    if (number.textContent.includes('₦')) {
                        number.textContent = '₦' + Math.floor(current).toLocaleString();
                    } else {
                        number.textContent = Math.floor(current).toLocaleString();
                    }
                }, 20);
            }
        });
    };

    // Trigger number animation when dashboard boxes come into view
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateNumbers();
                observer.unobserve(entry.target);
            }
        });
    });

    const dashboardBoxes = document.querySelector('.dashboard-boxes');
    if (dashboardBoxes) {
        observer.observe(dashboardBoxes);
    }

    // Add loading animation on page load
    window.addEventListener('load', function() {
        document.querySelectorAll('.loading-skeleton').forEach(el => {
            el.classList.remove('loading-skeleton');
        });
    });

    // Initialize charts after DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
        // Charts are already initialized above
        console.log('Buyer dashboard loaded successfully');
    });
</script>

@endsection
