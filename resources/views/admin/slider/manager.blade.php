<x-app-layout>

    <x-flash-session key="status_complete"><i class="fa-solid fa-circle-check"></i></x-flash-session>

    {{-- topbar --}}
    <x-topbar-content>
        <x-breadcrum href="{{ route('admin.dashboard') }}" page_name="Quản lí ảnh Slider" />
    </x-topbar-content>

    {{-- manager area --}}
    <div class="md:flex items-start gap-3 p-3 
    {{ session('status_failed') || session('status_action_failed') || session('status_complete') || request()->input('list') ? '' : 'animation_content_slide_up' }}">
        <div class="bg-white shadow-md rounded-md p-3 md:w-[45%]">
            <p class="text-[17px] font-semibold">Thêm ảnh cho Slider</p>
            <hr class="my-3">
            <form action="{{ route('admin.sliders.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                {{-- main img --}}
                <div class="mt-4">
                    <div
                        class="relative border bg-gray-100 border-gray-200 py-2 rounded-md h-[250px] shadow-sm overflow-hidden flex flex-col justify-center items-center">
                        <input type="file" name="file[]" id="file" class="file hidden" role="main_img_slider"
                            data-id="id_main_slider" data-module="slider">
                        <i class="delete_img fa-solid fa-xmark text-lg absolute right-2 top-2 text-gray-400 cursor-pointer z-40 hover:text-gray-800 {{ session('main_img_slider') ? '' : 'hidden' }}"
                            data-module="slider"></i>
                        <x-label for="file"
                            class="bg-gray-100 h-full w-full rounded-md flex items-center justify-center cursor-pointer {{ session('main_img_slider') ? 'hidden' : '' }}">
                            <i class="upload_img fa-solid fa-cloud-arrow-up text-5xl text-gray-500"></i>
                        </x-label>
                        <img src="{{ session('main_img_slider') ? asset(session('main_img_slider')) : '' }}"
                            alt="" class="max-h-full rounded-md url_img_slider">
                        <input type="hidden" name="img_id[]"
                            value="{{ session('id_main_slider') ? session('id_main_slider') : '' }}"
                            class="id_img_slider">
                        <span class="file_error text-red-600 error-text text-xs absolute bottom-2"></span>
                    </div>

                    <x-error-php error_field="file" />

                    <x-flash-session-normal key="status_failed" class="text-red-700 mt-2 md:mt-3">
                        <i class="fa-solid fa-circle-exclamation"></i>
                    </x-flash-session-normal>
                </div>

                {{-- Tiêu đề --}}
                <div class="mt-2">
                    <x-label for="title">
                        <span>Tiêu đề</span>
                        <span class="text-xs text-gray-600">(Không bắt buộc)</span>
                    </x-label>
                    <x-input type="text" name="title" id="title" />
                    <x-error-php error_field="title" />
                    <x-error-ajax error_field="title" />
                </div>

                {{-- Mô tả --}}
                <div class="mt-2">
                    <x-label for="desc">
                        <span>Mô tả</span>
                        <span class="text-xs text-gray-600">(Không bắt buộc)</span>
                    </x-label>
                    <x-input type="text" name="desc" id="desc" />
                    <x-error-php error_field="desc" />
                    <x-error-ajax error_field="desc" />
                </div>

                {{-- Link chuyển hướng --}}
                <div class="mt-2">
                    <x-label for="redirect_url">
                        <span>URL chuyển hướng</span>
                        <span class="text-xs text-gray-600">(Không bắt buộc)</span>
                    </x-label>
                    <x-input type="text" name="redirect_url" id="redirect_url" />
                    <x-error-php error_field="redirect_url" />
                    <x-error-ajax error_field="redirect_url" />
                </div>

                {{-- Thứ tự hiển thị --}}
                <div class="mt-2">
                    <x-label for="order">
                        <span>Thứ tự hiển thị</span>
                        <span class="text-lg text-red-600">*</span>
                    </x-label>
                    <x-input type="number" name="order" id="order" />
                    <x-error-php error_field="order" />
                    <x-error-ajax error_field="order" />
                </div>

                {{-- Trạng thái --}}
                <div class="mt-2">
                    <x-label for="post_cat">
                        <span>Trạng thái</span>
                    </x-label>
                    <x-select name="status" id="status" class="mt-1">
                        <option value="publish">Công khai</option>
                        <option value="disable">Vô hiệu hóa</option>
                    </x-select>
                    <x-error-php error_field="status" />
                </div>

                <div class="mt-3">
                    <x-button-customize type="submit" class="w-full py-3 text-center"> Thêm mới </x-button-customize>
                </div>
            </form>
        </div>

        <div class="bg-white shadow-md rounded-md p-3 md:w-[55%] mt-3 md:mt-0">
                <div class="flex flex-col md:flex-row md:justify-between justify-start md:items-center items-start gap-2 md:gap-0">

                    @if (request()->input('list') == 'trash')
                        <p class="text-[17px] font-semibold">Thùng rác</p>
                    @else
                        <p class="text-[17px] font-semibold">Danh sách ảnh</p>
                    @endif

            
                    @if (request()->input('list') == 'trash')
                        {{-- Quay lại --}}
                        <x-a-reset href="{!! request()->fullUrlWithQuery(['list'=>'normal']) !!}" class="px-5 w-full md:w-auto">
                            <i class="fa-solid fa-arrow-left"></i>
                            <span>Quay lại</span>
                        </x-a-reset>
                    @else
                        {{-- Thùng rác --}}
                        <x-a-trash href="{!! request()->fullUrlWithQuery(['list'=>'trash']) !!}">
                            <i class="fa-solid fa-trash"></i>
                            <span>Thùng rác</span>
                        </x-a-trash>
                    @endif
                </div>
                
                <hr class="my-3">

                <div class="list_sliders">
                    @include('admin.slider.partials.list_normal')
                </div>
        </div>
    </div>


</x-app-layout>
