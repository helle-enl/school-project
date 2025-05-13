<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Verify Email | FarmConnect</title>
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}" />
</head>

<body>
    <div class="login-container">

        <h3 class="brand-title">FARMCONNECT</h3>
        <h6 class="login-subtext">
            Please verify your email address
        </h6>

        <p style="font-size: 14px; color: #fff; margin-bottom: 20px; text-align: center;">
            Thanks for signing up! We just sent a verification link to your email.
            If you didn’t receive it, we’ll gladly send you another.
        </p>

        @if (session('status') == 'verification-link-sent')
            <div style="background: #d4edda; color: #155724; padding: 10px; border-radius: 8px; margin-bottom: 15px;">
                A new verification link has been sent to the email address you provided.
            </div>
        @endif

        <form method="POST" action="{{ route('verification.send') }}" class="login-form">
            @csrf
            <button type="submit" class="login-button">Resend Verification Email</button>
        </form>

        <form method="POST" action="{{ route('logout') }}" style="margin-top: 15px; text-align: center;">
            @csrf
            <button type="submit"
                style="
                background: none;
                border: none;
                color: #3f8d54;
                font-weight: 600;
                font-size: 14px;
                cursor: pointer;
                text-decoration: underline;">
                Log Out
            </button>
        </form>

    </div>
</body>

</html>
