<x-client-app-layout>
    <div class="flex flex-col md:flex-row items-start mt-2 gap-2">
        {{-- category --}}
        <div class="w-full md:w-[16%] bg-white p-4 rounded-md shadow-sm md:sticky top-2">
            <h1 class="font-semibold text-lg ml-2 text-gray-500 select-none">Danh mục sản phẩm</h1>
            <hr class="mt-3">
            <x-categories-product />
        </div>
        <div class="w-full md:w-[84%] animation_content_slide_up">
            {{-- banner slider --}}
            <div class="w-full bg-white shadow-sm rounded-md p-3 {{ $img_sliders->count() > 2 ? 'pb-2' : '' }}">
                <div class="box overflow-hidden">
                    <div class="slider-imgs w-full h-full rounded-md flex transtion-all duration-300">
                        @foreach ($img_sliders as $img)
                            <a href="" class="inline-block w-full md:w-[50%] shrink-0 h-full relative p-2 rounded-md">
                                <img src="{{ asset($img->media->url) }}" alt=""
                                    class="w-full h-[300px] object-cover rounded-md">
                                <div class="absolute top-10 z-10 p-5 text-white">
                                    <div class="title text-xl font-bold">{{ $img->title }}</div>
                                    <div class="desc w-[250px] mt-2">{{ $img->desc }}</div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="text-xs w-full flex justify-center">
                    @for ($i = 1; $i <= $img_sliders->count() / 2; $i++)
                        <div class="slider-dots w-[8px] h-[8px] rounded-full bg-gray-700 mx-[1px]"></div>
                    @endfor
                </div>
            </div>

            {{-- new --}}
            <div class="bg-white p-3 rounded-md shadow-sm mt-2">
                <div class="text-lg font-semibold flex justify-between items-center">
                    <div class="px-2 select-none">
                        <span>Sản phẩm mới</span>
                    </div>
                    <x-slider-button />
                </div>
                <div class="box overflow-hidden relative">
                    <div class="slider flex mt-1 transition-all duration-300">
                        @foreach ($products_new as $product)
                            <div
                                class="slider-item shrink-0 w-full md:w-[20%] p-2 transition-all duration-200">
                                <div class="border border-gray-200 rounded-md p-3 relative hover:border-gray-400 hover:shadow-md">
                                    <div
                                        class="disscount-note select-none absolute bg-gradient-to-r from-blue-600 to-blue-800 text-white px-5 py-1 rounded-tr-md rounded-bl-md shadow-md top-0 right-0">
                                        New
                                    </div>
                                    <div class="h-[200px] w-full">
                                        <a href="{{ url($product->slug) . '.html' }}">
                                            <img src="{{ asset($product->media->url) }}" alt=""
                                                class="h-full w-full object-contain">
                                        </a>
                                    </div>
                                    <div class="name font-semibold select-none mt-1">{{ $product->name }}</div>
                                    <div class="desc w-full truncate text-gray-500 mt-1 select-none">
                                        {{ $product->desc }}</div>
                                    <div class="price font-semibold mt-2 text-lg select-none">
                                        {{ number_format($product->price, 0, ',', '.') . 'đ' }}
                                    </div>
                                    <div class="cta mt-2 flex items-center justify-between">
                                        <a href="" data-id = "{{ $product->id }}"
                                            class="add-cart font-semibold hover:underline underline-offset-2 text-xs active:text-green-600">Thêm vào
                                            giỏ</a>
                                        <a href="{{ route('gio-hang.mua-ngay',$product->id) }}"
                                            class="px-4 py-2 bg-gradient-to-r from-green-500 to-green-700 rounded-md text-white shadow-sm hover:brightness-110 text-xs">Mua
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

            {{-- upsale --}}
            <div class="bg-white p-3 rounded-md shadow-sm mt-2">
                <div class="text-lg font-semibold flex justify-between items-center">
                    <div class="px-2 select-none">
                        <span>Sản phẩm bán chạy</span>
                    </div>
                    <x-slider-button />
                </div>
                <div class="box overflow-hidden relative">
                    <div class="slider flex mt-1 transition-all duration-300">
                        @foreach ($products_sales as $product)
                            <div
                                class="slider-item shrink-0 w-full md:w-[20%] p-2 transition-all duration-200">
                                <div class="border border-gray-200 rounded-md p-3 relative hover:border-gray-400 hover:shadow-md">
                                    <div
                                        class="sale-note select-none absolute bg-gradient-to-r from-red-500 to-red-700 text-white px-2 py-1 rounded-tr-md rounded-bl-md shadow-md top-0 right-0">
                                        Bán chạy</div>
                                    @if ($product->disscount > 0)
                                        <div
                                            class="disscount-note select-none absolute bg-gradient-to-r from-amber-300 to-amber-500 text-black px-5 py-1 rounded-tr-md rounded-bl-md shadow-md top-8 right-0">
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
                                        <a href="" data-id = "{{ $product->id }}"
                                            class="add-cart font-semibold hover:underline underline-offset-2 text-xs active:text-green-600">Thêm vào
                                            giỏ</a>
                                        <a href="{{ route('gio-hang.mua-ngay',$product->id) }}"
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
                                            Đã bán <span class="font-semibold">({{ $product->sold_count > 0 ? $product->sold_count : 0 }})</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- disscount --}}
            <div class="bg-white p-3 rounded-md shadow-sm mt-2">
                <div class="text-lg font-semibold flex justify-between items-center">
                    <div class="px-2 select-none">
                        <span>Sản phẩm giảm giá</span>
                    </div>
                    <x-slider-button />
                </div>
                <div class="box overflow-hidden relative">
                    <div class="slider flex mt-1 transition-all duration-300">
                        @foreach ($products_disscount as $product)
                            <div
                                class="slider-item shrink-0 w-full md:w-[20%] p-2 transition-all duration-200">
                                <div class="border border-gray-200 rounded-md p-3 relative hover:border-gray-400 hover:shadow-md">
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
                                    <div class="desc w-full truncate text-gray-500 mt-1 select-none">
                                        {{ $product->desc }}</div>
                                    <div class="price font-semibold mt-2 text-lg select-none">
                                        <del
                                            class="text-gray-400">{{ number_format($product->price, 0, ',', '.') . 'đ' }}</del>
                                        <span
                                            class="ml-2">{{ number_format($product->price - $product->price * ($product->disscount / 100), 0, ',', '.') . 'đ' }}</span>
                                    </div>
                                    <div class="cta mt-2 flex items-center justify-between">
                                        <a href="" data-id = "{{ $product->id }}"
                                            class="add-cart font-semibold hover:underline underline-offset-2 text-xs active:text-green-600">Thêm vào
                                            giỏ</a>
                                        <a href="{{ route('gio-hang.mua-ngay',$product->id) }}"
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
    </div>
</x-client-app-layout>
