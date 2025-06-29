<!DOCTYPE html>
<html>

<head>
    <title>Welcome to Our Farming Platform</title>
</head>

<body>
    <h1>Welcome to Our Farming Platform, {{ $user->first_name }}!</h1>

    <p>Dear {{ $user->first_name }} {{ $user->last_name }},</p>

    <p>Welcome to our agricultural platform! We're excited to have you join our community of dedicated farmers.</p>

    <p>As a farmer on our platform, you can:</p>
    <ul>
        <li>Showcase your farm and products</li>
        <li>Connect directly with buyers</li>
        <li>Manage your product listings</li>
        <li>Access farming resources and tips</li>
    </ul>

    @if ($user->farm_name)
        <p>We're looking forward to seeing {{ $user->farm_name }} thrive on our platform!</p>
    @endif

    <p>Get started by exploring your dashboard and setting up your farm profile.</p>

    <p>Happy farming!</p>
    <p> &copy; {{ now()->year }} FarmConnect Nigeria. All rights reserved.</p>
</body>

</html>
