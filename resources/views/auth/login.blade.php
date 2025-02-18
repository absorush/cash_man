<x-guest-layout>
    <!-- وضعیت نشست -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="rtl text-right bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 w-full max-w-md mx-auto">
        @csrf

        <!-- آدرس ایمیل -->
        <div>
            <x-input-label for="email" :value="__('ایمیل آدرس')" class="text-right" />
            <x-text-input id="email" class="block mt-1 w-full border-gray-300 rounded-md" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- رمز عبور -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('رمز عبور')" class="text-right" />
            <x-text-input id="password" class="block mt-1 w-full border-gray-300 rounded-md" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- مرا به خاطر بسپار -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="mr-2 text-sm text-gray-600">{{ __('مرا به خاطر بسپار') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                    {{ __('رمز عبور خود را فراموش کرده‌اید؟') }}
                </a>
            @endif

            <x-primary-button class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                {{ __('ورود') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>