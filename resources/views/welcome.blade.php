<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint Ticketing System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-blue-600 p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-white text-2xl font-bold">Complaint Ticketing System</h1>
            <div>
                <a href="{{ route('login') }}" class="text-white px-4 py-2 border rounded hover:bg-white hover:text-blue-600">Login</a>
                <a href="{{ route('register') }}" class="bg-white text-blue-600 px-4 py-2 rounded hover:bg-gray-200">Register</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="text-center py-20 bg-blue-500 text-white">
        <h2 class="text-4xl font-bold">Efficient Complaint Management</h2>
        <p class="mt-4 text-lg">Submit, track, and resolve complaints with ease.</p>
        <a href="{{ route('login') }}" class="mt-6 inline-block bg-white text-blue-600 px-6 py-3 rounded-full font-semibold text-lg shadow hover:bg-gray-200">
            Get Started
        </a>
    </header>

    <!-- Features Section -->
    <section class="container mx-auto py-16 px-6 text-center">
        <h3 class="text-3xl font-bold text-gray-800">How It Works</h3>
        <div class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="p-6 bg-white shadow-md rounded-lg">
                <h4 class="text-xl font-semibold text-blue-600">Submit a Complaint</h4>
                <p class="text-gray-600 mt-2">Easily file complaints through our simple form.</p>
            </div>
            <div class="p-6 bg-white shadow-md rounded-lg">
                <h4 class="text-xl font-semibold text-blue-600">Track Progress</h4>
                <p class="text-gray-600 mt-2">Monitor your complaint status in real-time.</p>
            </div>
            <div class="p-6 bg-white shadow-md rounded-lg">
                <h4 class="text-xl font-semibold text-blue-600">Get Resolution</h4>
                <p class="text-gray-600 mt-2">Receive timely responses and solutions.</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-6 mt-12">
        <p>&copy; {{ date('Y') }} Complaint Ticketing System. All rights reserved.</p>
    </footer>
</body>
</html>
