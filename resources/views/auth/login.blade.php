<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <!-- Title Above the Form -->
            <h2 class="text-3xl font-bold text-white text-center mb-6">Complaint Ticketing System</h2>
        </x-slot>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" required autofocus placeholder="Enter your email" />
            </div>

            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required placeholder="Enter your password" />
            </div>

            <!-- Login Button -->
            <div class="mt-4">
                <button class="bg-blue-500 text-white px-4 py-2 rounded-lg w-full">Login</button>
            </div>
        </form>

        <!-- Register Button -->
        <div class="mt-4 text-center">
            <p class="text-gray-600">Don't have an account?</p>
            <a href="{{ route('register') }}" class="mt-2 inline-block bg-gray-300 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-400">
                Register
            </a>
        </div>

    </x-auth-card>
</x-guest-layout>
