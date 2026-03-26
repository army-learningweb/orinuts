<x-client-app-layout>

    {{-- Thông báo thành công --}}
    <x-flash-session key="status_complete"><i class="fa-solid fa-circle-check"></i></x-flash-session>

    <div class="mt-2">
        <form action="{{ route('order') }}" method="post" class="flex flex-col md:flex-row items-start gap-2 ">
            @csrf
            <div class="w-full md:flex-1 bg-white shadow-sm rounded-md p-5 md:sticky top-2">
                <div class="w-full md:flex-1">
                    <div>
                        <p class="font-semibold text-lg">Thanh toán</p>
                        <hr class="my-3">
                    </div>
                    <div class="md:flex gap-5 flex-1 ">
                        <div class="flex-1">
                            <div class="">
                                <x-label for="name">
                                    <span>Họ và tên</span>
                                    <span class="text-lg text-red-600">*</span>
                                </x-label>
                                @if (request()->cookie('name'))
                                    <x-input type="text" name="name" id="name" value="{{ request()->cookie('name') }}"/>
                                @else
                                    <x-input type="text" name="name" id="name" value="{{ old('name') }}"/>
                                @endif
                                <x-error-php error_field="name" />
                                <x-error-ajax error_field="name" />
                            </div>

                            <div class="">
                                <x-label for="email">
                                    <span>Địa chỉ Email</span>
                                    <span class="text-lg text-red-600">*</span>
                                </x-label>
                                @if (request()->cookie('email'))
                                    <x-input type="text" name="email" id="email" value="{{ request()->cookie('email') }}"/>
                                @else
                                    <x-input type="text" name="email" id="email" value="{{ old('email') }}"/>
                                @endif
                                <x-error-php error_field="email" />
                                <x-error-ajax error_field="email" />
                            </div>


                            <div class="mt-2">
                                <x-label for="address">
                                    <span>Địa chỉ</span>
                                    <span class="text-lg text-red-600">*</span>
                                </x-label>
                                @if (request()->cookie('address'))
                                    <x-input type="text" name="address" id="address" placeholder="example@gmail.com" value="{{ request()->cookie('address') }}"/>
                                @else
                                    <x-input type="text" name="address" id="address" value="{{ old('address') }}"/>
                                @endif
                                <x-error-php error_field="address" />
                                <x-error-ajax error_field="address" />
                            </div>

                            <div class="mt-2">
                                <x-label for="tel">
                                    <span>Số điện thoại</span>
                                    <span class="text-lg text-red-600">*</span>
                                </x-label>
                                @if (request()->cookie('email'))
                                    <x-input type="number" name="tel" id="tel"  placeholder="078********" value="{{ request()->cookie('tel') }}"/>
                                @else
                                    <x-input type="number" name="tel" id="tel" value="{{ old('tel') }}"/>
                                @endif
                                <x-error-php error_field="tel" />
                                <x-error-ajax error_field="tel" />
                            </div>

                            <div class="mt-3">
                                <x-label for="note">
                                    <span>Ghi chú</span>
                                    <span class="text-xs text-gray-500">(Không bắt buộc)</span>
                                </x-label>
                                <br>
                                <textarea name="note" id="note" placeholder="Ghi chú về đơn hàng"
                                    class="mt-2 w-full min-h-[100px] border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring-green-500"></textarea>
                            </div>
                        </div>
                        <div class="w-full md:w-[50%] mt-2 md:mt-0">
                            <p class="font-semibold text-sm">Chọn phương thức thanh toán</p>
                            <div class="flex flex-wrap mt-3 gap-2">
                                <div class="w-full md:w-[49%] p-4 relative border rounded-md shadow-sm flex items-center">
                                    <input type="radio" name="payment_method" id="cod" value="cod" checked
                                        {{ old('payment_method') == 'cod' ? 'checked' : '' }} class="payment_method">
                                    <label for="cod"
                                        class="flex items-center absolute cursor-pointer -right-0 top-0 h-full w-full justify-center">
                                        <i class="fa-solid fa-money-bill-1-wave text-green-700 mx-3 text-lg"></i>
                                        Tiền mặt
                                    </label>
                                </div>
                                <div class="w-full md:w-[49%] p-4 relative border rounded-md shadow-sm flex items-center">
                                    <input type="radio" name="payment_method" id="momo" class="payment_method"
                                        value="momo" {{ old('payment_method') == 'momo' ? 'checked' : '' }}>
                                    <label for="momo"
                                        class="flex items-center absolute cursor-pointer -right-0 top-0 h-full w-full justify-center">
                                        <img src="{{ asset('images/logo-momo.webp') }}" alt=""
                                            class="w-[30px] mx-3"> Ví
                                        MoMo
                                    </label>
                                </div>
                                <div class="w-full md:w-[49%] p-4 relative border rounded-md shadow-sm flex items-center">
                                    <input type="radio" name="payment_method" id="zalo" class="payment_method"
                                        value="zalo" {{ old('payment_method') == 'zalo' ? 'checked' : '' }}>
                                    <label for="zalo"
                                        class="flex items-center absolute cursor-pointer -right-0 top-0 h-full w-full justify-center">
                                        <img src="{{ asset('images/zalopay.png') }}" alt=""
                                            class="w-[30px] mx-3">
                                        ZaloPay
                                    </label>
                                </div>
                                <div class="w-full md:w-[49%] p-4 relative border rounded-md shadow-sm flex items-center">
                                    <input type="radio" name="payment_method" id="banking" class="payment_method"
                                        value="banking" {{ old('payment_method') == 'banking' ? 'checked' : '' }}>
                                    <label for="banking"
                                        class="flex items-center absolute cursor-pointer -right-0 top-0 h-full w-full justify-center">
                                        <img src="{{ asset('images/vietcombank.jpg') }}" alt=""
                                            class="w-[30px] mx-3">
                                        Banking
                                    </label>
                                </div>
                                <p class="font-semibold text-sm mt-2 w-full select-none">Chính sách và cam kết</p>
                                <div class="flex flex-col gap-2 mt-1">
                                    <div class="flex gap-3 items-center">
                                        <span
                                            class="bg-gray-100 w-[40px] h-[40px] rounded-full flex justify-center items-center"><i
                                                class="fa-solid fa-truck-fast text-green-600"></i></span>
                                        <span>Dự kiến nhận hàng trong 2 - 3 ngày</span>
                                    </div>
                                    <div class="flex gap-3 items-center">
                                        <span
                                            class="bg-gray-100 w-[40px] h-[40px] rounded-full flex justify-center items-center"><i
                                                class="fa-solid fa-shield text-amber-500"></i></span>
                                        <span>Cho phép kiểm tra trước khi thanh toán</span>
                                    </div>
                                    <div class="flex gap-3 items-center">
                                        <span
                                            class="bg-gray-100 w-[40px] h-[40px] rounded-full flex justify-center items-center"><i
                                                class="fa-solid fa-repeat text-blue-600"></i></span>
                                        <span>7 ngày đổi trả nếu có lỗi</span>
                                    </div>
                                    <div class="flex gap-3 items-center">
                                        <span
                                            class="bg-gray-100 w-[40px] h-[40px] rounded-full flex justify-center items-center"><i
                                                class="fa-solid fa-star text-amber-500"></i></span>
                                        <span>Sản phẩm chính hãng 100% từ Orinuts</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full md:w-[30%] bg-white shadow-sm rounded-md p-5 sticky top-2">
                <p class="font-semibold text-lg select-none">Đơn hàng của bạn</p>
                <hr class="my-3">

                @foreach ($carts as $row)
                    <div class="flex items-center justify-between mt-2">
                        <div class="w-[25%] px-3"><img src="{{ asset($row->options->url) }}" alt=""
                                class="w-full h-[60px] object-cover rounded-md"></div>
                        <div class="w-[60%] flex gap-3">
                            <div class="truncate w-[150px]">{{ $row->name }}</div>
                            <div class="ml-3 font-semibold">(x{{ $row->qty }})</div>
                        </div>
                        <div class="w-[15%]"></div>
                        <div>{{ number_format($row->price * $row->qty, 0, ',', '.') . 'đ' }}</div>
                    </div>
                @endforeach
                <hr class="my-3">
                <div class="text-sm mt-2 flex justify-between w-full">
                    <p>Phí vận chuyển</p>
                    <p class="checkout-ship">{{ $checkout_ship }}</p>
                </div>

                <hr class="my-3">
                <div class="font-semibold text-sm mt-2 flex justify-between items-center w-full">
                    <p>Tổng thanh toán</p>
                    <p class="text-lg cart-total">{{ number_format($cart_total, 0, ',', '.') . 'đ' }}</p>
                    <input type="hidden" class="checkout-total-amount" name="" value="{{ $cart_total }}">
                </div>
                <button type="submit" class="flex justify-center items-center py-2 bg-gradient-to-r to-green-700 from-green-500 text-center text-white w-full font-semibold rounded-md mt-2 hover:brightness-110 cursor-pointer shadow-sm">
                    ĐẶT HÀNG
                </button>
                <a href="{{ route('gio-hang') }}"
                    class="py-2 mt-1 inline-block border border-gray-300 w-full rounded-md shadow-sm text-center hover:bg-gradient-to-r hover:from-green-500 hover:to-green-700 hover:text-white">
                    Quay lại giỏ hàng</a>
                <a href="{{ route('/') }}"
                    class="py-2 mt-1 inline-block border border-gray-300 w-full rounded-md shadow-sm text-center hover:bg-gradient-to-r hover:from-green-500 hover:to-green-700 hover:text-white">Tiếp
                    tục mua sắm</a>
            </div>
        </form>
    </div>



</x-client-app-layout>
