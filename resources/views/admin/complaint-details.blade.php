<!-- resources/views/admin/complaint-details.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-200">Complaint Details</h1>
        
        <!-- Complaint Information -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow mt-6">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Complaint ID: {{ $complaint->id }}</h2>
            <p class="text-gray-600 dark:text-gray-400">Customer: {{ $complaint->user->name }}</p>
            <p class="text-gray-600 dark:text-gray-400">Priority: {{ $complaint->priority }}</p>
            <p class="text-gray-600 dark:text-gray-400">Status: {{ $complaint->status }}</p>
            <p class="text-gray-600 dark:text-gray-400 mt-4">Description: {{ $complaint->description }}</p>
        </div>

        <!-- Update Complaint Status -->
        <form method="POST" action="{{ route('admin.complaint.update', $complaint->id) }}">
            @csrf
            @method('PUT')
            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Update Status</label>
            <select name="status" id="status" class="mt-2 block w-full bg-gray-200 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md">
                <option value="New" {{ $complaint->status == 'New' ? 'selected' : '' }}>New</option>
                <option value="In Progress" {{ $complaint->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                <option value="Resolved" {{ $complaint->status == 'Resolved' ? 'selected' : '' }}>Resolved</option>
                <option value="Closed" {{ $complaint->status == 'Closed' ? 'selected' : '' }}>Closed</option>
            </select>

            <button type="submit" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded-md">Update Status</button>
        </form>
    </div>
@endsection
