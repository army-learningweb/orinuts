<x-app-layout>

    {{-- Thông báo thành công --}}
    <x-flash-session key="status_complete">&nbsp;<i class="fa-solid fa-circle-check"></i></x-flash-session>

    {{-- topbar --}}
    <x-topbar-content>
        <x-breadcrum page_name="Danh sách khách mua hàng" href="{{ route('admin.dashboard') }}" />
    </x-topbar-content>

    {{-- Tác vụ thêm --}}
    <div class="additional-task p-3">
        <div class="bg-white shadow-md p-3 rounded-md md:flex md:justify-between md:items-center ">
            {{-- Thống kê --}}
            <div class="flex md:text-sm text-xs gap-2">
                <p class="select-none">
                    <span class="text-blue-700">Tất cả</span>
                    <span class="total_users font-semibold">({{ $total_customers }})</span>
                </p>
            </div>

            {{-- Tìm kiếm --}}
            <div class="hidden md:block">
                <form action="" method="POST" class="border-b w-full">
                    @csrf
                    <input type="text" placeholder="Nhập tên tìm kiếm..."
                        class="search_customer text-sm border-0 outline-none ring-0 focus:border-0 focus:outline-none focus:ring-0 pl-0" />
                    <i class="fa-solid fa-magnifying-glass"></i>
                </form>
            </div>

            <div class="md:flex gap-1 md:mt-0 mt-3">
                {{-- reset --}}
                <x-a-reset href="{{ route('admin.customers') }}" class="hidden md:block"><i class="fa-solid fa-rotate-left"></i> Reset</x-a-reset>
                
                {{-- Thùng rác --}}
                <x-a-trash href="{{ route('admin.customers.trash') }}" class="mt-1 md:mt-0 inline-block w-full text-center md:w-auto">
                    <i class="fa-solid fa-trash"></i>
                    <span>Thùng rác</span>
                </x-a-trash>
            </div>
        </div>
    </div>
    {{-- Bảng --}}
    <div class="data-table list_customers p-3 pt-0 {{ session('status_failed') || session('status_complete') ? '' : 'animation_content_slide_up' }} ">
        @include('admin.customer.partials.list_normal')
    </div>

</x-app-layout>
