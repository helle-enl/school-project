@extends('layouts.app')

@section('content')
    <section class="profile-section">
        <h1>Your Profile</h1>

        <div class="profile">
            <div class="profile-left">
                <img class="profile-pic" src="{{ asset('profile_pictures/' . $user->profile_picture) }}"
                    alt="Profile Picture" />
                <h3>{{ ucfirst($user->first_name) . ' ' . ucfirst($user->last_name) }}</h3>
                <div class="profile-info">
                    <strong>Email:</strong> <span>{{ $user->email }}</span>
                </div>
                <div class="profile-info">
                    <strong>Phone:</strong> <span>{{ $user->whatsapp_number }}</span>
                </div>
                <div class="profile-info">
                    <strong>Farm Name:</strong> <span>{{ $user->farm_name }}</span>
                </div>
                <div class="profile-info">
                    <strong>Farm Location:</strong> <span>{{ $user->farm_location }}</span>
                </div>
            </div>

            <div class="profile-right">
                {{-- <div class="profile-info">
                    <strong>Farm Size:</strong> <span>{{ $user->farm_size }}</span>
                </div> --}}
                <div class="profile-info">
                    <strong>Farm Type:</strong> <span>{{ $user->farm_type }}</span>
                </div>
                {{-- <div class="profile-info">
                    <strong>Farm Products:</strong> <span>{{ $user->farm_products }}</span>
                </div> --}}
                <div class="profile-info">
                    <strong>About Farmer:</strong> <span>{{ $user->about_farmer }}</span>
                </div>
                {{-- <div class="profile-info">
                    <strong>Social Media:</strong> <span>{{ $user->social_media }}</span>
                </div> --}}
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
                    <input type="text" id="last_name" name="last_name" value="{{ old('last_name', $user->last_name) }}"
                        required />
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
                    <input type="text" id="city" name="city" value="{{ old('city', $user->city) }}" required />
                </div>

                <div class="form-group profile-form-input-step-1">
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" value="{{ old('address', $user->address) }}"
                        required />
                </div>

                <div class="form-group profile-form-input-step-1">
                    <label for="profile_picture">Profile Picture:</label>
                    <input type="file" id="profile_picture" name="profile_picture" accept="image/*" />
                </div>

            </div>

            <!-- STEP 2 - 1 Column -->
            <div class="profile-form-step-2">


                <div class="form-group" style="margin-bottom: 18px;  text-align: left;">
                    <div style="margin-bottom: 8px;">
                        <label for="farm_name">Farm Name:</label>
                    </div>
                    <input type="text" id="farm_name" name="farm_name" value="{{ old('farm_name', $user->farm_name) }}"
                        style="width: 100%" required />
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

            <button class="sub" type="submit">Save changes</button>
        </form>

    </section>
@endsection
