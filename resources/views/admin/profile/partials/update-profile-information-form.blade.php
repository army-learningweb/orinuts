<div class="bg-white p-5 rounded-md shadow-md col-span-1">
    <header>
        <h2 class="text-lg font-medium">
            Hồ sơ
        </h2>
        
        <p class="mt-1 text-sm text-gray-500">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <hr class="my-3">

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="">
        @csrf
        @method('patch')

        <div class="mt-2 text-sm">
            <x-label for="name">Họ và tên</x-label>
            <x-input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" />
            <x-error-php error_field="name" />
            <x-error-ajax error_field="name"/>
        </div>

        <div class="mt-2 text-sm">

            <x-label for="email">Email</x-label>
            <x-input type="email" name="email" id="email" value="{{ old('name', $user->email) }}" />
            <x-error-php error_field="email" />
            <x-error-ajax error_field="email"/>

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="mt-4 md:flex md:items-center">
            <x-button-customize type="submit" class="md:w-auto">Lưu thông tin</x-button-customize>

            <div class="md:ml-3 mt-3">
                @if (session('status') === 'Đã cập nhật thông tin hồ sơ')
                    <div class="error-field text-green-700 text-sm animation_slide_left">
                        <i class="fa-solid fa-circle-check"></i> {{ session('status') }}
                    </div>
                @endif
            </div>

        </div>
    </form>
</div>
