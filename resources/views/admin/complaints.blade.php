@extends('layouts.app')
@section('title', 'Manage Complaints')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900 transition-colors duration-200">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 pt-20">
        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8">
            <div class="flex items-center mb-4 sm:mb-0">
                <a href="{{ route('admin.dashboard') }}" 
                   class="inline-flex items-center justify-center w-10 h-10 max-w-xs rounded-lg bg-white dark:bg-gray-800 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200" 
                   title="Back to Dashboard">
                    <svg width="24" height="24" class="text-gray-600 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white">Manage Complaints</h1>
            </div>
        </div>

        <!-- Complaints Table -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Customer</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Priority</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Support Staff</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($complaints as $complaint)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                    #{{ $complaint->id }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $complaint->user->name ?? 'Unknown' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                        @if($complaint->status === 'New') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                                        @elseif($complaint->status === 'In Progress') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                                        @else bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                        @endif">
                                        {{ $complaint->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                        @if($complaint->priority === 'High') bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200
                                        @elseif($complaint->priority === 'Medium') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                                        @else bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                        @endif">
                                        {{ $complaint->priority }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                    @if($complaint->assignedUser)
                                        {{ $complaint->assignedUser->name }}
                                    @else
                                        <span class="text-red-500">Unassigned</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm flex space-x-2">
                                    <a href="{{ route('admin.complaint-show', $complaint->id) }}"
                                       class="inline-flex items-center px-3 py-2 bg-blue-600 text-white text-xs font-semibold rounded-lg hover:bg-blue-700 transition duration-150">
                                        View Details
                                    </a>
                                    <button onclick="openAssignModal({{ $complaint->id }})"
                                            class="inline-flex items-center px-3 py-2 bg-green-600 text-white text-xs font-semibold rounded-lg hover:bg-green-700 transition duration-150">
                                        Assign
                                    </button>
                                    <form action="{{ route('admin.complaints.destroy', $complaint->id) }}" method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this complaint?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="inline-flex items-center px-3 py-2 bg-red-600 text-white text-xs font-semibold rounded-lg hover:bg-red-700 transition duration-150">
                                            Delete
                                        </button>
                                    </form>
                                </td>                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-600">
                {{ $complaints->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Assign Complaint Modal -->
<div id="assignModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-96">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Assign Complaint</h2>
        
        <form id="assignForm" action="{{ route('admin.complaints.assign', ':id') }}" method="POST">
            @csrf
            <input type="hidden" name="complaint_id" id="complaint_id">
            <label for="support_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Select Support Staff
            </label>
            <select name="support_id" id="support_id" class="w-full border-gray-300 rounded-lg">
                <option value="">-- Select Support Staff --</option>
                @foreach($supportStaff as $support)
                    <option value="{{ $support->id }}">{{ $support->name }}</option>
                @endforeach
            </select>
            <div class="flex justify-end space-x-2 mt-4">
                <button type="button" onclick="closeAssignModal()" class="px-4 py-2 bg-gray-500 text-white rounded-lg">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Assign</button>
            </div>
        </form>
    </div>
</div>
@endsection
