<x-app-layout>

    {{-- Thông báo thành công --}}
    <x-flash-session key="add_complete"><i class="fa-solid fa-circle-check"></i></x-flash-session>

    {{-- topbar --}}
    <x-topbar-content>
        <x-breadcrum href="{{route('admin.product.categories.list')}}" page_name="Thêm mới danh mục"/>
    </x-topbar-content>

    <div class="md:flex gap-3 md:items-start p-3 @if (!$errors->any() && !session('add_failed') && !session('add_complete') && !session('add_failed_parent') ) animation_content_slide_up @endif">

        {{-- Danh mục con --}}
        <form action="{{ route('admin.product.categories.store') }}" method="POST"
            class="md:w-[35%] text-sm bg-white rounded-lg shadow-md pt-1 pb-3 px-5">
            @csrf
            <input type="hidden" name="child_category" value="true">
            <p class="font-semibold text-lg my-3 select-none">Danh mục con</p>
            <hr>

            {{-- name --}}
            <div class="mt-2">
                <x-label for="child_cat_name">Tên danh mục <span class="text-lg text-red-600">*</span></x-label>
                <x-input type="text" name="child_cat_name" id="child_cat_name" />
                <x-error-php error_field="child_cat_name" />
                <x-error-ajax error_field="child_cat_name" />
            </div>

            {{-- slug --}}
            <div class="mt-2">
                <x-label for="child_cat_slug">Slug <span class="text-lg text-red-600">*</span></x-label>
                <x-input type="text" name="child_cat_slug" id="child_cat_slug" />
                <x-error-php error_field="child_cat_slug" />
                <x-error-ajax error_field="child_cat_slug" />
                <span class="text-xs mt-2 inline-block text-gray-500 select-none">
                    Vd: trai-cay-say-kho, hat-dieu, hat-dinh-duong
                </span>
            </div>

            <p class="my-2 text-xs">
                <i class="fa-solid fa-circle-check text-green-600 mr-1"></i>
                <span>Copy tên sản phẩm để làm Slug, hệ thống tự xử lý</span>
            </p>

            {{-- parent_cat --}}
            <div class="mt-2">
                <x-label for="parent_cat">Danh mục cha</x-label><br>
                <x-select name="parent_cat" id="parent_cat">
                    <option value="">- Chọn danh mục cha -</option>
                    @foreach ($list_parent_cats as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </x-select>
                <x-error-php error_field="parent_cat" />
                <x-error-ajax error_field="parent_cat" />
            </div>

            {{-- status --}}
            <div class="mt-2">
                <x-label for="child_cat_status">Trạng thái</x-label><br>
                <x-select name="child_cat_status" id="child_cat_status">
                    <option value="active" selected>Hoạt động</option>
                    <option value="unactive">Vô hiệu hóa</option>
                </x-select>
            </div>

            {{-- thông báo --}}
            <x-flash-session-normal key="add_failed_child" class="text-red-700 mt-3   ">
                <i class="fa-solid fa-circle-exclamation"></i>
            </x-flash-session-normal>

            {{-- button --}}
            <div class="mt-4">
                <x-button-customize type="submit" class="w-full py-3">Thêm mới</x-button-customize>
            </div>
        </form>

        {{-- Danh mục cha --}}
        <form action="{{ route('admin.product.categories.store') }}" method="POST"
            class="md:w-[35%] text-sm bg-white rounded-lg shadow-md pt-1 pb-3 px-5 mt-3 md:mt-0">
            @csrf
            <input type="hidden" name="parent_category" value="true">
            <p class="font-semibold text-lg my-3 select-none">Danh mục cha</p>
            <hr>

            {{-- name --}}
            <div class="mt-2">
                <x-label for="parent_cat_name">Tên danh mục <span class="text-lg text-red-600">*</span></x-label>
                <x-input type="text" name="parent_cat_name" id="parent_cat_name" />
                <x-error-php error_field="parent_cat_name" />
                <x-error-ajax error_field="parent_cat_name" />
            </div>

            {{-- slug --}}
            <div class="mt-2">
                <x-label for="parent_cat_slug">Slug <span class="text-lg text-red-600">*</span></x-label>
                <x-input type="text" name="parent_cat_slug" id="parent_cat_slug" />
                <x-error-php error_field="parent_cat_slug" />
                <x-error-ajax error_field="parent_cat_slug" />
                <span class="text-xs mt-2 inline-block text-gray-500 select-none">
                    Vd: trai-cay-say-kho, hat-dieu, hat-dinh-duong
                </span>

                <p class="my-2 text-xs">
                    <i class="fa-solid fa-circle-check text-green-600 mr-1"></i>
                    <span>Copy tên sản phẩm để làm Slug, hệ thống tự xử lý</span>
                </p>
            </div>

            {{-- status --}}
            <div class="mt-2">
                <x-label for="parent_cat_status">Trạng thái</x-label><br>
                <x-select name="parent_cat_status" id="parent_cat_status" class="parent_cat_status">
                    <option value="active" selected>Hoạt động</option>
                    <option value="unactive">Vô hiệu hóa</option>
                </x-select>
            </div>

            {{-- thông báo --}}
            <x-flash-session-normal key="add_failed_parent" class="text-red-700 mt-3   ">
                <i class="fa-solid fa-circle-exclamation"></i>
            </x-flash-session-normal>

            {{-- button --}}
            <div class="mt-4">
                <x-button-customize type="submit" class="w-full py-3">Thêm mới</x-button-customize>
            </div>

        </form>

        {{-- Noitce --}}
        <div class="notice md:w-[30%] text-sm bg-white rounded-lg shadow-md pt-1 pb-3 px-5 mt-3 md:mt-0">
            <p class="text-lg font-semibold mt-2">Lưu ý khi tạo danh mục !</p>
            <hr class="my-2">
            <ul class="list-decimal mt-1 inline-block ms-3 mb-3">
                <li class="mt-3"><span class="font-semibold">Tên</span> danh mục <span class="font-semibold">không
                        được trùng</span> với danh mục đã tồn tại trong hệ thống.</li>
                <li class="mt-3"><span class="font-semibold">Tên</span> danh mục <span class="font-semibold">không
                        chứa kí tự đặc biệt</span> như: & ^ % $ # @ !</li>
                <li class="mt-3">Slug nên viết chữ thường, không dấu, các từ cách nhau bằng dấu “-”.</li>
                <li class="mt-3">Slug dùng để tạo đường dẫn, không nên thay đổi sau khi đã có sản phẩm.</li>
                <li class="mt-3">Danh mục cha dùng để gom nhóm danh mục con, không chứa sản phẩm trực tiếp (khuyến
                    nghị).</li>
                <li class="mt-3"><span class="font-semibold">Trạng thái Không hoạt động</span> sẽ khiến danh mục
                    <span class="font-semibold">không hiển thị ngoài website.</span></li>
            </ul>
        </div>



    </div>
</x-app-layout>
