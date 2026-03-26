<x-app-layout>

    <x-flash-session key="status_complete"><i class="fa-solid fa-circle-check"></i></x-flash-session>

    {{-- topbar --}}
    <x-topbar-content>
        <x-breadcrum href="{{ route('admin.dashboard') }}" page_name="Quản lí Quyền" />
    </x-topbar-content>

    {{-- manager area --}}
    <div class="md:flex items-start gap-3 p-3 
    {{ session('status_failed') || session('status_action_failed') || session('status_complete') || $errors->any() ? '' : 'animation_content_slide_up' }}">
        <div class="bg-white shadow-md rounded-md p-3 md:w-[40%]">
            <p class="text-[17px] font-semibold">Tạo quyền</p>
            <hr class="my-3">
            <form action="{{route('admin.permission.store')}}" method="post">
                @csrf
                
                {{-- Tên quyền --}}
                <div class="mt-2">
                    <x-label for="name">
                        <span>Tên quyền</span>
                        <span class="text-lg text-red-600">*</span>
                    </x-label>
                    <x-input type="text" name="name" id="name"/>
                    <x-error-php error_field="name" />
                    <x-error-ajax error_field="name" />
                </div>

                {{-- Tên quyền --}}
                <div class="mt-2">
                    <x-label for="slug">
                        <span>Slug</span>
                        <span class="text-lg text-red-600">*</span>
                    </x-label>
                    <x-input type="text" name="slug" id="slug"/>
                    <x-error-php error_field="slug" />
                    <x-error-ajax error_field="slug" />
                    <p class="text-xs text-gray-500 mt-2"> Ví dụ: post.add</p>
                </div>

                {{-- Tên quyền --}}
                <div class="mt-2">
                    <x-label for="desc">
                        <span>Mô tả</span>
                        <span class="text-xs text-gray-600">(Không bắt buộc)</span>
                    </x-label>
                    <textarea name="desc" id="desc" cols="30" rows="10" class="w-full border-gray-300 shadow-sm rounded-md mt-2 focus:ring-green-500 focus:border-green-500"></textarea>
                    <x-error-php error_field="desc" />
                    <x-error-ajax error_field="desc" />
                </div>

                <div class="mt-2">
                    <x-button-customize type="submit" class="w-full py-3 text-center"> Thêm mới </x-button-customize>
                </div>
            </form>
        </div>

        <div class="bg-white shadow-md rounded-md p-3 md:w-[60%] mt-3 md:mt-0">
                <div class="flex justify-between items-center">
                    <p class="text-[17px] font-semibold">Danh sách Quyền</p>
                </div>
                
                <hr class="my-3">

                <div class="list_menu">
                    @include('admin.permission.partials.list_normal')
                </div>
        </div>
    </div>


</x-app-layout>
