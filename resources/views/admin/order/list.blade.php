<x-app-layout>

    {{-- Thông báo thành công --}}
    <x-flash-session key="status_complete">&nbsp;<i class="fa-solid fa-circle-check"></i></x-flash-session>

    {{-- topbar --}}
    <x-topbar-content>
        <x-breadcrum page_name="Danh sách đơn hàng" href="{{ route('admin.dashboard') }}" />
    </x-topbar-content>

    {{-- Tác vụ thêm --}}
    <div class="additional-task p-3">
        <div class="bg-white shadow-md p-3 rounded-md md:flex md:justify-between md:items-center ">
            {{-- Thống kê --}}
            <div class="flex md:text-sm gap-2 justify-between md:justify-normal">
                <p class="select-none hidden md:block">
                    <span class="">Tất cả</span>
                    <span class="total_orders font-semibold">({{ $total }})</span>
                </p>
                <p class="text-gray-500 select-none">
                    <span>Chờ xử lý</span>
                    <span class="pending_status text-gray-800 font-semibold">({{ $pending_status }})</span>
                </p>
                <p class="text-blue-600 select-none">
                    <span>Đang xử lý</span>
                    <span class="processing_status text-gray-800 font-semibold">({{ $processing_status }})</span>
                </p>
                <p class="text-amber-600 select-none hidden md:block">
                    <span>Đang giao</span>
                    <span class="shipped_status text-gray-800 font-semibold">({{ $shipped_status }})</span>
                </p>
                <p class="text-green-600 select-none">
                    <span>Đã nhận</span>
                    <span class="delivered_status text-gray-800 font-semibold">({{ $delivered_status }})</span>
                </p>
                <p class="text-red-600 select-none hidden md:block">
                    <span>Đã hủy</span>
                    <span class="canceled_status text-gray-800 font-semibold">({{ $canceled_status }})</span>
                </p>
            </div>
            {{-- Tìm kiếm --}}
            <div class="hidden md:block">
                <form action="" method="POST" class="border-b w-full">
                    @csrf
                    <input type="text" placeholder="Nhập mã đơn hoặc số điện thoại..."
                        class="md:w-[220px] search_order text-sm border-0 outline-none ring-0 focus:border-0 focus:outline-none focus:ring-0 pl-0" />
                    <i class="fa-solid fa-magnifying-glass"></i>
                </form>
            </div>
            {{-- Bộ lọc --}}
            <div class="flex flex-col md:flex-row gap-1 md:mt-1 mt-3">
                <form action="" method="POST" class="flex items-center font-semibold gap-1">
                    @csrf
                     <select name="filter_status_date" id="filter_status_date"
                        class="filter_status_date text-sm rounded-md py-1 focus:border-green-500 focus:ring-1 focus:ring-green-500 border-gray-500/30 shadow-sm md:w-[170px] w-full">
                        <option value="">Thời gian</option>
                        <option value="7">Gần nhất (7 ngày)</option>
                    </select>
                    
                    <select name="filter_status_order" id="filter_status_order"
                        class="filter_status_order text-sm rounded-md py-1 focus:border-green-500 focus:ring-1 focus:ring-green-500 border-gray-500/30 shadow-sm md:w-[170px] w-full">
                        <option value="">Trạng thái</option>
                        <option value="pending">Chờ xử lý</option>
                        <option value="processing">Đang xử lý</option>
                        <option value="shipped">Đang giao</option>
                        <option value="delivered">Đã nhận</option>
                        <option value="canceled">Đã hủy</option>
                    </select>
                </form>
                {{-- reset --}}
                <x-a-reset href="" class="text-center"><i class="fa-solid fa-rotate-left"></i> Reset</x-a-reset>
                {{-- Thùng rác --}}
            </div>
        </div>
    </div>
    {{-- Bảng --}}
    <div
        class="list_orders p-3 pt-0 {{ session('status_failed') || session('status_complete') ? '' : 'animation_content_slide_up' }} ">
        @include('admin.order.partials.list_normal')
    </div>

</x-app-layout>
