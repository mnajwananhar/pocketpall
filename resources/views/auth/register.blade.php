<x-guest-layout>
    <div class="p-8  rounded-lg  max-w-md mx-auto">
        <h2 class="text-2xl font-bold text-center text-white mb-6">Register</h2>
        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf
            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" class="block text-sm font-medium text-white" />
                <x-text-input id="name"
                    class="mt-1 block w-full bg-gray-700 border-gray-600 text-gray-200 focus:border-yellow-500 focus:ring focus:ring-yellow-500/50 rounded-md"
                    type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-red-500" />
            </div>
            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" class="block text-sm font-medium text-white" />
                <x-text-input id="email"
                    class="mt-1 block w-full bg-gray-700 border-gray-600 text-gray-200 focus:border-yellow-500 focus:ring focus:ring-yellow-500/50 rounded-md"
                    type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-500" />
            </div>
            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" class="block text-sm font-medium text-white" />
                <x-text-input id="password"
                    class="mt-1 block w-full bg-gray-700 border-gray-600 text-gray-200 focus:border-yellow-500 focus:ring focus:ring-yellow-500/50 rounded-md"
                    type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-500" />
            </div>
            <!-- Confirm Password -->
            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm Password')"
                    class="block text-sm font-medium text-white" />
                <x-text-input id="password_confirmation"
                    class="mt-1 block w-full bg-gray-700 border-gray-600 text-gray-200 focus:border-yellow-500 focus:ring focus:ring-yellow-500/50 rounded-md"
                    type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-red-500" />
            </div>
            <div class="flex items-center justify-between">
                <a class="underline text-sm text-white hover:text-white/70 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
                <x-primary-button>
                    {{ __('Register') }}
                </x-primary-button>
            </div>
            <hr class="my-4 border-gray-700">
            <div class="flex items-center justify-center">
                <a href="{{ route('auth.google') }}"
                    class="inline-flex items-center px-3 py-1 bg-red-600 text-white rounded-md hover:bg-red-500 transition-colors duration-200">
                    <i class="fab fa-google mr-2"></i> Register with Google
                </a>
            </div>
        </form>
    </div>
</x-guest-layout>
