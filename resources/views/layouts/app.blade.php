<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'FarmConnect Nigeria') }}</title>

    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        :root {
            --primary: #4CAF50;
            --primary-dark: #2E7D32;
            --danger: #f44336;
            --light-gray: #f9f9f9;
            --text: #333;
            --shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        header {
            background: linear-gradient(to right, var(--primary-dark), var(--primary));
            color: white;
            padding: 1rem 0;
            box-shadow: var(--shadow);
            border-bottom: 1px solid #ddd;
        }

        nav.navbar {
            max-width: 1200px;
            margin: auto;
            padding: 0 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .logo a {
            font-size: 1.6rem;
            font-weight: bold;
            color: white;
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            align-items: center;
            list-style: none;
            gap: 20px;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-links a:hover {
            color: #C8E6C9;
        }

        .dropdown {
            position: relative;
        }

        .dropdown-content {
            position: absolute;
            top: 100%;
            left: 0;
            background: white;
            min-width: 180px;
            display: none;
            box-shadow: var(--shadow);
            border-radius: 6px;
            overflow: hidden;
        }

        .dropdown-content a {
            padding: 10px 15px;
            color: var(--primary-dark);
            display: block;
            text-decoration: none;
        }

        .dropdown-content a:hover {
            background: #f1f1f1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-danger {
            background: var(--danger);
            color: white;
        }

        .btn:hover {
            transform: scale(1.02);
            box-shadow: var(--shadow);
        }

        .hamburger {
            display: none;
            font-size: 1.5rem;
            cursor: pointer;
        }

        .mobile-menu {
            display: none;
            flex-direction: column;
            width: 100%;
            margin-top: 10px;
        }

        .mobile-menu.show {
            display: flex;
        }

        main {
            flex-grow: 1;
            padding: 2rem 1rem;
            /* max-width: 1400px; */
            /* margin: auto; */
            widows: 100%
        }

        .footer {
            background: white;
            padding: 1rem;
            text-align: center;
            font-size: 0.9rem;
            color: #666;
            border-top: 1px solid #eee;
        }

        .alert {
            max-width: 900px;
            margin: 20px auto;
            padding: 1rem;
            border-radius: 6px;
            font-weight: 500;
        }

        .alert-success {
            background-color: #d0f0d8;
            color: #2e7d32;
            border: 1px solid #4caf50;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #b71c1c;
            border: 1px solid #f5c6cb;
        }

        /* .logout-text {
            display: none
        } */

        @media (max-width: 768px) {
            .logout-text {
                display: none
            }

            .nav-links {
                display: none;
                flex-direction: column;
                width: 100%;
            }

            .nav-links.show {
                display: flex;
            }

            .hamburger {
                display: block;
                color: white;
            }

            .nav-links li {
                margin: 10px 0;
            }
        }

        .error-message {
            color: #f44336;
            font-size: 0.85rem;
            margin-top: 4px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* Success Message */
        .success-message {
            background: rgba(76, 175, 80, 0.1);
            color: #2E7D32;
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            border-left: 4px solid #4CAF50;
        }
    </style>

    @yield('styles')
</head>

<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                <a href="{{ route('dashboard') }}">FarmConnect Nigeria</a>
            </div>



            <ul class="nav-links" id="navMenu">
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('profile.edit') }}">Profile</a></li>
                @if (auth()->user()->role === 'farmer')
                    <li class="dropdown">
                        <a href="#">Farm Products</a>
                        <div class="dropdown-content">
                            <a href="{{ route('farm-products.index') }}">All Products</a>
                            <a href="{{ route('farm-products.create') }}">Add New</a>
                            <a href="{{ route('farm-products-categories.index') }}">Categories</a>
                        </div>
                    </li>
                    <li><a href="{{ route('orders.index') }}">Orders</a></li>
                @elseif (auth()->user()->role === 'buyer')
                    <li><a href="{{ route('buyer.orders.index') }}">Orders</a></li>
                @endif

            </ul>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="logout-text"> Logout</span>

                </button>
            </form>
            <div class="hamburger" onclick="toggleMenu()">
                <i class="fas fa-bars"></i>
            </div>
        </nav>
    </header>



    @hasSection('header')
        <div class="page-header">@yield('header')</div>
    @endif

    <main>
        <div style="margin:auto; max-width: 700px; padding: 0 1rem;">
            @if (session('success'))
                <div class="success-message fade-in">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif
            @if ($errors->any())
                <div class="error-message fade-in"
                    style="background: rgba(244, 67, 54, 0.1); color: #c62828; padding: 15px 20px; border-radius: 12px; margin-bottom: 20px; border-left: 4px solid #f44336;">
                    <i class="fas fa-exclamation-triangle"></i>
                    <div>
                        <strong>Please fix the following errors:</strong>
                        <ul style="margin: 8px 0 0 20px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
        </div>
        @yield('content')
    </main>

    <footer class="footer">
        &copy; {{ now()->year }} FarmConnect Nigeria. All rights reserved.
    </footer>

    <script>
        function toggleMenu() {
            const nav = document.getElementById('navMenu');
            nav.classList.toggle('show');
        }
    </script>

    @yield('scripts')
</body>

</html>
