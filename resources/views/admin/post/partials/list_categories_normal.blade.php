@if (count($categories) > 0)
    {{-- Cập nhật tất cả --}}
    <form action="{{ route('admin.post.categories.action') }}" method="POST" id="update_all"
        class="bg-white shadow-md p-4 rounded-md {{ session('status_failed') || session('status_complete') ? '' : 'animation_content_slide_up' }}">
        @csrf
        <div class="flex justify-between items-center">

            {{-- Hành động --}}
            <div class="md:flex gap-1 items-center w-full md:w-auto">
                <select name="category_action" id="action"
                    class="w-full md:w-auto text-sm font-semibold rounded-md py-1 focus:border-green-500 focus:ring-1 focus:ring-green-500 border-gray-500/30 shadow-sm">
                    <option value="">- Hành động hàng loạt -</option>
                    <option value="trash" @if (old('category_action') == 'trash') selected @endif>Bỏ vào thùng rác</option>
                    <option value="unactive" @if (old('category_action') == 'unactive') selected @endif>Vô hiệu hóa</option>
                    <option value="active" @if (old('category_action') == 'active') selected @endif>Hoạt động</option>
                </select>
                {{-- button --}}
                <x-button-customize type="submit" class="mt-2 md:mt-0 w-full md:w-auto">Áp dụng</x-button-customize>
                {{-- thông báo --}}
                <x-flash-session-normal key="status_failed" class="text-red-700 mt-2 md:mt-0">
                    <i class="fa-solid fa-circle-exclamation"></i>
                </x-flash-session-normal>
            </div>

            <div class="annotation text-sm gap-5 hidden md:block">
                <p class="inline md:mr-2">
                    <span> <i class="fa-solid fa-folder text-amber-400 mr-1"></i></span>
                    <span>Danh mục cha</span>
                </p>
                <p class="inline md:mr-2">
                    <span> └─ </i> &nbsp;</span>
                    <span>Danh mục con</span>
                </p>
                <p class="inline">
                    <span> <i class="fa-solid fa-link-slash text-gray-400 mr-1"></i> </span>
                    <span>Danh mục chưa có liên kết</span>
                </p>
            </div>

        </div>
        <hr class="mt-4 mb-3">
        {{-- Bảng Categories --}}
        <div class="overflow-x-auto">
            <table class="text-sm border-gray-300 md:w-full min-w-[800px]">
                <thead>
                    <tr class="font-semibold">
                        <td class="px-1 py-1">
                            <input type="checkbox" name="check_all" class="check_all rounded-sm cursor-pointer">
                        </td>
                        <td class="py-1 px-2 select-none">Tên danh mục</td>
                        <td class="py-1 px-2 select-none">Slug</td>
                        <td class="py-1 px-2 select-none text-center">Trạng thái</td>
                        <td class="py-1 px-2 select-none">Thay đổi trạng thái</td>
                        <td class="py-1 px-2 select-none hidden md:table-cell">Ngày khởi tạo</td>
                        <td class="py-1 px-2 select-none hidden md:table-cell">Người tạo</td>
                        <td class="py-1 text-center select-none w-[50px]" colspan="2">Tùy chỉnh</td>
                    </tr>
                </thead>
                {{-- Dữ liệu --}}
                <tbody class="data-users">
                    {{-- CHA --}}
                    @foreach ($categories as $cat)
                        <tr class="border-gray-300 border-b border-gray-500/15 hover:bg-gray-300/20 transition-all duration-150
                        @if ($cat->parent_id > 0) hidden child_cat @else stop_open @endif">
                            <td class="px-1 py-3">
                                @if ($cat->parent_id === 0 || $cat->parent_id === null)
                                    <input type="checkbox" name="cat_id[]" value="{{ $cat->id }}" @if (old('cat_id') && in_array($cat->id, old('cat_id'))) checked @endif class="check_single rounded-sm cursor-pointer mb-[2px]">
                                @endif
                            </td>
                            <td class="py-3 px-2 cursor-pointer">
                                <div class="w-[180px] truncate @if ($cat->parent_id === 0) parent_cat @endif">
                                    @if ($cat->parent_id > 0)
                                        └─ &nbsp; {{ $cat->name }}
                                    @elseif ($cat->parent_id === null)
                                        <i class="fa-solid fa-link-slash text-gray-400"></i> &nbsp; {{ $cat->name }}
                                    @else
                                        <i class="fa-solid fa-folder text-amber-400"></i> &nbsp; {{ $cat->name }}
                                    @endif
                                </div>
                            </td>
                            <td class="py-3 px-2 select-none">
                                <div class="w-[100px] md:w-[150px] truncate"> {{ $cat->slug }} </div>
                            </td>
                            <td class="post_category_{{ $cat->id }} py-3 px-2 flex justify-center items-center">
                                <div class="text-center mt-1 select-none"> {!! set_status_category($cat->status) !!} </div>
                            </td>
                            <td class="py-3 px-2">
                                <select name="post_category_status" id="post_category_status"
                                    data-id = "{{ $cat->id }}"
                                    class="post_category_status text-xs rounded-md py-1 focus:border-green-500 focus:ring-1 focus:ring-green-500  w-[120px] shadow-sm border-gray-500/30 mt-1">
                                    <option value="active" @if ($cat->status == 'active') selected @endif>Hoạt động
                                    </option>
                                    <option value="unactive" @if ($cat->status == 'unactive') selected @endif>Vô hiệu
                                        hóa
                                    </option>
                                </select>
                            </td>
                            <td class="py-3 px-2 select-none hidden md:table-cell">{{ $cat->created_at }}</td>
                            <td class="py-3 px-2 select-none hidden md:table-cell">{{ $cat->user->name }}</td>
                            <td class="py-3 text-center">
                                <a href="{{route('admin.post.categories.edit',$cat->id)}}">
                                    <i
                                        class="open-modal-update-user text-md fa-solid fa-pen text-gray-500/70 cursor-pointer hover:text-green-500 transtion-all duration-150">
                                    </i>
                                </a>
                            </td>
                            <td class="py-3 text-center">
                                <a href="{{ route('admin.post.categories.destroy', $cat->id) }}"
                                    @if ($cat->parent_id === 0) onclick="return confirm('Bạn có chắc muốn xóa danh mục này, xóa danh mục Cha sẽ xóa tất cả danh mục Con ?')"
                                @else
                                    onclick="return confirm('Bạn có chắc muốn xóa danh mục này ?')" @endif>
                                    <i
                                        class="fa-solid fa-trash text-lg text-red-500/70 cursor-pointer hover:text-red-600 transition-all duration-150"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </form>
@else
    <p class="text-gray-500 px-3 pt-0 rounded-lg"> Nội dung này chưa có bản ghi nào ! </p>
@endif
