@if (count($users) > 0)
    {{-- Cập nhật tất cả --}}
    <form action="{{ route('admin.users.action') }}" method="POST" id="update_all"
        class="bg-white shadow-md p-4 rounded-md">
        @csrf
        <div class="md:flex gap-1 items-center">
            {{-- Hành động --}}
            <select name="action" id="action"
                class="w-full md:w-auto text-sm font-semibold rounded-md py-1 focus:border-green-500 focus:ring-1 focus:ring-green-500 border-gray-500/30 shadow-sm">
                <option value="">- Hành động hàng loạt -</option>
                <option value="delete" @if (old('action') == 'delete') selected @endif>Bỏ vào thùng rác</option>
                <option value="subpended" @if (old('action') == 'subpended') selected @endif>Đình chỉ</option>
                <option value="active" @if (old('action') == 'active') selected @endif>Hoạt động</option>
            </select>
            {{-- button --}}
            <x-button-customize type="submit" class="mt-1 md:mt-0 w-full md:w-auto">Áp dụng</x-button-customize>
            {{-- thông báo --}}
            <x-flash-session-normal key="status_failed" class="text-red-700 mt-2 md:mt-0">
                <i class="fa-solid fa-circle-exclamation"></i>
            </x-flash-session-normal>
        </div>

        {{-- Bảng Users --}}
        <div class="overflow-x-auto">
            <table class="text-sm border-gray-300 min-w-[1200px] md:w-full mt-3">
                <thead>
                    <tr class="font-semibold">
                        <td class="px-1 py-1">
                            <input type="checkbox" name="check_all" class="check_all rounded-sm cursor-pointer">
                        </td>
                        <td class="py-1 px-2 select-none">#</td>
                        <td class="py-1 px-2 select-none">Họ tên</td>
                        <td class="py-1 px-2 select-none">Email</td>
                        <td class="py-1 px-2 select-none">Quyền</td>
                        <td class="py-1 px-2 text-center  select-none">Trạng thái</td>
                        <td class="py-1 px-2 select-none">Thay đổi trạng thái</td>
                        <td class="py-1 px-2 select-none">Ngày khởi tạo</td>
                        <td class="py-1 text-center select-none w-[50px]" colspan="2">Tùy chỉnh</td>
                    </tr>
                </thead>
                {{-- Dữ liệu Users --}}
                <tbody class="data-users">
                    @foreach ($users as $user)
                        <tr
                            class="border-gray-300 border-b border-gray-500/15 hover:bg-gray-300/20 transition-all duration-150">
                            @if ($user->id != $admin_id)
                                <td class="px-1 py-3">
                                    <input type="checkbox" name="user_id[]" value="{{ $user->id }}"
                                        {{ is_array(old('user_id')) && in_array($user->id, old('user_id')) ? 'checked' : '' }}
                                        class="check_single rounded-sm cursor-pointer">
                                </td>
                            @else
                                <td class="px-1 py-3">
                                    <i class="fa-solid fa-crown text-amber-500"></i>
                                </td>
                            @endif
                            <td class="py-3 px-2 select-none">
                                {{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}</td>
                            <td class="py-3 px-2 select-none">
                                @if ($user->id == Auth::user()->id)
                                    {{ $user->name }}
                                @else
                                    <a href="{{ route('admin.users.edit', $user->id) }}"
                                        class="hover:underline underline-offset-2 text-blue-600">{{ $user->name }}</a>
                                @endif
                            </td>
                            <td class="py-3 px-2 select-none">
                                <div class="w-[150px] truncate">
                                    {{ $user->email }}
                                </div>
                            </td>
                            <td class="py-3 px-2 select-none">
                                @forelse ($user->roles as $role)
                                    <div class="bg-amber-400/20 text-amber-600 py-1 px-2 rounded-md inline">
                                        {{ $role->name }}</div>
                                @empty
                                    <span class="text-xs text-gray-500">Chưa được phân quyền !</span>
                                @endforelse
                            </td>
                            <td class="user_id_{{ $user->id }} status py-3 px-2 flex justify-center items-center">
                                <div class="text-center mt-1  select-none">
                                    {!! set_status_user($user->is_active) !!}
                                </div>
                            </td>
                            <td class="py-3 px-2">
                                <select name="user_status" id="user_status" data-id = "{{ $user->id }}"
                                    @if ($user->id == $admin_id) disabled @endif
                                    class="user_status text-xs rounded-md py-1 focus:border-green-500 focus:ring-1 focus:ring-green-500  w-[120px] shadow-sm border-gray-500/30 mt-1">

                                    <option value="active" @if ($user->is_active == 'active') selected @endif>Hoạt động
                                    </option>
                                    <option value="subpended" @if ($user->is_active == 'subpended') selected @endif>Đình chỉ
                                    </option>
                                    @if ($user->is_active == 'active' or $user->is_active == 'subpended')
                                    @else
                                        <option value="unactive" @if ($user->is_active == 'unactive') selected @endif>Chưa
                                            kích
                                            hoạt</option>
                                    @endif
                                </select>
                            </td>
                            <td class="created_at py-3 select-none">{{ $user->created_at }}</td>
                            @if ($user->id != $admin_id)
                                <td class="py-3 text-center">
                                    <a href="{{ route('admin.users.edit', $user->id) }}">
                                        <i
                                            class="open-modal-update-user text-md fa-solid fa-pen text-gray-500/70 cursor-pointer hover:text-green-700 transtion-all duration-150">
                                        </i>
                                    </a>
                                </td>
                                <td class="py-3 text-center">
                                    <a href="{{ route('admin.users.destroy', $user->id) }}"
                                        onclick="return confirm('Bạn có chắc muốn xóa thành viên này ?')">
                                        <i
                                            class="fa-solid fa-trash text-lg text-red-500/70 cursor-pointer hover:text-red-600 transition-all duration-150"></i>
                                    </a>
                                </td>
                            @else
                                <td class="py-3 text-center">
                                    ----
                                </td>
                                <td class="py-3 text-center">
                                    ----
                                </td>
                            @endif
                        </tr>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        {{-- panigation --}}
        <div class="mt-4">
            {{ $users->links('pagination::tailwind', ['class' => 'user_pagination']) }}
        </div>

    </form>
@else
    <p class="text-gray-500 px-3 pt-0 rounded-lg"> Nội dung này chưa có bản ghi nào ! </p>
@endif
