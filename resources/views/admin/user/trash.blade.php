<x-app-layout>

    {{-- Thông báo xóa vĩnh viễn thành công --}}
    <x-flash-session key="status_complete"><i class="fa-solid fa-circle-check"></i></x-flash-session>

    {{-- topbar --}}
    <x-topbar-content>
        <x-breadcrum href="{{ route('admin.users.list') }}" page_name="Thùng rác" class="flex items-center" />
    </x-topbar-content>

    {{-- Tác vụ thêm --}}
    <div class="additional-task p-3">
        <div class="bg-white shadow-md p-3 rounded-md flex justify-between items-center">

            {{-- Thống kê --}}
            <div class="flex text-sm gap-2">
                <p class="select-none">
                    <span class="text-blue-700">Tất cả</span>
                    <span class="total_users font-semibold">({{ $total_users }})</span>
                </p>
            </div>

            {{-- Tìm kiếm --}}
            <div class="border-b hidden md:block">
                <form action="" method="POST">
                    @csrf
                    <input type="text" placeholder="Nhập tên tìm kiếm..."
                        class="search_user_trash text-sm border-0 outline-none ring-0 focus:border-0 focus:outline-none focus:ring-0 pl-0" />
                    <i class="fa-solid fa-magnifying-glass"></i>
                </form>
            </div>

            {{-- quay lại --}}
            <div>
                <x-a-reset href="{{ route('admin.users.list') }}" class="px-5">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span>Quay lại</span>
                </x-a-reset>
            </div>
        </div>
    </div>

    {{-- Bảng --}}
    <div class="data-table list_users p-3 pt-0 {{ session('status_failed') || session('status_complete')  ? '' : 'animation_content_slide_up' }}">
        @include('admin.user.partials.list_trash')
    </div>

</x-app-layout>
