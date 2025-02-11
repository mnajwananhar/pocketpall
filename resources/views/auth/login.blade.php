<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="p-8  rounded-lg  max-w-md mx-auto">
        <h2 class="text-2xl font-bold text-center text-white mb-6">Log in</h2>
        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf
            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" class="block text-sm font-medium text-white" />
                <x-text-input id="email"
                    class="mt-1 block w-full bg-gray-700 border-gray-600 text-gray-200 focus:border-yellow-500 focus:ring focus:ring-yellow-500/50 rounded-md"
                    type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-500" />
            </div>
            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" class="block text-sm font-medium text-white" />
                <x-text-input id="password"
                    class="mt-1 block w-full bg-gray-700 border-gray-600 text-gray-200 focus:border-yellow-500 focus:ring focus:ring-yellow-500/50 rounded-md"
                    type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-500" />
            </div>
            <!-- Remember Me -->
            <div class="flex items-center justify-between">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-[#FCD535] shadow-sm focus:ring-[#FCD535]" name="remember">
                    <span class="ms-2 text-sm text-gray-200">{{ __('Remember me') }}</span>
                </label>
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-200 hover:text-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FCD535]"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>
            <!-- Login Button -->
            <div class="flex items-center justify-center">
                <x-primary-button
                    class="w-full bg-[#FCD535] text-gray-900 hover:bg-[#FCD535]/80 flex items-center justify-center">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
            <!-- Or Separator -->
            <div class="relative my-4">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="w-full border-t border-gray-700"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2  text-gray-400">or</span>
                </div>
            </div>
            <!-- Google Login -->
            <a href="{{ route('auth.google') }}"
                class="inline-flex items-center justify-center w-full px-3 py-1 bg-red-600 text-white rounded-md hover:bg-red-500 transition-colors duration-200 space-x-2">
                <i class="fab fa-google"></i>
                <span>Log in with Google</span>
            </a>
        </form>
    </div>
</x-guest-layout>
