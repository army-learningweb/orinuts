<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-label for="email">Email</x-label>
            <x-input type="email" name="email" id="email" />
            <x-error-php error_field="email" />
            <x-error-ajax error_field="email"/>
        </div>

        {{-- button --}}
        <div class="flex items-center justify-end mt-2">
            <x-button-customize type="submit" class="w-full py-3">GỬI LIÊN KẾT ĐẶT LẠI MẬT KHẨU</x-button-customize>
        </div>

        <x-button-mail/>
        
        <div class="mt-2">
            <a href="{{route('login')}}" class="text-blue-600 text-sm inline-block w-full text-center underline">Quay lại</a>
        </div>
    </form>
</x-guest-layout>
