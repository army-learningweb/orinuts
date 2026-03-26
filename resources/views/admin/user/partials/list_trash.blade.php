@if (count($users) > 0)
    {{-- Cập nhật tất cả --}}
    <form action="{{ route('admin.users.action') }}" method="POST" id="update_all"
        class="bg-white shadow-md p-4 rounded-lg">
        @csrf
         <div class="md:flex gap-1 items-center">
            {{-- Hành động --}}
            <select name="action" id="action"
                class="w-full md:w-auto text-sm font-semibold rounded-md py-1 focus:border-green-500 focus:ring-1 focus:ring-green-500 border-gray-500/30 shadow-sm">
                <option value="">- Hành động hàng loạt -</option>
                <option value="restore" @if (old('action') == 'restore') selected @endif>Khôi phục</option>
                <option value="forceDelete" @if (old('action') == 'forceDelete') selected @endif>Xóa vĩnh viễn</option>
            </select>
            {{-- button --}}
            <x-button-customize type="submit" class="mt-2 md:mt-0 w-full md:w-auto">Áp dụng</x-button-customize>
            {{-- thông báo --}}
            <x-flash-session-normal key="status_failed" class="text-red-700 mt-2 md:mt-0">
                <i class="fa-solid fa-circle-exclamation"></i>
            </x-flash-session-normal>
        </div>

        {{-- Bảng Users --}}
        <div class="overflow-x-auto">
            <table class="text-sm border-b border-gray-300 mt-1 min-w-[900px] md:w-full">
            <thead>
                <tr class="font-semibold">
                    <td class="px-1 py-3">
                        <input type="checkbox" name="check_all" class="check_all rounded-sm cursor-pointer">
                    </td>
                    <td class="py-3 px-2 select-none">#</td>
                    <td class="py-3 px-2 select-none">Họ tên</td>
                    <td class="py-3 px-2 select-none">Email</td>
                    <td class="py-3 px-2 select-none">Trạng thái</td>
                    <td class="py-3 px-2 select-none">Ngày xóa</td>
                    <td class="py-3 px-2 select-none">Thời gian cụ thể</td>
                    <td class="py-3 text-center select-none w-[50px]" colspan="2">Tùy chỉnh</td>
                </tr>
            </thead>
            {{-- Dữ liệu Users --}}
            <tbody class="data-users">
                @foreach ($users as $user)
                    <tr class="border-gray-300 border-b border-gray-500/15 hover:bg-gray-300/20 transition-all duration-150">
                        <td class="px-1 py-3">
                            <input type="checkbox" name="user_id[]" 
                            value="{{ $user->id }}" @if (old('user_id') && in_array($user->id, old('user_id'))) checked @endif
                            class="check_single rounded-sm cursor-pointer">
                        </td>
                        <td class="py-3 px-2 select-none">{{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}</td>
                        <td class="py-3 px-2 select-none">{{ $user->name }}</td>
                        <td class="py-3 px-2 select-none"><div class="w-[150px] truncate"> {{ $user->email }}</div></td>
                        <td class="py-3 px-2 select-none">-----------</td>
                        <td class="py-3 select-none">{{ $user->deleted_at }}</td>
                        <td class="py-3 px-2 select-none text-gray-500">{{ $user->deleted_at->diffForHumans() }}</td>
                        <td class="py-3 text-center">
                            <a href="{{ route('admin.users.restore', $user->id) }}">
                                <i
                                    class="text-lg fa-solid fa-rotate-left text-green-500/70 cursor-pointer hover:text-green-600 transtion-all duration-150">
                                </i>
                            </a>
                        </td>
                        <td class="py-3 text-center">
                            <a href="{{ route('admin.users.forceDelete', $user->id) }}" onclick="return confirm('Bạn có chắc muốn xóa thành viên này khỏi hệ thống ?')">
                                <i
                                    class="fa-solid fa-circle-xmark text-lg text-red-500/70 cursor-pointer hover:text-red-600 transition-all duration-150"></i>
                            </a>
                        </td>
                    </tr>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
        

        {{-- panigation --}}
        <div class="mt-4">
            {{$users->links('pagination::tailwind',['class' => 'user_pagination'])}}
        </div>

    </form>
@else
    <p class="text-gray-500 px-3 pt-0 rounded-lg"> Nội dung này chưa có bản ghi nào ! </p>
@endif
