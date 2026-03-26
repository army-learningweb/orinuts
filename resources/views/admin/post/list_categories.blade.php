<x-app-layout>

    {{-- Thông báo thành công --}}
    <x-flash-session key="status_complete"><i class="fa-solid fa-circle-check"></i></x-flash-session>

    {{-- topbar --}}
    <x-topbar-content>
        <x-breadcrum href="{{ route('admin.dashboard') }}" page_name="Danh sách danh mục" />
    </x-topbar-content>

    {{-- Tác vụ thêm --}}
    <div class="p-3">
        <div class="additional-task bg-white shadow-md p-3 rounded-md md:flex justify-between items-center">
            {{-- Thống kê --}}
            <div class="flex gap-2 text-xs md:text-sm md:w-[350px] justify-between md:justify-normal">
                <p class="select-none">
                    <span class="text-blue-700">Tất cả</span>
                    <span class="total_categories font-semibold">({{ $total }})</span>
                </p>
                <p class="text-green-700 select-none">
                    <span>Hoạt động</span>
                    <span class="post_active_status_category text-gray-800 font-semibold">({{ $active_status }})</span>
                </p>
                <p class="text-red-700 select-none">
                    <span>Vô hiệu hóa</span>
                    <span class="post_unactive_status_category text-gray-800 font-semibold">({{ $unactive_status }})</span>
                </p>
                <p class="">
                    <a href="{{route('admin.post.categories.trash')}}" class="underline">Đã xóa</a>
                    <span class="font-semibold select-none">({{ $total_trash }})</span>
                </p>
            </div>

            {{-- Nút --}}
            <div class="flex flex-col md:flex-row gap-1 mt-2 md:mt-0 text-center">
                {{-- reset --}}
                <x-a-reset href=""><i class="fa-solid fa-rotate-left"></i>
                    Reset</x-a-reset>

                {{-- Thêm danh mục --}}
                <x-a-customize href="{{ route('admin.post.categories.create') }}">
                    <i class="fa-solid fa-plus"></i>
                    <span>Thêm danh mục</span>
                </x-a-customize>

                {{-- Thùng rác --}}
                <x-a-trash href="{{route('admin.post.categories.trash')}}">
                    <i class="fa-solid fa-trash"></i>
                    <span>Thùng rác</span>
                </x-a-trash>
            </div>
        </div>
    </div>

    {{-- Bảng --}}
    <div class="data-table list_categories p-3 pt-0">
        @include('admin.post.partials.list_categories_normal')
    </div>

</x-app-layout>
