<!-- layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'FarmConnect Nigeria') }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}" />
    <style>
        .page-header {
            padding: 20px 0;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

        .page-header p {
            margin-top: 10px;
            font-size: 16px;
            color: #666;
        }



        .logout-btn {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
        }
    </style>
    @yield('styles')
</head>

<body>
    <header class="header">
        <nav class="navbar">
            <div class="logo">
                <a href="{{ route('dashboard') }}">FarmConnect Nigeria</a>
            </div>
            <ul class="nav-links">
                <li><a href="{{ route('profile.edit') }}">Profile</a></li>
                <li class="dropdown">
                    <a href="#" class="dropbtn">Form Products</a>
                    <div class="dropdown-content">
                        <a href="{{ route('farm-products.index') }}">All Products</a>
                        <a href="{{ route('farm-products.create') }}">Add New Product</a>
                        <a href="{{ route('farm-products-categories.index') }}">Categories</a>
                    </div>
                </li>
                <li><a href="#">Settings</a></li>
            </ul>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>

            </form>
        </nav>
    </header>

    <!-- Show success message -->
    <!-- Show all flash messages -->
    @foreach (['success', 'error', 'warning', 'info'] as $msg)
        @if (session($msg))
            <div class="alert alert-{{ $msg }}"
                style="
            max-width: 900px; 
            margin: 10px auto; 
            padding: 12px 18px; 
            border-radius: 4px; 
            font-weight: 600;
            color: {{ $msg === 'error' ? '#b71c1c' : ($msg === 'warning' ? '#f57c00' : ($msg === 'info' ? '#1976d2' : '#2e7d32')) }};
            background-color: {{ $msg === 'error' ? '#f8d7da' : ($msg === 'warning' ? '#fff3cd' : ($msg === 'info' ? '#d1ecf1' : '#d0f0d8')) }};
            border: 1px solid {{ $msg === 'error' ? '#f5c6cb' : ($msg === 'warning' ? '#ffeeba' : ($msg === 'info' ? '#bee5eb' : '#4caf50')) }};
        ">
                {{ session($msg) }}
            </div>
        @endif
    @endforeach
    @if ($errors->any())
        <div class="alert alert-error"
            style="
        max-width: 900px; 
        margin: 10px auto; 
        padding: 12px 18px; 
        border-radius: 4px; 
        font-weight: 600;
        color: #b71c1c;
        background-color: #f8d7da;
        border: 1px solid #f5c6cb;
    ">
            <strong>There were some problems with your input:</strong>
            <ul style="margin-top: 8px; padding-left: 20px; list-style-type: disc;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <!-- Page Heading -->
    @hasSection('header')
        <div class="page-header">
            @yield('header')
        </div>
    @endif

    <!-- Main Content -->
    <main class="" style="padding: 32px; margin: 20px auto;">
        @yield('content')
    </main>

    <footer class="footer">
        <p>&copy; {{ now()->year }} FarmConnect Nigeria. All rights reserved.</p>
    </footer>

    @yield('scripts')
</body>

</html>
