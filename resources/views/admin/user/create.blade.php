<x-app-layout>

    {{-- topbar --}}
    <x-topbar-content>
        <x-breadcrum href="{{ route('admin.users.list') }}" page_name="Thêm thành viên mới" />
    </x-topbar-content>

    <div class="p-3">
        <div class="md:flex md:items-start gap-3 @if (!$errors->any()) animation_content_slide_up @endif">
            {{-- form đăng ký thành viên --}}
            <form action="{{ route('admin.users.store') }}" method="POST"
                class="md:w-[40%] text-sm bg-white rounded-lg shadow-md pt-1 pb-3 px-5">
                @csrf

                {{-- name --}}
                <div class="mt-2">
                    <x-label for="name">Họ và tên <span class="text-lg text-red-600">*</span></x-label>
                    <x-input type="text" name="name" id="name" />
                    <x-error-php error_field="name" />
                    <x-error-ajax error_field="name" />
                </div>

                {{-- email --}}
                <div class="mt-2">
                    <x-label for="email">Email <span class="text-lg text-red-600">*</span></x-label>
                    <x-input type="text" name="email" id="email" />
                    <x-error-php error_field="email" />
                    <x-error-ajax error_field="email" />
                </div>

                {{-- password --}}
                <div class="mt-2">
                    <x-label for="password">Mật khẩu<span class="text-lg text-red-600">*</span></x-label>
                    <x-input type="password" name="password" id="password" />
                    <x-error-php error_field="password" />
                    <x-error-ajax error_field="password" />
                </div>

                {{-- confirm password --}}
                <div class="mt-2">
                    <x-label for="password_confirmation">Xác nhận mật khẩu <span
                            class="text-lg text-red-600">*</span></x-label>
                    <x-input type="password" name="password_confirmation" value="" id="password_confirmation" />
                    <x-error-php error_field="password_confirmation" />
                    <x-error-ajax error_field="password_confirmation" />
                </div>

                {{-- status --}}
                <div class="mt-2">
                    <x-label for="is_active">Trạng thái</x-label><br>
                    <x-select name="is_active" id="is_active">
                        <option value="active">Hoạt động</option>
                        <option value="unactive">Đình chỉ</option>
                    </x-select>
                </div>

                {{-- button --}}
                <div class="mt-4">
                    <x-button-customize type="submit" class="w-full py-3">Thêm mới</x-button-customize>
                </div>

            </form>

            {{-- attention --}}
            <div class="md:flex-1 p-5 pb-6 bg-white rounded-lg shadow-md mt-2 md:mt-0">
                <p class="text-lg font-semibold">Lưu ý khi tạo thành viên !</p>
                <hr class="my-2">
                <ul class="mt-3 text-sm">
                    <li class="mt-2"><i class="fa-solid fa-circle-exclamation text-blue-500 mr-2"></i>Email phải là
                        <span class="font-semibold text-blue-500">duy nhất</span></li>
                    <li class="mt-2"><i class="fa-solid fa-circle-check text-green-600 mr-2"></i>Mật khẩu nên tối
                        thiểu 8
                        ký tự, có chữ hoa & số</li>
                    <li class="mt-2"><i class="fa-solid fa-circle-xmark text-red-700 mr-2"></i>Trạng thái <span
                            class="font-semibold">"Chưa kích hoạt"</span> → người dùng <span class="font-semibold">chưa
                            thể
                            đăng nhập</span></li>
                </ul>
                <hr class="my-3">
                <ul class="mt-3 text-sm">
                    <p class="text-md font-semibold text-gray-500">Giải thích nhóm quyền</p>
                    <li class="mt-2"><span class="font-semibold">Quản lý hệ thống:</span> Toàn quyền quản trị</li>
                    <li class="mt-2"><span class="font-semibold">Nhân viên:</span> Quyền cơ bản</li>
                    <li class="mt-2"><span class="font-semibold">Cộng tác viên:</span> Quyền hạn chế</li>
                </ul>
                <hr class="my-3">
                <ul class="mt-3 text-sm">
                    <p class="text-md font-semibold text-gray-500">Sau khi tạo</p>
                    <li class="mt-2"><span class="font-semibold">1.</span> Lưu thông tin thành viên</li>
                    <li class="mt-2"><span class="font-semibold">2.</span> Gửi email thông báo</li>
                    <li class="mt-2"><span class="font-semibold">3.</span> Cho phép đăng nhập khi kích hoạt</li>
                </ul>
                <hr class="my-3">
                <ul class="mt-3 text-sm">
                    <p class="text-md font-semibold text-gray-800"><i
                            class="fa-solid fa-shield-halved text-yellow-500 mr-1"></i> Bảo mật & khuyến nghị</p>
                    <li class="mt-2">Không chia sẻ tài khoản cho nhiều người</li>
                    <li class="mt-2">Nên đổi mật khẩu sau lần đăng nhập đầu tiên</li>
                    <li class="mt-2">Hạn chế cấp quyền <strong>Quản lý hệ thống</strong></li>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
