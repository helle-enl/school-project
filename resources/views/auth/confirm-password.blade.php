<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Confirm Password | FarmConnect</title>
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}" />
</head>

<body>
    <div class="login-container">

        <h3 class="brand-title">FARMCONNECT</h3>
        <h6 class="login-subtext">Confirm your password</h6>

        <div style="text-align: center; font-size: 14px; margin-bottom: 15px; color: #fff;">
            This is a secure area of the application. Please confirm your password before continuing.
        </div>

        @if ($errors->has('password'))
            <div style="color: red; font-size: 14px; margin-bottom: 10px;">
                {{ $errors->first('password') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.confirm') }}" class="login-form">
            @csrf

            <input class="input-field" type="password" name="password" placeholder="Enter your password" required
                autocomplete="current-password" />

            <button type="submit" class="login-button">Confirm Password</button>
        </form>

        <h5 style="text-align: center; font-size: 14px; color: #3f8d54; font-weight: 600; margin-top: 10px;">
            <a href="{{ route('password.request') }}" class="sig">Forgot password?</a>
        </h5>

    </div>
</body>

</html>
