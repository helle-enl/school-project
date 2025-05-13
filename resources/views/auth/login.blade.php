<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login | FarmConnect</title>
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}" />
</head>
<body>
    <div class="login-container">
        <h3 class="brand-title">FARMCONNECT</h3>
        <h2 class="login-header">WELCOME BACK</h2>
        <h6 class="login-subtext">Enter your credentials to login</h6>

        <!-- Session Status -->
        @if (session('status'))
            <div class="session-status" style="color: green; margin-bottom: 10px;">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="login-form">
            @csrf

            <!-- Email or Username -->
            <input 
                class="input-field" 
                type="text" 
                name="email" 
                placeholder="Username / Email" 
                value="{{ old('email') }}" 
                required 
                autofocus 
            />
            @if ($errors->has('email'))
                <div class="error" style="color: red; font-size: 12px;">
                    {{ $errors->first('email') }}
                </div>
            @endif

            <!-- Password -->
            <input 
                class="input-field" 
                type="password" 
                name="password" 
                placeholder="Password" 
                required 
            />
            @if ($errors->has('password'))
                <div class="error" style="color: red; font-size: 12px;">
                    {{ $errors->first('password') }}
                </div>
            @endif

            <!-- Login Button -->
            <button type="submit" class="login-button">Login</button>

            <!-- Forgot Password -->
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="forgot-password">Forgot password?</a>
            @endif

            <!-- Signup Section -->
            <div class="signup-section">
                <h4>
                    Don’t have an account?
                    <a href="{{ route('register') }}" class="signup-link">Sign up</a>
                </h4>
            </div>
        </form>
    </div>
</body>
</html>
