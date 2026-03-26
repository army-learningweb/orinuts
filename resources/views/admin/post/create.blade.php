<x-app-layout>

    <x-flash-session key="status_complete"><i class="fa-solid fa-circle-check"></i></x-flash-session>

    {{-- topbar --}}
    <x-topbar-content>
        <x-breadcrum href="{{route('admin.post.list')}}" page_name="Thêm mới bài viết" />
    </x-topbar-content>

    <div class="p-3">
        <form action="{{ route('admin.post.store') }}" method="post"
            class="w-full {{ $errors->any() || session('status_failed') ? '' : 'animation_content_slide_up' }}"
            enctype="multipart/form-data">
            @csrf
            <div class="md:flex gap-3">
                <div class="p-3 rounded-md shadow-md md:flex flex-col md:w-[70%] overflow-hidden bg-white">

                    {{-- Images --}}
                    <div class="mt-5 md:mt-0">
                        {{-- main img --}}
                        <x-label class="">
                            <span>Ảnh bìa bản tin (banner)</span>
                            <span class="ml-1 text-red-600 text-lg">*</span>
                        </x-label>
                        <div
                            class="mt-2 relative border bg-gray-100 border-gray-200 py-2 rounded-md h-[350px] shadow-sm overflow-hidden flex flex-col justify-center items-center">
                            <input type="file" name="file[]" id="file" class="file hidden" role="main_img_post"
                                data-id="id_main_post" data-module="post">
                            <i class="delete_img fa-solid fa-xmark text-lg absolute right-2 top-2 text-gray-400 cursor-pointer z-40 hover:text-gray-800 {{ session('main_img_post') ? '' : 'hidden' }}"
                                data-module="post"></i>
                            <x-label for="file"
                                class="bg-gray-100 h-full w-full rounded-md flex items-center justify-center cursor-pointer {{ session('main_img_post') ? 'hidden' : '' }}">
                                <i class="upload_img fa-solid fa-cloud-arrow-up text-5xl text-gray-500"></i>
                            </x-label>
                            <img src="{{ session('main_img_post') ? asset(session('main_img_post')) : '' }}"
                                alt="" class="max-h-full rounded-md url_img_post">
                            <input type="hidden" name="img_id[]"
                                value="{{ session('id_main_post') ? session('id_main_post') : '' }}"
                                class="id_img_post">
                            <span class="file_error text-red-600 error-text text-xs absolute bottom-2"></span>
                        </div>
                        <x-error-php error_field="file" />

                        <x-flash-session-normal key="status_failed" class="text-red-700 mt-2 md:mt-3">
                            <i class="fa-solid fa-circle-exclamation"></i>
                        </x-flash-session-normal>
                    </div>

                    {{-- name --}}
                    <div class="mt-2">
                        <x-label for="title">
                            <span>Tiêu đề bài viết</span>
                            <span class="text-lg text-red-600">*</span>
                        </x-label>
                        <x-input type="text" name="title" id="title" />
                        <x-error-php error_field="title" />
                        <x-error-ajax error_field="title" />
                    </div>

                    {{-- desc --}}
                    <div class="mt-2">
                        <x-label for="desc">
                            <span>Mô tả ngắn</span>
                            <span class="text-xs text-gray-600">(Không bắt buộc)</span>
                        </x-label>
                        <x-input type="text" name="desc" id="desc" />
                        <x-error-php error_field="desc" />
                        <x-error-ajax error_field="desc" />
                    </div>

                    {{-- slug --}}
                    <div class="mt-2">
                        <x-label for="slug">
                            <span>Slug</span>
                            <span class="text-lg text-red-600">*</span>
                        </x-label>
                        <x-input type="text" name="slug" id="slug" />
                        <x-error-php error_field="slug" />
                        <x-error-ajax error_field="slug" />
                        <span class="text-xs mt-2 inline-block text-gray-500 select-none">
                            Vd: day-la-bai-viet-demo
                        </span>
                        <p class="mt-2 text-xs">
                            <i class="fa-solid fa-circle-check text-green-600 mr-1"></i>
                            <span>Copy tên sản phẩm để làm Slug, hệ thống tự xử lý</span>
                        </p>
                    </div>

                    {{-- status --}}
                    <div class="mt-2">
                        <x-label for="post_cat">
                            <span>Danh mục bài viết</span>
                            <span class="text-lg text-red-600">*</span>
                        </x-label>
                        <x-select name="post_cat" id="post_cat" class="mt-1">
                            <option value="">Chọn danh mục bài viết</option>
                            @foreach ($post_categories as $cat)
                                <option value="{{ $cat->parent_id > 0 ? $cat->id : '' }}"
                                    class="{{ $cat->parent_id > 0 ? '' : 'font-semibold' }}" {{ old('post_cat') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}
                                </option>
                            @endforeach
                        </x-select>
                        <x-error-php error_field="post_cat" />
                    </div>

                    {{-- status --}}
                    <div class="mt-2">
                        <x-label for="status">Trạng thái</x-label>
                        <x-select name="status" id="status" class="mt-2">
                            <option value="publish">Công khai</option>
                            <option value="draft">Nháp</option>
                            <option value="pending">Chờ duyệt</option>
                            <option value="disable">Vô hiệu hóa</option>
                        </x-select>
                        <x-error-php error_field="status" />
                    </div>

                    {{-- infomation --}}
                    <div class="md:w-[55%] mt-2 md:mt-0">
                        {{-- code --}}
                    </div>
                </div>

                <div class="p-4 bg-white shadow-md rounded-md md:w-[30%] hidden md:block">
                    <p class="font-semibold text-lg">Lưu ý khi thêm bài viết</p>
                    <hr class="my-2">
                    <ul class="list-disc list-inside mt-2">
                        <li class="mt-2">Các trường<span class="text-red-600 text-lg">*</span> là bắt buộc</li>
                        <li class="mt-2">Tiêu đề bài viết nên rõ ràng, không chứa ký tự đặc biệt hoặc nội dung gây
                            hiểu
                            nhầm.</li>
                        <li class="mt-2">Hình ảnh sản phẩm cần rõ nét, đúng định dạng và dung lượng theo quy định.
                        </li>
                        <li class="mt-2">Kiểm tra lại toàn bộ thông tin trước khi lưu để tránh sai sót.</li>
                    </ul>
                    <div class="mt-2">
                        <p class="font-semibold text-lg">Gợi ý:</p>
                        <p class="mt-1">- Chỉ chi phép định dạng ảnh (jpg,jpeg,png)</p>
                        <p class="mt-1">- Giảm bớt dung lượng trước khi upload</p>
                        <p class="mt-1">
                            <span class="text-red-600">
                                - <i class="fa-solid fa-file-circle-exclamation"></i> Lỗi file
                            </span>
                            <span>
                                -> File không hợp lệ
                            </span>
                        </p>
                    </div>
                </div>
                
            </div>

            {{-- details --}}
            <div class="mt-3">
                {{-- <x-forms.tinymce-editor id="product_details" placeholder="Thông tin chi tiết sản phẩm" /> --}}
                <textarea name="details" id="details" cols="30" rows="10"
                    class="w-full rounded-md shadow-md border-gray-200 focus:ring-green-500 focus:border-green-500 outline-none"
                    placeholder="Chi tiết bài viết....">{{old('details')}}</textarea>
            </div>

            {{-- button --}}
            <div class="mt-3 flex justify-end items-center gap-2">
                <x-a-reset class="py-2 w-[120px] text-center"><i class="fa-solid fa-arrow-left-long mr-1"></i> Quay
                    lại</x-a-reset>
                <x-button-customize type="submit" class="w-[120px] py-2 text-center"> Thêm mới </x-button-customize>
            </div>
        </form>
    </div>
</x-app-layout>
