<x-app-layout>

    {{-- Thông báo thành công --}}
    <x-flash-session key="status_complete"><i class="fa-solid fa-circle-check"></i></x-flash-session>

    {{-- topbar --}}
    <x-topbar-content>
        <x-breadcrum href="{{ route('admin.product.list') }}" page_name="Thùng rác" />
    </x-topbar-content>

    {{-- Tác vụ thêm --}}
    <div class="p-3">
        <div class="additional-task bg-white shadow-md p-3 rounded-md md:flex justify-between items-center">
            {{-- Thống kê --}}
            <div class="flex gap-2 text-xs md:text-sm">
                <p class="select-none">
                    <span class="text-blue-700">Tất cả</span>
                    <span class="total_product font-semibold">({{$total}})</span>
                </p>
            </div>

            {{-- Tìm kiếm --}}
            <div class="hidden md:block">
                <form action="" method="POST" class="border-b w-full">
                    @csrf
                    <input type="text" placeholder="Nhập tên tìm kiếm..."
                        class="search_product_trash text-sm border-0 outline-none ring-0 focus:border-0 focus:outline-none focus:ring-0 pl-0" />
                    <i class="fa-solid fa-magnifying-glass"></i>
                </form>
            </div>
            
            <div class="flex flex-col md:flex-row gap-2 mt-2 md:mt-0 text-center">
                {{-- reset --}}
                <x-a-reset href="">
                    <i class="fa-solid fa-rotate-left"></i>
                    Reset
                </x-a-reset>

                {{-- Quay lại --}}
                <x-a-reset href="{{ route('admin.product.list') }}" class="px-5 w-full md:w-auto">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span>Quay lại</span>
                </x-a-reset>
            </div>
        </div>
    </div>

    {{-- Bảng --}}
    <div class="data-table list_products p-3 pt-0 {{ session('status_failed') || session('status_complete') ? '' : 'animation_content_slide_up' }}">
        @include('admin.product.partials.list_trash')
    </div>

</x-app-layout>
