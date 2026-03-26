@if ($products->count() > 0)
    <div class="flex flex-wrap mt-1">
        @foreach ($products as $product)
            <div class="w-full md:w-[20%] p-2 transition-all duration-200">
                <div class="border border-gray-200 rounded-md p-3 relative hover:border-gray-400 hover:shadow-md">
                    @if ($product->up_sale == 'yes')
                        <div
                            class="sale-note select-none absolute bg-gradient-to-r from-red-500 to-red-700 text-white px-2 py-1 rounded-tr-md rounded-bl-md shadow-md top-0 right-0">
                            Bán chạy</div>
                    @endif

                    @if ($product->disscount > 0)
                        <div
                            class="disscount-note select-none absolute bg-gradient-to-r from-amber-300 to-amber-500 text-black px-5 py-1 rounded-tr-md rounded-bl-md shadow-md {{ $product->up_sale == 'yes' ? 'top-8' : 'top-0' }} right-0">
                            -{{ $product->disscount }}%</div>
                    @endif
                    <div class="h-[200px] w-full">
                        <a href="{{ url($product->slug) . '.html' }}">
                            <img src="{{ asset($product->media->url) }}" alt=""
                                class="h-full w-full object-contain">
                        </a>
                    </div>
                    <div class="name font-semibold select-none">{{ $product->name }}</div>
                    <div class="desc w-full truncate text-gray-500 mt-1 select-none">
                        {{ $product->desc }}</div>
                    <div class="price font-semibold mt-2 text-lg select-none">
                        <span
                            class="{{ $product->disscount > 0 ? 'text-gray-400 line-through' : '' }}">{{ number_format($product->price, 0, ',', '.') . 'đ' }}</span>
                        @if ($product->disscount > 0)
                            <span
                                class="ml-2">{{ number_format($product->price - $product->price * ($product->disscount / 100), 0, ',', '.') . 'đ' }}</span>
                        @endif
                    </div>
                    <div class="cta mt-2 flex items-center justify-between">
                        <a href="{{ route('gio-hang.add', $product->id) }}" data-id = "{{ $product->id }}"
                            class="add-cart font-semibold hover:underline underline-offset-2 text-xs active:text-green-600">
                            Thêm vào giỏ
                        </a>
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
    <div class="mt-2">
        {{ $products->links('pagination::tailwind', ['class' => 'all_product_pagination']) }}
    </div>
@else
    <p class="p-3 text-gray-500 italic">Không có sản phẩm theo tên bạn đang tìm kiếm</p>
@endif
