<div class="bg-white p-5 rounded-md shadow-md">
    <header>
        <h2 class="text-lg font-medium">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <hr class="my-3">

    <form method="post" action="{{ route('password.update') }}" class="">
        @csrf
        @method('put')

        <div class="mt-2 text-sm">
            <x-label for="update_password_current_password">Mật khẩu hiện tại</x-label>
            <x-input type="password" name="current_password" id="update_password_current_password" />
            <x-error-php error_field="current_password" />
            <x-error-ajax error_field="current_password" />
        </div>

        <div class="mt-2 text-sm">
            <x-label for="update_password_password">Mật khẩu mới</x-label>
            <x-input type="password" name="password" id="update_password_password" />
            <x-error-php error_field="password" />
            <x-error-ajax error_field="password" />
        </div>

        <div class="mt-2 text-sm">
            <x-label for="update_password_password_confirmation">Xác nhận mật khẩu</x-label>
            <x-input type="password" name="password_confirmation" id="update_password_password_confirmation" />
            <x-error-php error_field="password_confirmation" />
            <x-error-ajax error_field="password_confirmation" />
        </div>

        <div class="mt-4 md:flex md:items-center">
            <x-button-customize type="submit" class="md:w-auto">Cập nhật</x-button-customize>

            <div class="md:ml-3 mt-3">
                @if (session('status') === 'Đã cập nhật lại mật khẩu')
                    <div class="error-field text-green-700 text-sm animation_slide_left">
                        <i class="fa-solid fa-circle-check"></i> {{ session('status') }}
                    </div>
                @endif
            </div>

        </div>
    </form>
</div>
