<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register | FarmConnect</title>
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/signup.css') }}" /> --}}
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


    /* body::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 20"><defs><linearGradient id="a" x1="0%" y1="0%" x2="100%" y2="0%"><stop offset="0%" style="stop-color:rgba(255,255,255,0.1)"/><stop offset="100%" style="stop-color:rgba(255,255,255,0)"/></linearGradient></defs><path d="M0 0h100v20H0z" fill="url(%23a)"/></svg>') repeat;
        z-index: 0;
        opacity: 0.1;
    } */

    .body {
        position: relative;
        z-index: 1;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        width: 100%;
        max-width: 480px;
        padding: 40px;
        border-radius: 24px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1), 0 10px 20px rgba(0, 0, 0, 0.06);
        max-height: 95vh;
        overflow-y: auto;
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

    .role-tabs {
        display: flex;
        margin-bottom: 24px;
        background: #f3f4f6;
        border-radius: 12px;
        padding: 4px;
        position: relative;
    }

    .tab-btn {
        flex: 1;
        padding: 12px 16px;
        border: none;
        background: transparent;
        color: #6b7280;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        font-weight: 500;
        font-size: 14px;
        border-radius: 8px;
        position: relative;
        z-index: 2;
    }

    .tab-btn.active {
        background: linear-gradient(135deg, #4caf50 0%, #8bc34a 100%);
        color: white;
        box-shadow: 0 4px 12px rgba(76, 175, 80, 0.4);
        transform: translateY(-1px);
    }

    .role-description {
        text-align: center;
        font-size: 13px;
        color: #6b7280;
        margin-bottom: 24px;
        padding: 12px 16px;
        background: linear-gradient(135deg, rgba(76, 175, 80, 0.1) 0%, rgba(139, 195, 74, 0.1) 100%);
        border-radius: 8px;
        border-left: 3px solid #4caf50;
        transition: all 0.3s ease;
    }

    .regis {
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

    .log {
        padding: 16px 24px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
    }

    .log:active {
        transform: translateY(0);
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

    .log:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(76, 175, 80, 0.4);
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

    .for {
        text-align: center;
        font-size: 13px;
        color: #6b7280;
        line-height: 1.5;
        margin: 16px 0;
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

    .donsign:not(:has(h5)) {
        font-size: 14px;
        color: #6b7280;
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
    }

    /* Custom Scrollbar */
    .body::-webkit-scrollbar {
        width: 6px;
    }

    .body::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 3px;
    }

    .body::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, #4caf50 0%, #8bc34a 100%);
        border-radius: 3px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }

    .form-row.single {
        grid-template-columns: 1fr;
    }

    .form-row .input-group {
        margin: 0;
    }

    /* Responsive grid */
    @media (max-width: 640px) {
        .form-row {
            grid-template-columns: 1fr;
            gap: 15px;
        }
    }

    .regis {
        display: flex;
        flex-direction: column;
        gap: 25px;
    }

    .form-section {
        background: rgba(249, 250, 251, 0.5);
        padding: 20px;
        border-radius: 12px;
        border: 1px solid rgba(229, 231, 235, 0.5);
        margin-bottom: 20px;
    }

    .section-title {
        font-size: 14px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .section-title i {
        color: #4caf50;
    }
</style>


<body>
    <div class="body">
        <h3 class="farm">FARMCONNECT</h3>
        <h6 class="cred">Create your account and join our community</h6>

        <!-- Role Tabs -->
        <!-- Role Tabs -->
        <div class="role-tabs">
            <button type="button" class="tab-btn active" onclick="switchRole('farmer')" data-role="farmer">
                <i class="fas fa-seedling"></i> Farmer
            </button>
            <button type="button" class="tab-btn" onclick="switchRole('buyer')" data-role="buyer">
                <i class="fas fa-shopping-cart"></i> Buyer
            </button>
        </div>

        <!-- Role Description -->
        <div class="role-description" id="role-description">
            <i class="fas fa-info-circle"></i> Join as a farmer to sell your products directly to buyers
        </div>

        <form class="regis" method="POST" action="{{ route('register') }}">
            @csrf
            <input type="hidden" name="role" id="role" value="farmer" />

            <!-- Name Fields Row -->
            <div class="form-row">
                <div class="input-group">
                    <input class="put" type="text" name="first_name" placeholder="First Name"
                        value="{{ old('first_name') }}" required />
                    @if ($errors->has('first_name'))
                        <div class="error">{{ $errors->first('first_name') }}</div>
                    @endif
                </div>
                <div class="input-group">
                    <input class="put" type="text" name="last_name" placeholder="Last Name"
                        value="{{ old('last_name') }}" required />
                    @if ($errors->has('last_name'))
                        <div class="error">{{ $errors->first('last_name') }}</div>
                    @endif
                </div>
            </div>

            <!-- Contact Fields Row -->
            <div class="form-row">
                <div class="input-group">
                    <input class="put" type="text" name="city" placeholder="City/Town"
                        value="{{ old('city') }}" />
                    @if ($errors->has('city'))
                        <div class="error">{{ $errors->first('city') }}</div>
                    @endif
                </div>
                <div class="input-group">
                    <input class="put" type="number" name="whatsapp" placeholder="WhatsApp Number"
                        value="{{ old('whatsapp') }}" required />
                    @if ($errors->has('whatsapp'))
                        <div class="error">{{ $errors->first('whatsapp') }}</div>
                    @endif
                </div>
            </div>

            <!-- Email Field (Single Row) -->
            <div class="form-row single">
                <div class="input-group">
                    <input class="put" type="email" name="email" placeholder="Email" value="{{ old('email') }}"
                        required />
                    @if ($errors->has('email'))
                        <div class="error">{{ $errors->first('email') }}</div>
                    @endif
                </div>
            </div>

            <!-- Password Fields Row -->
            <div class="form-row">
                <div class="input-group">
                    <input class="put" type="password" name="password" placeholder="Password" required />
                    @if ($errors->has('password'))
                        <div class="error">{{ $errors->first('password') }}</div>
                    @endif
                </div>
                <div class="input-group">
                    <input class="put" type="password" name="password_confirmation" placeholder="Confirm Password"
                        required />
                </div>
            </div>

            <h6 class="for">
                By clicking sign up you agree to FarmConnect
                <a href="#" class="sig">Terms & Policy</a>
            </h6>

            <button type="submit" class="log">
                <i class="fas fa-user-plus"></i> Create Account
            </button>
            {{-- 
            <h5 class="donsign">or</h5>

            <button type="button" class="log google-btn">
                <i class="fab fa-google"></i> Continue with Google
            </button> --}}

            <div class="donsign">
                Already have an account?
                <a href="{{ route('login') }}" class="sig">Sign in here</a>
            </div>
        </form>

    </div>
</body>
<script>
    function initializeFromURL() {
        const urlParams = new URLSearchParams(window.location.search);
        const roleParam = urlParams.get('role');

        if (roleParam && (roleParam === 'farmer' || roleParam === 'buyer')) {
            // 从URL参数设置角色
            switchRole(roleParam);
        } else {
            // 如果没有URL参数，保持默认的farmer状态
            switchRole('farmer');
        }
    }

    function updateURL(role) {
        const url = new URL(window.location);
        url.searchParams.set('role', role);
        window.history.replaceState({}, '', url);
    }


    function switchRole(role) {
        // 更新隐藏输入字段的值
        document.getElementById('role').value = role;

        // 更新标签页外观
        const tabs = document.querySelectorAll('.tab-btn');
        tabs.forEach(tab => {
            tab.classList.remove('active');
            // 根据角色激活对应的标签页
            if ((role === 'farmer' && tab.textContent.includes('Farmer')) ||
                (role === 'buyer' && tab.textContent.includes('Buyer'))) {
                tab.classList.add('active');
            }
        });
        updateURL(role);

        // 更新角色描述
        const description = document.getElementById('role-description');
        description.style.opacity = '0.5';

        setTimeout(() => {
            if (role === 'farmer') {
                description.innerHTML =
                    '<i class="fas fa-seedling"></i> Join as a farmer to sell your products directly to buyers and grow your agricultural business';
            } else {
                description.innerHTML =
                    '<i class="fas fa-shopping-cart"></i> Join as a buyer to discover and purchase fresh products directly from local farmers';
            }
            description.style.opacity = '1';
        }, 200);
    }

    // 页面加载时初始化
    document.addEventListener('DOMContentLoaded', function() {
        initializeFromURL();
    });

    // function switchRole(role) {
    //     // Update hidden input value
    //     document.getElementById('role').value = role;

    //     // Update tab appearance with animation
    //     const tabs = document.querySelectorAll('.tab-btn');
    //     tabs.forEach(tab => {
    //         tab.classList.remove('active');
    //     });
    //     event.target.classList.add('active');

    //     // Update role description with fade effect
    //     const description = document.getElementById('role-description');
    //     description.style.opacity = '0.5';

    //     setTimeout(() => {
    //         if (role === 'farmer') {
    //             description.innerHTML =
    //                 '<i class="fas fa-seedling"></i> Join as a farmer to sell your products directly to buyers and grow your agricultural business';
    //         } else {
    //             description.innerHTML =
    //                 '<i class="fas fa-shopping-cart"></i> Join as a buyer to discover and purchase fresh products directly from local farmers';
    //         }
    //         description.style.opacity = '1';
    //     }, 200);
    // }
</script>

</html>
