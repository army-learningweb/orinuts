<ul class="mt-2">
    <li><a href="{{ route('san-pham') }}"
            class="font-semibold hover:text-green-600 flex items-center justify-between py-2 w-full mt-1 px-2 rounded-md truncate {{ session('page_active') == 'san-pham' && session('category_active') == '' ? 'active' : '' }}">
            <span>Tất cả sản phẩm</span>
        </a>
    </li>

    @foreach ($product_categories as $cat)
        <li><a href="{{ url($cat->slug) }}"
                class="font-semibold hover:text-green-600 flex items-center justify-between py-2 w-full mt-1 px-2 rounded-md truncate {{ 'san-pham/'.session('category_active') == $cat->slug ? 'active' : '' }}">
                <span>{{ $cat->name }}</span>
            </a>
        </li>
    @endforeach

    <hr class="my-2 hidden md:block">
    <div class="p-2 hidden md:block">
        <h1 class="font-semibold text-lg text-gray-500 select-none">Ưu đãi</h1>

        <p class="mt-2 select-none"><span class="text-red-600 font-semibold">Tưng bừng đón tết</span> - giảm giá cho các
            sản phẩm Hạt Điều, Hạt dẻ, Gói quà tặng</p>
    </div>

    <hr class="my-2 hidden md:block">
    <div class="p-2 select-none hidden md:block">
        <h1 class="font-semibold text-lg text-gray-500 select-none">Cam kết</h1>
        <p class="mt-2">Chất lượng - Chính hãng</p>
    </div>

</ul>
