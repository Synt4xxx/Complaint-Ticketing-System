<!-- resources/views/admin/complaint-show.blade.php -->
@extends('layouts.app')
@section('title', 'Complaint Details')
@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900 p-8">
    <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
        <h1 class="text-2xl font-bold mb-4">Complaint #{{ $complaint->id }}</h1>
        <p><strong>Customer:</strong> {{ $complaint->user->name }}</p>
        <p><strong>Status:</strong> {{ $complaint->status }}</p>
        <p><strong>Priority:</strong> {{ $complaint->priority }}</p>
        <p><strong>Message:</strong></p>
        <p class="mt-2 p-4 bg-gray-100 dark:bg-gray-700 rounded">{{ $complaint->message }}</p>

        <a href="{{ route('admin.complaints') }}" class="mt-4 inline-block text-blue-600 hover:underline">← Back to Complaints</a>
    </div>
</div>
@endsection