<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $farmer->farm_name ?? $farmer->first_name . ' ' . $farmer->last_name }} - FarmConnect Nigeria</title>
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

        /* Farmer Profile Section */
        .farmer-profile {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 40px;
        }

        .farmer-header {
            background: linear-gradient(135deg, #4CAF50, #66BB6A);
            color: white;
            padding: 40px;
            text-align: center;
            position: relative;
        }

        .farmer-header::before {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 30px;
            background: white;
            border-radius: 30px 30px 0 0;
        }

        .farmer-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            border: 4px solid white;
            position: relative;
            z-index: 2;
        }

        .farmer-avatar img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }

        .farmer-name {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            position: relative;
            z-index: 2;
        }

        .farmer-type {
            font-size: 1.2rem;
            opacity: 0.9;
            margin-bottom: 20px;
            position: relative;
            z-index: 2;
        }

        .farmer-stats {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
            position: relative;
            z-index: 2;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            display: block;
        }

        .stat-label {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .farmer-info {
            padding: 40px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-bottom: 30px;
        }

        .info-section {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 15px;
            border-left: 4px solid #4CAF50;
        }

        .info-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #2E7D32;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
            color: #666;
        }

        .info-item i {
            color: #4CAF50;
            width: 20px;
        }

        .contact-section {
            background: linear-gradient(135deg, rgba(76, 175, 80, 0.1), rgba(139, 195, 74, 0.1));
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            margin-top: 30px;
        }

        .contact-btn {
            display: inline-block;
            padding: 15px 30px;
            background: linear-gradient(135deg, #4CAF50, #66BB6A);
            color: white;
            text-decoration: none;
            border-radius: 25px;
            font-weight: 600;
            margin: 10px;
            transition: all 0.3s ease;
        }

        .contact-btn:hover {
            background: linear-gradient(135deg, #2E7D32, #4CAF50);
            transform: translateY(-2px);
        }

        .contact-btn.whatsapp {
            background: linear-gradient(135deg, #25D366, #128C7E);
        }

        .contact-btn.whatsapp:hover {
            background: linear-gradient(135deg, #128C7E, #075E54);
        }

        /* Products Section */
        .products-section {
            margin-top: 60px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .section-title {
            font-size: 2rem;
            font-weight: 700;
            color: #2E7D32;
        }

        .category-filter {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .category-btn {
            padding: 8px 16px;
            background: white;
            border: 2px solid #e5e7eb;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
            text-decoration: none;
            color: #666;
        }

        .category-btn.active,
        .category-btn:hover {
            background: #4CAF50;
            border-color: #4CAF50;
            color: white;
        }

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

        .product-category {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 15px;
        }

        .product-btn {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #4CAF50, #66BB6A);
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            text-align: center;
            display: block;
        }

        .product-btn:hover {
            background: linear-gradient(135deg, #2E7D32, #4CAF50);
        }

        /* No Products */
        .no-products {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }

        .no-products-icon {
            font-size: 4rem;
            color: #ccc;
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

            .farmer-header {
                padding: 30px 20px;
            }

            .farmer-name {
                font-size: 2rem;
            }

            .farmer-stats {
                gap: 20px;
            }

            .info-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .section-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .nav-container {
                flex-direction: column;
                gap: 15px;
            }
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
            backdrop-filter: blur(10px);
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
                <a href="{{ route('products') }}">Farmers</a> >
                {{ $farmer->farm_name ?? $farmer->first_name . ' ' . $farmer->last_name }}
            </div>

            <!-- Farmer Profile -->
            <div class="farmer-profile">
                <div class="farmer-header">
                    <div class="farmer-avatar">
                        @if ($farmer->profile_picture)
                            <img src="{{ asset('profile_pictures/' . $farmer->profile_picture) }}"
                                alt="{{ $farmer->first_name }}">
                        @else
                            <i class="fas fa-user"></i>
                        @endif
                    </div>
                    <h1 class="farmer-name">{{ $farmer->farm_name ?? $farmer->first_name . ' ' . $farmer->last_name }}
                    </h1>
                    <p class="farmer-type">
                        <i class="fas fa-seedling"></i>
                        {{ $farmer->farm_type ? ucfirst($farmer->farm_type) . ' Farming' : 'Mixed Farming' }}
                    </p>
                    <div class="farmer-stats">
                        <div class="stat-item">
                            <span class="stat-number">{{ $farmer->total_products }}</span>
                            <span class="stat-label">Products</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">{{ $farmer->total_orders }}</span>
                            <span class="stat-label">Total Orders</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">{{ $farmer->completed_orders }}</span>
                            <span class="stat-label">Completed</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">{{ $farmer->farmProducts->count() > 0 ? '★ 4.8' : 'New' }}</span>
                            <span class="stat-label">Rating</span>
                        </div>
                    </div>
                </div>

                <div class="farmer-info">
                    <div class="info-grid">
                        <div class="info-section">
                            <h3 class="info-title">
                                <i class="fas fa-map-marker-alt"></i>
                                Farm Location
                            </h3>
                            <div class="info-item">
                                <i class="fas fa-location-dot"></i>
                                <span>{{ $farmer->farm_location ?? 'Nigeria' }}</span>
                            </div>
                            @if ($farmer->city)
                                <div class="info-item">
                                    <i class="fas fa-city"></i>
                                    <span>{{ $farmer->city }}</span>
                                </div>
                            @endif
                            @if ($farmer->farm_size)
                                <div class="info-item">
                                    <i class="fas fa-expand-arrows-alt"></i>
                                    <span>Farm Size: {{ $farmer->farm_size }}</span>
                                </div>
                            @endif
                        </div>

                        <div class="info-section">
                            <h3 class="info-title">
                                <i class="fas fa-phone"></i>
                                Contact Information
                            </h3>
                            @if ($farmer->whatsapp_number)
                                <div class="info-item">
                                    <i class="fab fa-whatsapp"></i>
                                    <span>{{ $farmer->whatsapp_number }}</span>
                                </div>
                            @endif
                            <div class="info-item">
                                <i class="fas fa-envelope"></i>
                                <span>{{ $farmer->email }}</span>
                            </div>
                            @if ($farmer->farm_contact)
                                <div class="info-item">
                                    <i class="fas fa-phone-alt"></i>
                                    <span>{{ $farmer->farm_contact }}</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if ($farmer->about_farmer)
                        <div class="info-section">
                            <h3 class="info-title">
                                <i class="fas fa-info-circle"></i>
                                About the Farmer
                            </h3>
                            <p style="color: #666; line-height: 1.6; margin-top: 15px;">{{ $farmer->about_farmer }}</p>
                        </div>
                    @endif

                    <div class="contact-section">
                        <h3 style="color: #2E7D32; margin-bottom: 20px;">
                            <i class="fas fa-handshake"></i>
                            Get in Touch
                        </h3>
                        <p style="color: #666; margin-bottom: 20px;">
                            Ready to order fresh products or have questions? Contact {{ $farmer->first_name }}
                            directly.
                        </p>
                        @if ($farmer->whatsapp_number)
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $farmer->whatsapp_number) }}"
                                class="contact-btn whatsapp" target="_blank">
                                <i class="fab fa-whatsapp"></i>
                                WhatsApp
                            </a>
                        @endif
                        <a href="mailto:{{ $farmer->email }}" class="contact-btn">
                            <i class="fas fa-envelope"></i>
                            Send Email
                        </a>
                    </div>
                </div>
            </div>

            <!-- Products Section -->
            <div class="products-section">
                <div class="section-header">
                    <h2 class="section-title">
                        <i class="fas fa-leaf"></i>
                        Available Products ({{ $farmer->farmProducts->count() }})
                    </h2>
                    @if ($categories->count() > 1)
                        <div class="category-filter">
                            <a href="#" class="category-btn active" data-category="all">
                                All Products
                            </a>
                            @foreach ($categories as $category)
                                <a href="#" class="category-btn" data-category="{{ $category->id }}">
                                    {{ $category->name }} ({{ $category->products_count }})
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>

                @if ($farmer->farmProducts->count() > 0)
                    <div class="products-grid" id="products-grid">
                        @foreach ($farmer->farmProducts as $product)
                            <div class="product-card" data-category="{{ $product->category_id ?? 'uncategorized' }}">
                                <div class="product-image">
                                    @if ($product->product_image)
                                        <img src="{{ asset('product_images/' . $product->product_image) }}"
                                            alt="{{ $product->name }}">
                                    @endif
                                </div>
                                <div class="product-info">
                                    <h3 class="product-name">{{ $product->name }}</h3>
                                    <div class="product-price">
                                        ₦{{ number_format($product->selling_price ?? $product->unit_price) }}
                                        <span style="font-size: 0.8em; font-weight: 400; color: #666;">
                                            /{{ $product->unit_of_measurement }}
                                        </span>
                                    </div>
                                    <div class="product-category">
                                        <i class="fas fa-tag"></i>
                                        {{ $product->category->name ?? 'Uncategorized' }}
                                    </div>
                                    @if ($product->description)
                                        <p
                                            style="color: #666; font-size: 0.9rem; margin-bottom: 15px; line-height: 1.4;">
                                            {{ Str::limit($product->description, 80) }}
                                        </p>
                                    @endif
                                    <a href="{{ route('product.show', $product->id) }}" class="product-btn">
                                        <i class="fas fa-eye"></i>
                                        View Details
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="no-products">
                        <div class="no-products-icon">
                            <i class="fas fa-seedling"></i>
                        </div>
                        <h3>No Products Available</h3>
                        <p>{{ $farmer->first_name }} hasn't listed any products yet. Check back later!</p>
                    </div>
                @endif
            </div>

            <!-- Recent Reviews/Orders Section (Optional) -->
            @if ($recentOrders->count() > 0)
                <div class="reviews-section" style="margin-top: 60px;">
                    <h2 class="section-title" style="text-align: center; margin-bottom: 30px;">
                        <i class="fas fa-star"></i>
                        Recent Customer Orders
                    </h2>
                    <div
                        style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
                        @foreach ($recentOrders as $order)
                            <div
                                style="background: white; padding: 20px; border-radius: 15px; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);">
                                <h4 style="color: #2E7D32; margin-bottom: 10px;">{{ $order->product->name }}</h4>
                                <p style="color: #666; font-size: 0.9rem;">
                                    Ordered by {{ $order->buyer->first_name }} •
                                    {{ $order->created_at->diffForHumans() }}
                                </p>
                                <p style="color: #FF6B35; font-weight: 600; margin-top: 10px;">
                                    ₦{{ number_format($order->total_price) }} • {{ $order->quantity }}
                                    {{ $order->product->unit_of_measurement }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        // Category filtering
        document.querySelectorAll('.category-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const category = this.dataset.category;

                // Update active button
                document.querySelectorAll('.category-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                // Filter products
                document.querySelectorAll('.product-card').forEach(card => {
                    if (category === 'all' || card.dataset.category === category) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });

        // Smooth scrolling for internal links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>

</html>
