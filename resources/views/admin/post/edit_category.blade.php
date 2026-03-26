<x-app-layout>

    {{-- Thông báo thành công --}}
    <x-flash-session key="update_complete"><i class="fa-solid fa-circle-check"></i></x-flash-session>

    {{-- topbar --}}
    <x-topbar-content>
        <x-breadcrum href="{{route('admin.post.categories.list')}}" page_name="Cập nhật danh mục"/>
    </x-topbar-content>

    <div class="md:flex gap-3 w-full items-start p-3 @if (!$errors->any() && !session('update_complete')) animation_content_slide_up @endif">

        <form action="{{route('admin.post.categories.update',$category_details->id)}}" method="POST" class="md:w-[40%] text-sm bg-white rounded-lg shadow-md pt-1 pb-3 px-5">
            @csrf
            <input type="hidden" name="parent_id" value="{{$category_details->parent_id}}">

            {{-- catname --}}
            <div class="mt-2">
                <x-label for="cat_name">Tên danh mục <span class="text-lg text-red-600">*</span></x-label>
                <x-input type="text" name="cat_name" id="cat_name" value="{{old('cat_name',$category_details->name)}}" />
                <x-error-php error_field="cat_name" />
                <x-error-ajax error_field="cat_name" />
            </div>

            {{-- slug --}}
            <div class="mt-2">
                <x-label for="cat_slug">Slug <span class="text-lg text-red-600">*</span></x-label>
                <x-input type="text" name="cat_slug" id="cat_slug" value="{{old('cat_slug',$category_details->slug)}}" />
                <x-error-php error_field="cat_slug" />
                <x-error-ajax error_field="cat_slug" />
                <span class="text-xs mt-2 inline-block text-gray-500 select-none">
                    Vd: trai-cay-say-kho, hat-dieu, hat-dinh-duong
                </span>
            </div>

            <p class="my-2 text-xs">
                <i class="fa-solid fa-circle-check text-green-600 mr-1"></i>
                <span>Copy tên sản phẩm để làm Slug, hệ thống tự xử lý</span>
            </p>

            {{-- parent_cat --}}
            @if ($category_details->parent_id === null || $category_details->parent_id != 0)
                <div class="mt-2">
                    <x-label for="parent_cat">Danh mục cha</x-label><br>
                    <x-select name="parent_cat" id="parent_cat">
                        <option value="">- Chọn danh mục cha -</option>
                        @foreach ($parent_categories as $cat)
                            <option value="{{ $cat->id }}" @if ($category_details->parent_id == $cat->id) selected @endif>
                                {{ $cat->name }}</option>
                        @endforeach
                    </x-select>
                    <x-error-php error_field="parent_cat" />
                </div>
            @endif

            {{-- status --}}
            <div class="mt-2">
                <x-label for="cat_status">Trạng thái</x-label><br>
                <x-select name="cat_status" id="cat_status">
                    <option value="active" @if ($category_details->status == 'active') selected @endif>Hoạt động</option>
                    <option value="unactive" @if ($category_details->status == 'unactive') selected @endif>Vô hiệu hóa</option>
                </x-select>
            </div>
            
            <x-flash-session-normal key="update_failed" class="text-red-700 mt-3   ">
                <i class="fa-solid fa-circle-exclamation"></i>
            </x-flash-session-normal>

            {{-- button --}}
            <div class="mt-4">
                <x-button-customize type="submit" class="w-full py-3">Cập nhật</x-button-customize>
            </div>
        </form>

        <div class="notice md:w-[60%] text-sm bg-white rounded-lg shadow-md pt-1 pb-3 px-5 mt-3 md:mt-0">
            <p class="text-lg font-semibold mt-2">Lưu ý khi cập nhật danh mục !</p>
            <hr class="mt-2">
            <ul class="mt-1 inline-block ms-3 mb-3">
                <li class="mt-3">
                    <i class="fa-solid fa-circle-check text-green-600 text-lg mr-1"></i>
                    <span>Danh mục dùng để nhóm các sản phẩm cùng chủ đề, dễ tìm kiếm và cải thiện <span class="font-semibold">SEO Website</span></span>
                </li>
                <li class="mt-3">
                    <i class="fa-solid fa-circle-check text-green-600 text-lg mr-1"></i>
                    <span>Đặt tên ngắn gọn dễ hiểu, đúng nhu cầu tìm kiếm của khách hàng, không viết toàn chữ <span class="font-semibold">IN HOA</span></span>
                </li>
                <li class="mt-3">
                    <i class="fa-solid fa-circle-check text-green-600 text-lg mr-1"></i>
                    <span>Không thêm thông tin khuyến mãi vào tên danh mục</span>
                </li>
                <li class="mt-3">
                    <i class="fa-solid fa-circle-xmark text-red-700 text-lg mr-1"></i>
                    <span>"Quà tặng khuyễn mãi 50%" => <i class="fa-solid fa-check text-green-600"></i> "Quà tặng dịp tết"</span>
                </li>
                <li class="mt-3"></li>
                <li class="mt-3"></li>
            </ul>
        </div>



    </div>
</x-app-layout>
