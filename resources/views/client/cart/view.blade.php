<x-client-app-layout>

    {{-- Thông báo thành công --}}
    <x-flash-session key="status_complete"><i class="fa-solid fa-circle-check"></i></x-flash-session>

    <div class="{{ session('status_complete') ? '' : 'animation_content_slide_up' }}">
        <div class="flex flex-col md:flex-row items-start gap-2 mt-2">
            <div class="w-full md:flex-1">
                <div class="bg-white shadow-sm rounded-md p-5">
                    <div class="flex justify-between">
                        <span class="text-lg font-semibold select-none">Giỏ hàng</span>
                        @if ($cart_count > 0)
                            <span>
                                <a href="{{ route('gio-hang.destroy') }}"
                                    onclick="return confirm('Bạn muốn xóa giỏ hàng ?')">
                                    <i
                                        class="fa-solid fa-xmark text-lg text-gray-300 hover:text-gray-700 cursor-pointer"></i>
                                </a>
                            </span>
                        @endif
                    </div>
                    <hr class="my-3">
                    @if ($cart_count > 0)
                        <div class="md:w-full overflow-x-auto">
                            <table class="w-full min-w-[900px] select-none">
                                <tr class="font-semibold">
                                    <td class="w[150px] py-3">
                                        Tất cả 
                                        (<span class="total">{{ $cart_count }}</span> sản phẩm)
                                    </td>
                                    <td class="px-3">Tên & mô tả</td>
                                    <td class="text-center">Giảm giá</td>
                                    <td>Đơn giá</td>
                                    <td>Số lượng</td>
                                    <td>Thành tiền</td>
                                    <td>Xóa</td>
                                </tr>
                                @foreach ($carts as $row)
                                    <tr class="border-b">
                                        <td class="w-[150px] py-1">
                                            <img src="{{ $row->options->url }}" alt=""
                                                class="w-[70px] h-[70px] object-contain rounded-md">
                                        </td>
                                        <td class="w-[250px] px-3">
                                            <div class="flex flex-col justify-center">
                                                <span>{{ $row->name }}</span>
                                                <span
                                                    class="text-gray-400 line-clamp-1">{{ $row->options->desc }}</span>
                                            </div>
                                        </td>
                                        @if ($row->options->disscount > 0)
                                            <td class="text-center">-{{ $row->options->disscount }}%</td>
                                        @else
                                            <td class="text-gray-500 text-center">(Không)</td>
                                        @endif
                                        <td class="font-semibold">{{ number_format($row->price, 0, ',', '.') . 'đ' }}
                                        </td>
                                        <td>
                                            <input type="number" name="" id="" data-id="{{ $row->rowId }}" data-price="{{$row->price}}"
                                                value="{{ $row->qty }}"
                                                class="product_cart_quantity border-gray-200 w-[50px] text-center rounded-md shadow-sm p-[5px] focus:border-green-500 focus:ring-green-500"
                                                min="1" max="{{ $row->options->quantity }}">
                                        </td>
                                        <td class="total-amount-{{$row->rowId}} font-semibold">{{ number_format($row->subtotal, 0, ',', '.') . 'đ' }}
                                        </td>
                                        <td><a href="{{ route('gio-hang.delete', $row->rowId) }}"
                                                onclick="return confirm('Bạn muốn xóa sản phẩm này ?')"><i
                                                    class="fa-solid fa-trash text-lg text-gray-300 hover:text-gray-700 cursor-pointer"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    @else
                        <div class="text-gray-500 italic">
                            <span>Chưa có sản phẩm trong giỏ hàng</span> <br>
                            <span>Bạn tham khảo thêm các sản phẩm được gợi ý bên dưới nhé !</span>
                        </div>
                    @endif

                </div>

                {{-- disscount --}}
                <div class="bg-white p-3 rounded-md shadow-sm mt-2 order-2 hidden md:block">
                    <div class="text-lg font-semibold flex justify-between items-center">
                        <div class="px-2 select-none">
                            <span>Sản phẩm đang giảm giá</span>
                        </div>
                        <x-slider-button />
                    </div>
                    <div class="box overflow-hidden relative">
                        <div class="slider flex mt-1 transition-all duration-300">
                            @foreach ($products_disscount as $product)
                                <div class="slider-item shrink-0 w-full md:w-[20%] p-2 transition-all duration-200">
                                    <div
                                        class="border border-gray-200 rounded-md p-3 relative hover:border-gray-300 hover:shadow-md">
                                        <div
                                            class="disscount-note select-none absolute bg-gradient-to-r from-amber-300 to-amber-500 text-black px-5 py-1 rounded-tr-md rounded-bl-md shadow-md top-0 right-0">
                                            -{{ $product->disscount }}%</div>
                                        <div class="h-[200px] w-full">
                                            <a href="{{ url($product->slug) . '.html' }}">
                                                <img src="{{ asset($product->media->url) }}" alt=""
                                                    class="h-full w-full object-contain">
                                            </a>
                                        </div>
                                        <div class="name font-semibold select-none line-clamp-1">{{ $product->name }}</div>
                                        <div class="desc line-clamp-1 text-gray-500">{{ $product->desc }}</div>
                                        <div class="price font-semibold mt-2 text-lg select-none">
                                            <del
                                                class="text-gray-400">{{ number_format($product->price, 0, ',', '.') . 'đ' }}</del>
                                            <span
                                                class="ml-2">{{ number_format($product->price - $product->price * ($product->disscount / 100), 0, ',', '.') . 'đ' }}</span>
                                        </div>
                                        <div class="cta mt-2 flex items-center justify-between">
                                            <a href="{{ route('gio-hang.add',$product->id) }}"
                                                class="font-semibold hover:underline underline-offset-2 text-xs">Thêm
                                                vào
                                                giỏ</a>
                                             <a href="{{ route('gio-hang.mua-ngay',$product->id) }}"
                                                class="text-xs px-3 py-2 bg-gradient-to-r from-green-500 to-green-700 rounded-md text-white shadow-sm hover:brightness-110">Mua
                                                ngay</a>
                                        </div>
                                        <div class="rate flex justify-between w-full mt-3">
                                            <div class="select-none">
                                                <span><i class="fa-solid fa-star text-amber-500"></i></span>
                                                <span>
                                                @if ($product->review->count() > 0)
                                                    (5.0)
                                                @else
                                                    (0)
                                                @endif
                                            </span>
                                            </div>
                                            <div>
                                            Đã bán <span class="font-semibold">({{ $product->sold_count > 0 ? $product->sold_count : 0 }})</span>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white shadow-sm rounded-md w-full md:w-[22%] p-5 select-none sticky top-2 order-1">
                <div class="font-semibold text-lg text-gray-500">Ưu đãi</div>
                @if ($cart_count > 0) 
                    <div class="mt-2 flex items-center gap-2 text-blue-600 select-none">
                        <span><i class="fa-solid fa-ticket text-lg"></i></span>
                        @if ($more_cash_to_free_ship < 0)
                            <span class="cash-to-free-ship"> 
                                Miễn phí Ship cho đơn hàng của bạn
                            </span>
                        @else
                            <span class="cash-to-free-ship">
                                Thêm {{ number_format($more_cash_to_free_ship, 0, ',', '.') . 'đ' }} được miễn phí Ship
                            </span>
                        @endif
                    </div>
                    <div class="font-semibold text-lg mt-2">Tóm tắt đơn hàng</div>
                    <hr class="my-3">
                    <div class="flex items-center justify-between">
                        <div>Tạm tính</div>
                        <div class="total-amount font-semibold text-lg">{{ number_format($cart_provisional, 0, ',', '.') . 'đ' }}</div>
                    </div>
                    <div class="flex items-center justify-between mt-2">
                        <div>Phí vận chuyển</div>
                        <div class="">
                            @if ($more_cash_to_free_ship < 0)
                                <span class="view-ship">Miễn phí</span>
                            @else
                                <span class="view-ship">30.000đ</span>
                            @endif
                        </div>
                    </div>
                    <hr class="my-3">
                    <div class="flex items-center justify-between mt-2">
                        <div>Tổng đơn hàng</div>
                        @if ($more_cash_to_free_ship < 0)
                            <div class="cart-total font-semibold text-lg">{{ number_format($cart_provisional, 0, ',', '.') . 'đ' }}
                            </div>
                        @else
                            <div class="cart-total font-semibold text-lg">{{ number_format($cart_total, 0, ',', '.') . 'đ' }}</div>
                        @endif
                    </div>

                    <a href="{{ route('thanh-toan') }}"
                        class="py-2 w-full text-center inline-block bg-gradient-to-r from-green-500 to-green-700 text-white rounded-md shadow-sm mt-3 hover:brightness-110">Thanh
                        toán</a>
                    <a href="{{ route('/') }}" class="py-2 border border-gray-200 inline-block mt-1 rounded-md text-center w-full shadow-sm hover:bg-gradient-to-r hover:from-green-500 hover:to-green-700 hover:text-white">Tiếp tục mua sắm</a>
                @else
                    <div class="flex gap-2 items-center mt-2 text-blue-600">
                        <span><i class="fa-solid fa-ticket text-lg"></i></span>
                        <span>Miễn phí ship cho đơn từ 490k trở lên</span>
                    </div>
                @endif
            </div>
        </div>
    </div>

</x-client-app-layout>
