<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif
    
    {{-- mail button --}}
    <x-button-mail />
    
    {{-- verified email --}}
    <div class="mt-2">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <div>
                <x-button-customize class="w-full py-3">GỬI LẠI MAIL XÁC MINH</x-button-customize>
            </div>
        </form>
    </div>

    {{-- logout --}}
    <form method="POST" action="{{ route('logout') }}" class="text-center mt-2">
        @csrf
        <button type="submit"
            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none">
            {{ __('Log Out') }}
        </button>
    </form>
</x-guest-layout>
