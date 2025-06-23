<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FarmConnect Nigeria - Connect Farmers with Buyers</title>
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
            background-color: #fff;
        }

        /* Navigation Styles */
        .navbar {
            background: linear-gradient(135deg, #2E7D32, #4CAF50);
            padding: 15px 0;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            box-shadow: 0 4px 20px rgba(46, 125, 50, 0.3);
            backdrop-filter: blur(10px);
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

        .nav-btn.primary:hover {
            background: #E55A2B;
            border-color: #E55A2B;
            color: white;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, rgba(46, 125, 50, 0.9), rgba(76, 175, 80, 0.9)),
                url('assets/images/hero-farm.jpg') center/cover;
            min-height: 100vh;
            display: flex;
            align-items: center;
            text-align: center;
            color: white;
            position: relative;
            margin-top: 80px;
        }

        .hero-content {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            background: linear-gradient(45deg, #ffffff, #e8f5e8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero p {
            font-size: 1.3rem;
            margin-bottom: 40px;
            opacity: 0.9;
        }

        .hero-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .hero-btn {
            padding: 15px 30px;
            font-size: 1.1rem;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .hero-btn.primary {
            background: #FF6B35;
            color: white;
            border: 2px solid #FF6B35;
        }

        .hero-btn.secondary {
            background: transparent;
            color: white;
            border: 2px solid white;
        }

        .hero-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        /* Statistics Section */
        .stats-section {
            background: #f8f9fa;
            padding: 80px 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            text-align: center;
        }

        .stat-card {
            background: white;
            padding: 40px 20px;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }

        .stat-icon {
            font-size: 3rem;
            color: #4CAF50;
            margin-bottom: 20px;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: #2E7D32;
            margin-bottom: 10px;
        }

        .stat-label {
            font-size: 1.1rem;
            color: #666;
        }

        /* Popular Products Section */
        .popular-products {
            padding: 80px 0;
            background: white;
        }

        .section-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #2E7D32;
            margin-bottom: 15px;
        }

        .section-subtitle {
            font-size: 1.2rem;
            color: #666;
            max-width: 600px;
            margin: 0 auto;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
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
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 5px;
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
        }

        .product-btn:hover {
            background: linear-gradient(135deg, #2E7D32, #4CAF50);
        }

        /* Farmers by Location Section */
        .farmers-section {
            padding: 80px 0;
            background: #f8f9fa;
        }

        .location-tabs {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 40px;
            flex-wrap: wrap;
        }

        .location-tab {
            padding: 12px 25px;
            background: white;
            border: 2px solid #e0e0e0;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
        }

        .location-tab.active {
            background: #4CAF50;
            color: white;
            border-color: #4CAF50;
        }

        .farmers-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .farmer-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            text-align: center;
        }

        .farmer-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }

        .farmer-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, #4CAF50, #66BB6A);
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
        }

        .farmer-name {
            font-size: 1.3rem;
            font-weight: 600;
            color: #2E7D32;
            margin-bottom: 10px;
        }

        .farmer-speciality {
            color: #666;
            margin-bottom: 15px;
        }

        .farmer-rating {
            color: #FF6B35;
            margin-bottom: 20px;
        }

        .contact-farmer-btn {
            background: linear-gradient(135deg, #FF6B35, #E55A2B);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .contact-farmer-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 107, 53, 0.3);
        }

        /* Footer */
        .footer {
            background: linear-gradient(135deg, #2E7D32, #1B5E20);
            color: white;
            padding: 60px 0 30px;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            margin-bottom: 40px;
        }

        .footer-section h3 {
            font-size: 1.3rem;
            margin-bottom: 20px;
            color: #81C784;
        }

        .footer-section p,
        .footer-section a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            margin-bottom: 10px;
            display: block;
        }

        .footer-section a:hover {
            color: white;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.6);
        }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 20px;
        }

        .social-link {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .social-link:hover {
            background: #FF6B35;
            transform: translateY(-3px);
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

            .hero h1 {
                font-size: 2.5rem;
            }

            .hero p {
                font-size: 1.1rem;
            }

            .hero-buttons {
                flex-direction: column;
                align-items: center;
            }

            .section-title {
                font-size: 2rem;
            }

            .location-tabs {
                flex-direction: column;
                align-items: center;
            }
        }

        /* Loading Animation */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Fade-in Animation */
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            animation: fadeIn 0.8s ease forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
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
                <a href="{{ route('login') }}" class="nav-btn">
                    <i class="fas fa-sign-in-alt"></i>
                    Login
                </a>
                <a href="#" class="nav-btn primary">
                    <i class="fas fa-user-plus"></i>
                    Sign Up
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Connect Farmers with Buyers</h1>
            <p>The premier marketplace for premium cash crops in Nigeria. Buy directly from farmers or sell your harvest
                at fair prices.</p>
            <div class="hero-buttons">
                <a href="#products" class="hero-btn primary">
                    <i class="fas fa-shopping-cart"></i>
                    Start Buying
                </a>
                <a href="#farmers" class="hero-btn secondary">
                    <i class="fas fa-user-tie"></i>
                    Become a Seller
                </a>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="stats-section">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-card fade-in">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-number" id="farmers-count">2,500+</div>
                    <div class="stat-label">Registered Farmers</div>
                </div>
                <div class="stat-card fade-in">
                    <div class="stat-icon">
                        <i class="fas fa-seedling"></i>
                    </div>
                    <div class="stat-number" id="products-count">15,000+</div>
                    <div class="stat-label">Products Listed</div>
                </div>
                <div class="stat-card fade-in">
                    <div class="stat-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <div class="stat-number" id="transactions-count">8,750+</div>
                    <div class="stat-label">Successful Transactions</div>
                </div>
                <div class="stat-card fade-in">
                    <div class="stat-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="stat-number" id="locations-count">36</div>
                    <div class="stat-label">States Covered</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Products Section -->
    <section class="popular-products" id="products">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Most Popular Products</h2>
                <p class="section-subtitle">Discover the highest quality cash crops from trusted farmers across Nigeria
                </p>
            </div>

            <div class="products-grid" id="products-grid">
                <!-- Products will be loaded dynamically -->
            </div>

            <div style="text-align: center;">
                <a href="#" class="hero-btn primary">
                    <i class="fas fa-eye"></i>
                    View All Products
                </a>
            </div>
        </div>
    </section>

    <!-- Farmers by Location Section -->
    <section class="farmers-section" id="farmers">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Find Farmers by Location</h2>
                <p class="section-subtitle">Connect with trusted farmers in your preferred locations</p>
            </div>

            <div class="location-tabs" id="location-tabs">
                <div class="location-tab active" data-location="lagos">Lagos</div>
                <div class="location-tab" data-location="kano">Kano</div>
                <div class="location-tab" data-location="ogun">Ogun</div>
                <div class="location-tab" data-location="kaduna">Kaduna</div>
                <div class="location-tab" data-location="cross-river">Cross River</div>
                <div class="location-tab" data-location="ondo">Ondo</div>
            </div>

            <div class="farmers-grid" id="farmers-grid">
                <!-- Farmers will be loaded dynamically -->
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>About FarmConnect</h3>
                    <p>Connecting Nigerian farmers with buyers to create a sustainable agricultural marketplace that
                        benefits everyone.</p>
                    <div class="social-links">
                        <a href="#" class="social-link">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-link">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-link">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="social-link">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>

                <div class="footer-section">
                    <h3>For Buyers</h3>
                    <a href="#">Browse Products</a>
                    <a href="#">Find Farmers</a>
                    <a href="#">Bulk Orders</a>
                    <a href="#">Quality Guarantee</a>
                </div>

                <div class="footer-section">
                    <h3>For Farmers</h3>
                    <a href="#">List Your Products</a>
                    <a href="#">Pricing Guide</a>
                    <a href="#">Seller Support</a>
                    <a href="#">Success Stories</a>
                </div>

                <div class="footer-section">
                    <h3>Support</h3>
                    <a href="#">Help Center</a>
                    <a href="#">Contact Us</a>
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms of Service</a>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; 2024 FarmConnect Nigeria. All rights reserved.</p>
            </div>
        </div>
    </footer>

</body>

</html>
