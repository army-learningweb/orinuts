<x-client-app-layout>

    {{-- Thông báo thành công --}}
    <x-flash-session key="status_complete">&nbsp;<i class="fa-solid fa-circle-check"></i></x-flash-session>

    <div class="flex flex-col md:flex-row items-start mt-2 gap-2">
        {{-- category product --}}
        <div class="w-full md:w-[15%] bg-white p-4 rounded-md shadow-sm md:sticky top-2">
            <h1 class="font-semibold text-lg ml-2 text-gray-500 select-none">Danh mục sản phẩm</h1>
            <hr class="mt-3">
            <x-categories-product />
        </div>
        <div class="product-info w-full md:flex-1 {{ session('status_complete') ? '' : 'animation_content_slide_up' }}">
            <div class="flex flex-col md:flex-row items-start gap-2">
                <div class="bg-white shadow-sm rounded-md w-full md:flex-1 p-5">
                    <div class="flex flex-col md:flex-row gap-5 bg-white rounded-md flex-1 border-red-500">
                        <div class="w-full md:w-[40%]">
                            <div class="feature border rounded-md shadow-sm relative">
                                <img src="{{ asset($product_info->media->url) }}" alt=""
                                    class="feature_img w-full h-[400px] object-contain">
                                @if ($product_sub_img->count() > 0)
                                    <div
                                        class="btn absolute top-0 text-2xl flex justify-between items-center w-full h-full">
                                        <i
                                            class="btn-prev-img fa-solid fa-angle-left text-gray-300 hover:text-gray-500 cursor-pointer active:text-gray-700"></i>
                                        <i
                                            class="btn-next-img fa-solid fa-angle-right text-gray-300 hover:text-gray-500 cursor-pointer active:text-gray-700"></i>
                                    </div>
                                @endif
                            </div>
                            @if ($product_sub_img->count() > 0)
                                <div class="flex gap-2 mt-3">
                                    @foreach ($product_sub_img as $img)
                                        <img src="{{ asset($img->url) }}" alt=""
                                            class="sub_img object-cover w-[25%] h-[85px] overflow-hidden cursor-pointer opacity-70">
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <div class="info w-full md:flex-1 select-none p-5">
                            @if ($product_info->up_sale == 'yes' && $product_info->disscount > 0)
                                <div class="flex gap-1">
                                    <div
                                        class="tag font-semibold bg-gradient-to-r from-red-500 to-red-700 text-white w-[70px] p-1 text-center rounded-md shadow-md text-xs mb-3">
                                        Bán chạy
                                    </div>
                                    <div
                                        class="tag font-semibold bg-gradient-to-r from-amber-300 to-amber-500 text-black w-[70px] p-1 text-center rounded-md shadow-md text-xs mb-3">
                                        -{{ $product_info->disscount }}%
                                    </div>
                                </div>
                            @elseif($product_info->disscount > 0)
                                <div
                                    class="tag font-semibold bg-gradient-to-r from-amber-300 to-amber-500 text-black w-[70px] p-1 text-center rounded-md shadow-md text-xs mb-3">
                                    -{{ $product_info->disscount }}%
                                </div>
                            @elseif($product_info->up_sale == 'yes')
                                <div
                                    class="tag font-semibold bg-red-600 text-white w-[70px] p-1 text-center rounded-md shadow-md text-xs mb-3">
                                    Bán chạy
                                </div>
                            @endif
                            <div class="name font-semibold text-lg">{{ $product_info->name }}</div>
                            <div class="rate text-lg text-amber-500 mt-2">

                                @if ($product_info->review->count() == 0)
                                    @for ($i = 1; $i <=5; $i++)
                                         <i class="fa-regular fa-star"></i>
                                    @endfor
                                @else
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                @endif
                
                                <span class="text-gray-800 text-sm">
                                    ({{ $product_info->review->where('status','publish')->count() }})
                                    Đánh
                                    giá
                                </span>
                            </div>
                            <div class="desc mt-2 text-gray-500">{{ $product_info->desc }}</div>
                            <div class="price text-lg font-semibold mt-2">
                                @if ($product_info->disscount > 0)
                                    <div class="price font-semibold mt-2 text-lg select-none">
                                        <span class="font-normal text-sm">Giá:</span>
                                        <del
                                            class="text-gray-400">{{ number_format($product_info->price, 0, ',', '.') . 'đ' }}</del>
                                        <span
                                            class="ml-1">{{ number_format($product_info->price - $product_info->price * ($product_info->disscount / 100), 0, ',', '.') . 'đ' }}</span>
                                    </div>
                                @else
                                    <span class="font-normal text-sm">Giá:</span>
                                    <span>{{ number_format($product_info->price, 0, ',', '.') . 'đ' }}</span>
                                @endif
                            </div>
                            <div class="mt-2">
                                @if ($product_info->quantity == 0)
                                    <span class="text-red-600 font-semibold">Hết hàng</span>
                                @else
                                    Hàng kho: ({{ $product_info->quantity }}) gói
                                @endif
                                
                            </div>
                            <div class="flex gap-3 items-center mt-5">
                                <span
                                    class="bg-gray-100 w-[40px] h-[40px] rounded-full flex justify-center items-center"><i
                                        class="fa-solid fa-repeat"></i></span>
                                <span>Đổi trả nếu sản phẩm không đảm bảo</span>
                            </div>
                            <div class="flex gap-3 items-center mt-2">
                                <span
                                    class="bg-gray-100 w-[40px] h-[40px] rounded-full flex justify-center items-center"><i
                                        class="fa-solid fa-truck"></i></span>
                                <span>Miễn phí giao hàng cho đơn từ 490k trở lên</span>
                            </div>
                            <div class="flex gap-3 items-center mt-2">
                                <span
                                    class="bg-gray-100 w-[40px] h-[40px] rounded-full flex justify-center items-center"><i
                                        class="fa-solid fa-location-dot"></i></span>
                                <span>Giao hàng toàn quốc</span>
                            </div>
                            <div class="flex gap-3 items-center mt-2">
                                <span
                                    class="bg-gray-100 w-[40px] h-[40px] rounded-full flex justify-center items-center"><i
                                        class="fa-solid fa-star"></i></span>
                                <span>Cam kết chất lượng</span>
                            </div>
                        </div>
                    </div>
                    <hr class="my-5">
                    <div>
                        <h1 class="font-semibold text-lg">Thông tin chi tiết</h1>
                        <div class="mt-2 select-none">{!! $product_info->details !!}</div>
                    </div>
                    <hr class="my-5">
                    <div>
                        <h1 class="font-semibold text-lg select-none">Gửi đánh giá của bạn về sản phẩm này</h1>
                        <div class="mt-2">
                            <form action="{{ route('san-pham.danh-gia', $product_info->id) }}" method="post">
                                <div class="flex gap-1 items-center">
                                    <div>
                                        <i class="fa-regular fa-star text-xl text-amber-500 star" data-vote-num="1"></i>
                                        <i class="fa-regular fa-star text-xl text-amber-500 star" data-vote-num="2"></i>
                                        <i class="fa-regular fa-star text-xl text-amber-500 star" data-vote-num="3"></i>
                                        <i class="fa-regular fa-star text-xl text-amber-500 star" data-vote-num="4"></i>
                                        <i class="fa-regular fa-star text-xl text-amber-500 star" data-vote-num="5"></i>
                                    </div>
                                    <span class="ml-2 select-none star-num"></span>
                                    <input type="hidden" name="starVote" class="star-vote" value="">
                                </div>

                                @if (session('status_failed'))
                                    <span class="text-red-600 text-xs status_failed">{{ session('status_failed') }}
                                        !</span>
                                @endif

                                @csrf
                                <div class="mt-2">
                                    <x-label for="name">Họ tên</x-label>
                                    <x-input type="text" name="name" id="name" class="w-[50%]" />
                                    <x-error-php error_field="name" />
                                    <x-error-ajax error_field="name" />
                                </div>

                                <div class="mt-2">
                                    <x-label for="review">
                                        <span>Đánh giá của bạn</span>
                                        <span class="text-xs text-gray-500"></span>
                                    </x-label>
                                    <br>
                                    <textarea name="review" id="review" placeholder="Ghi đánh giá tại đây"
                                        class="mt-1 w-full min-h-[100px] border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring-green-500">{{ old('review') }}</textarea>
                                </div>
                                <input type="hidden" name="product_id" value={{ $product_info->id }}>
                                <x-button-customize type="submit" class="mt-1">Gửi đánh giá </x-button-customize>
                            </form>
                        </div>
                    </div>
                    <hr class="my-5">
                    <div>
                        <h1 class="font-semibold text-lg select-none">Đánh giá về sản phẩm</h1>

                        @if ($product_reviews->count() > 0)
                            <div class="flex gap-2 flex-wrap mt-3">
                            @foreach ($product_reviews as $review)
                                <div class="w-full md:w-[24%] rounded-md bg-gray-100 p-3 mt-2 md:mt-0">
                                        <div class="font-semibold">{{ $review->name }}</div>
                                        <div class="mt-2">
                                            @for ($i = 1; $i <= $review->vote_star; $i++)
                                                 <i class="fa-solid fa-star text-xl text-amber-500"></i>
                                            @endfor
                                        </div>
                                        <div class="mt-2">{{ $review->review }}</div>
                                </div>
                            @endforeach

                        </div>
                        @else
                            <p class="mt-2 text-gray-500"> Chưa có đánh giá nào !</p>
                        @endif
                        
                    </div>
                </div>

                <div class="w-full md:w-[25%] p-5 bg-white shadow-sm rounded-md md:sticky top-2 {{ $product_info->quantity == 0 ? 'opacity-50' : '' }}">
                    <form action="{{ route('gio-hang.add', $product_info->id) }}" method="post">
                        @method('GET')
                        @csrf
                        <div class="code font-medium text-lg select-none">Mã: {{ $product_info->code }}</div>
                        <hr class="my-3">
                        <div class="mt-2">
                            <label for="product_quantity">Số lượng</label>
                            <input type="number" name="product_quantity" id="product_quantity" value="1"
                                min="1" max="{{ $product_info->quantity }}"
                                class="ml-2 p-1 text-center rounded-sm shadow-sm w-[50px] h-[30px] focus:border-green-500 focus:ring-green-500 border-gray-200">

                        </div>
                        <div class="font-semibold flex justify-between items-center mt-1 select-none">
                            <div class="">Tạm tính</div>
                            @if ($product_info->disscount > 0)
                                <div class="provisional-total text-lg flex-1 text-right w-[90%] border-none">
                                    {{ number_format($product_info->price - $product_info->price * ($product_info->disscount / 100), 0, ',', '.') . 'đ' }}
                                </div>
                            @else
                                <div
                                    class="provisional-total text-lg flex-1 text-right w-[90%] border-none focus:ring-0 cursor-auto">
                                    {{ number_format($product_info->price, 0, ',', '.') . 'đ' }}
                                </div>
                            @endif
                            <input type="hidden" name="product_id" class="product_id"
                                value={{ $product_info->id }}>
                            <input type="hidden" name="url" class="url"
                                value="{{ url($product_info->slug) . '.html' }}">
                        </div>

                        <div class="flex flex-col mt-1">
                            <button type="submit" name="buyNow" value="yes" class="{{ $product_info->quantity == 0 ? 'pointer-events-none' : '' }} flex gap-1 justify-center items-center cursor-pointer text-center py-2 rounded-md shadow-sm mt-1 bg-gradient-to-r from-green-500 to-green-700 text-white hover:brightness-110">
                                Mua ngay
                            </button>
                            {{-- <a href="{{ route('gio-hang.mua-ngay', $product_info->id) }}"
                                class="text-center py-2 rounded-md shadow-sm mt-1 bg-gradient-to-r from-green-500 to-green-700 text-white hover:brightness-110 {{ $product_info->quantity == 0 ? 'pointer-events-none' : '' }}">Mua
                                ngay</a> --}}

                            <button type="submit" name="addCart"
                                class="{{ $product_info->quantity == 0 ? 'pointer-events-none' : '' }} flex gap-1 justify-center items-center cursor-pointer text-center py-2 rounded-md shadow-sm mt-1 border border-gray-200 text-xs hover:bg-gradient-to-r hover:from-green-500 hover:to-green-700 hover:text-white">
                                Thêm vào giỏ
                            </button>
                            
                        </div>
                    </form>
                </div>
            </div>

            {{-- disscount --}}
            <div class="bg-white p-3 rounded-md shadow-sm mt-2">
                <div class="text-lg font-semibold flex justify-between items-center">
                    <div class="px-2 select-none">
                        <span>Đang giảm giá</span>
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
                                    <div class="name font-semibold select-none">{{ $product->name }}</div>
                                    <div class="desc line-clamp-1 text-gray-500">{{ $product->desc }}</div>
                                    <div class="price font-semibold mt-2 text-lg select-none">
                                        <del
                                            class="text-gray-400">{{ number_format($product->price, 0, ',', '.') . 'đ' }}</del>
                                        <span
                                            class="ml-2">{{ number_format($product->price - $product->price * ($product->disscount / 100), 0, ',', '.') . 'đ' }}</span>
                                    </div>
                                    <div class="cta mt-2 flex items-center justify-between">
                                        <a href="{{ route('gio-hang.add', $product->id) }}"
                                            class="font-semibold hover:underline underline-offset-2 text-xs">Thêm vào
                                            giỏ</a>
                                        <a href="{{ route('gio-hang.mua-ngay', $product->id) }}"
                                            class="text-xs px-4 py-2 bg-gradient-to-r from-green-500 to-green-700 rounded-md text-white shadow-sm hover:brightness-110">Mua
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
                                            Đã bán <span
                                                class="font-semibold">({{ $product->sold_count > 0 ? $product->sold_count : 0 }})</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-client-app-layout>
