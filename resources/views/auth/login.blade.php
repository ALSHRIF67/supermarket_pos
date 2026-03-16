<x-guest-layout>
    <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
        {{-- Session Status --}}
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <h2 class="text-2xl font-bold text-center text-gray-900 mb-6">تسجيل الدخول</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Email --}}
            <div>
                <x-input-label for="email" :value="__('البريد الإلكتروني')" class="text-gray-700" />
                <x-text-input id="email" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            {{-- Password --}}
            <div class="mt-4">
                <x-input-label for="password" :value="__('كلمة المرور')" class="text-gray-700" />
                <x-text-input id="password" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            {{-- Remember Me --}}
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('تذكرني') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-between mt-6">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-blue-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition" href="{{ route('password.request') }}">
                        {{ __('نسيت كلمة المرور؟') }}
                    </a>
                @endif

                <button type="submit" class="px-8 py-3 bg-blue-600 text-white rounded-full font-semibold shadow-md hover:bg-blue-700 hover:shadow-lg transform hover:-translate-y-1 transition-all">
                    {{ __('تسجيل الدخول') }}
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>