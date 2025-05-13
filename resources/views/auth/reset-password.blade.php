<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reset Password | FarmConnect</title>
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}" />
</head>

<body>
    <div class="login-container">

        <h3 class="brand-title">FARMCONNECT</h3>
        <h6 class="login-subtext">Reset your password</h6>

        <form method="POST" action="{{ route('password.store') }}" class="login-form">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <input class="input-field" type="email" name="email" placeholder="Enter your email"
                value="{{ old('email', $request->email) }}" required autofocus />

            @if ($errors->has('email'))
                <div style="color: red; font-size: 14px;">
                    {{ $errors->first('email') }}
                </div>
            @endif

            <!-- Password -->
            <input class="input-field" type="password" name="password" placeholder="New password" required
                autocomplete="new-password" />

            @if ($errors->has('password'))
                <div style="color: red; font-size: 14px;">
                    {{ $errors->first('password') }}
                </div>
            @endif

            <!-- Confirm Password -->
            <input class="input-field" type="password" name="password_confirmation" placeholder="Confirm password"
                required autocomplete="new-password" />

            @if ($errors->has('password_confirmation'))
                <div style="color: red; font-size: 14px;">
                    {{ $errors->first('password_confirmation') }}
                </div>
            @endif

            <button type="submit" class="login-button">Reset Password</button>
        </form>

        <h5 style="text-align: center; font-size: 14px; color: #3f8d54; font-weight: 600; margin-top: 10px;">
            Back to <a href="{{ route('login') }}" class="sig">Login</a>
        </h5>

    </div>
</body>

</html>
