<section>
    <header>
        <h2 class="text-lg font-medium text-gray-200">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Current Password')" class="text-white" />
            <x-text-input id="update_password_current_password" name="current_password" type="password"
                class="mt-1 block w-full bg-gray-700 border-gray-600 text-gray-200 focus:border-yellow-500 focus:ring focus:ring-yellow-500/50"
                autocomplete="current-password" placeholder="{{ __('Enter your current password') }}" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-gray-400" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('New Password')" class="text-white" />
            <x-text-input id="update_password_password" name="password" type="password"
                class="mt-1 block w-full bg-gray-700 border-gray-600 text-gray-200 focus:border-yellow-500 focus:ring focus:ring-yellow-500/50"
                autocomplete="new-password" placeholder="{{ __('Enter your new password') }}" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-gray-400" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" class="text-white" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password"
                class="mt-1 block w-full bg-gray-700 border-gray-600 text-gray-200 focus:border-yellow-500 focus:ring focus:ring-yellow-500/50"
                autocomplete="new-password" placeholder="{{ __('Confirm your new password') }}" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-gray-400" />
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="px-4 py-2 bg-[#FCD535] text-gray-900 rounded-md hover:bg-[#FCD535]/80">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-400">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
