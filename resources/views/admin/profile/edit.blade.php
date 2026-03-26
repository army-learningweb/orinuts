<x-app-layout>
    
    {{-- topbar --}}
    <x-topbar-content>
        <x-breadcrum href="{{route('admin.dashboard')}}" page_name="Thông tin tài khoản" />
    </x-topbar-content>

    <div class="grid md:grid-cols-2 gap-3 mt-3 px-3 @if (!$errors->any() && !session('status') && !session('destroy_failed')) animation_content_slide_up @endif">
        {{-- profile --}}
        @include('admin.profile.partials.update-profile-information-form')

        {{-- change password --}}
        @include('admin.profile.partials.update-password-form')
    </div>

    {{-- delete-account --}}
    <div class="p-3">
        @include('admin.profile.partials.delete-user-form')
    </div>


</x-app-layout>
