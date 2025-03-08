@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-100">
        <!-- Include Admin Navigation -->
        @include('layouts.admin-nav')

        <!-- Main Content -->
        <div class="container mx-auto p-6">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-200">Admin Dashboard</h1>
            <p class="text-gray-600 dark:text-gray-400 mb-6">Welcome, Admin! Manage your system efficiently from here.</p>

            <!-- Dashboard Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Complaints Section -->
                <div class="bg-blue-100 dark:bg-blue-700 p-4 rounded-lg shadow">
                    <h2 class="font-semibold text-xl text-blue-800 dark:text-blue-200">Complaints</h2>
                    <p class="text-gray-600 dark:text-gray-200">Manage and respond to customer complaints.</p>
                    <a href="{{ route('admin.complaints') }}" class="mt-3 inline-block text-blue-500 dark:text-blue-300 hover:text-blue-700 dark:hover:text-blue-400">View Complaints</a>
                </div>

                <!-- Users Section -->
                <div class="bg-green-100 dark:bg-green-700 p-4 rounded-lg shadow">
                    <h2 class="font-semibold text-xl text-green-800 dark:text-green-200">Users</h2>
                    <p class="text-gray-600 dark:text-gray-200">Manage users and their roles.</p>
                    <a href="{{ route('admin.users') }}" class="mt-3 inline-block text-green-500 dark:text-green-300 hover:text-green-700 dark:hover:text-green-400">Manage Users</a>
                </div>

            <!-- Statistics/Recent Activities -->
            <div class="mt-6 bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">System Statistics</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- New Complaints Counter -->
                    <div class="bg-blue-50 dark:bg-blue-800 p-4 rounded-lg shadow">
                        <p class="font-semibold text-lg text-blue-700 dark:text-blue-200">New Complaints</p>
                        <p class="text-2xl font-bold text-blue-800 dark:text-blue-400">15</p> <!-- Dynamic Data -->
                    </div>

                    <!-- Active Users Counter -->
                    <div class="bg-green-50 dark:bg-green-800 p-4 rounded-lg shadow">
                        <p class="font-semibold text-lg text-green-700 dark:text-green-200">Active Users</p>
                        <p class="text-2xl font-bold text-green-800 dark:text-green-400">120</p> <!-- Dynamic Data -->
                    </div>
                </div>
            </div>

            <!-- Notifications/Alerts -->
            <div class="mt-6 bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">System Notifications</h3>
                <ul class="list-disc pl-6">
                    <li class="text-gray-600 dark:text-gray-400">System update required</li>
                    <li class="text-gray-600 dark:text-gray-400">New complaints need attention</li>
                </ul>
            </div>
        </div>
    </div>
@endsection
