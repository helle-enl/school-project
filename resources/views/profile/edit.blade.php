@extends('layouts.app')

@section('header')
    <div class="profile-header">
        <div class="header-navigation">
            <a href="{{ route('dashboard') }}" class="back-btn">
                <i class="fas fa-arrow-left"></i>
                Back to Dashboard
            </a>
            <div class="breadcrumb">
                <span>Profile</span>
            </div>
        </div>
        <div class="header-content">
            <h2 class="page-title">
                <i class="fas fa-user-circle"></i>
                Your Profile
            </h2>
            <p class="page-subtitle" style="color: white">Manage your account settings and personal information</p>
        </div>
    </div>
@endsection


@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* PROFILE SPECIAL */

        .profile-section {
            padding: 80px 40px 40px;
            background-color: #ffffff;
            width: 100%;
            max-width: 960px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            margin: 120px auto 40px;
            text-align: center;
            color: #333;
        }

        h1 {
            font-size: 28px;
            color: #2c6e49;
            margin-bottom: 20px;
        }

        .profile {
            display: flex;
            flex-wrap: wrap;
            gap: 40px;
            justify-content: center;
            margin-bottom: 40px;
        }

        .profile-left,
        .profile-right {
            width: 100%;
            max-width: 450px;
            margin-bottom: 20px;
        }

        .profile-pic {
            height: 120px;
            width: 120px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
            border: 3px solid #ddd;
        }

        .profile h3 {
            font-size: 24px;
            font-weight: 600;
            color: #000000;
            margin-bottom: 12px;
        }

        .profile-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            font-size: 14px;
            line-height: 1.5;
        }

        .profile-info strong {
            font-weight: bold;
            color: #7f8c8d;
        }

        .profile-info span {
            color: #2c6b2f;
        }

        .edit h3 {
            margin-top: 40px;
            font-size: 20px;
            color: #2c6b2f;
            font-weight: 600;
            border-bottom: 2px solid #2c6b2f;
            padding-bottom: 12px;
            margin-bottom: 20px;
        }

        .profile-form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-top: 20px;
        }

        .profile-form-step-2 {
            display: block;
            /* flex-direction: column;
        gap: 20px; */
            margin-top: 20px;
        }

        .form-group.profile-form-input-step-1 {
            display: flex;
            flex-direction: column;
        }

        .form-group.profile-form-input-step-2 {
            display: block;
        }

        @media (max-width: 768px) {
            .profile-form {
                display: block;
                grid-template-columns: 1fr;
            }
        }

        .form-group label {
            font-size: 15px;
            font-weight: bold;
            text-align: left;
            color: #2c6b2f;
            margin-bottom: 12px;
        }

        .form-group input[type="text"],
        .form-group input[type="tel"],
        .form-group input[type="email"],
        .form-group textarea {
            padding: 12px 15px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
            color: #333;
            border-radius: 5px;
            font-size: 14px;
            transition: border-color 0.3s ease, background-color 0.3s ease;
        }

        .form-group input[type="text"]:focus,
        .form-group input[type="tel"]:focus,
        .form-group input[type="email"]:focus,
        .form-group textarea:focus {
            border-color: #4caf50;
            background-color: #ecf0f1;
        }

        .sub {
            background-color: #4caf50;
            padding: 12px 25px;
            font-size: 16px;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            grid-column: span 2;
            margin-top: 20px;
            width: 100%;
        }

        .sub:hover {
            background-color: #4caf50;
        }

        .profile-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .profile-header {
            background: linear-gradient(135deg, #2E7D32 0%, #4CAF50 100%);
            color: white;
            padding: 30px;
            border-radius: 0px;
            margin-bottom: 30px;
            box-shadow: 0 8px 32px rgba(46, 125, 50, 0.3);
        }

        .header-navigation {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .back-btn {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .back-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateX(-3px);
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.9rem;
            opacity: 0.8;
        }

        .header-content {
            text-align: center;
        }

        .page-title {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }

        .page-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            font-weight: 300;
        }

        /* Main Content */
        .profile-main-content {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .profile-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .profile-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #2E7D32;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, #4CAF50, #81C784);
            color: white;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        /* Profile Details */
        .profile-details {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 40px;
            align-items: center;
        }

        .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            overflow: hidden;
            position: relative;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        .profile-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .image-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            color: rgba(255, 255, 255, 0.6);
        }

        .profile-info {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .info-label {
            font-weight: 600;
            color: #2E7D32;
            width: 120px;
        }

        .info-value {
            font-size: 1rem;
            color: #666;
        }

        /* Edit Profile Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1050;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
            align-items: center;
            justify-content: center;
        }

        .modal.show {
            display: flex;
        }

        .modal-dialog {
            background: white;
            border-radius: 8px;
            max-width: 500px;
            width: 100%;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
            animation: fadeInModal 0.3s ease;
        }

        @keyframes fadeInModal {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-header {
            padding: 16px 24px;
            background-color: #4caf50;
            color: white;
            font-weight: 600;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-body {
            padding: 24px;
        }

        .modal-footer {
            padding: 16px 24px;
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            border-top: 1px solid #ddd;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
        }

        .btn-close {
            background: transparent;
            border: none;
            font-size: 1.2rem;
            color: white;
            cursor: pointer;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 6px;
            color: #4caf50;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        textarea {
            width: 100%;
            padding: 8px 10px;
            border: 2px solid #4caf50;
            border-radius: 4px;
            font-size: 1rem;
            box-sizing: border-box;
            resize: vertical;
        }

        textarea {
            min-height: 80px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .profile-container {
                padding: 15px;
            }

            .profile-header {
                padding: 20px;
            }

            .page-title {
                font-size: 1.8rem;
                flex-direction: column;
                gap: 10px;
            }

            .profile-main-content {
                padding: 25px;
            }

            .profile-details {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .profile-image {
                width: 120px;
                height: 120px;
            }

            .btn {
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .header-navigation {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }

            .breadcrumb {
                order: -1;
            }
        }

        /* Animation Classes */
        .fade-in {
            animation: fadeIn 0.6s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endsection


@section('content')
    <div class="profile-container">
        <div class="profile-main-content fade-in">
            <div class="profile-actions">
                <h3 class="profile-title">Profile Details</h3>

            </div>

            <div class="profile-details">
                <div class="profile-image">
                    @if (auth()->user()->profile_picture)
                        <img src="{{ asset('profile_pictures/' . auth()->user()->profile_picture) }}" alt="Profile Image">
                    @else
                        <div class="image-placeholder">
                            <i class="fas fa-user"></i>
                        </div>
                    @endif
                </div>
                <div class="profile-info">
                    <div class="info-item">
                        <span class="info-label">Name:</span>
                        <span class="info-value">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Email:</span>
                        <span class="info-value">{{ auth()->user()->email }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Phone:</span>
                        <span class="info-value">{{ auth()->user()->phone_number ?? 'N/A' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Address:</span>
                        <span class="info-value">{{ auth()->user()->address ?? 'N/A' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Joined:</span>
                        <span class="info-value">{{ auth()->user()->created_at->format('M Y') }}</span>
                    </div>
                </div>
            </div>


            <div class="edit">
                <h3>Edit Profile</h3>
            </div>

            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <!-- STEP 1 - 2 Columns -->
                <div class="profile-form">
                    <div class="form-group profile-form-input-step-1">
                        <label for="first_name">First Name:</label>
                        <input type="text" id="first_name" name="first_name"
                            value="{{ old('first_name', $user->first_name) }}" required />
                    </div>

                    <div class="form-group profile-form-input-step-1">
                        <label for="last_name">Last Name:</label>
                        <input type="text" id="last_name" name="last_name"
                            value="{{ old('last_name', $user->last_name) }}" required />
                    </div>

                    <div class="form-group profile-form-input-step-1">
                        <label for="email">E-mail:</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                            required />
                    </div>

                    <div class="form-group profile-form-input-step-1">
                        <label for="phone_number">Phone Number:</label>
                        <input type="tel" id="phone_number" name="phone_number"
                            value="{{ old('phone_number', $user->phone_number) }}" />
                    </div>

                    <div class="form-group profile-form-input-step-1">
                        <label for="whatsapp_number">Whatsapp Number:</label>
                        <input type="tel" id="whatsapp_number" name="whatsapp_number"
                            value="{{ old('whatsapp_number', $user->whatsapp_number) }}" />
                    </div>

                    <div class="form-group profile-form-input-step-1">
                        <label for="country">Country:</label>
                        <input type="text" id="country" name="country" value="{{ old('country', $user->country) }}" />
                    </div>
                    <div class="form-group profile-form-input-step-1">
                        <label for="state">State:</label>
                        <input type="text" id="state" name="state" value="{{ old('state', $user->state) }}" />
                    </div>
                    <div class="form-group profile-form-input-step-1">
                        <label for="city">City:</label>
                        <input type="text" id="city" name="city" value="{{ old('city', $user->city) }}"
                            required />
                    </div>

                    <div class="form-group profile-form-input-step-1">
                        <label for="address">Address:</label>
                        <input type="text" id="address" name="address"
                            value="{{ old('address', $user->address) }}" required />
                    </div>

                    <div class="form-group profile-form-input-step-1">
                        <label for="profile_picture">Profile Picture:</label>
                        <input type="file" id="profile_picture" name="profile_picture" accept="image/*" />
                    </div>

                </div>

                @if ($user->role == 'farmer')
                    <!-- STEP 2 - 1 Column -->
                    <div class="profile-form-step-2">


                        <div class="form-group" style="margin-bottom: 18px;  text-align: left;">
                            <div style="margin-bottom: 8px;">
                                <label for="farm_name">Farm Name:</label>
                            </div>
                            <input type="text" id="farm_name" name="farm_name"
                                value="{{ old('farm_name', $user->farm_name) }}" style="width: 100%" required />
                        </div>

                        <div class="form-group" style="margin-bottom: 18px;  text-align: left;">
                            <div style="margin-bottom: 8px;">
                                <label for="farm_location">Farm Location:</label>
                            </div>
                            <input type="text" id="farm_location" name="farm_location" style="width: 100%"
                                value="{{ old('farm_location', $user->farm_location) }}" />
                        </div>

                        <div class="form-group" style="margin-bottom: 18px;  text-align: left;">
                            <div style="margin-bottom: 8px;">
                                <label for="about_farmer">About Farmer:</label>
                            </div>
                            <textarea id="about_farmer" name="about_farmer" style="width: 100% " rows="9">{{ old('about_farmer', $user->about_farmer) }}</textarea>
                        </div>
                    </div>
                @endif

                <button class="sub" type="submit">Save changes</button>
            </form>
        </div>


    </div>
@endsection
