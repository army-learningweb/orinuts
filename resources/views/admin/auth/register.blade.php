<x-guest-layout>
    <form method="POST" action="{{ route('admin.register.store') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-label for="name">Họ và tên <span class="text-red-600">*</span></x-label>
            <x-input type="text" name="name" id="name" />
            <x-error-php error_field="name" />
            <x-error-ajax error_field="name"/>
        </div>

        <!-- Email Address -->
        <div class="mt-2">
            <x-label for="email">Email <span class="text-red-600">*</span></x-label>
            <x-input type="email" name="email" id="email" />
            <x-error-php error_field="email" />
            <x-error-ajax error_field="email"/>
        </div>

        <!-- Password -->
        <div class="mt-2">
            <x-label for="password">Mật khẩu <span class="text-red-600">*</span></x-label>
            <x-input type="password" name="password" id="password" />
            <x-error-php error_field="password" />
            <x-error-ajax error_field="password"/>
        </div>

        <!-- Confirm Password -->
        <div class="mt-2">
            <x-label for="password_confirmation">Xác nhận mật khẩu</x-label>
            <x-input type="password" name="password_confirmation" id="password_confirmation" />
        </div>

        {{-- button --}}
        <div class="mt-4">
            <x-button-customize type="submit" class="w-full py-3">ĐĂNG KÝ</x-button-customize>
        </div>

        <div class="mt-3 text-center">
            <a class="underline text-sm text-blue-600 hover:text-gray-900 rounded-md focus:outline-none"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
        </div>
    </form>

</x-guest-layout>
