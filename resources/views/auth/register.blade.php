<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register | FarmConnect</title>
    <link rel="stylesheet" href="{{ asset('assets/css/signup.css') }}" />
</head>

<body>
    <div class="body" style="overflow-x: hidden; overflow-y: hidden;">
        <h3 class="farm">FARMCONNECT</h3>
        <h6 class="cred">Create your account</h6>

        <form class="regis" method="POST" action="{{ route('register') }}">
            @csrf

            <!-- First Name -->
            <input class="put" type="text" name="first_name" placeholder="First Name"
                value="{{ old('first_name') }}" required />
            @if ($errors->has('first_name'))
                <div class="error" style="color: red; font-size: 12px;">
                    {{ $errors->first('first_name') }}
                </div>
            @endif

            <!-- Last Name -->
            <input class="put" type="text" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}"
                required />
            @if ($errors->has('last_name'))
                <div class="error" style="color: red; font-size: 12px;">
                    {{ $errors->first('last_name') }}
                </div>
            @endif

            <!-- City -->
            <input class="put" type="text" name="city" placeholder="City/Town" value="{{ old('city') }}" />
            @if ($errors->has('city'))
                <div class="error" style="color: red; font-size: 12px;">
                    {{ $errors->first('city') }}
                </div>
            @endif

            <!-- WhatsApp Number -->
            <input class="put" type="number" name="whatsapp" placeholder="WhatsApp Number"
                value="{{ old('whatsapp') }}" required />
            @if ($errors->has('whatsapp'))
                <div class="error" style="color: red; font-size: 12px;">
                    {{ $errors->first('whatsapp') }}
                </div>
            @endif

            <!-- Email -->
            <input class="put" type="email" name="email" placeholder="Email" value="{{ old('email') }}"
                required />
            @if ($errors->has('email'))
                <div class="error" style="color: red; font-size: 12px;">
                    {{ $errors->first('email') }}
                </div>
            @endif

            <!-- Password -->
            <input class="put" type="password" name="password" placeholder="Password" required />
            @if ($errors->has('password'))
                <div class="error" style="color: red; font-size: 12px;">
                    {{ $errors->first('password') }}
                </div>
            @endif

            <!-- Confirm Password -->
            <input class="put" type="password" name="password_confirmation" placeholder="Confirm Password"
                required />

            <h6 class="for">
                By clicking sign up you agree to FarmConnect
                <a href="#" class="sig">Terms & Policy</a>
            </h6>

            <button type="submit" class="log">Sign Up</button>

            <h5 class="donsign">or</h5>
            <button type="button" class="log">Sign Up with Google</button>

            <h5 class="donsign">
                Already have an account?
                <a href="{{ route('login') }}" class="sig">Login</a>
            </h5>
        </form>
    </div>
</body>

</html>
