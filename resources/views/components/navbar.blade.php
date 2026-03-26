
{{-- Mobile --}}
<div class="bg-white py-2 px-3 md:hidden flex justify-between w-full cursor-pointer mt-2">
    <a href="{{ route('/') }}">
        <x-app-logo class="text-[40px] md:hidden" />
    </a>
    <div class="toggle_navbar border border-gray-200 py-1 px-2 rounded-md shadow-sm hover:border-green-600">
        <i class="fa-solid fa-bars text-xl"></i>
    </div>
</div>

{{-- Desktop --}}
<nav class="navbar hidden md:block">
    <div
        class="bg-white shadow-sm rounded-b-md px-3 py-4 pt-0 md:pt-2 flex flex-col items-start justify-center gap-1 md:gap-0 md:flex-row md:justify-between md:items-center relative">
        <div class="flex flex-col md:flex-row gap-0 md:gap-5">
            <a href="{{ route('/') }}">
                <x-app-logo class="text-[40px] hidden md:block" />
            </a>
            <ul
                class="client-mainmenu flex flex-col w-full md:flex-row items-start md:items-center font-semibold md:text-normal mt-3 md:mt-2">
                @foreach ($menus->where('parent_id', 0) as $menu)
                    <li class="group">
                        <a href="{{ url($menu->slug) }}"
                            class="group-hover:text-green-600 py-2 md:py-5 px-2 inline-block md:inline {{ $menu->slug == session('page_active') ? 'active' : '' }}">{{ $menu->name }}</a>
                        @if ($menus->where('parent_id', $menu->id)->count() > 0)
                            <ul
                                class="client-submenu absolute z-10 inset-x-5 rounded-b-md bg-white shadow-sm top-8 md:top-16 left-0 opacity-0 pointer-events-none group-hover:opacity-100 group-hover:pointer-events-auto w-full pt-3 pl-4 pb-5">
                                <div class="flex">
                                    <div class="w-[19%] border-r border-gray-300 p-1 pt-0 pr-5 hidden md:block">
                                        <p class="font-semibold text-2xl">Ưu đãi tháng 2 !</p>
                                        <p class="text-gray-500 font-normal mt-1">
                                            Mua 2 tặng 1 cho dòng Hạt Mix" hoặc "Hạt Điều Rang Muối - Mới về hàng
                                        </p>
                                    </div>
                                    <div class="flex p-1 md:p-0 ml-4">
                                        @foreach ($menus->where('parent_id', $menu->id) as $submenu)
                                            <div class="flex">
                                                <li><a href="{{ url($submenu->slug) }}"
                                                        class="p-3 pt-0 inline-block text-gray-700 hover:text-gray-800 hover:underline underline-offset-2">{{ $submenu->name }}</a>
                                                    @if ($menus->where('parent_id', $submenu->id)->count() > 0)
                                                        <ul>
                                                            @foreach ($menus->where('parent_id', $submenu->id) as $last_submenu)
                                                                <li><a href="{{ url($last_submenu->slug) }}"
                                                                        class="p-3 py-1 inline-block font-normal text-gray-700 hover:underline underline-offset-2">{{ $last_submenu->name }}</a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </li>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </ul>
                        @endif
                    </li>
                @endforeach
                {{-- <li class="group">
                <a href="" class="group-hover:text-green-600 py-5 px-2">Tài khoản</a>
            </li> --}}
            </ul>
        </div>
        <div class="flex items-center gap-5 md:mt-1">
            <div
                class="flex border px-3 py-2 justify-between gap-3 rounded-md mt-1 cursor-pointer hover:border-green-600 open_search">
                <p>Tìm kiếm sản phẩm tại đây </p>
                <span><i class="fa-solid fa-magnifying-glass"></i></span>
            </div>

            <span class="select-none">|</span>
            <a href="{{ route('gio-hang') }}"
                class="p-1 relative hover:text-green-600 {{ session('page_active') == 'gio-hang' ? 'active' : '' }}">
                <i class="fa-solid fa-cart-shopping text-xl"></i>
                <div class="cart-place">
                    @if ($cart_count > 0)
                        <div class="absolute top-0 right-0">
                            <span class="relative flex size-4">
                                <span
                                    class="absolute inline-flex h-full w-full animate-ping rounded-full bg-red-600 opacity-75"></span>
                                <span
                                    class="relative inline-flex size-4 rounded-full bg-red-600 justify-center items-center">
                                    <div class="cart-count text-xs font-semibold text-white">{{ $cart_count }}</div>
                                </span>
                            </span>
                        </div>
                    @endif
                </div>
            </a>
        </div>
    </div>

</nav>
