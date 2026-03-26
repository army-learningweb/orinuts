<x-app-layout>
    {{-- Thông báo thành công --}}
    <x-flash-session key="status_complete">&nbsp;<i class="fa-solid fa-circle-check"></i></x-flash-session>

    {{-- topbar --}}
    <x-topbar-content>
        <x-breadcrum page_name="Chi tiết đơn hàng ({{ $order_info->code }})" href="{{ route('admin.orders') }}" />
    </x-topbar-content>

    {{-- Bảng --}}
    <div
        class="mt-3 p-3 pt-0 {{ session('status_failed') || session('status_complete') ? '' : 'animation_content_slide_up' }} ">
        <div class="md:flex items-start gap-2">
            <form action="{{ route('admin.orders.update',$order_info->id) }}" method="POST" class="md:w-[40%] text-sm bg-white rounded-lg shadow-md pt-1 pb-3 px-5">
                @csrf

                <input type="hidden" name="customer_id" value="{{ $order_info->customer_id }}">
                {{-- code --}}
                <div class="mt-2">
                    <x-label for="code">Mã đơn hàng</x-label>
                    <x-input type="text" name="code" id="code" value="{{ $order_info->code }}" readonly
                        style="background: rgb(254, 233, 233)" />
                    <x-error-php error_field="code" />
                    <x-error-ajax error_field="code" />
                </div>

                {{-- total_amount --}}
                <div class="mt-2">
                    <x-label for="total_amount">Tổng số sản phẩm trong đơn</x-label>
                    <x-input type="text" name="total_amount" id="total_amount"
                        value="{{ $order_info->total_amount }}" readonly style="background: rgb(254, 233, 233)" />
                    <x-error-php error_field="total_amount" />
                    <x-error-ajax error_field="total_amount" />
                </div>

                {{-- address --}}
                <div class="mt-2">
                    <x-label for="payment_method">Phương thức thanh toán</span></x-label>
                    <x-input type="text" name="payment_method" id="payment_method" value="{{ $order_info->payment_method }}"
                        readonly style="background: rgb(254, 233, 233)" />
                    <x-error-php error_field="payment_method" />
                    <x-error-ajax error_field="payment_method" />
                </div>

                {{-- name --}}
                <div class="mt-1">
                    <x-label for="name">Tên người nhận <span class="text-lg text-red-600">*</span></x-label>
                    <x-input type="text" name="name" id="name" value="{{ $order_info->customer->name }}" />
                    <x-error-php error_field="name" />
                    <x-error-ajax error_field="name" />
                </div>

                {{-- tel --}}
                <div class="mt-1">
                    <x-label for="tel">Số điện thoại <span class="text-lg text-red-600">*</span></x-label>
                    <x-input type="text" name="tel" id="tel" value="{{ $order_info->customer->tel }}" />
                    <x-error-php error_field="tel" />
                    <x-error-ajax error_field="tel" />
                </div>

                {{-- status --}}
                <div class="mt-2">
                    <x-label for="status">Trạng thái</x-label>
                    <x-select name="status" id="status" class="mt-2">
                        <option value="pending" {{ $order_info->status == 'pending' ? 'selected' : '' }}>Chờ xử lý
                        </option>
                        <option value="processing" {{ $order_info->status == 'processing' ? 'selected' : '' }}>Đang xử
                            lý</option>
                        <option value="shipped" {{ $order_info->status == 'shipped' ? 'selected' : '' }}>Đang giao
                        </option>
                        <option value="refund" {{ $order_info->status == 'refund' ? 'selected' : '' }}>Hoàn trả
                        </option>
                        <option value="delivered" {{ $order_info->status == 'delivered' ? 'selected' : '' }}>Đã nhận
                        </option>
                        <option value="canceled" {{ $order_info->status == 'canceled' ? 'selected' : '' }}>Đã hủy
                        </option>
                    </x-select>
                    <x-error-php error_field="status" />
                </div>

                {{-- address --}}
                <div class="mt-2">
                    <x-label for="address">Địa chỉ giao hàng <span class="text-lg text-red-600">*</span></x-label> <br>
                    <textarea name="address" class="w-full border-gray-300 shadow-sm rounded-md mt-1 focus:border-green-500 focus:ring-green-500">{{ $order_info->shipping_address }}</textarea>
                    <x-error-php error_field="address" />
                    <x-error-ajax error_field="address" />
                </div>

                {{-- button --}}
                <div class="mt-2">
                    <x-button-customize type="submit" class="w-full py-3">Cập nhật thông tin đơn
                        hàng</x-button-customize>
                </div>
            </form>

            <div class="bg-white p-3 shadow-sm rounded-md flex-1 mt-3 md:mt-0">
                <p class="font-semibold">Sản phẩm chọn mua</p>
                <hr class="my-3">
                <div class="overflow-x-auto">
                    <table class="md:w-full min-w-[500px]">
                        <tr class="font-semibold">
                            <td class="px-2 py-1">#</td>
                            <td class="px-2 py-1 text-center">Ảnh</td>
                            <td class="px-2 py-1">Tên</td>
                            <td class="px-2 py-1">Đơn giá</td>
                            <td class="px-2 py-1 text-center">Số lượng</td>
                        </tr>
                        @php
                            $num = 1;
                        @endphp
                        @foreach ($order_details as $item)
                            <tr class="">
                                <td class="px-2 py-1">{{ $num++ }}</td>
                                <td class="px-2 py-1"><img src="{{ asset($item->product->media->url) }}"
                                        alt="" class="w-full h-[60px] object-contain"></td>
                                <td class="px-2 py-1"> {{ $item->product->name }}</td>
                                <td class="px-2 py-1">
                                    @if ($item->product->disscount > 0)
                                        {{ number_format($item->product->price - $item->product->price * ($item->product->disscount / 100), 0, ',', '.') . 'đ' }}
                                    @else
                                        {{ number_format($item->product->price, 0, ',', '.') . 'đ' }}
                                    @endif
                                </td>
                                <td class="px-2 py-1 text-center"> {{ $item->quantity }} </td>
                            </tr>
                        @endforeach
                    </table>
                </div>

                <hr class="my-3">
                <div class="">
                    <span>Tổng hóa đơn (Đã bao gồm phí):</span>
                    <span class="font-semibold text-lg">{{ number_format($order_info->total_price, 0, ',', '.') . 'đ' }}</span>
                </div>

                @if ($order_info->note != null)
                    <div class="mt-2">
                        <span>Ghi chú của khách hàng: {{ $order_info->note }}</span> 
                    </div>
                @endif
                
            </div>
        </div>
    </div>

</x-app-layout>
