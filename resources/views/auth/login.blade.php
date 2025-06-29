<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login | FarmConnect</title>
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<style>
    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        background: url("{{ asset('/assets/images/buying and selling.avif') }}") no-repeat center center / cover;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
        position: relative;
        overflow-x: hidden;
    }

    body::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(76, 175, 80, 0.8) 0%, rgba(139, 195, 74, 0.8) 100%);
        z-index: 0;
    }

    .body {
        position: relative;
        z-index: 1;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        width: 100%;
        max-width: 420px;
        padding: 40px;
        border-radius: 24px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1), 0 10px 20px rgba(0, 0, 0, 0.06);
        animation: slideUp 0.6s ease-out;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .farm {
        text-align: center;
        font-size: 32px;
        font-weight: 700;
        background: linear-gradient(135deg, #4caf50 0%, #8bc34a 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 8px;
        letter-spacing: -0.02em;
    }

    .cred {
        text-align: center;
        color: #6b7280;
        margin-bottom: 32px;
        font-size: 16px;
        font-weight: 400;
    }

    .login-form {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .input-group {
        position: relative;
    }

    .put {
        width: 100%;
        padding: 16px 20px;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        font-size: 15px;
        font-weight: 400;
        outline: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        background: #ffffff;
        color: #374151;
    }

    .put:focus {
        border-color: #4caf50;
        box-shadow: 0 0 0 4px rgba(76, 175, 80, 0.1);
        transform: translateY(-2px);
    }

    .put::placeholder {
        color: #9ca3af;
        font-weight: 400;
    }

    .error {
        color: #ef4444;
        font-size: 12px;
        margin-top: 6px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .error::before {
        content: "⚠";
        font-size: 10px;
    }

    .remember-forgot {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 10px 0;
    }

    .remember-me {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        color: #6b7280;
    }

    .remember-me input[type="checkbox"] {
        accent-color: #4caf50;
    }

    .forgot-password {
        color: #4caf50;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .forgot-password:hover {
        color: #388e3c;
        text-decoration: underline;
    }

    .log {
        padding: 16px 24px;
        background: linear-gradient(135deg, #4caf50 0%, #8bc34a 100%);
        color: white;
        font-weight: 600;
        border: none;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        font-size: 15px;
        position: relative;
        overflow: hidden;
    }

    .log::before {
        content: "";
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .log:hover::before {
        left: 100%;
    }

    .log:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(76, 175, 80, 0.4);
    }

    .log:active {
        transform: translateY(0);
    }

    .google-btn {
        background: #ffffff;
        color: #374151;
        border: 2px solid #e5e7eb;
        position: relative;
    }

    .google-btn:hover {
        background: #f9fafb;
        border-color: #d1d5db;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .google-btn::before {
        display: none;
    }

    .donsign {
        text-align: center;
        margin: 20px 0;
        position: relative;
    }

    .donsign h5 {
        font-size: 14px;
        color: #9ca3af;
        font-weight: 400;
        position: relative;
        padding: 0 20px;
        background: rgba(255, 255, 255, 0.95);
    }

    .donsign h5::before {
        content: "";
        position: absolute;
        top: 50%;
        left: -50px;
        right: -50px;
        height: 1px;
        background: #e5e7eb;
        z-index: -1;
    }

    .sig {
        color: #4caf50;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .sig:hover {
        color: #388e3c;
        text-decoration: underline;
    }

    /* Responsive Design */
    @media (max-width: 640px) {
        .body {
            padding: 24px;
            max-width: 100%;
            margin: 10px;
        }

        .farm {
            font-size: 28px;
        }

        .put {
            padding: 14px 16px;
        }

        .remember-forgot {
            flex-direction: column;
            gap: 10px;
            align-items: flex-start;
        }
    }
</style>

<body>
    <div class="body">
        <h3 class="farm">FARMCONNECT</h3>
        <h6 class="cred">Welcome back! Sign in to your account</h6>

        <form class="login-form" method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="input-group">
                <input class="put" type="email" name="email" placeholder="Email Address"
                    value="{{ old('email') }}" required />
                @if ($errors->has('email'))
                    <div class="error">{{ $errors->first('email') }}</div>
                @endif
            </div>

            <!-- Password -->
            <div class="input-group">
                <input class="put" type="password" name="password" placeholder="Password" required />
                @if ($errors->has('password'))
                    <div class="error">{{ $errors->first('password') }}</div>
                @endif
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="remember-forgot">
                <label class="remember-me">
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    Remember me
                </label>
                @if (Route::has('password.request'))
                    <a class="forgot-password" href="{{ route('password.request') }}">
                        Forgot password?
                    </a>
                @endif
            </div>

            <button type="submit" class="log">
                <i class="fas fa-sign-in-alt"></i> Sign In
            </button>

            {{-- <h5 class="donsign">or</h5>

            <button type="button" class="log google-btn">
                <i class="fab fa-google"></i> Continue with Google
            </button> --}}

            <div class="donsign">
                Don't have an account?
                <a href="{{ route('register') }}" class="sig">Create one here</a>
            </div>
        </form>
    </div>
</body>

</html>
