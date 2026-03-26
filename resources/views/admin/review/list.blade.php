<x-app-layout>

    {{-- Thông báo thành công --}}
    <x-flash-session key="status_complete">&nbsp;<i class="fa-solid fa-circle-check"></i></x-flash-session>

    {{-- topbar --}}
    <x-topbar-content>
        <x-breadcrum page_name="Đánh giá về sản phẩm" href="{{ route('admin.dashboard') }}" />
    </x-topbar-content>

    {{-- Tác vụ thêm --}}
    <div class="additional-task p-3">
        <div class="bg-white shadow-md p-3 rounded-md md:flex md:justify-between md:items-center ">
            {{-- Thống kê --}}
            <div class="flex md:text-sm text-xs gap-2">
                <p class="select-none">
                    <span class="text-blue-700">Tất cả</span>
                    <span class="total_reviews font-semibold">({{$total_review}})</span>
                </p>
                <p class="text-gray-500 select-none">
                    <span>Chờ xử lý</span>
                    <span class="pending_status_review text-gray-800 font-semibold">({{ $pending_status }})</span>
                </p>
                <p class="text-green-500 select-none">
                    <span>Công khai</span>
                    <span class="publish_status_review text-gray-800 font-semibold">({{ $publish_status }})</span>
                </p>
                <p class="text-red-700 select-none">
                    <span>Vô hiệu hóa</span>
                    <span class="canceled_status_review text-gray-800 font-semibold">({{ $canceled_status }})</span>
                </p>
               
            </div>

            <div class="flex gap-5 items-center">
                 {{-- Tìm kiếm --}}
                <div class="hidden md:block">
                    <form action="" method="POST" class="border-b w-full">
                        @csrf
                        <input type="text" placeholder="Nhập họ tên ..."
                            class="search_review text-sm border-0 outline-none ring-0 focus:border-0 focus:outline-none focus:ring-0 pl-0" />
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </form>
                </div>

                <div class="md:flex gap-1 md:mt-0 mt-3">
                {{-- reset --}}
                <x-a-reset href="{{ route('admin.reviews') }}" class="hidden md:block"><i class="fa-solid fa-rotate-left"></i> Reset</x-a-reset>
                </div>
            </div>
           
        </div>
    </div>
    {{-- Bảng --}}
    <div class="data-table list_reviews p-3 pt-0 {{ session('status_failed') || session('status_complete') ? '' : 'animation_content_slide_up' }} ">
        @include('admin.review.partials.list_normal')
    </div>

</x-app-layout>
