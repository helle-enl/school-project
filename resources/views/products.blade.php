<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - FarmConnect Nigeria</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f9fa;
        }

        /* Navigation - Same as home page */
        .navbar {
            background: linear-gradient(135deg, #2E7D32, #4CAF50);
            padding: 15px 0;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            box-shadow: 0 4px 20px rgba(46, 125, 50, 0.3);
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            color: white;
            text-decoration: none;
        }

        .nav-search {
            flex: 1;
            max-width: 400px;
            margin: 0 40px;
            position: relative;
        }

        .search-input {
            width: 100%;
            padding: 12px 50px 12px 20px;
            border: none;
            border-radius: 25px;
            font-size: 1rem;
            background: rgba(255, 255, 255, 0.9);
        }

        .search-btn {
            position: absolute;
            right: 5px;
            top: 50%;
            transform: translateY(-50%);
            background: #FF6B35;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            color: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .nav-actions {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .nav-btn {
            padding: 10px 20px;
            border: 2px solid white;
            background: transparent;
            color: white;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .nav-btn:hover {
            background: white;
            color: #2E7D32;
        }

        .nav-btn.primary {
            background: #FF6B35;
            border-color: #FF6B35;
        }

        /* Main Content */
        .main-content {
            margin-top: 100px;
            padding: 40px 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .page-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #2E7D32;
            margin-bottom: 15px;
        }

        .page-subtitle {
            font-size: 1.2rem;
            color: #666;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Filters Section */
        .filters-section {
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            margin-bottom: 40px;
        }

        .filters-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            align-items: center;
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
        }

        .filter-select,
        .filter-input {
            padding: 12px 15px;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            font-size: 1rem;
            outline: none;
            transition: all 0.3s ease;
        }

        .filter-select:focus,
        .filter-input:focus {
            border-color: #4CAF50;
            box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.1);
        }

        .filter-btn {
            background: linear-gradient(135deg, #4CAF50, #66BB6A);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .filter-btn:hover {
            background: linear-gradient(135deg, #2E7D32, #4CAF50);
            transform: translateY(-2px);
        }

        .clear-filters {
            background: transparent;
            color: #666;
            border: 2px solid #e5e7eb;
        }

        .clear-filters:hover {
            background: #f8f9fa;
            border-color: #d1d5db;
        }

        /* Results Header */
        .results-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .results-count {
            font-size: 1.1rem;
            color: #666;
        }

        .sort-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sort-label {
            font-weight: 600;
            color: #2E7D32;
        }

        /* Products Grid */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }

        .product-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }

        .product-image {
            width: 100%;
            height: 200px;
            background: linear-gradient(45deg, #4CAF50, #66BB6A);
            position: relative;
            overflow: hidden;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: #FF6B35;
            color: white;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .product-info {
            padding: 25px;
        }

        .product-name {
            font-size: 1.3rem;
            font-weight: 600;
            color: #2E7D32;
            margin-bottom: 10px;
        }

        .product-price {
            font-size: 1.5rem;
            font-weight: 700;
            color: #FF6B35;
            margin-bottom: 10px;
        }

        .product-location {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .product-farmer {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .product-actions {
            display: flex;
            gap: 10px;
        }

        .product-btn {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #4CAF50, #66BB6A);
            color: white;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #2E7D32, #4CAF50);
        }

        .btn-secondary {
            background: transparent;
            color: #FF6B35;
            border: 2px solid #FF6B35;
        }

        .btn-secondary:hover {
            background: #FF6B35;
            color: white;
        }

        /* Pagination */
        .pagination-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 40px;
        }

        .pagination {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .page-link {
            padding: 10px 15px;
            border: 2px solid #e5e7eb;
            background: white;
            color: #666;
            text-decoration: none;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .page-link:hover {
            border-color: #4CAF50;
            color: #4CAF50;
        }

        .page-link.active {
            background: #4CAF50;
            border-color: #4CAF50;
            color: white;
        }

        .page-link.disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* No Results */
        .no-results {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }

        .no-results-icon {
            font-size: 4rem;
            color: #ccc;
            margin-bottom: 20px;
        }

        .no-results-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }

        .no-results-text {
            color: #666;
            margin-bottom: 20px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .nav-container {
                flex-direction: column;
                gap: 20px;
            }

            .nav-search {
                margin: 0;
                max-width: 100%;
            }

            .filters-grid {
                grid-template-columns: 1fr;
            }

            .results-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .products-grid {
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                gap: 20px;
            }

            .page-title {
                font-size: 2rem;
            }
        }

        @media (max-width: 480px) {
            .product-actions {
                flex-direction: column;
            }

            .filters-section {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="{{ route('home') }}" class="logo">
                <i class="fas fa-seedling"></i>
                FarmConnect Nigeria
            </a>

            <div class="nav-search">
                <form action="{{ route('products') }}" method="GET" style="display: contents;">
                    <input type="text" class="search-input" name="search"
                        placeholder="Search for crops, farmers, locations..." value="{{ request('search') }}">
                    <button type="submit" class="search-btn">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>

            <div class="nav-actions">
                @auth
                    <a href="{{ route('dashboard') }}" class="nav-btn">
                        <i class="fas fa-tachometer-alt"></i>
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="nav-btn">
                        <i class="fas fa-sign-in-alt"></i>
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="nav-btn primary">
                        <i class="fas fa-user-plus"></i>
                        Sign Up
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <!-- Page Header -->
            <div class="page-header">
                <h1 class="page-title">Fresh Products from Nigerian Farmers</h1>
                <p class="page-subtitle">
                    Discover high-quality agricultural products directly from verified farmers across Nigeria
                </p>
            </div>

            <!-- Filters Section -->
            <div class="filters-section">
                <form action="{{ route('products') }}" method="GET" id="filterForm">
                    <div class="filters-grid">
                        <div class="filter-group">
                            <label class="filter-label">Search Products</label>
                            <input type="text" class="filter-input" name="search"
                                placeholder="Product name, description..." value="{{ request('search') }}">
                        </div>

                        <div class="filter-group">
                            <label class="filter-label">Category</label>
                            <select class="filter-select" name="category">
                                <option value="">All Categories</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }} ({{ $category->active_products_count }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="filter-group">
                            <label class="filter-label">Location</label>
                            <select class="filter-select" name="location">
                                <option value="">All Locations</option>
                                @foreach ($locations as $location)
                                    <option value="{{ $location }}"
                                        {{ request('location') == $location ? 'selected' : '' }}>
                                        {{ $location }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="filter-group">
                            <label class="filter-label">Min Price (₦)</label>
                            <input type="number" class="filter-input" name="min_price" placeholder="0"
                                value="{{ request('min_price') }}">
                        </div>

                        <div class="filter-group">
                            <label class="filter-label">Max Price (₦)</label>
                            <input type="number" class="filter-input" name="max_price" placeholder="Any"
                                value="{{ request('max_price') }}">
                        </div>

                        <div class="filter-group" style="justify-content: flex-end; flex-direction: row; gap: 10px;">
                            <button type="submit" class="filter-btn">
                                <i class="fas fa-search"></i>
                                Apply Filters
                            </button>
                            <a href="{{ route('products') }}" class="filter-btn clear-filters">
                                <i class="fas fa-times"></i>
                                Clear All
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Results Header -->
            <div class="results-header">
                <div class="results-count">
                    <strong>{{ $products->total() }}</strong> products found
                    @if (request('search'))
                        for "<strong>{{ request('search') }}</strong>"
                    @endif
                </div>

                <div class="sort-group">
                    <label class="sort-label">Sort by:</label>
                    <select class="filter-select" name="sort" onchange="updateSort(this.value)" style="margin: 0;">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                        <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Most Popular
                        </option>
                        <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to
                            High</option>
                        <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High
                            to Low</option>
                    </select>
                </div>
            </div>

            <!-- Products Grid -->
            @if ($products->count() > 0)
                <div class="products-grid">
                    @foreach ($products as $product)
                        <div class="product-card">
                            <div class="product-image">
                                @if ($product->product_image)
                                    <img src="{{ asset('product_images/' . $product->product_image) }}"
                                        alt="{{ $product->name }}">
                                @endif
                                @if ($product->orders_count > 0)
                                    <div class="product-badge">Popular</div>
                                @endif
                            </div>

                            <div class="product-info">
                                <h3 class="product-name">{{ $product->name }}</h3>
                                <div class="product-price">
                                    ₦{{ number_format($product->selling_price ?? $product->unit_price) }}
                                    <span style="font-size: 0.8em; font-weight: 400;">
                                        /{{ $product->unit_of_measurement }}
                                    </span>
                                </div>

                                <div class="product-location">
                                    <i class="fas fa-map-marker-alt"></i>
                                    {{ $product->farmer->farm_location ?? 'Location not specified' }}
                                </div>

                                <div class="product-farmer">
                                    <i class="fas fa-user"></i>
                                    {{ $product->farmer->farm_name ?? $product->farmer->first_name . ' ' . $product->farmer->last_name }}
                                </div>

                                @if ($product->description)
                                    <p style="color: #666; font-size: 0.9rem; margin-bottom: 15px; line-height: 1.4;">
                                        {{ Str::limit($product->description, 100) }}
                                    </p>
                                @endif

                                <div class="product-actions">
                                    <a href="{{ route('product.show', $product->id) }}"
                                        class="product-btn btn-secondary">
                                        <i class="fas fa-eye"></i>
                                        View Details
                                    </a>
                                    <button class="product-btn btn-primary"
                                        onclick="contactFarmer({{ $product->farmer->id }})">
                                        <i class="fas fa-phone"></i>
                                        Contact
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="pagination-wrapper">
                    {{ $products->withQueryString()->links('custom.pagination') }}
                </div>
            @else
                <!-- No Results -->
                <div class="no-results">
                    <div class="no-results-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <h3 class="no-results-title">No products found</h3>
                    <p class="no-results-text">
                        Try adjusting your search criteria or browse all available products.
                    </p>
                    <a href="{{ route('products') }}" class="filter-btn">
                        <i class="fas fa-refresh"></i>
                        View All Products
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        function updateSort(sortValue) {
            const url = new URL(window.location.href);
            url.searchParams.set('sort', sortValue);
            window.location.href = url.toString();
        }

        function contactFarmer(farmerId) {
            @auth
            window.location.href = `/farmer/${farmerId}/contact`;
        @else
            window.location.href = `/login?redirect=/farmer/${farmerId}/contact`;
        @endauth
        }

        // Auto-submit form when filters change
        document.querySelectorAll('.filter-select').forEach(select => {
            if (select.name !== 'sort') {
                select.addEventListener('change', function() {
                    document.getElementById('filterForm').submit();
                });
            }
        });

        // Search input enter key
        document.querySelector('input[name="search"]').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                document.getElementById('filterForm').submit();
            }
        });
    </script>
</body>

</html>
