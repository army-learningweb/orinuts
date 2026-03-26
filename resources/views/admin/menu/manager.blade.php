<x-app-layout>

    <x-flash-session key="status_complete"><i class="fa-solid fa-circle-check"></i></x-flash-session>

    {{-- topbar --}}
    <x-topbar-content>
        <x-breadcrum href="{{ route('admin.dashboard') }}" page_name="Quản lí Menu" />
    </x-topbar-content>

    {{-- manager area --}}
    <div class="md:flex items-start gap-3 p-3 
    {{ session('status_failed') || session('status_action_failed') || session('status_complete') || $errors->any() ? '' : 'animation_content_slide_up' }}">
        <div class="bg-white shadow-md rounded-md p-3 md:w-[30%]">
            <p class="text-[17px] font-semibold">Tạo Menu</p>
            <hr class="my-3">
            <form action="{{route('admin.menu.store')}}" method="post">
                @csrf

                <p class=" text-gray-500 text-sm select-none">Chọn 1 trong 3 liên kết để liên kết đến Menu</p>
                <x-flash-session-normal key="status_failed" class="text-red-700 mt-4 md:mt-2 text-sm">
                    <i class="fa-solid fa-circle-exclamation"></i>
                </x-flash-session-normal>

                {{-- Trang --}}
                <div class="mt-2">
                    <x-label for="page">
                        <span>Trang</span>
                    </x-label>
                    <x-select name="page" id="page" class="mt-2">
                        <option value="">- Chọn trang -</option>
                        @foreach ($pages as $page)
                            <option value="{{$page->id}}" {{ old('page') == $page->id ? 'selected' : '' }} 
                            > {{ $page->title }} </option>
                        @endforeach
                    </x-select>
                    <x-error-php error_field="page" />
                </div>

                {{-- danh mục sản phẩm --}}
                <div class="mt-2">
                    <x-label for="product">
                        <span>Danh mục sản phẩm</span>
                    </x-label>
                    <x-select name="product" id="product" class="mt-2">
                        <option value="">- Chọn danh mục -</option>
                        @foreach ($product_categories as $cat)
                            <option value="{{$cat->id}}" class="{{$cat->parent_id == 0 ? 'font-semibold' : ''}}" {{ old('product') == $cat->id ? 'selected' : '' }}
                            > {{ $cat->name }} </option>
                        @endforeach
                    </x-select>
                    <x-error-php error_field="product" />
                </div>

                {{-- Danh mục bài viết --}}
                <div class="mt-2">
                    <x-label for="post">
                        <span>Danh mục bài viết</span>
                    </x-label>
                    <x-select name="post" id="post" class="mt-2">
                        <option value="">- Chọn danh mục -</option>
                         @foreach ($post_categories as $cat)
                            <option value="{{$cat->id}}" class="{{$cat->parent_id == 0 ? 'font-semibold' : ''}}" {{ old('post') == $cat->id ? 'selected' : '' }}
                            > {{ $cat->name }} </option>
                        @endforeach
                    </x-select>
                    <x-error-php error_field="post" />
                </div> 

                <hr class="my-3">

                {{-- Menu cha --}}
                <div class="parent_id">
                    <x-label for="parent_id">
                        <span>Chọn Menu cha</span>
                        <span class="text-xs text-gray-600">(Bỏ qua nếu bạn đang tạo menu cha)</span>
                    </x-label>
                    <x-select name="parent_id" id="parent_id" class="mt-2">
                        <option value="">- Chọn Menu cha -</option>
                        @foreach ($menus as $menu)
                            <option value="{{$menu->id}}" class="{{$menu->parent_id == 0 ? 'font-semibold' : ''}} {{$menu->level == 2 ? 'hidden' : ''}}" {{ old('parent_id') == $menu->id ? 'selected' : '' }}>
                                {{$menu->name}} 
                            </option>
                        @endforeach
                    </x-select>
                    <x-error-php error_field="parent_id" />
                </div>
                
                {{-- Thứ tự hiển thị --}}
                <div class="mt-2">
                    <x-label for="order">
                        <span>Thứ tự hiển thị</span>
                        <span class="text-lg text-red-600">*</span>
                    </x-label>
                    <x-input type="number" name="order" id="order" min="1"/>
                    <x-error-php error_field="order" />
                    <x-error-ajax error_field="order" />
                </div>

                {{-- Trạng thái --}}
                <div class="mt-2">
                    <x-label for="post_cat">
                        <span>Trạng thái</span>
                    </x-label>
                    <x-select name="status" id="status" class="mt-2">
                        <option value="active">Hoạt động</option>
                        <option value="disable">Vô hiệu hóa</option>
                    </x-select>
                    <x-error-php error_field="status" />
                </div>

                <div class="mt-3">
                    <x-button-customize type="submit" class="w-full py-3 text-center"> Thêm mới </x-button-customize>
                </div>
            </form>
        </div>

        <div class="bg-white shadow-md rounded-md p-3 md:w-[70%] mt-3 md:mt-0">
                <div class="flex justify-between items-center">
                    <p class="text-[17px] font-semibold">Danh sách Menu</p>
                    <p class="italic text-gray-600 hidden md:block">Lưu ý liên kết khi xóa, Xóa cha sẽ xóa luôn tất cả con !</p>
                </div>
                
                <hr class="my-3">

                <div class="list_menu md:max-h-[550px] overflow-y-auto">
                    @include('admin.menu.partials.list_normal')
                </div>
        </div>
    </div>


</x-app-layout>
