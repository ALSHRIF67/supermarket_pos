<x-guest-layout>
    <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
        <h2 class="text-2xl font-bold text-center text-gray-900 mb-6">إنشاء حساب جديد</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('الاسم')" class="text-gray-700" />
                <x-text-input id="name" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('البريد الإلكتروني')" class="text-gray-700" />
                <x-text-input id="email" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('كلمة المرور')" class="text-gray-700" />
                <x-text-input id="password" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('تأكيد كلمة المرور')" class="text-gray-700" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between mt-6">
                <a class="underline text-sm text-gray-600 hover:text-blue-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition" href="{{ route('login') }}">
                    {{ __('لديك حساب بالفعل؟') }}
                </a>

                <button type="submit" class="px-8 py-3 bg-blue-600 text-white rounded-full font-semibold shadow-md hover:bg-blue-700 hover:shadow-lg transform hover:-translate-y-1 transition-all">
                    {{ __('تسجيل') }}
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>