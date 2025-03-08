<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gray-50 dark:bg-gray-900">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">

            <!-- Main Content Section (Form) -->
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">

                <!-- Logo Section (Inside the Form) -->
                <div class="mb-4 text-center">
                    <a href="/" class="flex justify-center">
                        <x-application-logo class="w-20 h-20 fill-current text-gray-500 dark:text-gray-300" />
                    </a>
                </div>

                <!-- Title Section (Inside the Form) -->
                <div class="text-center mb-6">
                    <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200">
                        Welcome to {{ config('app.name', 'Laravel') }}!
                    </h1>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">
                        We are glad you're here. Please log in or register to continue.
                    </p>
                </div>

                <!-- Main Form Content -->
                {{ $slot }}

                <!-- Footer (Inside the Form) -->
                <footer class="mt-8 text-center text-sm text-gray-600 dark:text-gray-400">
                    <p>&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.</p>
                </footer>

            </div>
        </div>
    </body>
</html>
