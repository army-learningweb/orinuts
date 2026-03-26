<div @if(session('destroy_failed')) password-error="true" @endif @error('password_destroy') password-error="true" @enderror
    class="modal-delete-account absolute bg-gray-900/30 pointer-events-none opacity-0 z-10 w-full h-full flex justify-center items-center transform-gpu transition-all duration-150 backdrop-blur-sm">
    <div
        class="modal-slide-down bg-white p-5 rounded-lg w-[90%] md:w-[40%] transform-gpu transition-all duration-200">
        <form action="{{ route('profile.destroy') }}" method="post">
            @csrf
            @method('delete')
            <header>
                <h2 class="md:text-lg text-sm font-medium text-gray-900 flex justify-between items-center">
                    <span>Bạn có chắc muốn xóa tài khoản ?</span>
                    <span
                        class="close-modal cursor-pointer p-2 px-3 rounded-md hover:bg-gray-500/30 transform-gpu transition-all duration-150"><i
                            class="fa-solid fa-x"></i></span>
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
                </p>
            </header>
            <div class="mt-2 text-sm">

                <x-label for="password_destroy">Mật khẩu</x-label>
                <x-input type="password" name="password_destroy" id="password_destroy" class="input-password-destroy"/>
                <x-error-php error_field="password_destroy" />
                <x-error-ajax error_field="password_destroy"/>

                <div class="float-right mt-3">
                     <x-button-delete type="submit" class="w-50">XÓA TÀI KHOẢN</x-button-delete>
                </div>
               
                @if (session('destroy_failed'))
                    <div class="error-field text-red-700 text-sm mt-2 animation_slide_left">
                        <i class="fa-solid fa-circle-exclamation"></i> {{ session('destroy_failed') }}
                    </div>
                @endif
            </div>
        </form>
    </div>
</div>
