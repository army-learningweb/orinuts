<x-app-layout>

    {{-- Thông báo thành công --}}
    <x-flash-session key="status_complete">&nbsp;<i class="fa-solid fa-circle-check"></i></x-flash-session>

    {{-- topbar --}}
    <x-topbar-content>
        <x-breadcrum page_name="Danh sách trang" href="{{ route('admin.dashboard') }}" />
    </x-topbar-content>

    {{-- Tác vụ thêm --}}
    <div class="additional-task p-3">
        <div class="bg-white shadow-md p-3 rounded-md md:flex md:justify-between md:items-center ">
            {{-- Thống kê --}}
            <div class="flex md:text-sm text-xs gap-2 justify-between md:justify-normal">
                <p class="select-none">
                    <span class="text-blue-700">Tất cả</span>
                    <span class="total_pages font-semibold">({{$total}})</span>
                </p>
                <p class="text-green-700 select-none">
                    <span>Công khai</span>
                    <span class="publish_status text-gray-800 font-semibold">({{$publish_status}})</span>
                </p>
                <p class="text-gray-600 select-none">
                    <span>Nháp</span>
                    <span class="draft_status text-gray-800 font-semibold">({{$draft_status}})</span>
                </p>
                <p class="text-red-700 select-none">
                    <span>Vô hiệu hóa</span>
                    <span class="disable_status text-gray-800 font-semibold">({{$disable_status}})</span>
                </p>
            </div>
            {{-- Tìm kiếm --}}
            <div class="hidden md:block">
                <form action="" method="POST" class="border-b w-full">
                    @csrf
                    <input type="text" placeholder="Nhập tên tìm kiếm..."
                        class="search_page text-sm border-0 outline-none ring-0 focus:border-0 focus:outline-none focus:ring-0 pl-0" />
                    <i class="fa-solid fa-magnifying-glass"></i>
                </form>
            </div>
            {{-- Bộ lọc --}}
            <div class="flex flex-col md:flex-row gap-1 md:mt-2 mt-3">
                <form action="" method="POST" class="flex items-center font-semibold gap-2">
                    @csrf
                    <p class="select-none text-sm hidden md:block">Trạng thái</p>
                    <select name="filter_status_page" id="filter_status_page"
                        class="filter_status_page text-sm rounded-md py-1 focus:border-green-500 focus:ring-1 focus:ring-green-500 border-gray-500/30 shadow-sm md:w-[130px] w-full">
                        <option value="">Tất cả</option>
                        <option value="publish">Công khai</option>
                        <option value="draft">Nháp</option>
                        <option value="disable">Vô hiệu hóa</option>
                    </select>
                </form>
                {{-- reset --}}
                <x-a-reset href="" class="text-center"><i
                        class="fa-solid fa-rotate-left"></i> Reset</x-a-reset>
                {{-- Thêm trang --}}
                <x-a-customize href="{{ route('admin.pages.create') }}" class="text-center">
                    <i class="fa-solid fa-plus"></i>
                    <span>Thêm mới</span>
                </x-a-customize>
                {{-- Thùng rác --}}
                <x-a-trash href="{{route('admin.pages.trash')}}" class="text-center">
                    <i class="fa-solid fa-trash"></i>
                    <span>Thùng rác</span>
                </x-a-trash>
            </div>
        </div>
    </div>
    {{-- Bảng --}}
    <div class="list_pages p-3 pt-0 {{ session('status_failed') || session('status_complete') ? '' : 'animation_content_slide_up' }} ">
        @include('admin.pages.partials.list_normal')
    </div>

</x-app-layout>
