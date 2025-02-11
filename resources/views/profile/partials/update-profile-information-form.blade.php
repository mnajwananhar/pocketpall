<section>
    <header>
        <h2 class="text-lg font-medium text-gray-200">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" class="text-white" />
            <x-text-input id="name" name="name" type="text"
                class="mt-1 block w-full bg-gray-700 border-gray-600 text-gray-200 focus:border-yellow-500 focus:ring focus:ring-yellow-500/50"
                :value="old('name', $user->name)" required autofocus autocomplete="name" placeholder="{{ __('Enter your name') }}" />
            <x-input-error class="mt-2 text-gray-400" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-white" />
            <x-text-input id="email" name="email" type="email"
                class="mt-1 block w-full bg-gray-700 border-gray-600 text-gray-200 focus:border-yellow-500 focus:ring focus:ring-yellow-500/50"
                :value="old('email', $user->email)" required autocomplete="username" placeholder="{{ __('Enter your email') }}" />
            <x-input-error class="mt-2 text-gray-400" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-400">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification"
                            class="underline text-sm text-gray-400 hover:text-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="px-4 py-2 bg-[#FCD535] text-gray-900 rounded-md hover:bg-[#FCD535]/80">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-400">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
