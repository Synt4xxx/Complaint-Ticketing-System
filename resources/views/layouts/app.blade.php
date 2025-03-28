<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <<link rel="stylesheet" href="{{ asset('fonts/figtree.css') }}">


        <!-- Scripts -->
        @viteReactRefresh
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen  bg-gray-100 dark:bg-gray-900">
        <!-- Loader (Moved inside <body>) -->
        <div id="loader" class="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-gray-900 bg-opacity-75 z-50">
            <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-blue-500"></div>
        </div>

        

            <!-- Navigation -->
            @php
            $user = auth()->user();
            @endphp

            @auth
                @if($user && $user->role === 'admin')
                    @include('layouts.admin-nav')
                @elseif($user && $user->role === 'customer')
                    @include('layouts.customer-nav')
                @elseif($user && $user->role === 'support_staff')
                    @include('layouts.support-nav')
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
