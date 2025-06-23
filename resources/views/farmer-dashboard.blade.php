@extends('layouts.app')

@section('header')
    <div class="dashboard-header">
        <div class="header-content">
            <h2 class="dashboard-title">
                <i class="fas fa-tractor"></i>
                Dashboard
            </h2>
            <p class="dashboard-subtitle" style="color: white">Monitor your farm's performance and sales analytics</p>
        </div>
        <div class="header-actions">
            <button class="btn btn-primary">
                <i class="fas fa-plus"></i>
                Add Product
            </button>
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

        .dashboard-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
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

        .dashboard-box h4 {
            font-size: 1.1rem;
            margin-bottom: 10px;
            color: #666;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
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

        .chart-period {
            display: flex;
            gap: 10px;
        }

        .period-btn {
            padding: 8px 16px;
            border: 2px solid #4CAF50;
            background: transparent;
            color: #4CAF50;
            border-radius: 20px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .period-btn.active,
        .period-btn:hover {
            background: #4CAF50;
            color: white;
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

        th {
            background: rgba(76, 175, 80, 0.1);
            color: #2E7D32;
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        tbody tr {
            transition: all 0.3s ease;
        }

        tbody tr:hover {
            background: rgba(76, 175, 80, 0.05);
            transform: scale(1.01);
        }

        .metric-card {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .metric-value {
            font-size: 1.8rem;
            font-weight: 700;
            color: #2E7D32;
        }

        .metric-label {
            font-size: 0.9rem;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
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

        .loading-skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% {
                background-position: 200% 0;
            }

            100% {
                background-position: -200% 0;
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
                    <i class="fas fa-seedling"></i>
                </div>
                <h4>Total Products</h4>
                <p>{{ $totalProducts }}</p>
                <div class="box-trend">
                    <i class="fas fa-arrow-up"></i>
                    <span>Active listings</span>
                </div>
            </div>

            <div class="dashboard-box">
                <div class="box-icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <h4>Units Sold</h4>
                <p>{{ number_format($totalUnitsSold) }}</p>
                <div class="box-trend">
                    <i class="fas fa-arrow-up"></i>
                    <span>Total volume</span>
                </div>
            </div>

            <div class="dashboard-box">
                <div class="box-icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <h4>Total Revenue</h4>
                <p>₦{{ number_format($totalSales, 2) }}</p>
                <div class="box-trend">
                    <i class="fas fa-arrow-up"></i>
                    <span>Gross sales</span>
                </div>
            </div>

            <div class="dashboard-box">
                <div class="box-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h4>Net Profit</h4>
                <p>₦{{ number_format($totalProfit, 2) }}</p>
                <div class="box-trend">
                    <i class="fas fa-arrow-up"></i>
                    <span>After costs</span>
                </div>
            </div>

            <div class="dashboard-box">
                <div class="box-icon">
                    <i class="fas fa-users"></i>
                </div>
                <h4>Active Customers</h4>
                <p>{{ $totalCustomers }}</p>
                <div class="box-trend">
                    <i class="fas fa-arrow-up"></i>
                    <span>Unique buyers</span>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="chart-container">
            <div class="chart-header">
                <h3 class="chart-title">
                    <i class="fas fa-calendar-day"></i>
                    Daily Sales Performance
                </h3>
                <div class="chart-period">
                    <button class="period-btn active">7 Days</button>
                    <button class="period-btn">30 Days</button>
                    <button class="period-btn">90 Days</button>
                </div>
            </div>
            <canvas id="dailySalesChart"></canvas>
        </div>

        <div class="chart-container">
            <div class="chart-header">
                <h3 class="chart-title">
                    <i class="fas fa-calendar-week"></i>
                    Weekly Revenue Trends
                </h3>
            </div>
            <canvas id="weeklySalesChart"></canvas>
        </div>

        <!-- Top Products Table -->
        <div class="data-table">
            <div class="table-header">
                <h3 class="table-title">
                    <i class="fas fa-star"></i>
                    Top Performing Products
                </h3>
                <span class="badge">{{ count($topSellingProducts) }} items</span>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Units Sold</th>
                        <th>Revenue</th>
                        <th>Performance</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($topSellingProducts as $index => $product)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <div class="product-info">
                                    <strong>{{ $product->name }}</strong>
                                    <small
                                        style="display: block; color: #666;">{{ $product->category->name ?? 'N/A' }}</small>
                                </div>
                            </td>
                            <td>
                                <span class="metric-value" style="font-size: 1.2rem;">{{ $product->units_sold ?? 0 }}</span>
                            </td>
                            <td>
                                <span class="metric-value"
                                    style="font-size: 1.2rem;">₦{{ number_format($product->total_sales ?? 0, 2) }}</span>
                            </td>
                            <td>
                                @php
                                    $maxSales = $topSellingProducts->max('total_sales') ?: 1;
                                    $percentage = $maxSales > 0 ? ($product->total_sales / $maxSales) * 100 : 0;
                                @endphp
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: {{ $percentage }}%"></div>
                                </div>
                                <small style="color: #666;">{{ number_format($percentage, 1) }}%</small>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <i class="fas fa-inbox"></i>
                                    <h4>No products sold yet</h4>
                                    <p>Start selling your products to see performance data here.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Top Customers Table -->
        <div class="data-table">
            <div class="table-header">
                <h3 class="table-title">
                    <i class="fas fa-crown"></i>
                    Top Valued Customers
                </h3>
                <span class="badge">{{ count($topCustomers) }} customers</span>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Customer</th>
                        <th>Total Orders</th>
                        <th>Total Spent</th>
                        <th>Customer Value</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($topCustomers as $index => $customer)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <div class="customer-info">
                                    <div class="customer-avatar">
                                        {{ strtoupper(substr($customer->first_name ?? 'U', 0, 1)) }}{{ strtoupper(substr($customer->last_name ?? 'N', 0, 1)) }}
                                    </div>
                                    <div>
                                        <strong>{{ $customer->first_name }} {{ $customer->last_name }}</strong>
                                        <small style="display: block; color: #666;">{{ $customer->email }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="metric-value"
                                    style="font-size: 1.2rem;">{{ $customer->order_count ?? 0 }}</span>
                            </td>
                            <td>
                                <span class="metric-value"
                                    style="font-size: 1.2rem;">₦{{ number_format($customer->total_spent ?? 0, 2) }}</span>
                            </td>
                            <td>
                                @php
                                    $maxSpent = $topCustomers->max('total_spent') ?: 1;
                                    $percentage = $maxSpent > 0 ? ($customer->total_spent / $maxSpent) * 100 : 0;
                                @endphp
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: {{ $percentage }}%"></div>
                                </div>
                                <small style="color: #666;">{{ number_format($percentage, 1) }}%</small>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <i class="fas fa-users"></i>
                                    <h4>No customers yet</h4>
                                    <p>Your first customers will appear here once they make purchases.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Detailed Product Performance -->
        <div class="data-table">
            <div class="table-header">
                <h3 class="table-title">
                    <i class="fas fa-analytics"></i>
                    Product Performance Analytics
                </h3>
                <div class="table-actions">
                    <button class="btn btn-secondary">
                        <i class="fas fa-download"></i>
                        Export Data
                    </button>
                </div>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Unit Price</th>
                        <th>Units Sold</th>
                        <th>Revenue</th>
                        <th>Profit Margin</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        @php
                            $unitsSold = $product->orders->sum('quantity');
                            $unitPrice = $product->selling_price ?? $product->unit_price;
                            $total = $product->orders->sum('total_price');
                            $profit = $total - $unitsSold * $product->unit_price;
                            $profitMargin = $total > 0 ? ($profit / $total) * 100 : 0;
                        @endphp
                        <tr>
                            <td>
                                <div class="product-cell">
                                    <div class="product-image">
                                        @if ($product->product_image)
                                            <img src="{{ asset('storage/' . $product->product_image) }}"
                                                alt="{{ $product->name }}">
                                        @else
                                            <i class="fas fa-leaf"></i>
                                        @endif
                                    </div>
                                    <div>
                                        <strong>{{ $product->name }}</strong>
                                        <small
                                            style="display: block; color: #666;">{{ Str::limit($product->description, 30) }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="category-badge">{{ $product->category->name ?? 'Uncategorized' }}</span>
                            </td>
                            <td>
                                <span class="price-tag">₦{{ number_format($unitPrice, 2) }}</span>
                                <small style="display: block; color: #666;">per
                                    {{ $product->unit_of_measurement }}</small>
                            </td>
                            <td>
                                <span class="metric-value" style="font-size: 1.1rem;">{{ $unitsSold }}</span>
                            </td>
                            <td>
                                <span class="metric-value"
                                    style="font-size: 1.1rem;">₦{{ number_format($total, 2) }}</span>
                            </td>
                            <td>
                                <div class="profit-indicator">
                                    <span class="profit-value {{ $profitMargin > 0 ? 'positive' : 'negative' }}">
                                        {{ number_format($profitMargin, 1) }}%
                                    </span>
                                    <small style="display: block; color: #666;">₦{{ number_format($profit, 2) }}</small>
                                </div>
                            </td>
                            <td>
                                <span class="status-badge status-{{ strtolower($product->status ?? 'active') }}">
                                    {{ ucfirst($product->status ?? 'Active') }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <i class="fas fa-seedling"></i>
                                    <h4>No products added yet</h4>
                                    <p>Add your first product to start tracking performance.</p>
                                    <button class="btn btn-primary" style="margin-top: 15px;">
                                        <i class="fas fa-plus"></i>
                                        Add Your First Product
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Enhanced Daily Sales Chart
        const dailySalesCtx = document.getElementById('dailySalesChart').getContext('2d');
        const dailySalesChart = new Chart(dailySalesCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($dailyLabels) !!},
                datasets: [{
                    label: 'Daily Revenue (₦)',
                    data: {!! json_encode($dailyData) !!},
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
                                return 'Revenue: ₦' + context.parsed.y.toLocaleString();
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

        // Enhanced Weekly Sales Chart
        const weeklySalesCtx = document.getElementById('weeklySalesChart').getContext('2d');
        const weeklySalesChart = new Chart(weeklySalesCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($weeklyLabels) !!},
                datasets: [{
                    label: 'Weekly Revenue (₦)',
                    data: {!! json_encode($weeklyData) !!},
                    backgroundColor: function(context) {
                        const chart = context.chart;
                        const {
                            ctx,
                            chartArea
                        } = chart;
                        if (!chartArea) {
                            return null;
                        }
                        const gradient = ctx.createLinearGradient(0, chartArea.bottom, 0, chartArea
                            .top);
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
                                return 'Revenue: ₦' + context.parsed.y.toLocaleString();
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

        // Chart period toggle functionality
        document.querySelectorAll('.period-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.period-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                // Here you could implement AJAX calls to load different time periods
            });
        });

        // Add loading animation on page load
        window.addEventListener('load', function() {
            document.querySelectorAll('.loading-skeleton').forEach(el => {
                el.classList.remove('loading-skeleton');
            });
        });

        // Animate numbers on scroll
        const animateNumbers = () => {
            const numbers = document.querySelectorAll('.dashboard-box p');
            numbers.forEach(number => {
                const target = parseInt(number.textContent.replace(/[₦,]/g, ''));
                if (target) {
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

        document.querySelector('.dashboard-boxes') && observer.observe(document.querySelector('.dashboard-boxes'));
    </script>

    <style>
        /* Additional styles for enhanced components */
        .badge {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .btn-secondary {
            background: rgba(46, 125, 50, 0.1);
            color: #2E7D32;
            border: 1px solid rgba(46, 125, 50, 0.2);
        }

        .btn-secondary:hover {
            background: rgba(46, 125, 50, 0.2);
            transform: translateY(-1px);
        }

        .table-actions {
            display: flex;
            gap: 10px;
        }

        .product-info {
            display: flex;
            flex-direction: column;
        }

        .customer-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .customer-avatar {
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

        .product-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .product-image {
            width: 45px;
            height: 45px;
            background: #f5f5f5;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-image i {
            color: #4CAF50;
            font-size: 1.2rem;
        }

        .category-badge {
            background: rgba(76, 175, 80, 0.1);
            color: #2E7D32;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .price-tag {
            font-weight: 600;
            color: #2E7D32;
            font-size: 1.1rem;
        }

        .profit-indicator {
            text-align: center;
        }

        .profit-value {
            font-weight: bold;
            font-size: 1.1rem;
        }

        .profit-value.positive {
            color: #4CAF50;
        }

        .profit-value.negative {
            color: #f44336;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-active {
            background: rgba(76, 175, 80, 0.1);
            color: #2E7D32;
        }

        .status-inactive {
            background: rgba(158, 158, 158, 0.1);
            color: #666;
        }

        .status-out-of-stock {
            background: rgba(244, 67, 54, 0.1);
            color: #c62828;
        }

        /* Chart container height */
        .chart-container canvas {
            height: 400px !important;
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

        /* Enhanced hover effects */
        .data-table table tbody tr:hover {
            background: rgba(76, 175, 80, 0.03);
            box-shadow: 0 2px 8px rgba(76, 175, 80, 0.1);
        }

        /* Responsive improvements */
        @media (max-width: 1024px) {
            .chart-container canvas {
                height: 300px !important;
            }

            .table-header {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }
        }

        @media (max-width: 768px) {
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

            .chart-container canvas {
                height: 250px !important;
            }

            table {
                font-size: 0.9rem;
            }

            th,
            td {
                padding: 10px 8px;
            }

            .customer-info,
            .product-cell {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }

            .customer-avatar {
                width: 35px;
                height: 35px;
                font-size: 0.8rem;
            }

            .product-image {
                width: 35px;
                height: 35px;
            }
        }

        /* Print styles */
        @media print {

            .dashboard-header,
            .chart-period,
            .table-actions,
            .btn {
                display: none !important;
            }

            .dashboard-container {
                max-width: none;
                padding: 0;
            }

            .dashboard-box {
                break-inside: avoid;
                box-shadow: none;
                border: 1px solid #ddd;
            }

            .chart-container,
            .data-table {
                break-inside: avoid;
                box-shadow: none;
                border: 1px solid #ddd;
            }
        }

        /* Accessibility improvements */
        .dashboard-box:focus,
        .btn:focus {
            outline: 2px solid #4CAF50;
            outline-offset: 2px;
        }

        .period-btn:focus {
            outline: 2px solid #4CAF50;
            outline-offset: 1px;
        }

        /* Additional micro-interactions */
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

        .dashboard-box:hover::after {
            opacity: 1;
        }

        /* Smooth transitions for all interactive elements */
        * {
            transition: all 0.2s ease-in-out;
        }

        /* Success/Error states for future use */
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

        .alert-warning {
            background: rgba(255, 193, 7, 0.1);
            color: #f57c00;
            border-left: 4px solid #ff9800;
        }
    </style>
@endsection
