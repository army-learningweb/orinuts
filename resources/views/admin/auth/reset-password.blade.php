<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-label for="email">Email</x-label>
            <x-input type="email" name="email" id="email" value="{{ old('email', $request->email) }}" />
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

        <!-- Confirm Password -->
        <div class="mt-2">
            <x-label for="password_confirmation">Xác nhận mật khẩu</x-label>
            <x-input type="password" name="password_confirmation" id="password_confirmation" />
            <x-error-php error_field="password_confirmation" />
        </div>


        <div class="flex items-center justify-end mt-2">
            <x-button-customize class="w-full py-3">ĐẶT LẠI MẬT KHẨU</x-button-customize>
        </div>
    </form>
</x-guest-layout>
