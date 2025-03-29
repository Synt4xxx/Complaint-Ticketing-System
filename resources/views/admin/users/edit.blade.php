@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-4 text-gray-900 dark:text-white">Edit User</h2>

    @if(session('error'))
        <div class="bg-red-500 text-white p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.user.update', $user->id) }}">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-semibold mb-1 text-gray-900 dark:text-gray-300">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                   class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring focus:ring-blue-300 dark:focus:ring-blue-500">
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-semibold mb-1 text-gray-900 dark:text-gray-300">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                   class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring focus:ring-blue-300 dark:focus:ring-blue-500">
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Role -->
        <div class="mb-4">
            <label for="role" class="block text-sm font-semibold mb-1 text-gray-900 dark:text-gray-300">Role</label>
            <select name="role" id="role"
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring focus:ring-blue-300 dark:focus:ring-blue-500">
                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="customer" {{ $user->role === 'customer' ? 'selected' : '' }}>Customer</option>
                <option value="support_staff" {{ $user->role === 'support_staff' ? 'selected' : '' }}>Support Staff</option>
            </select>
            @error('role')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Status -->
        <div class="mb-4">
            <label for="status" class="block text-sm font-semibold mb-1 text-gray-900 dark:text-gray-300">Status</label>
            <select name="status" id="status"
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring focus:ring-blue-300 dark:focus:ring-blue-500">
                <option value="active" {{ $user->status === 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $user->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
            @error('status')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password (Optional) -->
        <div class="mb-4">
            <label for="password" class="block text-sm font-semibold mb-1 text-gray-900 dark:text-gray-300">New Password (Optional)</label>
            <input type="password" name="password" id="password"
                   class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring focus:ring-blue-300 dark:focus:ring-blue-500">
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-4">
            <label for="password_confirmation" class="block text-sm font-semibold mb-1 text-gray-900 dark:text-gray-300">Confirm New Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation"
                   class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring focus:ring-blue-300 dark:focus:ring-blue-500">
        </div>

        <!-- Submit Button -->
        <div class="mt-6 flex items-center">
            <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition dark:bg-blue-500 dark:hover:bg-blue-400">
                Update User
            </button>
            <a href="{{ route('admin.users') }}"
               class="ml-4 text-gray-600 dark:text-gray-300 hover:underline">Cancel</a>
        </div>
    </form>
</div>
@endsection
