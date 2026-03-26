<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-3 text-center" :status="session('status')" />

    <form method="POST" action="{{ route('admin.login.store') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-label for="email">Email</x-label>
            <x-input type="text" name="email" id="email" />
            <x-error-php error_field="email" />
            <x-error-ajax error_field="email"/>
        </div>

        <!-- Password -->
        <div class="mt-2">
            <x-label for="password">Mật khẩu</x-label>
            <x-input type="password" name="password" id="password" />
            <x-error-php error_field="password" />
            <x-error-ajax error_field="password"/>
        </div>

        <!-- Remember Me -->
        <div class="flex justify-between mt-4 text-sm">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-green-700 shadow-sm focus:ring-0" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
            <div>
                @if (Route::has('admin.password.request'))
                    <a class="underline text-sm text-blue-600 rounded-md"
                        href="{{ route('admin.password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>
        </div>

        {{-- button --}}
        <div class="mt-4">
            <x-button-customize type="submit" class="w-full py-3">ĐĂNG NHẬP</x-button-customize>
        </div>
    </form>
</x-guest-layout>
