<x-app-layout>

    <x-flash-session key="status_complete"><i class="fa-solid fa-circle-check"></i></x-flash-session>

    {{-- topbar --}}
    <x-topbar-content>
        <x-breadcrum href="{{ route('admin.product.list') }}" page_name="Cập nhật sản phẩm" />
    </x-topbar-content>

    <div class="p-3">
        <form action="{{route('admin.product.update',$product_info->id)}}" method="post"
            class="w-full {{ $errors->any() || session('status_failed') ? '' : 'animation_content_slide_up' }}"
            enctype="multipart/form-data">
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
                            <i class="remove_img fa-solid fa-xmark text-lg absolute right-2 top-2  text-gray-400 cursor-pointer z-40 hover:text-gray-800" data-module="product"></i>
                            <x-label for="file"
                                class="bg-gray-100 h-full w-full rounded-md flex items-center justify-center cursor-pointer {{ $product_info->img_id == '' ? '' : 'hidden' }}">
                                <i class="upload_img fa-solid fa-cloud-arrow-up text-5xl text-gray-500"></i>
                            </x-label>
                            <img src="{{ asset($product_info->media->url) }}" alt="" class="max-h-full rounded-md url_img_product">
                            <input type="hidden" name="img_id[]" value="{{ $product_info->media->id }}" class="id_img_product">
                            <input type="hidden" name="old_img_id[]" value="{{ $product_info->media->id }}">
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
                            @if ($sub_imgs->count() > 0)
                                @for ($i = 0; $i <= $sub_imgs->count() - 1; $i++)
                                    <div
                                        class="img_box w-[25%] h-full rounded-md flex flex-col justify-center items-center cursor-pointer relative border border-gray-200">
                                        <input type="file" name="file[]" id="sub_file_{{ $i + 1 }}" class="hidden" role="sub_img_{{ $i + 1 }}" data-id="id_sub_{{ $i + 1 }}" data-module="product">
                                        <i class="remove_img fa-solid fa-xmark text-xs absolute right-1 top-1  text-gray-400 cursor-pointer z-40 hover:text-gray-800 {{ $sub_imgs[$i]->url ? '' : 'hidden' }}" data-module="product"></i>
                                        <x-label for="sub_file_{{ $i + 1 }}"
                                            class="bg-gray-100 h-full w-full rounded-md flex items-center justify-center cursor-pointer {{ $sub_imgs[$i]->url ? 'hidden' : '' }}">
                                            <i class="upload_img fa-solid fa-cloud-arrow-up text-lg text-gray-500"></i>
                                        </x-label>
                                        <img src="{{ asset($sub_imgs[$i]->url) }}" alt=""
                                            class="max-h-full max-w-full object-contain rounded-md shadow-sm url_img_product">
                                        <input type="hidden" name="img_id[]" value="{{ $sub_imgs[$i]->id }}" class="id_img_product">
                                        <input type="hidden" name="old_img_id[]" value="{{ $sub_imgs[$i]->id }}">
                                        <span
                                            class="file_error text-red-600 error-text text-xs mt-4 inline-block w-[80px] truncate text-center absolute bottom-0"></span>
                                    </div>
                                @endfor
                                @for ($i = 1; $i <= 4 - $sub_imgs->count(); $i++)
                                    <div
                                        class="img_box w-[25%] h-full rounded-md flex flex-col justify-center items-center cursor-pointer relative border border-gray-200">
                                        <input type="file" name="file[]" id="sub_file_{{ $i + $sub_imgs->count() }}" class="hidden" role="sub_img_{{ $i + $sub_imgs->count() }}" data-id="id_sub_{{ $i + $sub_imgs->count() }}" data-module="product">
                                        <i class="remove_img fa-solid fa-xmark text-xs absolute right-1 top-1  text-gray-400 cursor-pointer z-40 hover:text-gray-800 hidden" data-module="product"></i>
                                        <x-label for="sub_file_{{ $i + $sub_imgs->count() }}"
                                            class="bg-gray-100 h-full w-full rounded-md flex items-center justify-center cursor-pointer">
                                            <i class="upload_img fa-solid fa-cloud-arrow-up text-lg text-gray-500"></i>
                                        </x-label>
                                        <img src="" alt=""
                                            class="max-h-full max-w-full object-contain rounded-md shadow-sm url_img_product">
                                        <input type="hidden" name="img_id[]" value="" class="id_img_product">
                                        <input type="hidden" name="old_img_id[]" value="">
                                        <span
                                            class="file_error text-red-600 error-text text-xs mt-4 inline-block w-[80px] truncate text-center absolute bottom-0"></span>
                                    </div>
                                @endfor
                            @else
                                @for ($i = 1; $i <= 4; $i++)
                                    <div
                                        class="img_box w-[25%] h-full rounded-md flex flex-col justify-center items-center cursor-pointer relative border border-gray-200">
                                        <input type="file" name="file[]" id="sub_file_{{ $i }}" class="hidden" role="sub_img_{{$i}}" data-id="id_sub_{{ $i }}" data-module="product">
                                        <i
                                            class="remove_img fa-solid fa-xmark text-xs absolute right-1 top-1  text-gray-400 cursor-pointer z-40 hover:text-gray-800 hidden" data-module="product"></i>
                                        <x-label for="sub_file_{{ $i }}"
                                            class="bg-gray-100 h-full w-full rounded-md flex items-center justify-center cursor-pointer">
                                            <i class="upload_img fa-solid fa-cloud-arrow-up text-lg text-gray-500"></i>
                                        </x-label>
                                        <img src="" alt=""
                                            class="max-h-full max-w-full object-contain rounded-md shadow-sm url_img_product">
                                        <input type="hidden" name="img_id[]" value="" class="id_img_product">
                                        <input type="hidden" name="old_img_id[]" value="">
                                        <span
                                            class="file_error text-red-600 error-text text-xs mt-4 inline-block w-[80px] truncate text-center absolute bottom-0"></span>
                                    </div>
                                @endfor
                            @endif
                        </div>

                        <div class="mt-2 text-xs md:mt-1">
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
                        <div class="md:mt-0 mt-2">
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
                            <x-input type="text" name="code" id="code"
                                value="{{ old('code', $product_info->code) }}" />
                            <x-error-php error_field="code" />
                            <x-error-ajax error_field="code" />
                        </div>

                        {{-- name --}}
                        <div class="mt-2">
                            <x-label for="name">
                                <span>Tên sản phẩm</span>
                                <span class="text-lg text-red-600">*</span>
                            </x-label>
                            <x-input type="text" name="name" id="name"
                                value="{{ old('code', $product_info->name) }}" />
                            <x-error-php error_field="name" />
                            <x-error-ajax error_field="name" />
                        </div>

                        {{-- desc --}}
                        <div class="mt-2">
                            <x-label for="desc">
                                <span>Mô tả</span>
                                <span class="text-lg text-red-600">*</span>
                            </x-label>
                            <x-input type="text" name="desc" id="desc"
                                value="{{ $product_info->desc }}" />
                            <x-error-php error_field="desc" />
                            <x-error-ajax error_field="desc" />
                        </div>

                        {{-- price --}}
                        <div class="mt-2">
                            <x-label for="price">
                                <span>Giá</span>
                                <span class="text-lg text-red-600">*</span>
                            </x-label>
                            <x-input type="number" name="price" id="price" min="0"
                                value="{{ old('price', $product_info->price) }}" />
                            <x-error-php error_field="price" />
                            <x-error-ajax error_field="price" />
                        </div>

                        {{-- quantity --}}
                        <div class="mt-2">
                            <x-label for="quantity">
                                <span>Số lượng</span>
                                <span class="text-lg text-red-600">*</span>
                            </x-label>
                            <x-input type="number" name="quantity" id="quantity" min="0"
                                value="{{ old('quantity', $product_info->quantity) }}" />
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
                            <x-input type="text" name="slug" id="slug"
                                value="{{ old('slug', $product_info->slug) }}" />
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
                                        class="{{ $cat->parent_id > 0 ? '' : 'font-semibold' }}"
                                        {{ $product_info->cat_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}
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
                            <x-input type="number" name="disscount" id="disscount" placeholder="0" min="0"
                                max="100" value="{{ old('disscount', $product_info->disscount) }}" />
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
                                <option value="no" {{ $product_info->up_sale == 'no' ? 'selected' : '' }}>Mặc định
                                </option>
                                <option value="yes" {{ $product_info->up_sale == 'yes' ? 'selected' : '' }}>Đẩy bán
                                    trước</option>
                            </x-select>
                            <x-error-php error_field="up_sale" />
                        </div>
                    </div>
                </div>

                <div class="p-4 bg-white shadow-md rounded-md md:w-[30%] hidden md:block">
                    <p class="font-semibold text-lg">Lưu ý khi cập nhật sản phẩm</p>
                    <hr class="my-2">
                    <ul class="list-disc list-inside mt-2">
                        <li class="mt-2">Các trường <span class="text-red-600 text-lg">*</span> là bắt buộc</li>
                        <li class="mt-2">Tên sản phẩm nên rõ ràng, không chứa ký tự đặc biệt hoặc nội dung gây hiểu
                            nhầm.</li>
                        <li class="mt-2">Hình ảnh sản phẩm cần rõ nét, đúng định dạng và dung lượng theo quy định.
                        </li>
                        <li class="mt-2">Giá bán và số lượng phải là số hợp lệ, lớn hơn 0.</li>
                        <li class="mt-2">Kiểm tra lại toàn bộ thông tin trước khi lưu để tránh sai sót.</li>
                        <li class="mt-2">Chỉ khi cập nhật mọi thao tác mới được thực hiện thay đổi</li>
                    </ul>
                </div>
            </div>

            {{-- details --}}
            <div class="mt-3">
                <x-forms.tinymce-editor name="product_details" id="product_details" placeholder="Thông tin chi tiết sản phẩm">
                    {{ $product_info->details }}
                </x-forms.tinymce-editor>
                {{-- <textarea name="details" id="details" cols="30" rows="10"
                    class="w-full rounded-md shadow-md border-gray-200 focus:ring-green-500 focus:border-green-500 outline-none"
                    placeholder="">{!! $product_info->details !!}</textarea> --}}
            </div>

            {{-- button --}}
            <div class="mt-3 flex justify-end items-center gap-2">
                <x-a-reset href="{{route('admin.product.list')}}" class="py-2 w-[120px] text-center">
                    <i class="fa-solid fa-arrow-left-long mr-1"></i> 
                    Quay lại
                </x-a-reset>
                <x-button-customize type="submit" class="w-[120px] py-2 text-center"> Cập nhật </x-button-customize>
            </div>
        </form>
    </div>
</x-app-layout>
