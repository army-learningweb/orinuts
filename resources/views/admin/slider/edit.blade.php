<x-app-layout>

    <x-flash-session key="status_complete"><i class="fa-solid fa-circle-check"></i></x-flash-session>

    {{-- topbar --}}
    <x-topbar-content>
        <x-breadcrum href="{{ route('admin.sliders.manager') }}" page_name="Cập nhật thông tin" />
    </x-topbar-content>

    {{-- manager area --}}
    <div class="md:flex items-start gap-3 p-3 
    {{ session('status_failed') || session('status_action_failed') || session('status_complete') || $errors->any() || request()->input('list') ? '' : 'animation_content_slide_up' }}">
        <div class="bg-white shadow-md rounded-md p-3 md:w-[45%]">
            <form action="{{route('admin.sliders.update',$slider_info->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                {{-- main img --}}
                <div class="">
                    <div
                        class="relative border bg-gray-100 border-gray-200 py-2 rounded-md h-[250px] shadow-sm overflow-hidden flex flex-col justify-center items-center">
                        <input type="file" name="file[]" id="file" class="file hidden" role="main_img_slider"
                            data-id="id_main_slider" data-module="slider">
                        <i class="remove_img fa-solid fa-xmark text-lg absolute right-2 top-2 text-gray-400 cursor-pointer z-40 hover:text-gray-800 {{ $slider_info->media->url ? '' : 'hidden' }} "
                            data-module="slider"></i>
                        <x-label for="file"
                            class="bg-gray-100 h-full w-full rounded-md flex items-center justify-center cursor-pointer {{ $slider_info->media->url ? 'hidden' : '' }}">
                            <i class="upload_img fa-solid fa-cloud-arrow-up text-5xl text-gray-500"></i>
                        </x-label>
                        <img src="{{ asset($slider_info->media->url) }}"
                            alt="" class="max-h-full rounded-md url_img_slider">
                        <input type="hidden" name="img_id[]"
                            value="{{ $slider_info->media->id }}"
                            class="id_img_slider">
                        <input type="hidden" name="old_img_id[]" value="{{ $slider_info->media->id }}">
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
                    <x-input type="text" name="title" id="title" value="{{old('title',$slider_info->title)}}" placeholder="{{$slider_info->title ? '' : 'Chưa có nội dung'}}"/>
                    <x-error-php error_field="title" />
                    <x-error-ajax error_field="title" />
                </div>

                {{-- Mô tả --}}
                <div class="mt-2">
                    <x-label for="desc">
                        <span>Mô tả</span>
                        <span class="text-xs text-gray-600">(Không bắt buộc)</span>
                    </x-label>
                    <x-input type="text" name="desc" id="desc"  value="{{old('desc',$slider_info->desc)}}" placeholder="{{$slider_info->title ? '' : 'Chưa có nội dung'}}"/>
                    <x-error-php error_field="desc" />
                    <x-error-ajax error_field="desc" />
                </div>

                {{-- Link chuyển hướng --}}
                <div class="mt-2">
                    <x-label for="redirect_url">
                        <span>URL chuyển hướng</span>
                        <span class="text-xs text-gray-600">(Không bắt buộc)</span>
                    </x-label>
                    <x-input type="text" name="redirect_url" id="redirect_url"  value="{{old('redirect_url',$slider_info->redirect_url)}}" placeholder="{{$slider_info->title ? '' : 'Chưa có nội dung'}}"/>
                    <x-error-php error_field="redirect_url" />
                    <x-error-ajax error_field="redirect_url" />
                </div>

                {{-- Thứ tự hiển thị --}}
                <div class="mt-2">
                    <x-label for="order">
                        <span>Thứ tự hiển thị</span>
                        <span class="text-lg text-red-600">*</span>
                    </x-label>
                    <x-input type="number" name="order" id="order"  value="{{old('order',$slider_info->order)}}" placeholder="{{$slider_info->title ? '' : 'Chưa có nội dung'}}"/>
                    <x-error-php error_field="order" />
                    <x-error-ajax error_field="order" />
                </div>

                {{-- Trạng thái --}}
                <div class="mt-2">
                    <x-label for="status">
                        <span>Trạng thái</span>
                    </x-label>
                    <x-select name="status" id="status" class="mt-1">
                        <option value="publish" {{$slider_info->status == 'publish' ? 'selected' : ''}} >Công khai</option>
                        <option value="disable" {{$slider_info->status == 'disable' ? 'selected' : ''}} >Vô hiệu hóa</option>
                    </x-select>
                    <x-error-php error_field="status" />
                </div>

                <div class="mt-3">
                    <x-button-customize type="submit" class="w-full py-3 text-center"> Cập nhật </x-button-customize>
                </div>
            </form>
        </div>

        <div class="bg-white shadow-md rounded-md p-3 md:w-[55%] mt-3 md:mt-0">
                <div class="flex justify-between items-center">

                    @if (request()->input('list') == 'trash')
                        <p class="text-[17px] font-semibold">Thùng rác</p>
                    @else
                        <p class="text-[17px] font-semibold">Danh sách ảnh</p>
                    @endif

            
                    @if (request()->input('list') == 'trash')
                        {{-- Quay lại --}}
                        <x-a-reset href="{{ request()->fullUrlWithQuery(['list'=>'normal']) }}" class="px-5 md:w-full">
                            <i class="fa-solid fa-arrow-left"></i>
                            <span>Quay lại</span>
                        </x-a-reset>
                    @else
                        {{-- Thùng rác --}}
                        <x-a-trash href="{{ request()->fullUrlWithQuery(['list'=>'trash']) }}">
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
