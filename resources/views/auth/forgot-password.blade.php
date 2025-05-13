<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Forgot Password | FarmConnect</title>
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}" />
</head>

<body>
    <div class="login-container">

        <h3 class="brand-title">FARMCONNECT</h3>
        {{-- <h2 class="login-header">Forgot your password?</h2> --}}
        <h6 class="login-subtext">Forgot your password?</h6>


        @if (session('status'))
            <div style="background: #d4edda; color: #155724; padding: 10px; border-radius: 8px;">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="login-form">
            @csrf

            <input class="input-field" type="email" name="email" placeholder="Enter your email"
                value="{{ old('email') }}" required autofocus />

            @if ($errors->has('email'))
                <div style="color: red; font-size: 14px;">
                    {{ $errors->first('email') }}
                </div>
            @endif

            <button type="submit" class="login-button">Send Password Reset Link</button>
        </form>

        <h5 class=""
            style="text-align: center; font-size: 14px; color: #3f8d54; font-weight: 600; margin-top: 10px;">
            Remember your password?
            <a href="{{ route('login') }}" class="sig">Login</a>
        </h5>

    </div>
</body>

</html>
