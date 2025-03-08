<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    @vite('resources/css/app.css') <!-- Include Tailwind CSS -->
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        @include('partials.admin-nav') !-- Admin Navigation -->
        <main class="p-6">
            @yield('content') <!-- This will be replaced by the child view content -->
        </main>
    </div>
</body>
</html>
