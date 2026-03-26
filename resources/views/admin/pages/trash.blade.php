<x-app-layout>

    {{-- Thông báo thành công --}}
    <x-flash-session key="status_complete">&nbsp;<i class="fa-solid fa-circle-check"></i></x-flash-session>

    {{-- topbar --}}
    <x-topbar-content>
        <x-breadcrum page_name="Thùng rác" href="{{ route('admin.pages.list') }}" />
    </x-topbar-content>

    {{-- Tác vụ thêm --}}
    <div class="additional-task p-3">
        <div class="bg-white shadow-md p-3 rounded-md flex md:flex-row flex-col  md:justify-between md:items-center ">
            {{-- Thống kê --}}
            <div class="flex md:text-sm text-xs gap-2">
                <p class="select-none">
                    <span class="text-blue-700">Tất cả</span>
                    <span class="total_users font-semibold">({{ $total }})</span>
                </p>
            </div>

            {{-- Tìm kiếm --}}
            <div class="hidden md:block">
                <form action="" method="POST" class="border-b w-full">
                    @csrf
                    <input type="text" placeholder="Nhập tên tìm kiếm..."
                        class="search_page_trash text-sm border-0 outline-none ring-0 focus:border-0 focus:outline-none focus:ring-0 pl-0" />
                    <i class="fa-solid fa-magnifying-glass"></i>
                </form>
            </div>

            {{-- Quay lại --}}
            <x-a-reset href="{{ route('admin.pages.list') }}" class="px-5 w-full md:w-auto mt-2 md:mt-0 text-center">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Quay lại</span>
            </x-a-reset>
        </div>
    </div>
    {{-- Bảng --}}
    <div
        class="list_pages p-3 pt-0 {{ session('status_failed') || session('status_complete') ? '' : 'animation_content_slide_up' }} ">
        @include('admin.pages.partials.list_trash')
    </div>

</x-app-layout>
