@if (count($orders) > 0)
    {{-- Cập nhật tất cả --}}
    <form action="{{ route('admin.orders.action') }}" method="POST" id="update_all"
        class="form bg-white shadow-md p-4 rounded-md">
        @csrf
        <div class="flex flex-col md:flex-row justify-between items-center">

            {{-- Hành động --}}
            <div class="md:flex gap-1 items-center w-full md:w-auto">
                <select name="order_action" id="action"
                    class="w-full md:w-auto text-sm font-semibold rounded-md py-1 focus:border-green-500 focus:ring-1 focus:ring-green-500 border-gray-500/30 shadow-sm">
                    <option value="">- Hành động hàng loạt -</option>
                    <option value="pending" {{ old('order_action') == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                    <option value="processing" {{ old('order_action') == 'processing' ? 'selected' : '' }}>Đang xử lý
                    </option>
                    <option value="shipped" {{ old('order_action') == 'shipped' ? 'selected' : '' }}>Đang giao</option>
                    <option value="delivered" {{ old('order_action') == 'delivered' ? 'selected' : '' }}>Đã nhận
                    </option>
                    <option value="canceled" {{ old('order_action') == 'canceled' ? 'selected' : '' }}>Đã hủy</option>
                </select>
                {{-- button --}}
                <x-button-customize type="submit" class="mt-1 md:mt-0 w-full md:w-auto">Áp dụng</x-button-customize>
                {{-- thông báo --}}
                <x-flash-session-normal key="status_failed" class="text-red-700 mt-2 md:mt-0">
                    <i class="fa-solid fa-circle-exclamation"></i>
                </x-flash-session-normal>
            </div>

            <div class="font-semibold text-lg mt-3 md:mt-0">
                <span><i class="fa-solid fa-sack-dollar text-green-600"></i></span>
                <span class="revenue">{{ number_format($revenue, 0, ',', '.') . 'đ' }}</span>
            </div>
        </div>
        <hr class="mt-4 mb-3">
        {{-- Bảng Categories --}}
        <div class="overflow-x-auto">
            <table class="text-sm border-gray-300 md:w-full min-w-[1200px]">
                <thead>
                    <tr class="font-semibold">
                        <td class="px-1 py-2">
                            <input type="checkbox" name="check_all" class="check_all rounded-sm cursor-pointer">
                        </td>
                        <td class="py-2 select-none">Mã đơn</td>
                        <td class="py-2 px-2 select-none">Tổng</td>
                        <td class="py-2 select-none text-center">Số điện thoại</td>
                        <td class="py-2 px-2 select-none">Địa chỉ giao hàng</td>
                        <td class="py-2 select-none">Người mua</td>
                        <td class="py-2 select-none">Thời gian</td>
                        <td class="py-2 select-none text-center">Trạng thái</td>
                        <td class="py-2 select-none text-center">Cập nhật trạng thái</td>
                        <td class="py-2 select-none w-[50px]">Chi tiết</td>
                    </tr>
                </thead>
                {{-- Dữ liệu --}}
                <tbody class="data-pages">
                    @foreach ($orders as $order)
                        <tr
                            class="border-gray-300 border-b border-gray-500/15 hover:bg-gray-300/20 transition-all duration-150">
                            <td class="px-1 py-4">
                                <input type="checkbox" name="order_id[]" value="{{ $order->id }}"
                                    class="check_single rounded-sm cursor-pointer"
                                    {{ old('order_id') && in_array($order->id, old('order_id')) ? 'checked' : '' }}>
                            </td>
                            <td class="py-4 select-none">{{ $order->code }}</td>
                            <td class="py-4 px-2 select-none font-semibold">
                                {{ number_format($order->total_price, 0, ',', '.') . 'đ' }}
                            </td>
                            <td class="py-4 select-none text-center">
                                {{ $order->tel }}
                            </td>
                            <td class="py-4 px-2 select-none">
                                <div class="w-[100px] line-clamp-1">
                                    {{ $order->shipping_address }}
                                </div>

                            </td>
                            <td class="py-4 select-none">
                                {{ $order->customer ? $order->customer->name : '(Không xác định)' }}</td>
                            <td class="py-4 select-none">
                                <span class="font-semibold">{{ $order->created_at->diffForHumans() }}</span>
                            </td>
                            <td class="py-4 select-none flex justify-center">
                                <div class="w-auto order_status_{{ $order->id }}">{!! set_status_order($order->status) !!}</div>
                            </td>
                            <td class="">
                                <div class="flex justify-center">

                                    <select name="order_status" data-id = "{{ $order->id }}"
                                        {{ $order->status == 'canceled' ? 'disabled' : '' }}
                                        class="order_status is_delivered_{{ $order->id }} text-xs rounded-md py-1 focus:border-green-500 focus:ring-1 focus:ring-green-500  w-[120px] shadow-sm border-gray-500/30">

                                       
                                            <option value="pending"
                                                {{ $order->status == 'pending' ? 'selected' : '' }}>Chờ
                                                xử lý</option>
                                            <option value="processing"
                                                {{ $order->status == 'processing' ? 'selected' : '' }}>Đang xử lý
                                            </option>
                                            <option value="shipped"
                                                {{ $order->status == 'shipped' ? 'selected' : '' }}>Đã
                                                giao</option>
                                       

                                       
                                            <option value="refund" {{ $order->status == 'refund' ? 'selected' : '' }}>
                                                Hoàn trả</option>
                                       
                                        <option value="delivered"
                                            {{ $order->status == 'delivered' ? 'selected' : '' }}>Đã nhận</option>
                                        <option value="canceled" {{ $order->status == 'canceled' ? 'selected' : '' }}>
                                            Đã hủy</option>

                                    </select>
                                </div>

                            </td>
                            <td class="py-4 text-center view_details_{{ $order->id }} select-none">
                                @if ($order->status == 'canceled')
                                    ...
                                @else
                                    <a href="{{ route('admin.orders.edit', $order->id) }}"
                                        class="text-blue-600 hover:underline underline-offset-2">Chi tiết</a>
                                @endif

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $orders->links('pagination::tailwind', ['class' => 'order_pagination']) }}
        </div>
    </form>
@else
    <p class="text-gray-500 px-3 pt-0 rounded-lg"> Nội dung này chưa có bản ghi nào ! </p>
@endif
