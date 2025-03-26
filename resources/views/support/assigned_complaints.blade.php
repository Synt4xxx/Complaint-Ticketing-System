@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl mx-auto bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">

        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Assigned Complaints</h2>
            <p class="text-gray-500 dark:text-gray-400">Manage all assigned complaints in one place.</p>
        </div>

        <!-- Complaints List -->
        <div class="p-6 space-y-4">
            @if($assignedComplaints->isEmpty())
                <div class="p-4 text-center bg-gray-100 dark:bg-gray-700 rounded-lg">
                    <p class="text-gray-500 dark:text-gray-300">No assigned complaints found.</p>
                </div>
            @else
                @foreach ($assignedComplaints as $complaint)
                    <div class="bg-gray-100 dark:bg-gray-700 p-5 rounded-lg shadow-sm">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                Complaint #{{ $complaint->id }}
                            </h3>
                            <p class="text-gray-500 dark:text-gray-300 text-sm">
                                Submitted on {{ $complaint->created_at->format('M d, Y') }}
                            </p>
                        </div>

                        <p class="text-gray-600 dark:text-gray-300 mt-2">
                            {{ Str::limit($complaint->description, 100) }}
                        </p>

                        <div class="mt-3 flex items-center space-x-3">
                            <!-- Priority Badge -->
                            <span class="px-3 py-1 text-xs font-semibold rounded-full
                                @if($complaint->priority == 'urgent') bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200
                                @elseif($complaint->priority == 'high') bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200
                                @elseif($complaint->priority == 'medium') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                                @else bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 @endif">
                                {{ ucfirst($complaint->priority) }}
                            </span>

                            <!-- Status Badge -->
                            <span class="px-3 py-1 text-xs font-semibold rounded-full
                                @if($complaint->status == 'New') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                                @elseif($complaint->status == 'In Progress') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                                @else bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 @endif">
                                {{ $complaint->status }}
                            </span>
                        </div>

                        <!-- Actions -->
                        <div class="mt-4 text-right">
                            <a href="{{ route('support.view_complaint', $complaint->id) }}"
                               class="inline-flex items-center px-4 py-2 bg-blue-600 dark:bg-blue-500 text-white rounded-lg hover:bg-blue-700 dark:hover:bg-blue-600 transition-all duration-200 shadow-sm">
                                View Details
                            </a>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <!-- Back Button -->
        <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-600 text-right">
            <a href="{{ route('support.dashboard') }}"
               class="inline-flex items-center px-4 py-2 bg-gray-600 dark:bg-gray-500 text-white rounded-lg hover:bg-gray-700 dark:hover:bg-gray-600 transition-all duration-200 shadow-sm">
                Back to Dashboard
            </a>
        </div>
    </div>
</div>
@endsection
