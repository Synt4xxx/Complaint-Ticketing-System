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
                <a href="{{ route('admin.complaints') }}" class="inline-flex items-center text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300">
                    View Complaints
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Statistics Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Complaints -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Total Complaints</h3>
                <span class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $totalComplaints ?? 0 }}</span>
            </div>

            <!-- Active Complaints -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Active Complaints</h3>
                <span class="text-2xl font-bold text-yellow-600 dark:text-yellow-400">{{ $activeComplaints ?? 0 }}</span>
            </div>

            <!-- Resolved Complaints -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Resolved Complaints</h3>
                <span class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $resolvedComplaints ?? 0 }}</span>
            </div>

            <!-- Total Users -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Total Users</h3>
                <span class="text-2xl font-bold text-purple-600 dark:text-purple-400">{{ $totalUsers ?? 0 }}</span>
            </div>
        </div>

        <!-- Recent Complaints List -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 border border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Recent Complaints</h3>
            <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($recentComplaints as $complaint)
                    <li class="py-2">
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $complaint->title }}</span>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Status: {{ $complaint->status }}</p>
                    </li>
                @empty
                    <li class="py-2 text-gray-500 dark:text-gray-400">No recent complaints</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection
