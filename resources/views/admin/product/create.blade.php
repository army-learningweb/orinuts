<x-app-layout>

    <x-flash-session key="status_complete"><i class="fa-solid fa-circle-check"></i></x-flash-session>

    {{-- topbar --}}
    <x-topbar-content>
        <x-breadcrum href="{{route('admin.product.list')}}" page_name="Thêm mới sản phẩm" />
    </x-topbar-content>

    <div class="p-3">
        <form action="{{route('admin.product.store')}}" method="post" class="w-full {{ $errors->any() || session('status_failed') ? '' : 'animation_content_slide_up' }}" enctype="multipart/form-data">
            @csrf

            <div class="md:flex gap-3 ">
                <div class="p-3 rounded-md shadow-md md:flex md:w-[70%] gap-3 overflow-hidden bg-white">
                    {{-- Images --}}
                    <div class="md:w-[45%] flex flex-col gap-1 mt-5 md:mt-0">

                        {{-- main img --}}
                        <x-label class="">
                            <span>Ảnh sản phẩm</span>
                            <span class="ml-1 text-red-600 text-lg">*</span>
                        </x-label>
                        <div
                            class="relative border bg-gray-100 border-gray-200 py-2 rounded-md h-[350px] shadow-sm overflow-hidden flex flex-col justify-center items-center">
                            <input type="file" name="file[]" id="file" class="file hidden" role="main_img_product" data-id="id_main_product" data-module="product">
                            <i class="delete_img fa-solid fa-xmark text-lg absolute right-2 top-2 text-gray-400 cursor-pointer z-40 hover:text-gray-800 {{ session('main_img_product') ? '' : 'hidden' }}" data-module="product"></i>
                            <x-label for="file"
                                class="bg-gray-100 h-full w-full rounded-md flex items-center justify-center cursor-pointer {{ session('main_img_product') ? 'hidden' : '' }}">
                                <i class="upload_img fa-solid fa-cloud-arrow-up text-5xl text-gray-500"></i>
                            </x-label>
                            <img src="{{ session('main_img_product') ? asset(session('main_img_product')) : ''}}" alt="" class="max-h-full rounded-md url_img_product">
                            <input type="hidden" name="img_id[]" value="{{ session('id_main_product') ? session('id_main_product') : '' }}" class="id_img_product">
                            <span class="file_error text-red-600 error-text text-xs absolute bottom-2"></span>
                        </div>
                        <x-error-php error_field="file" />

                        <x-flash-session-normal key="status_failed" class="text-red-700 mt-2 md:mt-3">
                            <i class="fa-solid fa-circle-exclamation"></i>
                        </x-flash-session-normal>

                        {{-- sub img --}}
                        <x-label for="" class="inline-block mt-3 md:mt-2">
                            Ảnh phụ 
                            <span class="text-gray-500 text-xs">(Không bắt buộc)</span>
                        </x-label>
                        <div class="rounded-md h-[90px] mt-2 md:mt-1 flex items-center gap-2">
                            @for ($i = 1; $i <= 4; $i++)
                                <div
                                    class="img_box w-[25%] h-full rounded-md flex flex-col justify-center items-center cursor-pointer relative border border-gray-200">
                                    <input type="file" name="file[]" id="sub_file_{{$i}}" class="hidden" role="sub_img_{{$i}}" data-id="id_sub_{{$i}}" data-module="product">
                                    <i
                                        class="delete_img fa-solid fa-xmark text-xs absolute right-1 top-1  text-gray-400 cursor-pointer z-40 hover:text-gray-800 {{ session('sub_img_'.$i) ? '' : 'hidden' }}" data-module="product"></i>
                                    <x-label for="sub_file_{{ $i }}"
                                        class="bg-gray-100 h-full w-full rounded-md flex items-center justify-center cursor-pointer {{ session('sub_img_'.$i) ? 'hidden' : '' }}">
                                        <i class="upload_img fa-solid fa-cloud-arrow-up text-lg text-gray-500"></i>
                                    </x-label>
                                    <img src="{{ session('sub_img_'.$i) ? asset(session('sub_img_'.$i)) : '' }}" alt="" class="max-h-full max-w-full object-contain rounded-md shadow-sm url_img_product">
                                    <input type="hidden" name="img_id[]" value="{{ session('id_sub_'.$i) ? session('id_sub_'.$i) : '' }}" class="id_img_product">
                                    <span
                                        class="file_error text-red-600 error-text text-xs mt-4 inline-block w-[80px] truncate text-center absolute bottom-0"></span>
                                </div>
                            @endfor       
                        </div>
                        
                        <div class="mt-2 md:mt-0 text-xs">
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

                        {{-- status --}}
                        <div class="md:mt-1 mt-2">
                            <x-label for="status">Trạng thái</x-label>
                            <x-select name="status" id="status">
                                <option value="active" selected>Hoạt động</option>
                                <option value="unactive">Vô hiệu hóa</option>
                            </x-select>
                            <x-error-php error_field="status" />
                        </div>
                    </div>

                    {{-- infomation --}}
                    <div class="md:w-[55%] mt-2 md:mt-0">

                        {{-- code --}}
                        <div class="">
                            <x-label for="code">
                                <span>Mã sản phẩm</span>
                                <span class="text-lg text-red-600">*</span>
                                <span class="text-xs text-gray-500">(Bắt đầu bằng ori# và số -> vd: ori#123)</span>
                            </x-label>
                            <x-input type="text" name="code" id="code" />
                            <x-error-php error_field="code" />
                            <x-error-ajax error_field="code" />
                        </div>

                        {{-- name --}}
                        <div class="mt-2">
                            <x-label for="name">
                                <span>Tên sản phẩm</span>
                                <span class="text-lg text-red-600">*</span>
                            </x-label>
                            <x-input type="text" name="name" id="name" />
                            <x-error-php error_field="name" />
                            <x-error-ajax error_field="name" />
                        </div>

                        {{-- desc --}}
                        <div class="mt-2">
                            <x-label for="desc">
                                <span>Mô tả</span>
                                <span class="text-lg text-red-600">*</span>
                            </x-label>
                            <x-input type="text" name="desc" />
                            <x-error-php error_field="desc" />
                            <x-error-ajax error_field="desc" />
                        </div>

                        {{-- price --}}
                        <div class="mt-2">
                            <x-label for="price">
                                <span>Giá</span>
                                <span class="text-lg text-red-600">*</span>
                            </x-label>
                            <x-input type="number" name="price" min="0" />
                            <x-error-php error_field="price" />
                            <x-error-ajax error_field="price" />
                        </div>

                        {{-- quantity --}}
                        <div class="mt-2">
                            <x-label for="quantity">
                                <span>Số lượng</span>
                                <span class="text-lg text-red-600">*</span>
                            </x-label>
                            <x-input type="number" name="quantity" min="0" />
                            <x-error-php error_field="quantity" />
                            <x-error-ajax error_field="quantity" />
                        </div>

                        {{-- Slug --}}
                        <div class="mt-2">
                            <x-label for="slug">
                                <span>Slug</span>
                                <span class="text-red-600 text-lg">*</span>
                                <span class="text-xs text-gray-500 mr-1">(Copy tên sản phẩm để làm Slug)</span>
                            </x-label>
                            <x-input type="text" name="slug"/>
                            <x-error-php error_field="slug" />
                            <x-error-ajax error_field="slug" />
                        </div>

                        {{-- product cat --}}
                        <div class="mt-2">
                            <x-label for="product_cat">
                                <span>Danh mục sản phẩm</span>
                                <span class="text-lg text-red-600">*</span>
                            </x-label>
                            <x-select name="product_cat" id="product_cat">
                                <option value="">- Chọn danh mục sản phẩm -</option>
                                @foreach ($product_categories as $cat)
                                    <option value="{{ $cat->parent_id > 0 ? $cat->id : '' }}"
                                        class="{{ $cat->parent_id > 0 ? '' : 'font-semibold' }}" {{ old('product_cat') == $cat->id ? 'selected' : ''}}>{{ $cat->name }}
                                    </option>
                                @endforeach
                            </x-select>
                            <x-error-php error_field="product_cat" />
                            <x-error-ajax error_field="product_cat" />
                        </div>         

                        {{-- disscount --}}
                        <div class="mt-2">
                            <x-label for="disscount">
                                <span>Giảm giá %</span>
                                <span class="text-xs text-gray-500 inline-block">&nbsp;(Không bắt buộc)</span>
                            </x-label>
                            <x-input type="number" name="disscount" placeholder="0" min="0"
                                max="100" />
                            <x-error-php error_field="disscount" />
                            <x-error-ajax error_field="disscount" />
                        </div>

                        {{-- upsale --}}
                        <div class="mt-2">
                            <x-label for="up_sale">
                                <span>Up Sale</span>
                                <span class="text-xs text-gray-500 inline-block">&nbsp;(Không bắt buộc)</span>
                            </x-label>
                            <x-select name="up_sale" id="up_sale">
                                <option value="no">Mặc định</option>
                                <option value="yes">Đẩy bán trước</option>
                            </x-select>
                            <x-error-php error_field="up_sale" />
                        </div>
                    </div>
                </div>

                <div class="p-4 bg-white shadow-md rounded-md md:w-[30%] hidden md:block">
                    <p class="font-semibold text-lg">Lưu ý khi thêm sản phẩm</p>
                    <hr class="my-2">
                    <ul class="list-disc list-inside mt-2">
                        <li class="mt-2">Các trường<span
                                class="text-red-600 text-lg">*</span> là bắt buộc</li>
                        <li class="mt-2">Tên sản phẩm nên rõ ràng, không chứa ký tự đặc biệt hoặc nội dung gây hiểu
                            nhầm.</li>
                        <li class="mt-2">Hình ảnh sản phẩm cần rõ nét, đúng định dạng và dung lượng theo quy định.
                        </li>
                        <li class="mt-2">Giá bán và số lượng phải là số hợp lệ, lớn hơn 0.</li>
                        <li class="mt-2">Kiểm tra lại toàn bộ thông tin trước khi lưu để tránh sai sót.</li>
                    </ul>
                </div>
            </div>

            {{-- details --}}
            <div class="mt-3">
                <x-forms.tinymce-editor name="product_details" id="product_details" placeholder="Thông tin chi tiết sản phẩm">
                    {{ old('product_details') }}
                </x-forms.tinymce-editor>
                {{-- <textarea name="details" id="details" cols="30" rows="10" 
                class="w-full rounded-md shadow-md border-gray-200 focus:ring-green-500 focus:border-green-500 outline-none" 
                placeholder="">Thông tin chi tiết sản phẩm...</textarea> --}}
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
