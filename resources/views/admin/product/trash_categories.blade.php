<x-app-layout>

    {{-- Thông báo thành công --}}
    <x-flash-session key="status_complete"><i class="fa-solid fa-circle-check"></i></x-flash-session>

    {{-- topbar --}}
     <x-topbar-content>
        <x-breadcrum href="{{ route('admin.product.categories.list') }}" page_name="Thùng rác" />
    </x-topbar-content>

    {{-- Tác vụ thêm --}}
    <div class="p-3">
        <div class="additional-task bg-white shadow-md p-4 rounded-md flex justify-between items-center">

            {{-- Thống kê --}}
            <div class="flex text-sm gap-2">
                <p class="select-none">
                    <span class="text-blue-700">Tất cả</span>
                    <span class="total_users font-semibold">({{ $total }})</span>
                </p>
            </div>
            {{-- quay lại --}}
            <div>
                <x-a-reset href="{{ route('admin.product.categories.list') }}" class="px-5">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span>Quay lại</span>
                </x-a-reset>
            </div>
        </div>
        
    </div>

    {{-- Bảng --}}
    <div class="data-table p-3 pt-0">
        @include('admin.product.partials.list_categories_trash')
    </div>

</x-app-layout>
