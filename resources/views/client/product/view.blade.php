<x-client-app-layout>
    <div class="flex flex-col md:flex-row items-start mt-2 gap-2">
        {{-- category --}}
        <div class="w-full md:w-[15%] bg-white p-4 rounded-md shadow-sm md:sticky top-2">
            <h1 class="font-semibold text-lg ml-2 text-gray-500 select-none">Danh mục sản phẩm</h1>
            <hr class="mt-3">
            <x-categories-product/>
        </div>
        <div class="w-full md:w-[85%] animation_content_slide_up">
            @if ($products->count() > 0)
                <div class="bg-white p-3 rounded-md shadow-sm">
                    <div class="">
                        @foreach ($products as $parent_cat => $products)
                            <p class="font-semibold text-lg select-none flex items-center gap-4 px-2 mt-2">
                                <span>{{ $parent_cat }}</span>
                                @if ($products->count() > 5)
                                    <span>
                                        <a href=""
                                            class="text-blue-600 text-sm font-normal underline underline-offset-2">Xem
                                            tất cả</a>
                                    </span>
                                @endif
                            </p>
                            <ul class="flex flex-wrap">
                                @php
                                    $count = 0;
                                @endphp
                                @foreach ($products as $product)
                                    @php
                                        $count += 1;
                                    @endphp
                                    <li class="w-full md:w-[20%] transition-all duration-250 p-2">
                                        <div
                                            class="w-full inline-block border p-3 rounded-md shadow-sm hover:border-gray-400 hover:shadow-md relative">
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
                                                <a href="{{ url($product->slug).'.html' }}" class="rounded-md">
                                                    <img src="{{ asset($product->media->url) }}" alt=""
                                                        class="h-full w-full object-contain rounded-md">
                                                </a>
                                            </div>
                                            <div class="name font-semibold select-none mt-1 line-clamp-1">{{ $product->name }}</div>
                                            <div class="desc text-gray-500 line-clamp-1 mt-1 select-none">
                                                {{ $product->desc }}</div>
                                            <div class="price font-semibold mt-2 text-lg select-none">
                                                <span
                                                    class="{{ $product->disscount > 0 ? 'text-gray-400 line-through' : '' }}">{{ number_format($product->price, 0, ',', '.') . 'đ' }}</span>
                                                @if ($product->disscount > 0)
                                                    <span
                                                        class="ml-2">{{ number_format($product->price - $product->price * ($product->disscount / 100), 0, ',', '.') . 'đ' }}</span>
                                                @endif
                                            </div>
                                            <div class="cta">
                                                <div class="cta mt-2 flex items-center justify-between">
                                                    <a href="" data-id = "{{ $product->id }}"
                                                        class="add-cart font-semibold hover:underline underline-offset-2 text-xs active:text-green-600">Thêm
                                                        vào
                                                        giỏ</a>
                                                    <a href="{{ route('gio-hang.mua-ngay',$product->id) }}"
                                                        class="text-xs px-4 py-2 bg-gradient-to-r from-green-500 to-green-700 rounded-md text-white shadow-sm hover:brightness-110">Mua
                                                        ngay</a>
                                                </div>
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
                                    </li>
                                    @if ($count == 5)
                                        @break
                                    @endif
                                @endforeach
                            </ul>
                        @endforeach
                    </div>
                </div>
            @else
                @include('client.layouts.404');
            @endif
        </div>
    </div>
</x-client-app-layout>
