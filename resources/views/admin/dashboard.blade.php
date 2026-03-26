<x-app-layout>

    <x-flash-session key="welcome"><i class="fa-solid fa-hand-peace"></i></x-flash-session>

    {{-- topbar --}}
    <x-topbar-content>
        <x-breadcrum page_name="Dashboard" />
    </x-topbar-content>

    {{-- datacontent --}}
    <div class="data-content animation_content_slide_up text-sm px-3 pb-3 pt-1 md:pt-3 box-border">

        {{-- stat --}}
        <div class="stat grid grid-cols-1 md:grid-cols-4 gap-1 md:gap-3">

            <div class = 'stat-item bg-white w-full mt-2 md:mt-0 rounded-md shadow-md p-5 box-border'>
                <div class="flex justify-between items-end">
                    <div>
                        <p class="select-none">Đơn hàng chưa xử lý</p>
                        <p class="text-3xl font-semibold select-none mt-2 pending_num_stat">{{ $total_order_pending }}</p>
                    </div>
                    <div>
                        <i class="fa-solid fa-receipt text-5xl text-green-600"></i>
                    </div>
                </div>
                <a href="{{ route('admin.orders') }}"
                    class="text-blue-600 text-sm hover:underline underline-offset-2 mt-2 inline-block">Danh sách đơn hàng</a>
            </div>

            <x-stat-item href="#" stat_name="Doanh thu" number="{{ number_format($revenue, 0, ',', '.') . 'đ' }}"
                link_name="">
                <i class="fa-solid fa-sack-dollar text-5xl text-green-600"></i>
            </x-stat-item>
            <x-stat-item href="{{ route('admin.product.list') }}" stat_name="Tổng sản phẩm"
                number="{{ $total_product }}" link_name="Danh sách sản phẩm" class="hidden md:block">
                <i class="fa-brands fa-product-hunt text-5xl text-blue-600"></i>
            </x-stat-item>
            <x-stat-item href="{{ route('admin.post.list') }}" stat_name="Tổng bài viết" number="{{ $total_post }}"
                link_name="Danh sách bài viết" class="hidden md:block">
                <i class="fa-solid fa-pen-to-square text-5xl text-blue-600"></i>
            </x-stat-item>
        </div>

        <div class="data-table md:flex items-start gap-3 mt-3">
            {{-- new order --}}
            <div class="bg-white p-4 shadow-md rounded-md flex-1 overflow-x-auto md:col-span-2">
                <p class="font-semibold select-none px-1">Đơn hàng <span
                        class="ml-1 inline-block px-4 py-1 bg-blue-600/15 text-blue-600 rounded-md text-xs">Mới
                        nhất</span></p>
                <hr class="mt-3">
                <div class="new_orders_list">
                    @include('admin.partials.new_orders')
                </div>
            </div>

            {{-- out_of_stock --}}
            <div class="bg-white p-4 shadow-md rounded-md mt-3 md:mt-0">
                <p class="font-semibold select-none">Sản phẩm <span
                        class="ml-1 inline-block px-4 py-1 bg-amber-600/15 text-amber-600 rounded-md text-xs">Sắp hết
                        hàng</span></p>
                <hr class="mt-3">
                <div class="list-out-of-stock overflow-x-auto md:overflow-x-hidden">
                    @include('admin.partials.out_of_stock')
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
