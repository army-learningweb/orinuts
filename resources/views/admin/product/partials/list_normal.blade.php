@if (count($products) > 0)
    {{-- Cập nhật tất cả --}}
    <form action="{{ route('admin.product.action') }}" method="POST" id="update_all"
        class="form bg-white shadow-md p-4 rounded-md box-border">
        @csrf
        <div class="flex justify-between items-center">
            {{-- Hành động --}}
            <div class="md:flex gap-1 items-center w-full md:w-auto">
                <select name="product_action" id="action"
                    class="w-full md:w-auto text-sm font-semibold rounded-md py-1 focus:border-green-500 focus:ring-1 focus:ring-green-500 border-gray-500/30 shadow-sm">
                    <option value="">- Hành động hàng loạt -</option>
                    <option value="trash" {{ old('product_action') == 'trash' ? 'selected' : '' }}>Bỏ vào thùng rác
                    </option>
                    <option value="unactive" {{ old('product_action') == 'unactive' ? 'selected' : '' }}>Vô hiệu hóa
                    </option>
                    <option value="active" {{ old('product_action') == 'active' ? 'selected' : '' }}>Hoạt động</option>
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
            <table class="text-sm border-gray-300min-w-[1250px] md:w-full ">
                <thead>
                    <tr class="font-semibold">
                        <td class="px-1 py-1">
                            <input type="checkbox" name="check_all" class="check_all rounded-sm cursor-pointer">
                        </td>
                        <td class="py-1 select-none">#</td>
                        <td class="py-1 px-2 select-none text-center">Ảnh</td>
                        <td class="py-1 px-2 select-none">Tên</td>
                        <td class="py-1 px-2 select-none">Giá</td>
                        <td class="py-1 px-2 select-none text-center">Số lượng</td>
                        <td class="py-1 px-2 select-none text-center">Trạng thái</td>
                        <td class="py-1 px-2 select-none">Thay đổi trạng thái</td>
                        <td class="py-1 px-2 select-none">Ngày tạo</td>
                        <td class="py-1 px-2 select-none">Người tạo</td>
                        <td class="py-1 text-center select-none w-[50px]" colspan="2">Tùy chỉnh</td>
                    </tr>
                </thead>
                {{-- Dữ liệu --}}
                <tbody class="data-products">
                    @foreach ($products as $product)
                        <tr
                            class="border-gray-300 border-b border-gray-500/15 hover:bg-gray-300/20 transition-all duration-150">
                            <td class="px-1 py-2">
                                <input type="checkbox" name="product_id[]" value="{{ $product->id }}"
                                    class="check_single rounded-sm cursor-pointer"
                                    {{ old('product_id') && in_array($product->id, old('product_id')) ? 'checked' : '' }}>
                            </td>
                            <td class="py-2 select-none">
                                {{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}</td>
                            <td class="py-2 px-2 select-none">
                                <img src="{{ asset($product->media->url) }}" alt="" class="w-full h-[60px] rounded-md object-contain">
                            </td>
                            <td class="py-2 px-2 select-none"><a href="{{ route('admin.product.edit',$product->id) }}" class="text-blue-600 hover:underline underline-offset-2">{{ $product->name }}</a></td>
                            <td class="py-2 px-2 select-none">{{ number_format($product->price, 0, '', '.') . 'đ' }}</td>
                            <td class="py-2 px-2 select-none text-center">{{ $product->quantity }}</td>
                            <td class="select-none text-center">
                                <div class="inline-block product_status_{{$product->id}} box-border">{!! set_status_product($product->status) !!}</div>
                            </td>
                            <td class="py-2 px-2">
                                <select name="product_status" id="product_status" data-id = "{{ $product->id }}"
                                    class="product_status text-xs rounded-md py-1 focus:border-green-500 focus:ring-1 focus:ring-green-500  w-[120px] shadow-sm border-gray-500/30">
                                    <option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>Hoạt
                                        động
                                    </option>
                                    <option value="unactive" {{ $product->status == 'unactive' ? 'selected' : '' }}>Vô
                                        hiệu hóa
                                    </option>
                                </select>
                            </td>
                            <td class="py-2 px-2 select-none">{{ $product->created_at }}</td>
                            <td class="py-2 px-2 select-none">{{ $product->user->name }}</td>
                            <td class="py-2 text-center">
                                <a href="{{ route('admin.product.edit', $product->id) }}">
                                    <i
                                        class="open-modal-update-user text-md fa-solid fa-pen text-gray-500/70 cursor-pointer hover:text-green-500 transtion-all duration-150">
                                    </i>
                                </a>
                            </td>
                            <td class="py-2 text-center">
                                <a href="{{ route('admin.product.destroy', $product->id) }}"
                                    onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này ?')">
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
            {{ $products->links('pagination::tailwind', ['class' => 'product_pagination']) }}
        </div>
    </form>
@else
    <p class="text-gray-500 px-3 pt-0 rounded-lg"> Nội dung này chưa có bản ghi nào ! </p>
@endif
