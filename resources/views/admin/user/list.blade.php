<x-app-layout>

    {{-- Thông báo thành công --}}
    <x-flash-session key="status_complete">&nbsp;<i class="fa-solid fa-circle-check"></i></x-flash-session>

    {{-- topbar --}}
    <x-topbar-content>
        <x-breadcrum page_name="Danh sách thành viên" href="{{ route('admin.dashboard') }}" />
    </x-topbar-content>

    {{-- Tác vụ thêm --}}
    <div class="additional-task p-3">
        <div class="bg-white shadow-md p-3 rounded-md md:flex md:justify-between md:items-center ">
            {{-- Thống kê --}}
            <div class="flex md:text-sm text-xs gap-2">
                <p class="select-none">
                    <span class="text-blue-700">Tất cả</span>
                    <span class="total_users font-semibold">({{ $total_users }})</span>
                </p>
                <p class="text-green-700 select-none">
                    <span>Hoạt động</span>
                    <span class="active_status text-gray-800 font-semibold">({{ $active_status }})</span>
                </p>
                <p class="text-red-700 select-none">
                    <span>Đình chỉ</span>
                    <span class="subpended_status text-gray-800 font-semibold">({{ $subpended_status }})</span>
                </p>
                <p class="text-amber-600 select-none">
                    <span>Chưa kích hoạt</span>
                    <span class="unactive_status text-gray-800 font-semibold">({{ $unactive_status }})</span>
                </p>
            </div>
            {{-- Tìm kiếm --}}
            <div class="hidden md:block">
                <form action="" method="POST" class="border-b w-full">
                    @csrf
                    <input type="text" placeholder="Nhập tên tìm kiếm..."
                        class="search_user text-sm border-0 outline-none ring-0 focus:border-0 focus:outline-none focus:ring-0 pl-0" />
                    <i class="fa-solid fa-magnifying-glass"></i>
                </form>
            </div>
            {{-- Bộ lọc --}}
            <div class="md:flex gap-1 md:mt-2 mt-3">
                <form action="" method="POST" class="flex items-center font-semibold gap-2">
                    @csrf
                    <p class="select-none text-sm hidden md:block">Trạng thái</p>
                    <select name="filter_status_user" id="filter_status_user"
                        class="filter_status_user w-full text-sm rounded-md py-1 focus:border-green-500 focus:ring-1 focus:ring-green-500 border-gray-500/30 shadow-sm md:w-[130px]">
                        <option value="">Tất cả</option>
                        <option value="active">Hoạt động</option>
                        <option value="subpended">Đình chỉ</option>
                        <option value="unactive">Chưa kích hoạt</option>
                    </select>
                </form>
                {{-- reset --}}
                <x-a-reset href="{{ route('admin.users.list') }}" class="hidden md:block"><i
                        class="fa-solid fa-rotate-left"></i> Reset</x-a-reset>
                {{-- Thêm thành viên --}}
                <x-a-customize href="{{ route('admin.users.create') }}" class="hidden md:block">
                    <i class="fa-solid fa-plus"></i>
                    <span>Thêm thành viên</span>
                </x-a-customize>
                {{-- Thùng rác --}}
                <x-a-trash href="{{ route('admin.users.trash') }}" class="mt-1 md:mt-0 inline-block w-full text-center md:w-auto">
                    <i class="fa-solid fa-trash"></i>
                    <span>Thùng rác</span>
                </x-a-trash>

            </div>
        </div>
    </div>
    {{-- Bảng --}}
    <div class="data-table list_users p-3 pt-0 {{ session('status_failed') || session('status_complete') ? '' : 'animation_content_slide_up' }} ">
        @include('admin.user.partials.list_normal')
    </div>

</x-app-layout>
