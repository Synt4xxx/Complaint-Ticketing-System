@extends('layouts.app')
@section('title', 'Complaint Details')
@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">

        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Complaint #{{ $complaint->id }}</h2>
            <p class="text-gray-500 dark:text-gray-400">Submitted on {{ $complaint->created_at->format('M d, Y') }}</p>
        </div>

        <!-- Content -->
        <div class="p-6 space-y-4">
            <div>
                <h3 class="font-semibold text-gray-900 dark:text-white">Drugstore</h3>
                <p class="text-gray-600 dark:text-gray-300">{{ $complaint->drugstore_name }}</p>
            </div>

            <div>
                <h3 class="font-semibold text-gray-900 dark:text-white">Complaint Type</h3>
                <p class="text-gray-600 dark:text-gray-300">{{ ucfirst(str_replace('_', ' ', $complaint->complaint_type)) }}</p>
            </div>

            <div>
                <h3 class="font-semibold text-gray-900 dark:text-white">Priority</h3>
                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                    @if($complaint->priority == 'urgent') bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200
                    @elseif($complaint->priority == 'high') bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200
                    @elseif($complaint->priority == 'medium') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                    @else bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 @endif">
                    {{ ucfirst($complaint->priority) }}
                </span>
            </div>

            <div>
                <h3 class="font-semibold text-gray-900 dark:text-white">Status</h3>
                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                    @if($complaint->status == 'New') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                    @elseif($complaint->status == 'In Progress') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                    @else bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 @endif">
                    {{ $complaint->status }}
                </span>
            </div>

            <div>
                <h3 class="font-semibold text-gray-900 dark:text-white">Details</h3>
                <p class="text-gray-600 dark:text-gray-300 whitespace-pre-line">{{ $complaint->description }}</p>
            </div>

            <!-- Attachments Section -->
            @if($complaint->attachments->isNotEmpty())
                <div>
                    <h3 class="font-semibold text-gray-900 dark:text-white">Attachments</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-2">
                        @foreach($complaint->attachments as $attachment)
                            <div class="border p-2 rounded-lg bg-gray-100 dark:bg-gray-700">
                                @if(in_array(pathinfo($attachment->file_path, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                    <!-- Image Preview -->
                                    <img src="{{ asset($attachment->file_path) }}" alt="Attachment" class="w-full h-48 object-cover rounded-lg">
                                @else
                                    <!-- Download Link for Other Files -->
                                    <a href="{{ asset('storage/' . $attachment->file_path) }}" class="text-blue-500 dark:text-blue-400 hover:underline" target="_blank">
                                        {{ $attachment->file_name }}
                                    </a>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <p class="text-gray-500 dark:text-gray-400">No attachments uploaded.</p>
            @endif

        </div>

        <!-- Back Button -->
        <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-600 text-right">
            <a href="{{ route('complaints.index') }}"
               class="inline-flex items-center px-4 py-2 bg-gray-600 dark:bg-gray-500 text-white rounded-lg hover:bg-gray-700 dark:hover:bg-gray-600 transition-all duration-200 shadow-sm">
                Back to Complaints
            </a>
        </div>
    </div>
</div>
@endsection
