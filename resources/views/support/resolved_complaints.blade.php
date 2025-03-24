@extends('layouts.app')

@section('title', 'Resolved Complaints')

@section('content')
<div class="container mx-auto p-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg">
    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-4">Resolved Complaints</h2>

    <table class="w-full border-collapse border border-gray-300 dark:border-gray-600">
        <thead>
            <tr class="bg-gray-200 dark:bg-gray-700">
                <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">ID</th>
                <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Title</th>
                <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Description</th>
                <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Status</th>
                <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($resolvedComplaints as $complaint)
            <tr class="border border-gray-300 dark:border-gray-600">
                <td class="px-4 py-2">{{ $complaint->id }}</td>
                <td class="px-4 py-2">{{ $complaint->title }}</td>
                <td class="px-4 py-2">{{ $complaint->description }}</td>
                <td class="px-4 py-2">{{ $complaint->status }}</td>
                <td class="px-4 py-2">
                    <a href="{{ route('support.view_complaint', $complaint->id) }}" 
                       class="text-blue-500 hover:underline">View</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @if($resolvedComplaints->isEmpty())
        <p class="text-gray-500 dark:text-gray-400 mt-4">No assigned complaints found.</p>
    @endif
</div>
@endsection
