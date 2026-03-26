<x-app-layout>

    {{-- Thông báo thành công --}}
    <x-flash-session key="status_complete"><i class="fa-solid fa-circle-check"></i></x-flash-session>

    {{-- topbar --}}
    <x-topbar-content>
        <x-breadcrum href="{{ route('admin.dashboard') }}" page_name="Danh sách sản phẩm" />
    </x-topbar-content>

    {{-- Tác vụ thêm --}}
    <div class="p-3">
        <div class="additional-task bg-white shadow-md p-3 rounded-md md:flex justify-between items-center">
            {{-- Thống kê --}}
            <div class="flex gap-2 text-xs md:text-sm md:w-[350px] justify-between md:justify-normal">
                <p class="select-none">
                    <span class="text-blue-700">Tất cả</span>
                    <span class="total_product font-semibold">({{ $total }})</span>
                </p>
                <p class="text-green-700 select-none">
                    <span>Hoạt động</span>
                    <span class="active_status_product text-gray-800 font-semibold">({{ $active_status }})</span>
                </p>
                <p class="text-red-700 select-none">
                    <span>Vô hiệu hóa</span>
                    <span class="unactive_status_product text-gray-800 font-semibold">({{ $unactive_status }})</span>
                </p>
                <p class="">
                    <a href="{{route('admin.product.trash')}}" class="underline">Đã xóa</a>
                    <span class="font-semibold select-none">({{ $total_trash }})</span>
                </p>
            </div>

            {{-- Tìm kiếm --}}
            <div class="hidden md:block">
                <form action="" method="POST" class="border-b w-full">
                    @csrf
                    <input type="text" placeholder="Nhập tên tìm kiếm..."
                        class="search_product text-sm border-0 outline-none ring-0 focus:border-0 focus:outline-none focus:ring-0 pl-0" />
                    <i class="fa-solid fa-magnifying-glass"></i>
                </form>
            </div>
            
            <div class="flex flex-col md:flex-row gap-1 mt-2 md:mt-0 text-center md:items-center">
                {{-- Lọc --}}
                <div>
                    <form action="" method="get" class="flex items-center font-semibold gap-2">
                        @csrf
                        <p class="select-none text-sm hidden md:block">Trạng thái</p>
                        <select name="filter_status_product" id="filter_status_user"
                            class="filter_status_product text-sm rounded-md py-1 focus:border-green-500 focus:ring-1 focus:ring-green-500 border-gray-500/30 shadow-sm md:w-[130px] w-full">
                            <option value="">Tất cả</option>
                            <option value="active">Hoạt động</option>
                            <option value="unactive">Vô hiệu hóa</option>
                        </select>
                    </form>
                </div>

                {{-- reset --}}
                <x-a-reset href=""><i class="fa-solid fa-rotate-left"></i>
                    Reset</x-a-reset>

                {{-- Thêm danh mục --}}
                <x-a-customize href="{{ route('admin.product.create') }}">
                    <i class="fa-solid fa-plus"></i>
                    <span>Thêm mới</span>
                </x-a-customize>

                {{-- Thùng rác --}}
                <x-a-trash href="{{route('admin.product.trash')}}">
                    <i class="fa-solid fa-trash"></i>
                    <span>Thùng rác</span>
                </x-a-trash>
            </div>
        </div>
    </div>

    {{-- Bảng --}}
    <div class="list_products p-3 pt-0 {{ session('status_failed') || session('status_complete') ? '' : 'animation_content_slide_up' }}">
        @include('admin.product.partials.list_normal')
    </div>

</x-app-layout>
