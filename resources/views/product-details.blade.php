<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - FarmConnect Nigeria</title>
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

        /* Navigation - Same as other pages */
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

        .breadcrumb {
            margin-bottom: 30px;
            color: #666;
        }

        .breadcrumb a {
            color: #4CAF50;
            text-decoration: none;
        }

        .breadcrumb a:hover {
            text-decoration: underline;
        }

        /* Product Details Section */
        .product-details {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 40px;
        }

        .product-main {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            padding: 40px;
        }

        .product-image-section {
            position: relative;
        }

        .product-image {
            width: 100%;
            height: 400px;
            background: linear-gradient(45deg, #4CAF50, #66BB6A);
            border-radius: 15px;
            overflow: hidden;
            position: relative;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background: #FF6B35;
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
        }

        .product-info-section {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .product-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #2E7D32;
            margin-bottom: 10px;
        }

        .product-price {
            font-size: 2rem;
            font-weight: 700;
            color: #FF6B35;
            margin-bottom: 20px;
        }

        .product-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 20px;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #666;
        }

        .meta-item i {
            color: #4CAF50;
        }

        .product-description {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .farmer-info {
            background: linear-gradient(135deg, rgba(76, 175, 80, 0.1), rgba(139, 195, 74, 0.1));
            padding: 20px;
            border-radius: 15px;
            border-left: 4px solid #4CAF50;
        }

        .farmer-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
        }

        .farmer-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #4CAF50, #66BB6A);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
        }

        .farmer-details h3 {
            color: #2E7D32;
            margin-bottom: 5px;
        }

        .farmer-details p {
            color: #666;
            font-size: 0.9rem;
        }

        /* Order Section */
        .order-section {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            padding: 40px;
            margin-bottom: 40px;
        }

        .order-title {
            font-size: 1.8rem;
            font-weight: 600;
            color: #2E7D32;
            margin-bottom: 30px;
            text-align: center;
        }

        .order-form {
            max-width: 600px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #2E7D32;
        }

        .form-input {
            width: 100%;
            padding: 15px;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            font-size: 1rem;
            outline: none;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            border-color: #4CAF50;
            box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.1);
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .quantity-btn {
            width: 40px;
            height: 40px;
            border: 2px solid #4CAF50;
            background: transparent;
            color: #4CAF50;
            border-radius: 50%;
            cursor: pointer;
            font-size: 1.2rem;
            transition: all 0.3s ease;
        }

        .quantity-btn:hover {
            background: #4CAF50;
            color: white;
        }

        .quantity-input {
            width: 80px;
            text-align: center;
            font-weight: 600;
        }

        .price-summary {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin: 20px 0;
        }

        .price-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .price-row.total {
            font-weight: 700;
            font-size: 1.2rem;
            color: #2E7D32;
            border-top: 2px solid #e5e7eb;
            padding-top: 10px;
            margin-top: 15px;
        }

        .order-btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #4CAF50, #66BB6A);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .order-btn:hover {
            background: linear-gradient(135deg, #2E7D32, #4CAF50);
            transform: translateY(-2px);
        }

        .order-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        /* Related Products */
        .related-products {
            margin-top: 60px;
        }

        .section-title {
            font-size: 2rem;
            font-weight: 700;
            color: #2E7D32;
            text-align: center;
            margin-bottom: 40px;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
        }

        .product-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }

        .card-image {
            height: 200px;
            background: linear-gradient(45deg, #4CAF50, #66BB6A);
            position: relative;
        }

        .card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .card-info {
            padding: 20px;
        }

        .card-title {
            font-weight: 600;
            color: #2E7D32;
            margin-bottom: 10px;
        }

        .card-price {
            font-weight: 700;
            color: #FF6B35;
            font-size: 1.2rem;
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

            .product-main {
                grid-template-columns: 1fr;
                gap: 20px;
                padding: 20px;
            }

            .product-title {
                font-size: 2rem;
            }

            .product-price {
                font-size: 1.5rem;
            }

            .order-section {
                padding: 20px;
            }

            .nav-container {
                flex-direction: column;
                gap: 15px;
            }
        }

        /* Login Required Message */
        .login-required {
            background: linear-gradient(135deg, rgba(255, 107, 53, 0.1), rgba(229, 90, 43, 0.1));
            border: 2px solid #FF6B35;
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            margin: 20px 0;
        }

        .login-required h3 {
            color: #FF6B35;
            margin-bottom: 15px;
        }

        .login-required p {
            color: #666;
            margin-bottom: 20px;
        }

        .login-btn {
            display: inline-block;
            padding: 12px 30px;
            background: #FF6B35;
            color: white;
            text-decoration: none;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .login-btn:hover {
            background: #E55A2B;
            transform: translateY(-2px);
        }

        /* Sold out form styles */
        .form-input:disabled,
        .quantity-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed !important;
            background-color: #f5f5f5;
        }

        .quantity-btn:disabled:hover {
            background: transparent !important;
            color: #ccc !important;
        }

        .sold-out-overlay {
            backdrop-filter: blur(2px);
        }

        .order-btn:disabled {
            opacity: 0.7;
            cursor: not-allowed !important;
            transform: none !important;
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="#" class="logo">
                <i class="fas fa-seedling"></i>
                FarmConnect Nigeria
            </a>

            <div class="nav-search">
                <input type="text" class="search-input" placeholder="Search for crops, farmers, locations...">
                <button class="search-btn">
                    <i class="fas fa-search"></i>
                </button>
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
            <!-- Breadcrumb -->
            <div class="breadcrumb">
                <a href="{{ route('home') }}">Home</a> >
                <a href="{{ route('products') }}">Products</a> >
                {{ $product->name }}
            </div>

            <!-- Product Details -->
            <div class="product-details">
                <div class="product-main">
                    <div class="product-image-section">
                        <div class="product-image">
                            @if ($product->product_image)
                                <img src="{{ asset('product_images/' . $product->product_image) }}"
                                    alt="{{ $product->name }}">
                            @endif
                            @if ($product->orders->count() > 0)
                                <div class="product-badge">Popular</div>
                            @endif
                        </div>
                    </div>
                    <div class="product-info-section">
                        <h1 class="product-title">{{ $product->name }}</h1>
                        <div class="product-price">
                            ₦{{ number_format($product->selling_price ?? $product->unit_price) }}
                            <span style="font-size: 1rem; font-weight: 400; color: #666;">
                                per {{ $product->unit_of_measurement }}
                            </span>
                        </div>
                        @php
                            // Calculate available stock
                            $soldQuantity = $product
                                ->orders()
                                ->whereIn('status', ['confirmed', 'completed', 'shipped', 'delivered'])
                                ->sum('quantity');
                            $availableStock = max(0, $product->total_stock - $soldQuantity);
                        @endphp

                        <div class="product-meta">
                            <div class="meta-item">
                                <i class="fas fa-box"></i>
                                <span>
                                    @if ($availableStock > 0)
                                        Stock: {{ $availableStock }} available
                                    @else
                                        <span style="color: #f44336; font-weight: 600;">Sold Out</span>
                                    @endif
                                </span>
                            </div>
                            <div class="meta-item">
                                <i class="fas fa-tag"></i>
                                <span>{{ $product->category->name ?? 'Uncategorized' }}</span>
                            </div>
                            <div class="meta-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>{{ $product->farmer->farm_location ?? 'Nigeria' }}</span>
                            </div>
                            @if ($product->tags)
                                <div class="meta-item">
                                    <i class="fas fa-tags"></i>
                                    <span>{{ $product->tags }}</span>
                                </div>
                            @endif
                        </div>

                        @if ($product->description)
                            <div class="product-description">
                                <h3 style="margin-bottom: 15px; color: #2E7D32;">
                                    <i class="fas fa-info-circle"></i> Product Description
                                </h3>
                                <p>{{ $product->description }}</p>
                            </div>
                        @endif

                        <div class="farmer-info">
                            <div class="farmer-header">
                                <div class="farmer-avatar">
                                    @if ($product->farmer->profile_picture)
                                        <img src="{{ asset('profile_pictures/' . $product->farmer->profile_picture) }}"
                                            alt="{{ $product->farmer->first_name }}"
                                            style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                                    @else
                                        <i class="fas fa-user"></i>
                                    @endif
                                </div>
                                <div class="farmer-details">
                                    <h3>{{ $product->farmer->farm_name ?? $product->farmer->first_name . ' ' . $product->farmer->last_name }}
                                    </h3>
                                    <p><i class="fas fa-seedling"></i>
                                        {{ $product->farmer->farm_type ? ucfirst($product->farmer->farm_type) . ' Farming' : 'Mixed Farming' }}
                                    </p>
                                    <p><i class="fas fa-phone"></i> Contact:
                                        {{ $product->farmer->whatsapp_number ?? 'Available on order' }}</p>
                                </div>
                            </div>
                            @if ($product->farmer->about_farmer)
                                <p style="color: #666; line-height: 1.6;">{{ $product->farmer->about_farmer }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- Order Section -->
            @auth
                @if (auth()->user()->role === 'buyer')
                    @if ($availableStock > 0)
                        <div class="order-section">
                            <h2 class="order-title">
                                <i class="fas fa-shopping-cart"></i> Place Your Order
                            </h2>

                            <form class="order-form" id="orderForm" action="{{ route('orders.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="buyer_id" value="{{ auth()->id() }}">

                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fas fa-sort-numeric-up"></i> Quantity
                                    </label>
                                    <div class="quantity-controls">
                                        <button type="button" class="quantity-btn" onclick="decreaseQuantity()">-</button>
                                        <input type="number" class="form-input quantity-input" name="quantity"
                                            id="quantity" value="1" min="1" max="{{ $availableStock }}"
                                            onchange="updateTotal()">
                                        <button type="button" class="quantity-btn" onclick="increaseQuantity()">+</button>
                                    </div>
                                    <small style="color: #666; margin-top: 5px; display: block;">
                                        Maximum available: {{ $availableStock }} {{ $product->unit_of_measurement }}
                                    </small>
                                </div>


                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fas fa-map-marker-alt"></i> Shipping Address
                                    </label>
                                    <textarea class="form-input" name="shipping_address" rows="3" placeholder="Enter your delivery address..."
                                        required></textarea>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fas fa-sticky-note"></i> Additional Notes (Optional)
                                    </label>
                                    <textarea class="form-input" name="note" rows="2" placeholder="Any special requests or notes..."></textarea>
                                </div>

                                <div class="price-summary">
                                    <div class="price-row">
                                        <span>Unit Price:</span>
                                        <span>₦{{ number_format($product->selling_price ?? $product->unit_price) }}</span>
                                    </div>
                                    <div class="price-row">
                                        <span>Quantity:</span>
                                        <span id="summaryQuantity">1</span>
                                    </div>
                                    <div class="price-row total">
                                        <span>Total Amount:</span>
                                        <span
                                            id="totalAmount">₦{{ number_format($product->selling_price ?? $product->unit_price) }}</span>
                                    </div>
                                </div>

                                <button type="submit" class="order-btn" id="orderButton">
                                    <i class="fas fa-check-circle"></i> Place Order Now
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="login-required">
                            <h3><i class="fas fa-exclamation-triangle"></i> Product Sold Out</h3>
                            <p>This product is currently out of stock. Please check back later or contact the farmer
                                directly.</p>
                            <p style="color: #666;">Farmer: {{ $product->farmer->first_name }}
                                {{ $product->farmer->last_name }}</p>
                        </div>
                    @endif
                @else
                    <div class="login-required">
                        <h3><i class="fas fa-user-shield"></i> Farmer Account Detected</h3>
                        <p>You're logged in as a farmer. Only buyers can place orders for products.</p>
                        <p>Switch to a buyer account to purchase products from other farmers.</p>
                    </div>
                @endif
            @else
                <div class="login-required">
                    <h3><i class="fas fa-sign-in-alt"></i> Login Required</h3>
                    <p>Please log in to your account to place an order for this product.</p>
                    <p>Don't have an account? Sign up as a buyer to start purchasing fresh products from farmers.</p>
                    <div style="margin-top: 20px;">
                        <a href="{{ route('login') }}" class="login-btn">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </a>
                        <a href="{{ route('register', ['role' => 'buyer']) }}" class="login-btn"
                            style="margin-left: 15px; background: #4CAF50;">
                            <i class="fas fa-user-plus"></i> Sign Up as Buyer
                        </a>
                    </div>
                </div>
            @endauth
            <!-- Related Products -->
            @if ($relatedProducts->count() > 0)
                <div class="related-products">
                    <h2 class="section-title">
                        <i class="fas fa-leaf"></i> Related Products
                    </h2>

                    <div class="products-grid">
                        @foreach ($relatedProducts as $relatedProduct)
                            <div class="product-card">
                                <div class="card-image">
                                    @if ($relatedProduct->product_image)
                                        <img src="{{ asset('product_images/' . $relatedProduct->product_image) }}"
                                            alt="{{ $relatedProduct->name }}">
                                    @endif
                                </div>
                                <div class="card-info">
                                    <h3 class="card-title">{{ $relatedProduct->name }}</h3>
                                    <div class="card-price">
                                        ₦{{ number_format($relatedProduct->selling_price ?? $relatedProduct->unit_price) }}
                                        <span style="font-size: 0.8em; font-weight: 400;">
                                            /{{ $relatedProduct->unit_of_measurement }}
                                        </span>
                                    </div>
                                    <p style="color: #666; font-size: 0.9rem; margin: 10px 0;">
                                        <i class="fas fa-map-marker-alt"></i>
                                        {{ $relatedProduct->farmer->farm_location ?? 'Nigeria' }}
                                    </p>
                                    <a href="{{ route('product.show', $relatedProduct->id) }}"
                                        style="display: inline-block; padding: 8px 16px; background: #4CAF50; color: white; 
                                              text-decoration: none; border-radius: 20px; font-size: 0.9rem; font-weight: 600;
                                              transition: all 0.3s ease; margin-top: 10px;">
                                        <i class="fas fa-eye"></i> View Details
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        const unitPrice = {{ $product->selling_price ?? $product->unit_price }};
        const maxStock = {{ $availableStock }};
        const isProductAvailable = maxStock > 0;

        function updateTotal() {
            const quantityInput = document.getElementById('quantity');
            const orderButton = document.getElementById('orderButton');

            // If product is sold out, disable everything and return
            if (!isProductAvailable || maxStock <= 0) {
                quantityInput.disabled = true;
                quantityInput.value = 0;
                orderButton.disabled = true;
                orderButton.innerHTML = '<i class="fas fa-times-circle"></i> Sold Out';
                orderButton.style.background = '#f44336';
                orderButton.style.cursor = 'not-allowed';

                // Update summary to show sold out
                document.getElementById('summaryQuantity').textContent = '0';
                document.getElementById('totalAmount').textContent = '₦0';
                return;
            }

            const quantity = parseInt(quantityInput.value) || 1;
            const total = quantity * unitPrice;

            // Update summary
            document.getElementById('summaryQuantity').textContent = quantity;
            document.getElementById('totalAmount').textContent = '₦' + total.toLocaleString();

            // Validate quantity against available stock
            if (quantity > maxStock) {
                quantityInput.value = maxStock;
                updateTotal();
                alert(`Only ${maxStock} units available in stock`);
                return;
            }

            // Update order button state for available products
            if (quantity > maxStock) {
                orderButton.disabled = true;
                orderButton.innerHTML = '<i class="fas fa-exclamation-triangle"></i> Insufficient Stock';
                orderButton.style.background = '#ff9800';
            } else {
                orderButton.disabled = false;
                orderButton.innerHTML = '<i class="fas fa-check-circle"></i> Place Order Now';
                orderButton.style.background = '';
                orderButton.style.cursor = 'pointer';
            }
        }

        function increaseQuantity() {
            // Check if product is available
            if (!isProductAvailable || maxStock <= 0) {
                alert('This product is currently sold out.');
                return;
            }

            const quantityInput = document.getElementById('quantity');
            const currentValue = parseInt(quantityInput.value) || 1;
            if (currentValue < maxStock) {
                quantityInput.value = currentValue + 1;
                updateTotal();
            } else {
                alert(`Only ${maxStock} units available in stock`);
            }
        }

        function decreaseQuantity() {
            // Check if product is available
            if (!isProductAvailable || maxStock <= 0) {
                alert('This product is currently sold out.');
                return;
            }

            const quantityInput = document.getElementById('quantity');
            const currentValue = parseInt(quantityInput.value) || 1;
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
                updateTotal();
            }
        }

        // Enhanced form submission validation
        document.getElementById('orderForm')?.addEventListener('submit', function(e) {
            e.preventDefault(); // Always prevent default first

            // Check if product is available
            if (!isProductAvailable || maxStock <= 0) {
                alert('This product is currently sold out and cannot be ordered.');
                return false;
            }

            const quantity = parseInt(document.getElementById('quantity').value) || 1;

            if (quantity > maxStock) {
                alert(`Sorry, only ${maxStock} units are available in stock.`);
                return false;
            }

            if (quantity <= 0) {
                alert('Please select a valid quantity.');
                return false;
            }

            // If all validations pass, submit the form
            const orderButton = document.getElementById('orderButton');
            const originalText = orderButton.innerHTML;

            orderButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing Order...';
            orderButton.disabled = true;

            // Actually submit the form
            this.submit();

            // Re-enable button after 5 seconds in case of issues
            setTimeout(() => {
                orderButton.innerHTML = originalText;
                orderButton.disabled = false;
            }, 5000);
        });

        // Disable quantity input interactions for sold out products
        document.getElementById('quantity')?.addEventListener('focus', function() {
            if (!isProductAvailable || maxStock <= 0) {
                this.blur();
                alert('This product is currently sold out.');
            }
        });

        document.getElementById('quantity')?.addEventListener('input', function() {
            if (!isProductAvailable || maxStock <= 0) {
                this.value = 0;
                updateTotal();
                return;
            }
            updateTotal();
        });

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateTotal();

            // If sold out, disable all form interactions
            if (!isProductAvailable || maxStock <= 0) {
                // Disable all form inputs
                const formInputs = document.querySelectorAll(
                    '#orderForm input, #orderForm textarea, #orderForm button');
                formInputs.forEach(input => {
                    if (input.type !== 'hidden') {
                        input.disabled = true;
                        input.style.opacity = '0.5';
                        input.style.cursor = 'not-allowed';
                    }
                });

                // Show sold out message in form
                const orderForm = document.getElementById('orderForm');
                if (orderForm) {
                    const soldOutMessage = document.createElement('div');
                    soldOutMessage.className = 'sold-out-overlay';
                    soldOutMessage.style.cssText = `
                    position: absolute;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    background: rgba(244, 67, 54, 0.1);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    border-radius: 10px;
                    z-index: 10;
                `;
                    soldOutMessage.innerHTML = `
                    <div style="text-align: center; color: #f44336; font-weight: 600;">
                        <i class="fas fa-exclamation-triangle" style="font-size: 2rem; margin-bottom: 10px;"></i>
                        <div>Product Sold Out</div>
                        <small>This item is currently unavailable</small>
                    </div>
                `;

                    orderForm.style.position = 'relative';
                    orderForm.appendChild(soldOutMessage);
                }
            }
        });

        // Enhanced real-time stock checking
        function checkStockAvailability() {
            fetch(`/farm-products/{{ $product->id }}/stock`)
                .then(response => response.json())
                .then(data => {
                    const newMaxStock = data.available_stock;
                    const quantityInput = document.getElementById('quantity');
                    const orderButton = document.getElementById('orderButton');

                    // Update global variables
                    window.maxStock = newMaxStock;
                    window.isProductAvailable = newMaxStock > 0;

                    // Update form state based on new stock
                    if (newMaxStock <= 0) {
                        // Product became sold out
                        quantityInput.disabled = true;
                        quantityInput.value = 0;
                        orderButton.disabled = true;
                        orderButton.innerHTML = '<i class="fas fa-times-circle"></i> Sold Out';
                        orderButton.style.background = '#f44336';

                        // Update stock display in meta
                        const stockMeta = document.querySelector('.meta-item span');
                        if (stockMeta && stockMeta.textContent.includes('Stock:')) {
                            stockMeta.innerHTML = '<span style="color: #f44336; font-weight: 600;">Sold Out</span>';
                        }
                    } else {
                        // Product became available
                        quantityInput.disabled = false;
                        quantityInput.max = newMaxStock;

                        // Adjust current quantity if it exceeds new stock
                        if (parseInt(quantityInput.value) > newMaxStock) {
                            quantityInput.value = Math.min(1, newMaxStock);
                        }

                        // Update stock display
                        const stockMeta = document.querySelector('.meta-item span');
                        if (stockMeta) {
                            stockMeta.innerHTML = `Stock: ${newMaxStock} available`;
                        }
                    }

                    updateTotal();
                })
                .catch(error => {
                    console.error('Error checking stock:', error);
                });
        }

        // Check stock every 30 seconds
        setInterval(checkStockAvailability, 30000);

        // Check stock when page becomes visible
        document.addEventListener('visibilitychange', function() {
            if (!document.hidden) {
                checkStockAvailability();
            }
        });
    </script>

</body>

</html>
