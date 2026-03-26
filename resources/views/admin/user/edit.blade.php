<x-app-layout>

    {{-- topbar --}}
    <x-topbar-content>
        <x-breadcrum href="{{ route('admin.users.list') }}" page_name="Cập nhật thông tin ({{$user->name}})" />
    </x-topbar-content>

    <div class="md:flex md:items-start p-3 gap-3 @if (!$errors->any()) animation_content_slide_up @endif">
        {{-- form cập nhật thông tin --}}
        <form action="{{route('admin.users.update',$user->id)}}" method="POST" 
            class="md:w-[40%] text-sm bg-white rounded-lg shadow-md pt-1 pb-3 px-5">
            @csrf
            {{-- name --}}
            <div class="mt-2">
                <x-label for="name">Họ và tên <span class="text-lg text-red-600">*</span></x-label>
                <x-input type="text" name="name" id="name" value="{{old('name',$user->name)}}"/>
                <x-error-php error_field="name" />
                <x-error-ajax error_field="name" />
            </div>

            {{-- email --}}
            <div class="mt-2">
                <x-label for="email">Email <span class="text-lg text-red-600">*</span></x-label>
                <x-input type="text" name="email" id="email" value="{{old('email',$user->email)}}" readonly style="background: rgb(254, 233, 233)"/>
                <x-error-php error_field="email" />
                <x-error-ajax error_field="email" />
            </div>

            {{-- password --}}
            <div class="mt-2">
                <x-label for="password">Mật khẩu<span class="text-xs text-gray-500 inline-block">&nbsp;(Không bắt buộc)</span></x-label>
                <x-input type="password" name="password" id="password"/>
                <x-error-php error_field="password" />
                <x-error-ajax error_field="password" />
            </div>

            {{-- confirm password --}}
            <div class="mt-2">
                <x-label for="password_confirmation">Xác nhận mật khẩu <span class="text-xs text-gray-500 inline-block">&nbsp;(Không bắt buộc)</span>
                </x-label>
                <x-input type="password" name="password_confirmation" id="password_confirmation" value="" />
                <x-error-php error_field="password_confirmation" />
                <x-error-ajax error_field="password_confirmation" />
            </div>

            {{-- role --}}
            <div class="mt-2">
                <x-label for="roles">Nhóm quyền <span class="text-lg text-red-600">*</span></x-label><br>
                <x-select name="roles[]" id="roles" multiple>
                    @foreach ($roles as $role)
                        <option value="{{$role->id}}" class="mt-1 rounded-md py-1 px-3"{{ in_array($role->id,$user_role) ? 'selected' : '' }}>{{$role->name}}</option>
                    @endforeach
                </x-select>
            </div>

            {{-- status --}}
            <div class="mt-2">
                <x-label for="is_active">Trạng thái</x-label><br>
                <x-select name="is_active" id="is_active">
                    <option value="active" @if($user->is_active == 'active') selected @endif>Hoạt động</option>
                    <option value="subpended" @if($user->is_active == 'subpended') selected @endif>Đình chỉ</option>
                </x-select>
            </div>

            {{-- button --}}
            <div class="mt-4">
                <x-button-customize type="submit" class="w-full py-3">Cập nhật</x-button-customize>
            </div>

        </form>

        {{-- attention --}}
        <div class="md:flex-1 mt-2 md:mt-0 p-5 pb-6 bg-white rounded-lg shadow-md">
            <p class="text-lg font-semibold">Lưu ý khi cập nhật thông tin !</p>
            <hr class="my-2">
            <ul class="mt-3 text-sm">
                <li class="mt-2"><i class="fa-solid fa-circle-exclamation text-blue-500 mr-2"></i>Email là định danh duy nhất<span
                        class="font-semibold text-blue-500">    duy nhất</span></li>
                <li class="mt-2"><i class="fa-solid fa-circle-check text-green-600 mr-2"></i>
                    Mật khẩu chỉ cần nhập khi muốn đổi mật khẩu mới. Nếu để trống, hệ thống sẽ giữ nguyên mật khẩu cũ.
                </li>
                <li class="mt-2"><i class="fa-solid fa-circle-xmark text-red-700 mr-2"></i>Trạng thái <span
                        class="font-semibold">"Chưa kích hoạt"</span> → người dùng <span class="font-semibold">chưa thể
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
                <p class="text-md font-semibold text-gray-500">Sau khi cập nhật</p>
                <li class="mt-2"><span class="font-semibold">1.</span> Lưu thông tin thành viên</li>
                <li class="mt-2"><span class="font-semibold">2.</span> Áp dụng quyền & trạng thái mới ngay lập tức</li>
                <li class="mt-2"><span class="font-semibold">3.</span> Thành viên đăng nhập theo trạng thái hiện tại của tài khoản</li>
            </ul>
            <hr class="my-3">
            <ul class="mt-3 text-sm">
                <p class="text-md font-semibold text-gray-800"><i
                        class="fa-solid fa-shield-halved text-yellow-500 mr-1"></i> Bảo mật & khuyến nghị</p>
                <li class="mt-2">Không chia sẻ tài khoản cho nhiều người</li>
                <li class="mt-2">Nên đổi mật khẩu định kỳ để đảm bảo an toàn</li>
                <li class="mt-2">Chỉ cấp quyền <strong>Quản lý hệ thống</strong> khi thực sự cần thiết</li>
            </ul>

        </div>
    </div>
</x-app-layout>
