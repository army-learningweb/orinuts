@if (count($posts) > 0)
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
                    <option value="trash" {{ old('post_action') == 'trash' ? 'selected' : '' }}>Bỏ vào thùng rác</option>
                    <option value="disable" {{ old('post_action') == 'disable' ? 'selected' : '' }}>Vô hiệu hóa</option>
                    <option value="publish" {{ old('post_action') == 'publish' ? 'selected' : '' }}>Công khai</option>
                    <option value="draft" {{ old('post_action') == 'draft' ? 'selected' : '' }}>Nháp</option>
                    <option value="pending" {{ old('post_action') == 'pending' ? 'selected' : '' }}>Chờ duyệt</option>
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
            <table class="text-sm border-gray-300 md:w-full min-w-[1200px]">
                <thead>
                    <tr class="font-semibold">
                        <td class="px-1 py-1">
                            <input type="checkbox" name="check_all" class="check_all rounded-sm cursor-pointer">
                        </td>
                        <td class="py-1 select-none">#</td>
                        <td class="py-1 select-none text-center">Ảnh bìa</td>
                        <td class="py-1 px-2 select-none">Tiêu đề</td>  
                        <td class="py-1 px-2 select-none text-center">Trạng thái</td>
                        <td class="py-1 px-2 select-none">Thay đổi trạng thái</td>
                        <td class="py-1 px-2 select-none">Ngày tạo</td>
                        <td class="py-1 px-2 select-none">Người tạo</td>
                        <td class="py-1 text-center select-none w-[50px]" colspan="2">Tùy chỉnh</td>
                    </tr>
                </thead>
                {{-- Dữ liệu --}}
                <tbody class="data-posts">
                    @foreach ($posts as $post)
                        <tr
                            class="border-gray-300 border-b border-gray-500/15 hover:bg-gray-300/20 transition-all duration-150">
                            <td class="px-1 py-1">
                                <input type="checkbox" name="post_id[]" value="{{ $post->id }}"
                                    class="check_single rounded-sm cursor-pointer"
                                    {{ old('post_id') && in_array($post->id, old('post_id')) ? 'checked' : '' }}>
                            </td>
                            <td class="py-1 select-none">{{ ($posts->currentPage() - 1) * $posts->perPage() + $loop->iteration }}</td>
                            <td class="py-1 select-none flex items-center justify-center">
                                <div class="w-[150px] h-[60px] flex justify-center items-center">
                                    <img src="{{ asset($post->media->url) }}" alt=""
                                        class="max-h-full rounded-md object-contain">
                                </div>
                            </td>
                            <td class="py-1 px-2 select-none">
                                <div class="w-[150px] truncate"><a href="{{ route('admin.post.edit',$post->id) }}" class="text-blue-600 hover:underline underline-offset-2">{{ $post->title }}</a></div>
                            </td>
                            <td class="py-1 px-2 select-none post_status_{{ $post->id }}">
                                <div class="mt-1 text-center flex justify-center">
                                    {!! set_status_post($post->status) !!}
                                </div>
                            </td>
                            <td class="py-1 px-2">
                                <select name="post_status" id="post_status" data-id = "{{ $post->id }}"
                                    class="post_status text-xs rounded-md py-1 focus:border-green-500 focus:ring-1 focus:ring-green-500  w-[120px] shadow-sm border-gray-500/30 mt-1">
                                    <option value="publish" {{ $post->status == 'publish' ? 'selected' : '' }}>Công khai</option>
                                    <option value="draft" {{ $post->status == 'draft' ? 'selected' : '' }}>Nháp</option>
                                    <option value="pending" {{ $post->status == 'pending' ? 'selected' : '' }}>Chờ duyệt</option>
                                    <option value="disable" {{ $post->status == 'disable' ? 'selected' : '' }}>Vô hiệu hóa</option>
                                </select>
                            </td>
                            <td class="py-1 px-2 select-none">{{ $post->created_at }}</td>
                            <td class="py-1 px-2 select-none">{{ $post->user->name }}</td>
                            <td class="py-3 text-center">
                                <a href="{{route('admin.post.edit',$post->id)}}">
                                    <i
                                        class="open-modal-update-user text-md fa-solid fa-pen text-gray-500/70 cursor-pointer hover:text-green-500 transtion-all duration-150">
                                    </i>
                                </a>
                            </td>
                            <td class="py-3 text-center">
                                <a href="{{ route('admin.post.destroy', $post->id) }}"
                                    onclick="return confirm('Bạn có chắc muốn xóa bài viết này ?')">
                                    <i
                                        class="fa-solid fa-trash text-lg text-red-500/70 cursor-pointer hover:text-red-600 transition-all duration-150"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{$posts->links('pagination::tailwind',['class' => 'post_pagination'])}}
        </div>
    </form>
@else
    <p class="text-gray-500 px-3 pt-0 rounded-lg"> Nội dung này chưa có bản ghi nào ! </p>
@endif
