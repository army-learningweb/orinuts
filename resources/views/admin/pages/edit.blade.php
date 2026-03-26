<x-app-layout>

    {{-- topbar --}}
    <x-topbar-content>
        <x-breadcrum href="{{ route('admin.pages.list') }}" page_name="Cập nhật trang" />
    </x-topbar-content>

    <div class="p-3">
        <div class="md:flex md:items-start gap-3 @if (!$errors->any()) animation_content_slide_up @endif">
            <form action="{{route('admin.pages.update',$page_info->id)}}" method="POST" class="md:w-full text-sm bg-white rounded-lg shadow-md pt-1 pb-3 px-5">
                @csrf

                {{-- title --}}
                <div class="mt-2">
                    <x-label for="title">Tiêu đề trang <span class="text-lg text-red-600">*</span></x-label>
                    <x-input type="text" name="title" id="title" value="{{old('title',$page_info->title)}}"/>
                    <x-error-php error_field="title" />
                    <x-error-ajax error_field="title" />
                </div>

                {{-- slug --}}
                <div class="mt-2">
                    <x-label for="slug">Slug <span class="text-xs text-gray-600">(Không bắt buộc)</span></x-label>
                    <x-input type="text" name="slug" id="slug" value="{{old('slug',$page_info->slug)}}"/>
                    <x-error-php error_field="slug" />
                    <x-error-ajax error_field="slug" />
                </div>

                {{-- status --}}
                <div class="mt-2">
                    <x-label for="status">Trạng thái</x-label>
                    <x-select name="status" id="status">
                        <option value="publish"{{$page_info->status == 'publish' ? 'selected' : '' }}>Công khai</option>
                        <option value="draft" {{$page_info->status == 'draft' ? 'selected' : '' }}>Nháp</option>
                        <option value="disable" {{$page_info->status == 'disable' ? 'selected' : '' }}>Vô hiệu hóa</option>
                    </x-select>
                </div>

                {{-- content --}}
                <div class="mt-3">
                    <x-forms.tinymce-editor id="pages_details" placeholder="Nội dung trang" name="content">{!! $page_info->content !!}</x-forms.tinymce-editor>
                    {{-- <x-label for="content">
                        Nội dung trang
                        <span class="text-xs text-gray-600">(Không bắt buộc)</span>
                    </x-label>
                    <textarea name="content" id="content" cols="30" rows="10" placeholder="Nội dung trang ở đây...."
                        class="border-gray-300 rounded-md w-full mt-1 shadow-sm focus:ring-green-500 focus:border-green-500">{{old('content',$page_info->content)}}</textarea> --}}
                </div>

                {{-- button --}}
                <div class="mt-2">
                    <x-button-customize type="submit" class="w-full py-3">Cập nhật</x-button-customize>
                </div>

            </form>

            {{-- attention --}}
            
        </div>
    </div>
</x-app-layout>
