@extends('layouts.app')
@section('title', 'Submit Drugstore Complaint')
@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900 transition-colors duration-200">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="max-w-3xl mx-auto">
            <!-- Header -->
            <div class="mb-6">
                <div class="flex items-center">
                    <a href="{{ route('customer.dashboard') }}" 
                       class="inline-flex items-center justify-center w-10 h-10 rounded-lg bg-white dark:bg-gray-800 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200 mr-4">
                        <svg class="w-6 h-6 text-gray-600 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </a>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Submit Drugstore Complaint</h1>
                </div>
            </div>

            <!-- Complaint Form -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden border border-gray-200 dark:border-gray-700">
                <form action="{{ route('complaints.store') }}" method="POST" class="p-6" enctype="multipart/form-data">
                    @csrf

                    @if(session('success'))
                        <div class="mb-4 p-4 rounded-lg bg-green-100 dark:bg-green-800 text-green-700 dark:text-green-200">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="mb-4 p-4 rounded-lg bg-red-100 dark:bg-red-800 text-red-700 dark:text-red-200">
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Drugstore Name -->
                    <div class="mb-6">
                        <label for="drugstore_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Drugstore Name
                        </label>
                        <input type="text" 
                               name="drugstore_name" 
                               id="drugstore_name" 
                               value="{{ old('drugstore_name') }}"
                               class="block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                               placeholder="Enter the drugstore name"
                               required>
                    </div>

                    <!-- Complaint Type -->
                    <div class="mb-6">
                        <label for="complaint_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Type of Complaint
                        </label>
                        <select name="complaint_type" 
                                id="complaint_type" 
                                class="block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                required>
                            <option value="">Select complaint type</option>
                            <option value="medication_quality">Medication Quality</option>
                            <option value="service_issue">Customer Service</option>
                            <option value="pricing">Pricing Issues</option>
                            <option value="prescription">Prescription Handling</option>
                            <option value="safety">Safety Concerns</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <!-- Incident Date -->
                    <div class="mb-6">
                        <label for="incident_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Date of Incident
                        </label>
                        <input type="date" 
                               name="incident_date" 
                               id="incident_date" 
                               value="{{ old('incident_date') }}"
                               class="block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                               required>
                    </div>

                    <!-- Priority Level -->
                    <div class="mb-6">
                        <label for="priority" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Priority Level
                        </label>
                        <select name="priority" 
                                id="priority" 
                                class="block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                required>
                            <option value="low">Low Priority</option>
                            <option value="medium">Medium Priority</option>
                            <option value="high">High Priority</option>
                            <option value="urgent">Urgent</option>
                        </select>
                    </div>

                    <!-- Complaint Description -->
                    <div class="mb-6">
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Detailed Description
                        </label>
                        <textarea name="description" 
                                  id="description" 
                                  rows="6" 
                                  class="block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                  placeholder="Please provide detailed information about your complaint"
                                  required>{{ old('description') }}</textarea>
                    </div>

                    <!-- Evidence Upload -->
                    <div class="mb-6">
                        <label for="attachments" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Supporting Documents (Optional)
                        </label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-lg">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <div class="flex text-sm text-gray-600 dark:text-gray-400">
                                    <label for="file-upload" class="relative cursor-pointer rounded-md font-medium text-blue-600 dark:text-blue-400 hover:text-blue-500 focus-within:outline-none">
                                        <span>Upload files</span>
                                        <input id="file-upload" name="attachments[]" type="file" class="sr-only" multiple>
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    Receipts, photos, or other relevant documents (PNG, JPG, PDF up to 10MB)
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-blue-500 dark:hover:bg-blue-600">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Submit Complaint
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection