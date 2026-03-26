<x-app-layout>

    {{-- topbar --}}
    <x-topbar-content>
        <x-breadcrum href="{{ route('admin.pages.list') }}" page_name="Thêm trang tĩnh" />
    </x-topbar-content>

    <div class="p-3">
        <div class="md:flex md:items-start gap-3 @if (!$errors->any()) animation_content_slide_up @endif">
            <form action="{{route('admin.pages.store')}}" method="POST" class="md:w-[70%] text-sm bg-white rounded-lg shadow-md pt-1 pb-3 px-5">
                @csrf

                {{-- title --}}
                <div class="mt-2">
                    <x-label for="title">Tiêu đề trang <span class="text-lg text-red-600">*</span></x-label>
                    <x-input type="text" name="title" id="title" />
                    <x-error-php error_field="title" />
                    <x-error-ajax error_field="title" />
                </div>

                {{-- slug --}}
                <div class="mt-2">
                    <x-label for="slug">Slug <span class="text-xs text-gray-600">(Không bắt buộc)</span></x-label>
                    <x-input type="text" name="slug" id="slug" />
                    <x-error-php error_field="slug" />
                    <x-error-ajax error_field="slug" />
                </div>

                {{-- status --}}
                <div class="mt-2">
                    <x-label for="status">Trạng thái</x-label>
                    <x-select name="status" id="status">
                        <option value="publish">Công khai</option>
                        <option value="draft">Nháp</option>
                        <option value="disable">Vô hiệu hóa</option>
                    </x-select>
                </div>

                {{-- content --}}
                <div class="mt-3">
                    <x-forms.tinymce-editor id="pages_details" placeholder="Nội dung trang" name="content"></x-forms.tinymce-editor>
                    {{-- <x-label for="content">
                        Nội dung trang
                        <span class="text-xs text-gray-600">(Không bắt buộc)</span>
                    </x-label>
                    <textarea name="content" id="content" cols="30" rows="10" placeholder="Nội dung trang ở đây...."
                        class="border-gray-300 rounded-md w-full mt-1 shadow-sm focus:ring-green-500 focus:border-green-500"></textarea> --}}
                </div>

                {{-- button --}}
                <div class="mt-2">
                    <x-button-customize type="submit" class="w-full py-3">Thêm mới</x-button-customize>
                </div>

            </form>

            {{-- attention --}}
            <div class="md:flex-1 p-5 pb-6 bg-white rounded-lg shadow-md mt-2 md:mt-0">
                <p class="text-lg font-semibold">Lưu ý khi tạo trang !</p>
                <hr class="my-2">
                <ul class="list-disc ml-5 text-gray-700 space-y-2">
                    <li>Kiểm tra kỹ <strong>Tiêu đề trang</strong> không quá 70 ký tự.</li>
                    <li>Đảm bảo các liên kết (link) bên trong đều hoạt động.</li>
                    <li>Đừng quên kiểm tra hiển thị trên di động trước khi nhấn nút "Xuất bản" nhé!</li>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
