<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ Auth::check() && Auth::user()->role == 'admin' ? 'Admin Dashboard' : 'User Dashboard' }}</title>
    @vite('resources/css/app.css')
    @stack('styles')
</head>
<body class="bg-gray-100 dark:bg-gray-900">
    @if(Auth::check() && Auth::user()->role == 'admin')
        @include('partials.admin-navbar')
    @else
        @include('partials.user-navbar')
    @endif

    <main class="container mx-auto p-6">
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>
