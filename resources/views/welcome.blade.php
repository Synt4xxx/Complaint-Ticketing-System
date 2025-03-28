<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint Ticketing System</title>

    <!-- Load Tailwind via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>
<body class="bg-gray-50 dark:bg-gray-900 transition-colors duration-200">
    
    <!-- Loader -->
    <div id="loader">
        <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-blue-500"></div>
    </div>

    <!-- Navbar -->
    <nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 shadow-sm fixed top-0 w-full z-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-blue-400 dark:from-blue-500 dark:to-blue-300 text-transparent bg-clip-text">
                    Complaint Ticketing System
                </h1>
                <div class="flex items-center space-x-4">

                    <!-- Auth Links -->
                    <a href="{{ route('login') }}" class="text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 px-4 py-2 rounded-lg transition-colors duration-200">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="bg-blue-600 dark:bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-700 dark:hover:bg-blue-600 transition-colors duration-200">
                        Register
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="relative bg-gradient-to-br from-blue-600 to-blue-700 dark:from-blue-800 dark:to-blue-900">
        <div class="absolute inset-0">
            <img src="{{ asset('images/hero-pattern.png') }}" alt="Background Pattern" class="w-full h-full object-cover opacity-10">
        </div>
        <div class="relative max-w-7xl mx-auto py-24 px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl sm:text-5xl font-bold text-white mb-6">
                Efficient Complaint Management
            </h2>
            <p class="text-xl text-blue-100 max-w-2xl mx-auto mb-10">
                Submit, track, and resolve complaints with our streamlined system.
            </p>
            <a href="{{ route('login') }}" class="inline-flex items-center px-8 py-3 bg-white dark:bg-gray-800 text-blue-600 dark:text-blue-400 rounded-full font-semibold text-lg shadow-lg hover:bg-blue-50 dark:hover:bg-gray-700 transition-colors duration-200 transform hover:scale-105">
                Get Started
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
            </a>
        </div>
    </header>

    <!-- Features Section -->
    <section class="py-20 bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h3 class="text-3xl font-bold text-center text-gray-900 dark:text-white mb-12">
                How It Works
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach([
                    ['title' => 'Submit a Complaint', 'icon' => 'M11 5H6a2 2...', 'desc' => 'File your complaints easily.'],
                    ['title' => 'Track Progress', 'icon' => 'M9 5H7a2 2...', 'desc' => 'Monitor your complaint status.'],
                    ['title' => 'Get Resolution', 'icon' => 'M5 13l4 4L19...', 'desc' => 'Receive prompt responses.'],
                ] as $feature)
                <div class="bg-gray-50 dark:bg-gray-700 rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="bg-blue-100 dark:bg-blue-900/50 w-14 h-14 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $feature['icon'] }}"/>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">{{ $feature['title'] }}</h4>
                    <p class="text-gray-600 dark:text-gray-300">{{ $feature['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 dark:bg-gray-950 text-gray-400 dark:text-gray-500">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-sm">&copy; {{ date('Y') }} Complaint Ticketing System. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
