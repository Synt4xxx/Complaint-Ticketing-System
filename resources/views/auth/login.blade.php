<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <h2 class="text-2xl font-bold">Login to Complaint System</h2>
        </x-slot>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required />
            </div>

            <div class="mt-4">
                <button class="bg-blue-500 text-white px-4 py-2 rounded-lg">Login</button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
