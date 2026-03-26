@if (count($trashs) > 0)
    {{-- Cập nhật tất cả --}}
    <form action="{{route('admin.post.action')}}" method="POST" id="update_all"
        class="form bg-white shadow-md p-4 rounded-md">
        @csrf
        <div class="flex justify-between items-center">

            {{-- Hành động --}}
            <div class="md:flex gap-1 items-center w-full md:w-auto">
                <select name="post_action" id="action"
                    class="w-full md:w-auto text-sm font-semibold rounded-md py-1 focus:border-green-500 focus:ring-1 focus:ring-green-500 border-gray-500/30 shadow-sm">
                    <option value="">- Hành động hàng loạt -</option>
                    <option value="restore" {{ old('post_action') == 'restore' ? 'selected' : '' }}>Khôi phục</option>
                    <option value="forceDelete" {{ old('post_action') == 'forceDelete' ? 'selected' : '' }}>Xóa vĩnh viễn</option>
                </select>
                {{-- button --}}
                <x-button-customize type="submit" class="mt-2 md:mt-0 w-full md:w-auto">Áp dụng</x-button-customize>
                {{-- thông báo --}}
                <x-flash-session-normal key="status_failed" class="text-red-700 mt-2 md:mt-0">
                    <i class="fa-solid fa-circle-exclamation"></i>
                </x-flash-session-normal>
            </div>

        </div>
        <hr class="mt-4 mb-3">
        {{-- Bảng Categories --}}
        <div class="overflow-x-auto">
            <table class="text-sm border-gray-300 md:w-full min-w-[1000px]">
                <thead>
                    <tr class="font-semibold">
                        <td class="px-1 py-1">
                            <input type="checkbox" name="check_all" class="check_all rounded-sm cursor-pointer">
                        </td>
                        <td class="py-1 select-none">#</td>
                        <td class="py-1 px-2 select-none text-center">Ảnh bìa</td>
                        <td class="py-1 px-2 select-none">Tiêu đề</td>  
                        <td class="py-1 px-2 select-none">Ngày xóa</td>
                        <td class="py-1 px-2 select-none">Thời gian cụ thể</td>
                        <td class="py-1 px-2 select-none">Người tạo</td>
                        <td class="py-1 text-center select-none w-[50px]" colspan="2">Tùy chỉnh</td>
                    </tr>
                </thead>
                {{-- Dữ liệu --}}
                <tbody class="data-posts">
                    @foreach ($trashs as $trash)
                        <tr
                            class="border-gray-300 border-b border-gray-500/15 hover:bg-gray-300/20 transition-all duration-150">
                            <td class="px-1 py-1">
                                <input type="checkbox" name="post_id[]" value="{{ $trash->id }}"
                                    class="check_single rounded-sm cursor-pointer"
                                    {{ old('post_id') && in_array($trash->id, old('post_id')) ? 'checked' : '' }}>
                            </td>
                            <td class="py-1 select-none">{{ ($trashs->currentPage() - 1) * $trashs->perPage() + $loop->iteration }}</td>
                            <td class="py-1 px-2 select-none flex items-center justify-center">
                                <div class="w-[150px] h-[60px] flex justify-center items-center">
                                    <img src="{{ asset($trash->media->url) }}" alt=""
                                        class="max-h-full rounded-md object-contain">
                                </div>
                            </td>
                            <td class="py-1 px-2 select-none">
                                <div class="w-[150px] truncate">{{ $trash->title }}</div>
                            </td>
                            <td class="py-1 px-2 select-none">{{ $trash->deleted_at }}</td>
                             <td class="py-1 px-2 select-none text-gray-500">{{ $trash->deleted_at->diffForHumans() }}</td>
                            <td class="py-1 px-2 select-none">{{ $trash->user->name }}</td>
                            <td class="py-3 text-center">
                                <a href="{{route('admin.post.restore',$trash->id)}}">
                                    <i
                                        class="text-lg fa-solid fa-rotate-left text-green-500/70 cursor-pointer hover:text-green-600 transtion-all duration-150">
                                    </i>
                                </a>
                            </td>
                            <td class="py-3 text-center">
                                <a href="{{route('admin.post.forceDelete',$trash->id)}}"
                                    onclick="return confirm('Bạn có chắc muốn xóa sản bài viết này khỏi hệ thống ?')">
                                    <i
                                        class="fa-solid fa-circle-xmark text-lg text-red-500/70 cursor-pointer hover:text-red-600 transition-all duration-150"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{$trashs->links('pagination::tailwind',['class' => 'post_pagination'])}}
        </div>
    </form>
@else
    <p class="text-gray-500 px-3 pt-0 rounded-lg"> Nội dung này chưa có bản ghi nào ! </p>
@endif
