<!-- resources/views/admin/complaints.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <!-- Back Button -->
        <a href="{{ route('admin.dashboard') }}" 
           class="inline-flex items-center justify-center w-10 h-10 mb-4 rounded-full bg-white hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 shadow-sm transition-colors duration-200" 
           title="Back to Dashboard">
            <svg class="w-6 h-6 text-gray-600 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </a>

        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-200">Manage Complaints</h1>
        
        <!-- Complaints Table -->
        <div class="overflow-x-auto bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
            <table class="min-w-full table-auto">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">ID</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">Customer</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">Status</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">Priority</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($complaints as $complaint)
                        <tr>
                            <td class="px-4 py-2">{{ $complaint->id }}</td>
                            <td class="px-4 py-2">{{ $complaint->user->name }}</td>
                            <td class="px-4 py-2">{{ $complaint->status }}</td>
                            <td class="px-4 py-2">{{ $complaint->priority }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('admin.complaint.show', $complaint->id) }}" class="text-blue-500 dark:text-blue-300">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
