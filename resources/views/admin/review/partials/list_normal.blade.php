@if (count($reviews) > 0)
    {{-- Cập nhật tất cả --}}
    <form action="{{ route('admin.reviews.action') }}" method="POST" id="update_all"
        class="bg-white shadow-md p-4 rounded-md">
        @csrf
        <div class="md:flex gap-1 items-center">
            {{-- Hành động --}}
            <select name="action" id="action"
                class="w-full md:w-auto text-sm font-semibold rounded-md py-1 focus:border-green-500 focus:ring-1 focus:ring-green-500 border-gray-500/30 shadow-sm">
                <option value="">- Hành động hàng loạt -</option>
                <option value="forceDelete">Xóa vĩnh viễn</option>
                <option value="publish">Công khai</option>
                <option value="canceled">Vô hiệu hóa</option>
            </select>
            {{-- button --}}
            <x-button-customize type="submit" class="mt-1 md:mt-0 w-full md:w-auto">Áp dụng</x-button-customize>
            {{-- thông báo --}}
            <x-flash-session-normal key="status_failed" class="text-red-700 mt-2 md:mt-0">
                <i class="fa-solid fa-circle-exclamation"></i>
            </x-flash-session-normal>
        </div>
        {{-- Bảng review --}}
        <div class="overflow-x-auto mt-3">
            <table class="text-sm border-gray-300 min-w-[1200px] md:w-full">
                <thead>
                    <tr class="font-semibold">
                        <td class="px-1 py-2">
                            <input type="checkbox" name="check_all" class="check_all rounded-sm cursor-pointer">
                        </td>
                        <td class="py-2 px-2 select-none">#</td>
                        <td class="py-2 px-2 select-none">Sản phẩm</td>
                        <td class="py-2 px-2 select-none">Đánh giá</td>
                        <td class="py-2 px-2 select-none">Bình chọn</td>
                        <td class="py-2 px-2 select-none">Họ tên</td>
                        <td class="py-2 px-2 select-none text-center">Trạng thái</td>
                        <td class="py-2 px-2 select-none text-center">Cập nhật trạng thái</td>
                        <td class="py-2 px-2 select-none">Ngày</td>
                        <td class="py-2 text-center select-none w-[50px]">Xóa</td>
                    </tr>
                </thead>
                {{-- Dữ liệu review --}}
                <tbody>
                    @foreach ($reviews as $review)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="py-2 px-1">
                                <input type="checkbox" name="review_id[]" value="{{ $review->id }}"
                                    {{ is_array(old('review_id')) && in_array($review->id, old('review_id')) ? 'checked' : '' }}
                                    class="check_single rounded-sm cursor-pointer">
                            </td>
                            <td class="py-2 px-2 select-none">#</td>
                            <td class="py-2 px-2 select-none">
                                <div class="w-[120px] truncate">{{ $review->product->name }}</div>
                            </td>
                            <td class="py-2 px-2 select-none">
                                <div class="line-clamp-2 w-[250px]">{{ $review->review }}</div>
                            </td>
                            <td class="py-2 px-2 select-none"><i class="fa-solid fa-star text-amber-500"></i>
                                ({{ $review->vote_star }})</td>
                            <td class="py-2 px-2 select-none">{{ $review->name }}</td>
                            <td class="py-2 px-2 select-none review_status_{{ $review->id }}">
                                <div class="flex justify-center ">
                                    {!! set_status_review($review->status) !!}
                                </div>
                            </td>
                            <td class="">
                                <div class="flex justify-center">
                                    <select name="review_status" id="review_status" data-id = "{{ $review->id }}"
                                        class="review_status text-xs rounded-md py-1 focus:border-green-500 focus:ring-1 focus:ring-green-500  w-[120px] shadow-sm border-gray-500/30">
                                        <option value="pending" {{ $review->status == 'pending' ? 'selected' : '' }}>Chờ
                                            duyệt</option>
                                        <option value="publish" {{ $review->status == 'publish' ? 'selected' : '' }}>
                                            Công khai</option>
                                        <option value="canceled" {{ $review->status == 'canceled' ? 'selected' : '' }}>
                                            Vô hiệu hóa</option>
                                    </select>
                                </div>

                            </td>
                            <td class="py-2 px-2 select-none">{{ $review->created_at }}</td>
                            <td class="py-2 text-center select-none w-[50px]">
                                <a href="{{ route('admin.reviews.forceDelete',$review->id) }}"
                                    onclick="return confirm('Bạn có chắc muốn xóa bình luận này khỏi hệ thống ?')">
                                    <i
                                        class="fa-solid fa-circle-xmark text-lg text-red-500/70 cursor-pointer hover:text-red-600 transition-all duration-150"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        {{-- panigation --}}
        <div class="mt-4">
            {{ $reviews->links('pagination::tailwind', ['class' => 'review_pagination']) }}
        </div>

    </form>
@else
    <p class="text-gray-500 px-3 pt-0 rounded-lg"> Nội dung này chưa có bản ghi nào ! </p>
@endif
