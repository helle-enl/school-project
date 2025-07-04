@extends('layouts.app')

@section('header')
    <div class="product-detail-header">
        <div class="header-navigation">
            <a href="{{ route('farm-products.index') }}" class="back-btn">
                <i class="fas fa-arrow-left"></i>
                Back to Products
            </a>
            <div class="breadcrumb">
                <span>Products</span>
                <i class="fas fa-chevron-right"></i>
                <span>{{ $product->name }}</span>
            </div>
        </div>
        <div class="product-header-content">
            <div class="product-main-info">
                <div class="product-image-preview">
                    @if ($product->product_image)
                        <img src="{{ asset('storage/' . $product->product_image) }}" alt="{{ $product->name }}">
                    @else
                        <div class="image-placeholder">
                            <i class="fas fa-leaf"></i>
                        </div>
                    @endif
                    <div class="status-overlay">
                        <span class="status-badge status-{{ strtolower($product->status ?? 'active') }}">
                            {{ ucfirst($product->status ?? 'Active') }}
                        </span>
                    </div>
                </div>
                <div class="product-title-section">
                    <div class="category-tag">
                        <i class="fas fa-tag"></i>
                        {{ $product->category->name ?? 'Uncategorized' }}
                    </div>
                    <h1 class="product-title">{{ $product->name }}</h1>
                    <p class="product-description" style="color:white;">{{ $product->description }}</p>
                    <div class="price-display">
                        <span
                            class="current-price">₦{{ number_format($product->selling_price ?? $product->unit_price, 2) }}</span>
                        <span class="price-unit">per {{ $product->unit_of_measurement }}</span>
                    </div>
                </div>
            </div>
            <div class="header-actions">
                <button class="btn btn-secondary" onclick="generateReport()">
                    <i class="fas fa-file-pdf"></i>
                    Export Report
                </button>
                <a href="{{ route('farm-products.edit', $product->id) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i>
                    Edit Product
                </a>
                <button class="btn btn-success" onclick="promoteProduct()">
                    <i class="fas fa-bullhorn"></i>
                    Promote
                </button>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .product-detail-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }

        .product-detail-header {
            background: linear-gradient(135deg, #2E7D32 0%, #4CAF50 100%);
            color: white;
            padding: 30px;
            border-radius: 0px;
            margin-bottom: 30px;
            box-shadow: 0 8px 32px rgba(46, 125, 50, 0.3);
        }

        .header-navigation {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .back-btn {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .back-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateX(-3px);
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.9rem;
            opacity: 0.8;
        }

        .product-header-content {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 30px;
        }

        .product-main-info {
            display: flex;
            gap: 25px;
            flex: 1;
        }

        .product-image-preview {
            width: 120px;
            height: 120px;
            border-radius: 20px;
            overflow: hidden;
            position: relative;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        .product-image-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .image-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            color: rgba(255, 255, 255, 0.6);
        }

        .status-overlay {
            position: absolute;
            top: 8px;
            right: 8px;
        }

        .status-badge {
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            backdrop-filter: blur(10px);
        }

        .status-active {
            background: rgba(76, 175, 80, 0.9);
            color: white;
        }

        .status-inactive {
            background: rgba(158, 158, 158, 0.9);
            color: white;
        }

        .product-title-section {
            flex: 1;
        }

        .category-tag {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255, 255, 255, 0.15);
            color: white;
            padding: 6px 12px;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 500;
            margin-bottom: 12px;
        }

        .product-title {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 8px;
            line-height: 1.3;
        }

        .product-description {
            font-size: 1rem;
            opacity: 0.9;
            margin-bottom: 15px;
            line-height: 1.5;
        }

        .price-display {
            display: flex;
            align-items: baseline;
            gap: 10px;
        }

        .current-price {
            font-size: 2rem;
            font-weight: 700;
        }

        .price-unit {
            font-size: 1rem;
            opacity: 0.8;
        }

        .header-actions {
            display: flex;
            gap: 12px;
            flex-direction: column;
        }

        .btn {
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            cursor: pointer;
            font-size: 0.9rem;
            white-space: nowrap;
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .btn-warning {
            background: rgba(255, 193, 7, 0.9);
            color: white;
        }

        .btn-success {
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        /* Analytics Dashboard */
        .analytics-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }

        .main-analytics {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .sidebar-analytics {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        /* KPI Cards */
        .kpi-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .kpi-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 25px;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .kpi-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #4CAF50, #81C784);
        }

        .kpi-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 16px 48px rgba(0, 0, 0, 0.15);
        }

        .kpi-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #4CAF50, #81C784);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            color: white;
            font-size: 1.3rem;
        }

        .kpi-value {
            font-size: 2rem;
            font-weight: 700;
            color: #2E7D32;
            margin-bottom: 5px;
        }

        .kpi-label {
            font-size: 0.9rem;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .kpi-trend {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 0.8rem;
        }

        .trend-up {
            color: #4CAF50;
        }

        .trend-down {
            color: #f44336;
        }

        .trend-neutral {
            color: #666;
        }

        /* Chart Container */
        /* Chart container height fix */
        .chart-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            height: 450px;
        }

        .chart-wrapper {
            position: relative;
            height: 350px;
            width: 100%;
        }

        #salesChart {
            height: 100% !important;
            width: 100% !important;
            max-height: 350px !important;
        }


        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .chart-title {
            font-size: 1.4rem;
            font-weight: 600;
            color: #2E7D32;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .chart-controls {
            display: flex;
            gap: 8px;
        }

        .chart-btn {
            padding: 6px 12px;
            border: 2px solid #4CAF50;
            background: transparent;
            color: #4CAF50;
            border-radius: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.8rem;
        }

        .chart-btn.active,
        .chart-btn:hover {
            background: #4CAF50;
            color: white;
        }

        /* Info Cards */
        .info-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .info-card-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .info-card-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #4CAF50, #81C784);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.1rem;
        }

        .info-card-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #2E7D32;
        }

        /* Stock Alert */
        .stock-alert {
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 500;
        }

        .stock-alert.low {
            background: rgba(244, 67, 54, 0.1);
            color: #c62828;
            border-left: 4px solid #f44336;
        }

        .stock-alert.medium {
            background: rgba(255, 152, 0, 0.1);
            color: #f57c00;
            border-left: 4px solid #ff9800;
        }

        .stock-alert.high {
            background: rgba(76, 175, 80, 0.1);
            color: #2E7D32;
            border-left: 4px solid #4CAF50;
        }

        /* Customer List */
        .customer-list {
            max-height: 300px;
            overflow-y: auto;
        }

        .customer-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .customer-item:hover {
            background: rgba(76, 175, 80, 0.05);
            padding-left: 5px;
        }

        .customer-avatar {
            width: 35px;
            height: 35px;
            background: linear-gradient(135deg, #4CAF50, #81C784);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 0.8rem;
        }

        .customer-info {
            flex: 1;
        }

        .customer-name {
            font-weight: 600;
            color: #2E7D32;
            font-size: 0.9rem;
        }

        .customer-stats {
            font-size: 0.8rem;
            color: #666;
        }

        .customer-amount {
            font-weight: 600;
            color: #4CAF50;
            font-size: 0.9rem;
        }

        /* Recent Orders */
        .orders-list {
            max-height: 350px;
            overflow-y: auto;
        }

        .order-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .order-item:hover {
            background: rgba(76, 175, 80, 0.05);
            padding-left: 5px;
        }

        .order-details {
            flex: 1;
        }

        .order-id {
            font-size: 0.8rem;
            color: #666;
            margin-bottom: 3px;
        }

        .order-quantity {
            font-weight: 600;
            color: #2E7D32;
            margin-bottom: 3px;
        }

        .order-date {
            font-size: 0.75rem;
            color: #999;
        }

        .order-amount {
            text-align: right;
        }

        .order-price {
            font-weight: 700;
            color: #4CAF50;
            font-size: 1.1rem;
        }

        .order-status {
            font-size: 0.7rem;
            padding: 2px 8px;
            border-radius: 10px;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .status-completed {
            background: rgba(76, 175, 80, 0.2);
            color: #2E7D32;
        }

        .status-pending {
            background: rgba(255, 152, 0, 0.2);
            color: #f57c00;
        }

        .status-cancelled {
            background: rgba(244, 67, 54, 0.2);
            color: #c62828;
        }

        /* Performance Metrics */
        .performance-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-top: 20px;
        }

        .performance-item {
            text-align: center;
            padding: 15px;
            background: rgba(76, 175, 80, 0.05);
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .performance-item:hover {
            background: rgba(76, 175, 80, 0.1);
            transform: translateY(-2px);
        }

        .performance-value {
            font-size: 1.4rem;
            font-weight: 700;
            color: #2E7D32;
            margin-bottom: 5px;
        }

        .performance-label {
            font-size: 0.8rem;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Inventory Details */
        .inventory-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            padding: 20px;
            background: rgba(76, 175, 80, 0.05);
            border-radius: 12px;
            margin-top: 15px;
        }

        .inventory-item {
            text-align: center;
        }

        .inventory-number {
            font-size: 1.8rem;
            font-weight: 700;
            color: #2E7D32;
            margin-bottom: 5px;
        }

        .inventory-label {
            font-size: 0.9rem;
            color: #666;
        }

        /* Progress Bars */
        .progress-container {
            margin: 15px 0;
        }

        .progress-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 0.9rem;
        }

        .progress-bar {
            width: 100%;
            height: 8px;
            background: rgba(76, 175, 80, 0.2);
            border-radius: 4px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #4CAF50, #81C784);
            border-radius: 4px;
            transition: width 0.3s ease;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .analytics-grid {
                grid-template-columns: 1fr;
            }

            .sidebar-analytics {
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                display: grid;
            }

            .chart-container {
                height: 400px;
            }

            .chart-wrapper {
                height: 300px;
            }
        }

        @media (max-width: 768px) {
            .chart-container {
                height: 350px;
            }

            .chart-wrapper {
                height: 250px;
            }

            #salesChart {
                max-height: 250px !important;
            }
        }


        @media (max-width: 768px) {
            .product-detail-container {
                padding: 15px;
            }

            .product-detail-header {
                padding: 20px;
            }

            .product-header-content {
                flex-direction: column;
                gap: 20px;
            }

            .product-main-info {
                flex-direction: column;
                text-align: center;
            }

            .product-image-preview {
                align-self: center;
            }

            .header-actions {
                flex-direction: row;
                justify-content: center;
                flex-wrap: wrap;
            }

            .kpi-cards {
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
            }

            .chart-header {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }

            .performance-grid,
            .inventory-details {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .kpi-cards {
                grid-template-columns: 1fr;
            }

            .header-navigation {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }

            .breadcrumb {
                order: -1;
            }
        }

        /* Animation Classes */
        .fade-in {
            animation: fadeIn 0.6s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .slide-up {
            animation: slideUp 0.4s ease;
        }

        @keyframes slideUp {
            from {
                transform: translateY(30px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Custom Scrollbars */
        .customer-list::-webkit-scrollbar,
        .orders-list::-webkit-scrollbar {
            width: 6px;
        }

        .customer-list::-webkit-scrollbar-track,
        .orders-list::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }

        .customer-list::-webkit-scrollbar-thumb,
        .orders-list::-webkit-scrollbar-thumb {
            background: #4CAF50;
            border-radius: 3px;
        }

        .customer-list::-webkit-scrollbar-thumb:hover,
        .orders-list::-webkit-scrollbar-thumb:hover {
            background: #2E7D32;
        }

        /* Print Styles */
        @media print {

            .header-actions,
            .chart-controls {
                display: none !important;
            }

            .product-detail-container {
                max-width: none;
                padding: 0;
            }

            .kpi-card,
            .chart-container,
            .info-card {
                break-inside: avoid;
                box-shadow: none;
                border: 1px solid #ddd;
            }
        }
    </style>
@endsection

@section('content')
    <div class="product-detail-container">
        <!-- Stock Alert -->
        @php
            $stockLevel = 'high';
            $stockMessage = 'Stock level is healthy';
            $availableStock = $availableStock ?? 0;

            if ($availableStock <= 0) {
                $stockLevel = 'low';
                $stockMessage = 'Product is sold out! Add more stock to continue selling.';
            } elseif ($availableStock <= 5) {
                $stockLevel = 'low';
                $stockMessage = 'Very low stock alert! Only ' . $availableStock . ' units remaining.';
            } elseif ($availableStock <= 20) {
                $stockLevel = 'medium';
                $stockMessage = 'Low stock alert! Only ' . $availableStock . ' units remaining.';
            }
        @endphp


        @if ($stockLevel !== 'high')
            <div class="stock-alert {{ $stockLevel }}">
                <i class="fas fa-{{ $stockLevel === 'low' ? 'exclamation-triangle' : 'info-circle' }}"></i>
                <span>{{ $stockMessage }}</span>
            </div>
        @endif

        <!-- Analytics Grid -->
        <div class="analytics-grid">
            <!-- Main Analytics -->
            <div class="main-analytics">
                <!-- KPI Cards -->
                <div class="kpi-cards fade-in">
                    <div class="kpi-card">
                        <div class="kpi-icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="kpi-value">{{ $totalUnitsSold }}</div>
                        <div class="kpi-label">Units Sold</div>
                        <div class="kpi-trend trend-{{ $salesTrend >= 0 ? 'up' : 'down' }}">
                            <i class="fas fa-arrow-{{ $salesTrend >= 0 ? 'up' : 'down' }}"></i>
                            <span>{{ abs($salesTrend) }}% vs last month</span>
                        </div>
                    </div>

                    <div class="kpi-card">
                        <div class="kpi-icon">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <div class="kpi-value">₦{{ number_format($totalRevenue, 0) }}</div>
                        <div class="kpi-label">Total Revenue</div>
                        <div class="kpi-trend trend-{{ $revenueTrend >= 0 ? 'up' : 'down' }}">
                            <i class="fas fa-arrow-{{ $revenueTrend >= 0 ? 'up' : 'down' }}"></i>
                            <span>{{ abs($revenueTrend) }}% vs last month</span>
                        </div>
                    </div>

                    <div class="kpi-card">
                        <div class="kpi-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="kpi-value">₦{{ number_format($netProfit, 0) }}</div>
                        <div class="kpi-label">Net Profit</div>
                        <div
                            class="kpi-trend trend-{{ ($profitMargin >= 20 ? 'up' : $profitMargin >= 10) ? 'neutral' : 'down' }}">
                            <i class="fas fa-percentage"></i>
                            <span>{{ number_format($profitMargin, 1) }}% margin</span>
                        </div>
                    </div>

                    <div class="kpi-card">
                        <div class="kpi-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="kpi-value">{{ $totalCustomers }}</div>
                        <div class="kpi-label">Customers</div>
                        <div class="kpi-trend trend-up">
                            <i class="fas fa-user-plus"></i>
                            <span>{{ $newCustomers }} new this month</span>
                        </div>
                    </div>

                    <div class="kpi-card">
                        <div class="kpi-icon">
                            <i class="fas fa-boxes"></i>
                        </div>
                        <div class="kpi-value">{{ $product->total_stock }}</div>
                        <div class="kpi-label">Stock Remaining</div>
                        <div
                            class="kpi-trend trend-{{ ($stockLevel === 'high' ? 'up' : $stockLevel === 'medium') ? 'neutral' : 'down' }}">
                            <i class="fas fa-warehouse"></i>
                            <span>{{ ucfirst($stockLevel) }} level</span>
                        </div>
                    </div>

                    <div class="kpi-card">
                        <div class="kpi-icon">
                            <i class="fas fa-boxes"></i>
                        </div>
                        <div class="kpi-value">{{ $availableStock ?? 0 }}</div>
                        <div class="kpi-label">Available Stock</div>
                        <div
                            class="kpi-trend trend-{{ $availableStock > 10 ? 'up' : ($availableStock > 0 ? 'neutral' : 'down') }}">
                            <i class="fas fa-warehouse"></i>
                            <span>{{ $availableStock > 10 ? 'Good' : ($availableStock > 0 ? 'Low' : 'Sold Out') }}</span>
                        </div>
                    </div>

                </div>

                <!-- Sales Chart -->
                <!-- Sales Chart -->
                <div class="chart-container slide-up">
                    <div class="chart-header">
                        <h3 class="chart-title">
                            <i class="fas fa-chart-area"></i>
                            Sales Performance
                        </h3>
                        <div class="chart-controls">
                            <button class="chart-btn active" data-period="7">7 Days</button>
                            <button class="chart-btn" data-period="30">30 Days</button>
                            <button class="chart-btn" data-period="90">90 Days</button>
                        </div>
                    </div>
                    <div class="chart-wrapper">
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>


                <!-- Performance Analysis -->
                <div class="chart-container">
                    <div class="chart-header">
                        <h3 class="chart-title">
                            <i class="fas fa-analytics"></i>
                            Performance Breakdown
                        </h3>
                    </div>
                    <div class="performance-grid">
                        <div class="performance-item">
                            <div class="performance-value">{{ number_format($averageOrderValue, 0) }}</div>
                            <div class="performance-label">Avg Order Value</div>
                        </div>
                        <div class="performance-item">
                            <div class="performance-value">{{ $repeatCustomers }}%</div>
                            <div class="performance-label">Repeat Customers</div>
                        </div>
                        <div class="performance-item">
                            <div class="performance-value">{{ $conversionRate }}%</div>
                            <div class="performance-label">Conversion Rate</div>
                        </div>
                        <div class="performance-item">
                            <div class="performance-value">{{ $totalOrders }}</div>
                            <div class="performance-label">Total Orders</div>
                        </div>
                    </div>

                    <!-- Demand Analysis -->
                    <div class="progress-container">
                        <div class="progress-header">
                            <span>Demand Score</span>
                            <span>{{ $demandScore }}%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: {{ $demandScore }}%"></div>
                        </div>
                    </div>

                    <div class="progress-container">
                        <div class="progress-header">
                            <span>Stock Turnover</span>
                            <span>{{ $stockTurnover }}x</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: {{ min($stockTurnover * 20, 100) }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Analytics -->
            <div class="sidebar-analytics">
                <!-- Inventory Details -->
                <div class="info-card">
                    <div class="info-card-header">
                        <div class="info-card-icon">
                            <i class="fas fa-warehouse"></i>
                        </div>
                        <h3 class="info-card-title">Inventory Details</h3>
                    </div>

                    <div class="inventory-details">
                        <div class="inventory-item">
                            <div class="inventory-number"> {{ $availableStock ?? 0 }} </div>
                            <div class="inventory-label">Current Stock</div>
                        </div>
                        <div class="inventory-item">
                            <div class="inventory-number">{{ $product->total_stock }}</div>
                            <div class="inventory-label">Initial Stock</div>
                        </div>
                        <div class="inventory-item">
                            <div class="inventory-number">{{ $reorderLevel ?? 0 }}</div>
                            <div class="inventory-label">Reorder Level</div>
                        </div>
                        <div class="inventory-item">
                            <div class="inventory-number">{{ $stockValue }}</div>
                            <div class="inventory-label">Stock Value</div>
                        </div>
                    </div>

                    @if ($product->total_stock <= 10)
                        <div class="stock-alert low" style="margin-top: 15px;">
                            <i class="fas fa-exclamation-triangle"></i>
                            <span>Restock recommended</span>
                        </div>
                    @endif
                </div>

                <!-- Top Customers -->
                <div class="info-card">
                    <div class="info-card-header">
                        <div class="info-card-icon">
                            <i class="fas fa-crown"></i>
                        </div>
                        <h3 class="info-card-title">Top Customers</h3>
                    </div>

                    <div class="customer-list">
                        @forelse($topCustomers as $customer)
                            <div class="customer-item">
                                <div class="customer-avatar">
                                    {{ strtoupper(substr($customer->first_name ?? 'U', 0, 1)) }}{{ strtoupper(substr($customer->last_name ?? 'N', 0, 1)) }}
                                </div>
                                <div class="customer-info">
                                    <div class="customer-name">{{ $customer->first_name }} {{ $customer->last_name }}
                                    </div>
                                    <div class="customer-stats">{{ $customer->orders_count }} orders •
                                        {{ $customer->total_quantity }} units</div>
                                </div>
                                <div class="customer-amount">₦{{ number_format($customer->total_spent, 0) }}</div>
                            </div>
                        @empty
                            <div class="empty-state" style="padding: 20px; text-align: center;">
                                <i class="fas fa-users" style="font-size: 2rem; color: #ccc; margin-bottom: 10px;"></i>
                                <p style="color: #666;">No customers yet</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Recent Orders -->
                <div class="info-card">
                    <div class="info-card-header">
                        <div class="info-card-icon">
                            <i class="fas fa-receipt"></i>
                        </div>
                        <h3 class="info-card-title">Recent Orders</h3>
                    </div>

                    <div class="orders-list">
                        @forelse($recentOrders as $order)
                            <div class="order-item">
                                <div class="order-details">
                                    <div class="order-id">#{{ $order->id }}</div>
                                    <div class="order-quantity">{{ $order->quantity }}
                                        {{ $product->unit_of_measurement }}</div>
                                    <div class="order-date">{{ $order->created_at->format('M j, Y') }}</div>
                                </div>
                                <div class="order-amount">
                                    <div class="order-price">₦{{ number_format($order->total_price, 0) }}</div>
                                    <div class="order-status status-{{ strtolower($order->status) }}">
                                        {{ $order->status }}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="empty-state" style="padding: 20px; text-align: center;">
                                <i class="fas fa-receipt" style="font-size: 2rem; color: #ccc; margin-bottom: 10px;"></i>
                                <p style="color: #666;">No orders yet</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="info-card">
                    <div class="info-card-header">
                        <div class="info-card-icon">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <h3 class="info-card-title">Quick Actions</h3>
                    </div>

                    <div style="display: flex; flex-direction: column; gap: 12px;">
                        <button class="btn btn-success" onclick="updateStock()">
                            <i class="fas fa-plus"></i>
                            Add Stock
                        </button>
                        <button class="btn btn-warning" onclick="adjustPrice()">
                            <i class="fas fa-tag"></i>
                            Adjust Price
                        </button>
                        <a href="{{ route('farm-products.edit', $product->id) }}" class="btn btn-info">
                            <i class="fas fa-edit"></i>
                            Edit Details
                        </a>
                        <button class="btn btn-secondary" onclick="createPromotion()">
                            <i class="fas fa-percent"></i>
                            Create Promotion
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Insights -->
        <div class="chart-container">
            <div class="chart-header">
                <h3 class="chart-title">
                    <i class="fas fa-lightbulb"></i>
                    Business Insights
                </h3>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
                <div style="padding: 20px; background: rgba(76, 175, 80, 0.05); border-radius: 12px;">
                    <h4 style="color: #2E7D32; margin-bottom: 10px;">
                        <i class="fas fa-trending-up"></i>
                        Sales Trend
                    </h4>
                    <p style="color: #666; line-height: 1.5;">
                        @if ($salesTrend > 0)
                            Your product sales are growing by {{ $salesTrend }}% compared to last month. Consider
                            increasing stock levels to meet demand.
                        @elseif($salesTrend < 0)
                            Sales have decreased by {{ abs($salesTrend) }}%. Consider promotional campaigns or price
                            adjustments.
                        @else
                            Sales are stable. Monitor market conditions for optimization opportunities.
                        @endif
                    </p>
                </div>

                <div style="padding: 20px; background: rgba(33, 150, 243, 0.05); border-radius: 12px;">
                    <h4 style="color: #1976D2; margin-bottom: 10px;">
                        <i class="fas fa-users"></i>
                        Customer Behavior
                    </h4>
                    <p style="color: #666; line-height: 1.5;">
                        You have {{ $repeatCustomers }}% repeat customers with an average order value of
                        ₦{{ number_format($averageOrderValue, 0) }}.
                        @if ($repeatCustomers > 60)
                            Excellent customer loyalty!
                        @else
                            Focus on customer retention strategies.
                        @endif
                    </p>
                </div>

                <div style="padding: 20px; background: rgba(255, 152, 0, 0.05); border-radius: 12px;">
                    <h4 style="color: #F57C00; margin-bottom: 10px;">
                        <i class="fas fa-warehouse"></i>
                        Inventory Optimization
                    </h4>
                    <p style="color: #666; line-height: 1.5;">
                        @if ($product->total_stock <= 10)
                            Critical: Stock is running low. Immediate restocking recommended.
                        @elseif($stockTurnover < 2)
                            Consider reducing stock levels or implementing promotional strategies.
                        @else
                            Good stock turnover rate of {{ $stockTurnover }}x annually.
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Stock Update Modal -->
    <div class="modal" id="stockModal" style="display: none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Update Stock</h3>
                <button class="modal-close" onclick="closeStockModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="stockForm">
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600;">Current Stock</label>
                        <input type="number" value="{{ $product->total_stock }}" disabled
                            style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px; background: #f9f9f9;">
                    </div>
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600;">Add Quantity</label>
                        <input type="number" id="addQuantity" min="1"
                            style="width: 100%; padding: 10px; border: 2px solid rgba(76, 175, 80, 0.2); border-radius: 8px;">
                    </div>
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600;">Reason</label>
                        <select id="stockReason"
                            style="width: 100%; padding: 10px; border: 2px solid rgba(76, 175, 80, 0.2); border-radius: 8px;">
                            <option value="restock">New Stock Arrival</option>
                            <option value="return">Customer Return</option>
                            <option value="adjustment">Stock Adjustment</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div style="display: flex; gap: 10px; justify-content: flex-end;">
                        <button type="button" class="btn btn-secondary" onclick="closeStockModal()">Cancel</button>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i>
                            Update Stock
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Price Adjustment Modal -->
    <div class="modal" id="priceModal" style="display: none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Adjust Price</h3>
                <button class="modal-close" onclick="closePriceModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="priceForm">
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600;">Current Price</label>
                        <input type="number" value="{{ $product->selling_price ?? $product->unit_price }}" disabled
                            style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px; background: #f9f9f9;">
                    </div>
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600;">New Price (₦)</label>
                        <input type="number" id="newPrice" step="0.01" min="0"
                            style="width: 100%; padding: 10px; border: 2px solid rgba(76, 175, 80, 0.2); border-radius: 8px;">
                    </div>
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600;">Price Change Reason</label>
                        <select id="priceReason"
                            style="width: 100%; padding: 10px; border: 2px solid rgba(76, 175, 80, 0.2); border-radius: 8px;">
                            <option value="market_adjustment">Market Price Adjustment</option>
                            <option value="cost_change">Cost Change</option>
                            <option value="promotion">Promotional Pricing</option>
                            <option value="demand">Demand-based Adjustment</option>
                            <option value="competitor">Competitor Analysis</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div id="priceImpact" style="margin-bottom: 20px; padding: 15px; border-radius: 8px; display: none;">
                        <h4 style="margin-bottom: 10px;">Price Impact Analysis</h4>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; font-size: 0.9rem;">
                            <div>Change: <span id="priceChangePercent">0%</span></div>
                            <div>New Margin: <span id="newMargin">0%</span></div>
                        </div>
                    </div>
                    <div style="display: flex; gap: 10px; justify-content: flex-end;">
                        <button type="button" class="btn btn-secondary" onclick="closePriceModal()">Cancel</button>
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-save"></i>
                            Update Price
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Chart Data
        const salesData = {
            labels: {!! json_encode($chartLabels) !!},
            datasets: [{
                label: 'Units Sold',
                data: {!! json_encode($chartData) !!},
                backgroundColor: 'rgba(76, 175, 80, 0.1)',
                borderColor: '#4CAF50',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#4CAF50',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 6,
                pointHoverRadius: 8
            }, {
                label: 'Revenue (₦)',
                data: {!! json_encode($revenueData) !!},
                backgroundColor: 'rgba(33, 150, 243, 0.1)',
                borderColor: '#2196F3',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#2196F3',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 6,
                pointHoverRadius: 8,
                yAxisID: 'y1'
            }]
        };


        // Chart Configuration
        const chartConfig = {
            type: 'line',
            data: salesData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                aspectRatio: 2,
                layout: {
                    padding: 0
                },
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
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
                                if (context.datasetIndex === 0) {
                                    return 'Units Sold: ' + context.parsed.y;
                                } else {
                                    return 'Revenue: ₦' + context.parsed.y.toLocaleString();
                                }
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        display: true,
                        grid: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: 'Time Period'
                        }
                    },
                    y: {
                        type: 'linear',
                        display: true,
                        position: 'left',
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        title: {
                            display: true,
                            text: 'Units Sold'
                        },
                        beginAtZero: true
                    },
                    y1: {
                        type: 'linear',
                        display: true,
                        position: 'right',
                        title: {
                            display: true,
                            text: 'Revenue (₦)'
                        },
                        grid: {
                            drawOnChartArea: false,
                        },
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return '₦' + value.toLocaleString();
                            }
                        }
                    }
                },
                onResize: function(chart, size) {
                    // 确保图表不会超出容器
                    if (size.height > 350) {
                        chart.canvas.style.height = '350px';
                    }
                }
            }
        };

        // Initialize Chart
        let salesChart;
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('salesChart');
            if (ctx) {

                const container = ctx.parentElement;
                container.style.position = 'relative';
                container.style.height = '350px';


                ctx.style.height = '350px';
                ctx.style.maxHeight = '350px';

                salesChart = new Chart(ctx, chartConfig);


                setTimeout(() => {
                    if (salesChart) {
                        salesChart.resize();
                    }
                }, 100);
            }

            // Initialize chart controls
            initializeChartControls();

            // Initialize animations
            animateElements();

            // Initialize modals
            initializeModals();
        });


        // Chart Controls
        function initializeChartControls() {
            const chartButtons = document.querySelectorAll('.chart-btn');
            chartButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    chartButtons.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');

                    const period = this.dataset.period;
                    updateChart(period);
                });
            });
        }

        function updateChart(period) {
            // Show loading state
            salesChart.data.datasets[0].data = [];
            salesChart.data.datasets[1].data = [];
            salesChart.update();

            Fetch new data
            fetch(`/farm-products/{{ $product->id }}/chart-data?period=${period}`)
                .then(response => response.json())
                .then(data => {
                    salesChart.data.labels = data.labels;
                    salesChart.data.datasets[0].data = data.unitsData;
                    salesChart.data.datasets[1].data = data.revenueData;
                    salesChart.update('active');
                })
                .catch(error => {
                    console.error('Error updating chart:', error);
                    showNotification('Error loading chart data', 'error');
                });
        }

        // Update Chart Data

        function updateChartL(period) {
            // Show loading state
            salesChart.data.datasets[0].data = [];
            salesChart.data.datasets[1].data = [];
            salesChart.update();

            // Fetch new data with correct route
            fetch(`{{ route('farm-products.chart-data', $product->id) }}?period=${period}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        salesChart.data.labels = data.labels;
                        salesChart.data.datasets[0].data = data.unitsData;
                        salesChart.data.datasets[1].data = data.revenueData;
                        salesChart.update('active');
                    } else {
                        showNotification('Error loading chart data', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error updating chart:', error);
                    showNotification('Error loading chart data', 'error');
                });
        }

        // Stock Update - 修复API路径
        document.getElementById('stockForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const quantity = document.getElementById('addQuantity').value;
            const reason = document.getElementById('stockReason').value;

            if (!quantity || quantity <= 0) {
                showNotification('Please enter a valid quantity', 'error');
                return;
            }

            fetch(`{{ route('farm-products.update-stock', $product->id) }}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify({
                        quantity: parseInt(quantity),
                        reason: reason
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showNotification(data.message, 'success');
                        setTimeout(() => window.location.reload(), 1500);
                    } else {
                        showNotification(data.message || 'Error updating stock', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Error updating stock', 'error');
                });

            closeStockModal();
        });

        // Price Update - 修复API路径
        document.getElementById('priceForm').addEventListener('submit', function(e) {
                    e.preventDefault();

                    const newPrice = document.getElementById('newPrice').value;
                    const reason = document.getElementById('priceReason').value;

                    if (!newPrice || newPrice <= 0) {
                        showNotification('Please enter a valid price', 'error');
                        return;
                    }


                    // Animate Elements
                    function animateElements() {
                        // Animate KPI cards
                        const kpiCards = document.querySelectorAll('.kpi-card');
                        kpiCards.forEach((card, index) => {
                            setTimeout(() => {
                                card.classList.add('fade-in');
                            }, index * 100);
                        });

                        // Animate numbers
                        animateNumbers();
                    }

                    // Animate Numbers
                    function animateNumbers() {
                        const numberElements = document.querySelectorAll('.kpi-value');
                        numberElements.forEach(element => {
                            const target = parseFloat(element.textContent.replace(/[₦,]/g, ''));
                            if (!isNaN(target)) {
                                animateNumber(element, target);
                            }
                        });
                    }

                    function animateNumber(element, target) {
                        const duration = 1500;
                        const increment = target / (duration / 16);
                        let current = 0;
                        const isPrice = element.textContent.includes('₦');

                        const timer = setInterval(() => {
                            current += increment;
                            if (current >= target) {
                                current = target;
                                clearInterval(timer);
                            }

                            if (isPrice) {
                                element.textContent = '₦' + Math.floor(current).toLocaleString();
                            } else {
                                element.textContent = Math.floor(current).toLocaleString();
                            }
                        }, 16);
                    }

                    // Modal Functions
                    function initializeModals() {
                        // Price impact calculator
                        const newPriceInput = document.getElementById('newPrice');
                        if (newPriceInput) {
                            newPriceInput.addEventListener('input', calculatePriceImpact);
                        }
                    }

                    // Stock Management
                    function updateStock() {
                        document.getElementById('stockModal').style.display = 'flex';
                    }

                    function closeStockModal() {
                        document.getElementById('stockModal').style.display = 'none';
                        document.getElementById('stockForm').reset();
                    }

                    // Price Management
                    function adjustPrice() {
                        document.getElementById('priceModal').style.display = 'flex';
                    }

                    function closePriceModal() {
                        document.getElementById('priceModal').style.display = 'none';
                        document.getElementById('priceForm').reset();
                        document.getElementById('priceImpact').style.display = 'none';
                    }

                    function calculatePriceImpact() {
                        const currentPrice = {{ $product->selling_price ?? $product->unit_price }};
                        const newPrice = parseFloat(document.getElementById('newPrice').value);
                        const costPrice = {{ $product->unit_price }};

                        if (newPrice && newPrice > 0) {
                            const changePercent = ((newPrice - currentPrice) / currentPrice * 100).toFixed(1);
                            const newMargin = ((newPrice - costPrice) / newPrice * 100).toFixed(1);

                            document.getElementById('priceChangePercent').textContent = changePercent + '%';
                            document.getElementById('newMargin').textContent = newMargin + '%';
                            document.getElementById('priceImpact').style.display = 'block';

                            // Color coding
                            const impactElement = document.getElementById('priceImpact');
                            if (Math.abs(changePercent) > 20) {
                                impactElement.style.background = 'rgba(244, 67, 54, 0.1)';
                                impactElement.style.borderLeft = '4px solid #f44336';
                            } else if (Math.abs(changePercent) > 10) {
                                impactElement.style.background = 'rgba(255, 152, 0, 0.1)';
                                impactElement.style.borderLeft = '4px solid #ff9800';
                            } else {
                                impactElement.style.background = 'rgba(76, 175, 80, 0.1)';
                                impactElement.style.borderLeft = '4px solid #4CAF50';
                            }
                        } else {
                            document.getElementById('priceImpact').style.display = 'none';
                        }
                    }

                    // Form Submissions
                    document.getElementById('stockForm').addEventListener('submit', function(e) {
                        e.preventDefault();

                        const quantity = document.getElementById('addQuantity').value;
                        const reason = document.getElementById('stockReason').value;

                        if (!quantity || quantity <= 0) {
                            showNotification('Please enter a valid quantity', 'error');
                            return;
                        }

                        // Submit stock update
                        fetch(`/farm-products/{{ $product->id }}/update-stock`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                        .getAttribute(
                                            'content')
                                },
                                body: JSON.stringify({
                                    quantity: parseInt(quantity),
                                    reason: reason
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    showNotification('Stock updated successfully', 'success');
                                    setTimeout(() => window.location.reload(), 1500);
                                } else {
                                    showNotification('Error updating stock', 'error');
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                showNotification('Error updating stock', 'error');
                            });

                        closeStockModal();
                    });

                    document.getElementById('priceForm').addEventListener('submit', function(e) {
                        e.preventDefault();

                        const newPrice = document.getElementById('newPrice').value;
                        const reason = document.getElementById('priceReason').value;

                        if (!newPrice || newPrice <= 0) {
                            showNotification('Please enter a valid price', 'error');
                            return;
                        }

                        // Submit price update
                        fetch(`/farm-products/{{ $product->id }}/update-price`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                        .getAttribute(
                                            'content')
                                },
                                body: JSON.stringify({
                                    price: parseFloat(newPrice),
                                    reason: reason
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    showNotification('Price updated successfully', 'success');
                                    setTimeout(() => window.location.reload(), 1500);
                                } else {
                                    showNotification('Error updating price', 'error');
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                showNotification('Error updating price', 'error');
                            });

                        closePriceModal();
                    });

                    // Additional Functions
                    function generateReport() {
                        showNotification('Generating report...', 'info');
                        window.open(`/farm-products/{{ $product->id }}/report`, '_blank');
                    }

                    function promoteProduct() {
                        showNotification('Promotion feature coming soon!', 'info');
                    }

                    function createPromotion() {
                        showNotification('Promotion creation feature coming soon!', 'info');
                    }

                    // Notification System
                    function showNotification(message, type = 'info') {
                        const notification = document.createElement('div');
                        notification.className = `notification notification-${type}`;
                        notification.innerHTML = `
                <div class="notification-content">
                    <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'}"></i>
                    <span>${message}</span>
                    <button class="notification-close" onclick="this.parentElement.parentElement.remove()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;

                        document.body.appendChild(notification);

                        // Auto remove after 5 seconds
                        setTimeout(() => {
                            if (notification.parentElement) {
                                notification.remove();
                            }
                        }, 5000);
                    }

                    // Keyboard Shortcuts
                    document.addEventListener('keydown', function(e) {
                        // Escape to close modals
                        if (e.key === 'Escape') {
                            closeStockModal();
                            closePriceModal();
                        }

                        // Quick actions
                        if (e.altKey) {
                            switch (e.key) {
                                case 's':
                                    e.preventDefault();
                                    updateStock();
                                    break;
                                case 'p':
                                    e.preventDefault();
                                    adjustPrice();
                                    break;
                                case 'e':
                                    e.preventDefault();
                                    window.location.href = '{{ route('farm-products.edit', $product->id) }}';
                                    break;
                            }
                        }
                    });

                    // Auto-refresh data every 5 minutes
                    setInterval(() => {
                        updateChart(document.querySelector('.chart-btn.active').dataset.period);
                    }, 300000);

                    // Print functionality
                    function printReport() {
                        window.print();
                    }

                    // Export to CSV
                    function exportToCSV() {
                        const csvData = [
                            ['Metric', 'Value'],
                            ['Product Name', '{{ $product->name }}'],
                            ['Total Units Sold', '{{ $totalUnitsSold }}'],
                            ['Total Revenue', '{{ $totalRevenue }}'],
                            ['Net Profit', '{{ $netProfit }}'],
                            ['Current Stock', '{{ $product->total_stock }}'],
                            ['Total Customers', '{{ $totalCustomers }}'],
                            ['Average Rating', '{{ $averageRating }}'],
                            ['Profit Margin', '{{ $profitMargin }}%']
                        ];

                        const csvContent = csvData.map(row => row.join(',')).join('\n');
                        const blob = new Blob([csvContent], {
                            type: 'text/csv'
                        });
                        const url = window.URL.createObjectURL(blob);
                        const link = document.createElement('a');
                        link.href = url;
                        link.download = `{{ $product->name }}_report_${new Date().toISOString().split('T')[0]}.csv`;
                        link.click();
                        window.URL.revokeObjectURL(url);
                    }

                    // Global functions
                    window.updateStock = updateStock;
                    window.closeStockModal = closeStockModal;
                    window.adjustPrice = adjustPrice;
                    window.closePriceModal = closePriceModal;
                    window.generateReport = generateReport;
                    window.promoteProduct = promoteProduct;
                    window.createPromotion = createPromotion;
                    window.printReport = printReport;
                    window.exportToCSV = exportToCSV;
    </script>

    <style>
        /* Modal Styles */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: white;
            border-radius: 20px;
            padding: 30px;
            max-width: 500px;
            width: 90%;
            max-height: 80vh;
            overflow-y: auto;
            position: relative;
            animation: modalSlideIn 0.3s ease;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        @keyframes modalSlideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid rgba(76, 175, 80, 0.1);
        }

        .modal-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2E7D32;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #666;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-close:hover {
            color: #f44336;
            background: rgba(244, 67, 54, 0.1);
            transform: rotate(90deg);
        }

        .modal-body {
            padding: 0;
        }

        /* Notification Styles */
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
            z-index: 1100;
            animation: slideInRight 0.3s ease;
            max-width: 400px;
            min-width: 300px;
        }

        .notification-content {
            padding: 15px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .notification-success {
            border-left: 4px solid #4CAF50;
        }

        .notification-success .fas {
            color: #4CAF50;
        }

        .notification-error {
            border-left: 4px solid #f44336;
        }

        .notification-error .fas {
            color: #f44336;
        }

        .notification-info {
            border-left: 4px solid #2196F3;
        }

        .notification-info .fas {
            color: #2196F3;
        }

        .notification-close {
            background: none;
            border: none;
            color: #666;
            cursor: pointer;
            margin-left: auto;
            transition: color 0.3s ease;
            padding: 5px;
        }

        .notification-close:hover {
            color: #f44336;
        }

        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        /* Loading Overlay */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(5px);
            z-index: 999;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 20px;
        }

        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 4px solid rgba(76, 175, 80, 0.3);
            border-top: 4px solid #4CAF50;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Tooltip Styles */
        .tooltip {
            position: relative;
            display: inline-block;
        }

        .tooltip .tooltiptext {
            visibility: hidden;
            width: 200px;
            background-color: #2E7D32;
            color: white;
            text-align: center;
            border-radius: 8px;
            padding: 8px 12px;
            position: absolute;
            z-index: 1001;
            bottom: 125%;
            left: 50%;
            margin-left: -100px;
            opacity: 0;
            transition: opacity 0.3s;
            font-size: 0.8rem;
        }

        .tooltip .tooltiptext::after {
            content: "";
            position: absolute;
            top: 100%;
            left: 50%;
            margin-left: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: #2E7D32 transparent transparent transparent;
        }

        .tooltip:hover .tooltiptext {
            visibility: visible;
            opacity: 1;
        }

        /* Enhanced hover effects */
        .kpi-card:hover .kpi-icon {
            transform: scale(1.1);
            box-shadow: 0 8px 25px rgba(76, 175, 80, 0.3);
        }

        .customer-item:hover .customer-avatar {
            transform: scale(1.1);
            box-shadow: 0 4px 15px rgba(76, 175, 80, 0.3);
        }

        .order-item:hover {
            transform: translateX(5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        /* Focus styles for accessibility */
        .btn:focus,
        input:focus,
        select:focus {
            outline: 2px solid #4CAF50;
            outline-offset: 2px;
        }

        /* Print optimizations */
        @media print {

            .header-actions,
            .chart-controls,
            .modal,
            .notification {
                display: none !important;
            }

            .product-detail-container {
                max-width: none;
                padding: 0;
            }

            .kpi-card,
            .chart-container,
            .info-card {
                break-inside: avoid;
                box-shadow: none;
                border: 1px solid #ddd;
                margin-bottom: 20px;
            }

            body {
                background: white !important;
            }
        }

        /* Custom scrollbar for modal */
        .modal-content::-webkit-scrollbar {
            width: 6px;
        }

        .modal-content::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }

        .modal-content::-webkit-scrollbar-thumb {
            background: #4CAF50;
            border-radius: 3px;
        }

        .modal-content::-webkit-scrollbar-thumb:hover {
            background: #2E7D32;
        }

        /* Enhanced form styles */
        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #2E7D32;
        }

        .form-input,
        .form-select {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid rgba(76, 175, 80, 0.2);
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
        }

        .form-input:focus,
        .form-select:focus {
            border-color: #4CAF50;
            box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.1);
            outline: none;
        }

        .form-input:hover,
        .form-select:hover {
            border-color: rgba(76, 175, 80, 0.4);
        }

        /* Success/Error states for inputs */
        .form-input.success {
            border-color: #4CAF50;
            background: rgba(76, 175, 80, 0.05);
        }

        .form-input.error {
            border-color: #f44336;
            background: rgba(244, 67, 54, 0.05);
        }

        /* Button loading state */
        .btn.loading {
            opacity: 0.7;
            cursor: not-allowed;
            position: relative;
        }

        .btn.loading::after {
            content: '';
            position: absolute;
            width: 16px;
            height: 16px;
            margin: auto;
            border: 2px solid transparent;
            border-top-color: currentColor;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
    </style>
@endsection
