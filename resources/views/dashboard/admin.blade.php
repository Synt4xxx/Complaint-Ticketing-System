@extends('layouts.app')
@section('title', 'Admin Dashboard')
@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900 transition-colors duration-200">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Welcome Section -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 dark:from-blue-800 dark:to-blue-900 rounded-2xl shadow-lg mb-6 p-6">
            <h1 class="text-2xl sm:text-3xl font-bold text-white mb-2">Welcome, Admin!</h1>
            <p class="text-blue-100">Manage your system efficiently from here</p>
        </div>

        <!-- Quick Actions Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <!-- Complaints Card -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700 hover:shadow-lg transition-all duration-200">
                <div class="flex items-center mb-4">
                    <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900/50 text-blue-600 dark:text-blue-400">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Complaints</h2>
                        <p class="text-gray-500 dark:text-gray-400">Manage customer complaints</p>
                    </div>
                </div>
                <a href="{{ route('admin.complaints') }}" 
                   class="inline-flex items-center text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300">
                    View Complaints
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

            <!-- Users Card -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700 hover:shadow-lg transition-all duration-200">
                <div class="flex items-center mb-4">
                    <div class="p-3 rounded-full bg-green-100 dark:bg-green-900/50 text-green-600 dark:text-green-400">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Users</h2>
                        <p class="text-gray-500 dark:text-gray-400">Manage system users</p>
                    </div>
                </div>
                <a href="{{ route('admin.users') }}" 
                   class="inline-flex items-center text-green-600 dark:text-green-400 hover:text-green-800 dark:hover:text-green-300">
                    Manage Users
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Statistics Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <!-- New Complaints Stats -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">New Complaints</h3>
                    <span class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $newComplaintsCount ?? 0 }}</span>
                </div>
                <div class="h-2 bg-blue-100 dark:bg-blue-900/50 rounded-full">
                    <div class="h-2 bg-blue-500 rounded-full" style="width: {{ ($newComplaintsCount ?? 0) > 0 ? ($newComplaintsCount / ($totalComplaintsCount ?? 1)) * 100 : 0 }}%"></div>
                </div>
            </div>

            <!-- Active Users Stats -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Active Users</h3>
                    <span class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $activeUsersCount ?? 0 }}</span>
                </div>
                <div class="h-2 bg-green-100 dark:bg-green-900/50 rounded-full">
                    <div class="h-2 bg-green-500 rounded-full" style="width: {{ ($activeUsersCount ?? 0) > 0 ? ($activeUsersCount / ($totalUsersCount ?? 1)) * 100 : 0 }}%"></div>
                </div>
            </div>
        </div>

        <!-- System Notifications -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">System Notifications</h3>
                <span class="px-3 py-1 text-sm text-blue-600 dark:text-blue-400 bg-blue-100 dark:bg-blue-900/50 rounded-full">
                    2 New
                </span>
            </div>
            <div class="space-y-4">
                <div class="flex items-start p-4 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg">
                    <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <div class="ml-3">
                        <h4 class="text-sm font-medium text-yellow-800 dark:text-yellow-200">System Update Required</h4>
                        <p class="mt-1 text-sm text-yellow-700 dark:text-yellow-300">A new system update is available. Please review and install.</p>
                    </div>
                </div>
                <div class="flex items-start p-4 bg-red-50 dark:bg-red-900/20 rounded-lg">
                    <svg class="w-6 h-6 text-red-600 dark:text-red-400 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div class="ml-3">
                        <h4 class="text-sm font-medium text-red-800 dark:text-red-200">New Complaints Need Attention</h4>
                        <p class="mt-1 text-sm text-red-700 dark:text-red-300">There are unassigned complaints that require immediate attention.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
