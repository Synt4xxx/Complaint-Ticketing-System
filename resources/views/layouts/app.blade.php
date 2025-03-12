<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Add the theme script in the head section -->
        <script>
            // Add the theme initialization and toggle functions here
            // (Copy the script from welcome.blade.php)
        </script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @auth
                @if(auth()->user()->role === 'admin')
                    @include('layouts.admin-nav')
                @elseif(auth()->user()->role === 'customer')
                    @include('layouts.customer-nav')
                @endif
            @endauth

            <!-- Flash Messages -->
            @if (session('success'))
                <div class="bg-green-100 text-green-800 p-3 rounded mb-4 mx-4 mt-4">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 text-red-800 p-3 rounded mb-4 mx-4 mt-4">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>
        </div>
    </body>
</html>
