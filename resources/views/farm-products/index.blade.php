@extends('layouts.app')

@section('header')
    <div class="products-header">
        <div class="header-content">
            <h2 class="page-title">
                <i class="fas fa-leaf"></i>
                Farm Products
            </h2>
            <p class="page-subtitle" style="color:white">Manage and showcase your farm's finest produce</p>
        </div>
        <div class="header-actions">
            <button class="btn btn-secondary" id="filterToggle">
                <i class="fas fa-filter"></i>
                Filters
            </button>
            <a href="{{ route('farm-products.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i>
                Add New Product
            </a>
        </div>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .products-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }

        .products-header {
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

        .header-actions {
            display: flex;
            gap: 15px;
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
            font-size: 0.95rem;
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

        .btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .btn-success {
            background: linear-gradient(135deg, #4CAF50, #81C784);
            color: white;
        }

        .btn-warning {
            background: linear-gradient(135deg, #FF9800, #FFB74D);
            color: white;
        }

        .btn-danger {
            background: linear-gradient(135deg, #f44336, #ef5350);
            color: white;
        }

        .btn-info {
            background: linear-gradient(135deg, #2196F3, #64B5F6);
            color: white;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .btn-sm {
            padding: 8px 16px;
            font-size: 0.85rem;
        }

        /* Search and Filter Section */
        .search-filter-section {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .search-bar {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            flex-wrap: wrap;
            align-items: center;
        }

        .search-input-group {
            flex: 1;
            min-width: 300px;
            position: relative;
        }

        .search-input {
            width: 100%;
            padding: 15px 50px 15px 20px;
            border: 2px solid rgba(76, 175, 80, 0.2);
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
        }

        .search-input:focus {
            outline: none;
            border-color: #4CAF50;
            box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.1);
        }

        .search-icon {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #4CAF50;
            font-size: 1.2rem;
        }

        .view-toggle {
            display: flex;
            background: rgba(76, 175, 80, 0.1);
            border-radius: 8px;
            padding: 4px;
        }

        .view-btn {
            padding: 8px 16px;
            border: none;
            background: transparent;
            color: #4CAF50;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .view-btn.active {
            background: #4CAF50;
            color: white;
        }

        .filters-panel {
            display: none;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            padding-top: 20px;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .filters-panel.active {
            display: grid;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .filter-label {
            font-weight: 600;
            color: #2E7D32;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .filter-select {
            padding: 10px 15px;
            border: 2px solid rgba(76, 175, 80, 0.2);
            border-radius: 8px;
            background: white;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .filter-select:focus {
            outline: none;
            border-color: #4CAF50;
        }

        /* Stats Overview */
        .products-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 20px;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #4CAF50, #81C784);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #4CAF50, #81C784);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            color: white;
            font-size: 1.3rem;
        }

        .stat-value {
            font-size: 1.8rem;
            font-weight: 700;
            color: #2E7D32;
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 0.9rem;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Products Grid */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }

        .products-grid.list-view {
            grid-template-columns: 1fr;
        }

        .product-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 16px 48px rgba(0, 0, 0, 0.15);
        }

        .product-card.list-item {
            display: flex;
            border-radius: 16px;
        }

        .product-card.list-item .product-image {
            width: 200px;
            height: 150px;
            flex-shrink: 0;
        }

        .product-card.list-item .product-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .product-image {
            width: 100%;
            height: 220px;
            background: linear-gradient(135deg, #f5f5f5, #e8e8e8);
            position: relative;
            overflow: hidden;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .product-card:hover .product-image img {
            transform: scale(1.05);
        }

        .product-image .placeholder-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 3rem;
            color: #4CAF50;
            opacity: 0.5;
        }

        .product-status {
            position: absolute;
            top: 15px;
            right: 15px;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
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

        .status-out-of-stock {
            background: rgba(244, 67, 54, 0.9);
            color: white;
        }

        .product-content {
            padding: 25px;
        }

        .product-category {
            display: inline-block;
            background: rgba(76, 175, 80, 0.1);
            color: #2E7D32;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 500;
            margin-bottom: 12px;
        }

        .product-name {
            font-size: 1.4rem;
            font-weight: 700;
            color: #2E7D32;
            margin-bottom: 8px;
            line-height: 1.3;
        }

        .product-description {
            color: #666;
            font-size: 0.95rem;
            line-height: 1.5;
            margin-bottom: 15px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .product-metrics {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 20px;
        }

        .metric {
            text-align: center;
            padding: 12px;
            background: rgba(76, 175, 80, 0.05);
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .metric:hover {
            background: rgba(76, 175, 80, 0.1);
            transform: translateY(-2px);
        }

        .metric-value {
            font-size: 1.3rem;
            font-weight: 700;
            color: #2E7D32;
            display: block;
        }


        .metric-label {
            font-size: 0.8rem;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 4px;
        }

        .product-price {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding: 15px;
            background: linear-gradient(135deg, rgba(76, 175, 80, 0.1), rgba(129, 199, 132, 0.1));
            border-radius: 12px;
            border: 1px solid rgba(76, 175, 80, 0.2);
        }

        .price-info {
            display: flex;
            flex-direction: column;
        }

        .current-price {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2E7D32;
        }

        .price-unit {
            font-size: 0.9rem;
            color: #666;
        }

        .stock-indicator {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .stock-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        .stock-high {
            background: #4CAF50;
        }

        .stock-medium {
            background: #FF9800;
        }

        .stock-low {
            background: #f44336;
        }

        @keyframes pulse {
            0% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }

            100% {
                opacity: 1;
            }
        }

        .product-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .action-btn {
            flex: 1;
            min-width: 80px;
            text-align: center;
            justify-content: center;
            padding: 10px 15px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.3s ease;
            cursor: pointer;
            font-size: 0.9rem;
        }

        .quick-actions {
            position: absolute;
            top: 15px;
            left: 15px;
            display: flex;
            gap: 8px;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .product-card:hover .quick-actions {
            opacity: 1;
            transform: translateY(0);
        }

        .quick-action-btn {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            border: none;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            font-size: 0.9rem;
        }

        .quick-edit {
            background: rgba(33, 150, 243, 0.8);
        }

        .quick-duplicate {
            background: rgba(255, 152, 0, 0.8);
        }

        .quick-delete {
            background: rgba(244, 67, 54, 0.8);
        }

        .quick-action-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        /* Pagination */
        .pagination-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 40px;
        }

        .pagination {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .page-btn {
            width: 40px;
            height: 40px;
            border: 2px solid rgba(76, 175, 80, 0.2);
            background: white;
            color: #4CAF50;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
        }

        .page-btn:hover,
        .page-btn.active {
            background: #4CAF50;
            color: white;
            border-color: #4CAF50;
        }

        .page-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 80px 20px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .empty-state-icon {
            font-size: 5rem;
            color: #4CAF50;
            margin-bottom: 30px;
            opacity: 0.5;
        }

        .empty-state h3 {
            font-size: 1.8rem;
            color: #2E7D32;
            margin-bottom: 15px;
        }

        .empty-state p {
            color: #666;
            font-size: 1.1rem;
            margin-bottom: 30px;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Loading States */
        .loading-skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 8px;
        }

        @keyframes loading {
            0% {
                background-position: 200% 0;
            }

            100% {
                background-position: -200% 0;
            }
        }

        /* Modal Styles */
        .modal {
            display: none;
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

        .modal.active {
            display: flex;
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
            margin-bottom: 20px;
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
        }

        .modal-close:hover {
            color: #f44336;
            transform: rotate(90deg);
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .products-grid {
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
                gap: 20px;
            }

            .search-bar {
                flex-direction: column;
            }

            .search-input-group {
                min-width: 100%;
            }
        }

        @media (max-width: 768px) {
            .products-container {
                padding: 15px;
            }

            .products-header {
                flex-direction: column;
                gap: 20px;
                text-align: center;
                padding: 25px;
            }

            .page-title {
                font-size: 2rem;
            }

            .header-actions {
                justify-content: center;
                flex-wrap: wrap;
            }

            .products-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .products-stats {
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
            }

            .search-filter-section {
                padding: 20px;
            }

            .filters-panel {
                grid-template-columns: 1fr;
            }

            .product-card.list-item {
                flex-direction: column;
            }

            .product-card.list-item .product-image {
                width: 100%;
                height: 200px;
            }

            .product-content {
                padding: 20px;
            }

            .product-metrics {
                grid-template-columns: 1fr;
                gap: 10px;
            }

            .product-actions {
                flex-direction: column;
            }

            .action-btn {
                min-width: 100%;
            }
        }

        @media (max-width: 480px) {
            .products-stats {
                grid-template-columns: 1fr;
            }

            .product-price {
                flex-direction: column;
                gap: 10px;
                text-align: center;
            }

            .modal-content {
                margin: 20px;
                padding: 20px;
            }
        }

        /* Dark mode support */
        @media (prefers-color-scheme: dark) {

            .search-input,
            .filter-select {
                background: rgba(255, 255, 255, 0.1);
                color: white;
                border-color: rgba(255, 255, 255, 0.2);
            }
        }

        /* Print styles */
        @media print {

            .products-header,
            .search-filter-section,
            .product-actions,
            .quick-actions,
            .pagination-wrapper {
                display: none !important;
            }

            .products-container {
                max-width: none;
                padding: 0;
            }

            .product-card {
                break-inside: avoid;
                box-shadow: none;
                border: 1px solid #ddd;
                margin-bottom: 20px;
            }
        }

        /* Accessibility improvements */
        .btn:focus,
        .search-input:focus,
        .filter-select:focus {
            outline: 2px solid #4CAF50;
            outline-offset: 2px;
        }

        .product-card:focus-within {
            outline: 2px solid #4CAF50;
            outline-offset: 4px;
        }

        /* Animation utilities */
        .fade-in {
            animation: fadeIn 0.5s ease;
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
            animation: slideUp 0.3s ease;
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
    </style>
@endsection

@section('content')
    <div class="products-container">
        <!-- Product Statistics -->
        <div class="products-stats">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-boxes"></i>
                </div>
                <div class="stat-value">{{ $products->count() }}</div>
                <div class="stat-label">Total Products</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-value">{{ $products->where('status', 'published')->count() }}</div>
                <div class="stat-label">Active</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="stat-value">{{ $products->where('total_stock', '<=', 10)->count() }}</div>
                <div class="stat-label">Low Stock</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="stat-value">₦{{ number_format($products->sum('selling_price'), 0) }}</div>
                <div class="stat-label">Total Value</div>
            </div>
        </div>

        <!-- Search and Filter Section -->
        <div class="search-filter-section">
            <div class="search-bar">
                <div class="search-input-group">
                    <input type="text" class="search-input"
                        placeholder="Search products by name, category, or description..." id="searchInput">
                    <i class="fas fa-search search-icon"></i>
                </div>
                <div class="view-toggle">
                    <button class="view-btn active" data-view="grid">
                        <i class="fas fa-th"></i>
                        Grid
                    </button>
                    <button class="view-btn" data-view="list">
                        <i class="fas fa-list"></i>
                        List
                    </button>
                </div>
            </div>

            <div class="filters-panel" id="filtersPanel">
                <div class="filter-group">
                    <label class="filter-label">Category</label>
                    <select class="filter-select" id="categoryFilter">
                        <option value="">All Categories</option>
                        @foreach ($categories ?? [] as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="filter-group">
                    <label class="filter-label">Status</label>
                    <select class="filter-select" id="statusFilter">
                        <option value="">All Status</option>
                        <option value="published">Active</option>
                        <option value="unpublished">Inactive</option>
                        <option value="draft">Draft</option>
                        <option value="out_of_stock">Out of Stock</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label class="filter-label">Price Range</label>
                    <select class="filter-select" id="priceFilter">
                        <option value="">All Prices</option>
                        <option value="0-1000">₦0 - ₦1,000</option>
                        <option value="1000-5000">₦1,000 - ₦5,000</option>
                        <option value="5000-10000">₦5,000 - ₦10,000</option>
                        <option value="10000+">₦10,000+</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label class="filter-label">Stock Level</label>
                    <select class="filter-select" id="stockFilter">
                        <option value="">All Stock</option>
                        <option value="high">High (50+)</option>
                        <option value="medium">Medium (11-49)</option>
                        <option value="low">Low (1-10)</option>
                        <option value="out">Out of Stock</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label class="filter-label">Sort By</label>
                    <select class="filter-select" id="sortFilter">
                        <option value="name_asc">Name (A-Z)</option>
                        <option value="name_desc">Name (Z-A)</option>
                        <option value="price_asc">Price (Low to High)</option>
                        <option value="price_desc">Price (High to Low)</option>
                        <option value="stock_asc">Stock (Low to High)</option>
                        <option value="stock_desc">Stock (High to Low)</option>
                        <option value="created_desc">Newest First</option>
                        <option value="created_asc">Oldest First</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="products-grid" id="productsGrid">
            @forelse($products as $product)
                <div class="product-card fade-in" data-category="{{ $product->category_id ?? '' }}"
                    data-status="{{ $product->status ?? 'published' }}"
                    data-price="{{ $product->selling_price ?? $product->unit_price }}"
                    data-stock="{{ $product->total_stock }}" data-name="{{ strtolower($product->name) }}">

                    <!-- Quick Actions -->
                    <div class="quick-actions">
                        <button class="quick-action-btn quick-edit"
                            onclick="window.location.href='{{ route('farm-products.edit', $product->id) }}'"
                            title="Edit Product">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="quick-action-btn quick-duplicate" onclick="duplicateProduct({{ $product->id }})"
                            title="Duplicate Product">
                            <i class="fas fa-copy"></i>
                        </button>
                        <button class="quick-action-btn quick-delete" onclick="confirmDelete({{ $product->id }})"
                            title="Delete Product">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>

                    <!-- Product Image -->
                    <div class="product-image">
                        @if ($product->product_image)
                            <img src="{{ asset('product_images/' . $product->product_image) }}"
                                alt="{{ $product->name }}" loading="lazy">
                        @else
                            <i class="fas fa-leaf placeholder-icon"></i>
                        @endif

                        <!-- Product Status Badge -->
                        <div class="product-status status-{{ strtolower($product->status ?? 'published') }}">
                            @if ($product->total_stock <= 0)
                                Out of Stock
                            @else
                                {{ ucfirst($product->status ?? 'Published') }}
                            @endif
                        </div>
                    </div>

                    <!-- Product Content -->
                    <div class="product-content">
                        <!-- Category Badge -->
                        <span class="product-category">
                            {{ $product->category->name ?? 'Uncategorized' }}
                        </span>

                        <!-- Product Name -->
                        <h3 class="product-name">{{ $product->name }}</h3>

                        <!-- Product Description -->
                        <p class="product-description">
                            {{ $product->description ?? 'No description available.' }}
                        </p>

                        <!-- Product Metrics -->
                        <div class="product-metrics">
                            <div class="metric">
                                <span class="metric-value">{{ $product->orders_count ?? 0 }}</span>
                                <span class="metric-label">Orders</span>
                            </div>
                            <div class="metric">
                                <span class="metric-value">{{ $product->total_sales ?? 0 }}</span>
                                <span class="metric-label">Sold</span>
                            </div>
                        </div>

                        <!-- Product Price and Stock -->
                        <div class="product-price">
                            <div class="price-info">
                                <span class="current-price">
                                    ₦{{ number_format($product->selling_price ?? $product->unit_price, 2) }}
                                </span>
                                <span class="price-unit">per {{ $product->unit_of_measurement }}</span>
                            </div>
                            <div class="stock-indicator">
                                @php
                                    $stockLevel = 'high';
                                    $stockText = 'In Stock';
                                    if ($product->total_stock <= 0) {
                                        $stockLevel = 'low';
                                        $stockText = 'Out of Stock';
                                    } elseif ($product->total_stock <= 10) {
                                        $stockLevel = 'low';
                                        $stockText = 'Low Stock';
                                    } elseif ($product->total_stock <= 50) {
                                        $stockLevel = 'medium';
                                        $stockText = 'Medium Stock';
                                    }
                                @endphp
                                <div class="stock-dot stock-{{ $stockLevel }}"></div>
                                <span>{{ $stockText }} ({{ $product->total_stock }})</span>
                            </div>
                        </div>

                        <!-- Product Actions -->
                        <div class="product-actions">
                            <a href="{{ route('farm-products.show', $product->id) }}" class="action-btn btn-info">
                                <i class="fas fa-eye"></i>
                                View
                            </a>
                            <a href="{{ route('farm-products.edit', $product->id) }}" class="action-btn btn-warning">
                                <i class="fas fa-edit"></i>
                                Edit
                            </a>
                            <button onclick="toggleStatus({{ $product->id }})"
                                class="action-btn {{ ($product->status ?? 'published') === 'published' ? 'btn-secondary' : 'btn-success' }}">
                                <i
                                    class="fas fa-{{ ($product->status ?? 'published') === 'published' ? 'pause' : 'play' }}"></i>
                                {{ ($product->status ?? 'published') === 'published' ? 'Unpublish' : 'Publish' }}
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="fas fa-seedling"></i>
                    </div>
                    <h3>No Products Found</h3>
                    <p>You haven't added any products yet. Start by adding your first farm product to showcase your produce
                        to potential buyers.</p>
                    <a href="{{ route('farm-products.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        Add Your First Product
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if ($products->hasPages())
            <div class="pagination-wrapper">
                <div class="pagination">
                    @if ($products->onFirstPage())
                        <button class="page-btn" disabled>
                            <i class="fas fa-chevron-left"></i>
                        </button>
                    @else
                        <a href="{{ $products->previousPageUrl() }}" class="page-btn">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    @endif

                    @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                        @if ($page == $products->currentPage())
                            <button class="page-btn active">{{ $page }}</button>
                        @else
                            <a href="{{ $url }}" class="page-btn">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if ($products->hasMorePages())
                        <a href="{{ $products->nextPageUrl() }}" class="page-btn">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    @else
                        <button class="page-btn" disabled>
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    @endif
                </div>
            </div>
        @endif
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal" id="deleteModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Confirm Deletion</h3>
                <button class="modal-close" onclick="closeDeleteModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this product? This action cannot be undone.</p>
                <div style="margin-top: 20px; display: flex; gap: 10px; justify-content: flex-end;">
                    <button class="btn btn-secondary" onclick="closeDeleteModal()">Cancel</button>
                    <button class="btn btn-danger" id="confirmDeleteBtn">
                        <i class="fas fa-trash"></i>
                        Delete Product
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Global variables
        let currentDeleteId = null;

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            initializeFilters();
            initializeSearch();
            initializeViewToggle();
            animateCards();
        });

        // Initialize filters
        function initializeFilters() {
            const filterToggle = document.getElementById('filterToggle');
            const filtersPanel = document.getElementById('filtersPanel');

            filterToggle.addEventListener('click', function() {
                filtersPanel.classList.toggle('active');
                const icon = filterToggle.querySelector('i');
                icon.classList.toggle('fa-filter');
                icon.classList.toggle('fa-filter-circle-xmark');
            });

            // Add event listeners to all filter selects
            document.querySelectorAll('.filter-select').forEach(select => {
                select.addEventListener('change', applyFilters);
            });
        }

        // Initialize search functionality
        function initializeSearch() {
            const searchInput = document.getElementById('searchInput');
            let searchTimeout;

            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    applyFilters();
                }, 300);
            });
        }

        // Initialize view toggle
        function initializeViewToggle() {
            const viewButtons = document.querySelectorAll('.view-btn');
            const productsGrid = document.getElementById('productsGrid');

            viewButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    // Update active button
                    viewButtons.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');

                    // Update grid view
                    const view = this.dataset.view;
                    if (view === 'list') {
                        productsGrid.classList.add('list-view');
                        productsGrid.querySelectorAll('.product-card').forEach(card => {
                            card.classList.add('list-item');
                        });
                    } else {
                        productsGrid.classList.remove('list-view');
                        productsGrid.querySelectorAll('.product-card').forEach(card => {
                            card.classList.remove('list-item');
                        });
                    }
                });
            });
        }

        // Apply all filters
        function applyFilters() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const categoryFilter = document.getElementById('categoryFilter').value;
            const statusFilter = document.getElementById('statusFilter').value;
            const priceFilter = document.getElementById('priceFilter').value;
            const stockFilter = document.getElementById('stockFilter').value;
            const sortFilter = document.getElementById('sortFilter').value;

            const productCards = Array.from(document.querySelectorAll('.product-card'));
            let visibleCards = [];

            productCards.forEach(card => {
                let isVisible = true;

                // Search filter
                if (searchTerm) {
                    const productName = card.dataset.name;
                    const description = card.querySelector('.product-description').textContent.toLowerCase();
                    const category = card.querySelector('.product-category').textContent.toLowerCase();

                    if (!productName.includes(searchTerm) &&
                        !description.includes(searchTerm) &&
                        !category.includes(searchTerm)) {
                        isVisible = false;
                    }
                }

                // Category filter
                if (categoryFilter && card.dataset.category !== categoryFilter) {
                    isVisible = false;
                }

                // Status filter
                if (statusFilter && card.dataset.status !== statusFilter) {
                    isVisible = false;
                }

                // Price filter
                if (priceFilter) {
                    const price = parseFloat(card.dataset.price);
                    const [min, max] = priceFilter.split('-').map(p => parseFloat(p.replace('+', '')));

                    if (priceFilter.includes('+')) {
                        if (price < min) isVisible = false;
                    } else {
                        if (price < min || price > max) isVisible = false;
                    }
                }

                // Stock filter
                if (stockFilter) {
                    const stock = parseInt(card.dataset.stock);
                    switch (stockFilter) {
                        case 'high':
                            if (stock < 50) isVisible = false;
                            break;
                        case 'medium':
                            if (stock < 11 || stock > 49) isVisible = false;
                            break;
                        case 'low':
                            if (stock < 1 || stock > 10) isVisible = false;
                            break;
                        case 'out':
                            if (stock > 0) isVisible = false;
                            break;
                    }
                }

                // Show/hide card with animation
                if (isVisible) {
                    card.style.display = 'block';
                    card.classList.add('fade-in');
                    visibleCards.push(card);
                } else {
                    card.style.display = 'none';
                    card.classList.remove('fade-in');
                }
            });

            // Apply sorting
            if (sortFilter && visibleCards.length > 0) {
                sortProducts(visibleCards, sortFilter);
            }

            // Show empty state if no products visible
            toggleEmptyState(visibleCards.length === 0);
        }

        // Sort products
        function sortProducts(cards, sortType) {
            const container = document.getElementById('productsGrid');

            cards.sort((a, b) => {
                switch (sortType) {
                    case 'name_asc':
                        return a.dataset.name.localeCompare(b.dataset.name);
                    case 'name_desc':
                        return b.dataset.name.localeCompare(a.dataset.name);
                    case 'price_asc':
                        return parseFloat(a.dataset.price) - parseFloat(b.dataset.price);
                    case 'price_desc':
                        return parseFloat(b.dataset.price) - parseFloat(a.dataset.price);
                    case 'stock_asc':
                        return parseInt(a.dataset.stock) - parseInt(b.dataset.stock);
                    case 'stock_desc':
                        return parseInt(b.dataset.stock) - parseInt(a.dataset.stock);
                    case 'created_desc':
                        return new Date(b.dataset.created || 0) - new Date(a.dataset.created || 0);
                    case 'created_asc':
                        return new Date(a.dataset.created || 0) - new Date(b.dataset.created || 0);
                    default:
                        return 0;
                }
            });

            // Reorder DOM elements
            cards.forEach(card => container.appendChild(card));
        }

        // Toggle empty state
        function toggleEmptyState(show) {
            let emptyState = document.querySelector('.empty-state-filter');

            if (show && !emptyState) {
                emptyState = document.createElement('div');
                emptyState.className = 'empty-state empty-state-filter';
                emptyState.innerHTML = `
                    <div class="empty-state-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <h3>No Products Match Your Filters</h3>
                    <p>Try adjusting your search criteria or filters to find what you're looking for.</p>
                    <button class="btn btn-secondary" onclick="clearAllFilters()">
                        <i class="fas fa-times"></i>
                        Clear All Filters
                    </button>
                `;
                document.getElementById('productsGrid').appendChild(emptyState);
            } else if (!show && emptyState) {
                emptyState.remove();
            }
        }

        // Clear all filters
        function clearAllFilters() {
            document.getElementById('searchInput').value = '';
            document.querySelectorAll('.filter-select').forEach(select => {
                select.selectedIndex = 0;
            });
            applyFilters();
        }

        // Animate cards on load
        function animateCards() {
            const cards = document.querySelectorAll('.product-card');
            cards.forEach((card, index) => {
                setTimeout(() => {
                    card.classList.add('fade-in');
                }, index * 100);
            });
        }

        // Product actions
        function toggleStatus(productId) {
            if (confirm('Are you sure you want to change the status of this product?')) {
                // Make AJAX request to toggle status
                fetch(`/farm-products/${productId}/toggle-status`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Reload page to show updated status
                            window.location.reload();
                        } else {
                            alert('Error updating product status');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error updating product status');
                    });
            }
        }

        function duplicateProduct(productId) {
            if (confirm('Are you sure you want to duplicate this product?')) {
                window.location.href = `/farm-products/${productId}/duplicate`;
            }
        }

        function confirmDelete(productId) {
            currentDeleteId = productId;
            document.getElementById('deleteModal').classList.add('active');

            document.getElementById('confirmDeleteBtn').onclick = function() {
                deleteProduct(productId);
            };
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.remove('active');
            currentDeleteId = null;
        }

        function deleteProduct(productId) {
            fetch(`/farm-products/${productId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        closeDeleteModal();

                        // Remove card with animation
                        const card = document.querySelector(`[data-product-id="${productId}"]`);
                        if (card) {
                            card.style.animation = 'fadeOut 0.3s ease';
                            setTimeout(() => {
                                card.remove();
                                // Check if we need to show empty state
                                const remainingCards = document.querySelectorAll('.product-card');
                                if (remainingCards.length === 0) {
                                    window.location.reload();
                                }
                            }, 300);
                        }

                        // Show success message
                        showNotification('Product deleted successfully', 'success');
                    } else {
                        alert('Error deleting product');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error deleting product');
                });
        }

        // Notification system
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

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl/Cmd + K to focus search
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                document.getElementById('searchInput').focus();
            }

            // Escape to close modal
            if (e.key === 'Escape') {
                closeDeleteModal();
            }
        });

        // Lazy loading for images
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.remove('lazy');
                        imageObserver.unobserve(img);
                    }
                });
            });

            document.querySelectorAll('img[data-src]').forEach(img => {
                imageObserver.observe(img);
            });
        }

        // Infinite scroll (if needed)
        function initInfiniteScroll() {
            let loading = false;
            let currentPage = 1;

            window.addEventListener('scroll', () => {
                if (loading) return;

                if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 1000) {
                    loading = true;
                    loadMoreProducts();
                }
            });
        }

        function loadMoreProducts() {
            // Implementation for loading more products via AJAX
            // This would be used if you implement infinite scroll
        }

        // Export functions for global use
        window.toggleStatus = toggleStatus;
        window.duplicateProduct = duplicateProduct;
        window.confirmDelete = confirmDelete;
        window.closeDeleteModal = closeDeleteModal;
        window.clearAllFilters = clearAllFilters;
    </script>
@endsection
