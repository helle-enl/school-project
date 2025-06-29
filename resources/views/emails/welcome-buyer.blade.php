<!DOCTYPE html>
<html>

<head>
    <title>Welcome to Our Agricultural Marketplace</title>
</head>

<body>
    <h1>Welcome to Our Agricultural Marketplace, {{ $user->first_name }}!</h1>

    <p>Dear {{ $user->first_name }} {{ $user->last_name }},</p>

    <p>Welcome to our agricultural marketplace! We're thrilled to have you as part of our growing community.</p>

    <p>As a buyer on our platform, you can:</p>
    <ul>
        <li>Browse fresh products directly from farmers</li>
        <li>Connect with local and regional farmers</li>
        <li>Access detailed information about farms and their practices</li>
        <li>Enjoy competitive prices and quality products</li>
    </ul>

    <p>Start exploring our marketplace to discover amazing agricultural products from verified farmers.</p>

    <p>Happy shopping!</p>
    <p> &copy; {{ now()->year }} FarmConnect Nigeria. All rights reserved.</p>
</body>

</html>
