@if (count($sliders) > 0)
    <form action="{{ route('admin.sliders.action') }}" method="post">
        @csrf
        {{-- Hành động --}}
        <div class="md:flex gap-1 items-center w-full md:w-auto mb-3 mt-1">
            <select name="slider_action" id="action"
                class="w-full md:w-auto text-sm rounded-md py-1 focus:border-green-500 focus:ring-1 focus:ring-green-500 border-gray-500/20 shadow-sm">
                <option value="">- Hành động hàng loạt -</option>
                @if (request()->input('list') == 'trash')
                    <option value="restore" {{ old('slider_action') == 'restore' ? 'selected' : '' }}>Khôi phục
                    </option>
                    <option value="forceDelete" {{ old('slider_action') == 'forceDelete' ? 'selected' : '' }}>Xóa vĩnh
                        viễn
                    </option>
                @else
                    <option value="trash" {{ old('slider_action') == 'trash' ? 'selected' : '' }}>Bỏ vào thùng
                        rác
                    </option>
                    <option value="disable" {{ old('slider_action') == 'disable' ? 'selected' : '' }}>Vô hiệu
                        hóa
                    </option>
                    <option value="publish" {{ old('slider_action') == 'publish' ? 'selected' : '' }}>Công khai
                    </option>
                @endif

            </select>
            {{-- button --}}
            <button type="submit"
                class="mt-2 md:mt-0 w-full md:w-auto text-xs bg-gradient-to-r from-green-500 to-green-700 py-[7px] px-3 rounded-md hover:brightness-110 text-white font-semibold cursor-pointer flex items-center justify-center">
                Áp dụng </button>
            {{-- thông báo --}}
            <x-flash-session-normal key="status_action_failed" class="text-red-700 mt-2 md:mt-0 text-xs">
                <i class="fa-solid fa-circle-exclamation"></i>
            </x-flash-session-normal>
        </div>

        <div class="overflow-x-auto">
            <table class="text-sm border-gray-300 md:w-full min-w-[650px]">
                <thead>
                    <tr class="font-semibold">
                        <td class="px-1 py-1">
                            <input type="checkbox" name="check_all" class="check_all rounded-sm cursor-pointer">
                        </td>
                        <td class="py-2 select-none text-center">Ảnh</td>
                        <td class="py-1 px-2 select-none text-center">Thứ tự</td>
                        <td class="py-1 px-2 select-none text-center">Trạng thái</td>
                        <td class="py-1 px-2 select-none">Thay đổi trạng thái</td>
                        <td class="py-1 text-center select-none w-[50px]" colspan="2">Tùy chỉnh</td>
                    </tr>
                </thead>
                {{-- Dữ liệu --}}
                <tbody class="data-sliders">
                    @foreach ($sliders as $slider)
                        <tr
                            class="border-gray-300 border-b border-gray-500/15 hover:bg-gray-300/20 transition-all duration-150">
                            <td class="px-1 py-1">
                                <input type="checkbox" name="slider_id[]" value="{{ $slider->id }}"
                                    class="check_single rounded-sm cursor-pointer"
                                    {{ old('slider_id') && in_array($slider->id, old('slider_id')) ? 'checked' : '' }}>
                            </td>
                            <td class="py-2 select-none flex items-center justify-center">
                                <div class="w-[100px] h-[50px] flex justify-center items-center">
                                    <img src="{{ asset($slider->media->url) }}" alt=""
                                        class="max-h-full rounded-md object-contain">
                                </div>
                            </td>
                            <td class="py-1 px-2 select-none text-center">{{ $slider->order }}</td>
                            <td class="py-1 px-2 select-none slider_status_{{ $slider->id }}">
                                <div class="mt-1 text-center flex justify-center">
                                    {!! set_status_slider($slider->status) !!}
                                </div>
                            </td>
                            <td class="py-1 px-2">
                                <select name="slider_status" id="slider_status" data-id = "{{ $slider->id }}"
                                    class="slider_status text-xs rounded-md py-1 focus:border-green-500 focus:ring-1 focus:ring-green-500  w-[120px] shadow-sm border-gray-500/30 mt-1">
                                    <option value="publish" {{ $slider->status == 'publish' ? 'selected' : '' }}>Công
                                        khai
                                    </option>
                                    <option value="disable" {{ $slider->status == 'disable' ? 'selected' : '' }}>Vô
                                        hiệu
                                        hóa
                                    </option>
                                </select>
                            </td>
                            @if (request()->input('list') == 'trash')
                                <td class="py-3 text-center">
                                    <a href="{{ route('admin.sliders.restore', $slider->id) }}">
                                        <i
                                            class="text-lg fa-solid fa-rotate-left text-green-500/70 cursor-pointer hover:text-green-600 transtion-all duration-150">
                                        </i>
                                    </a>
                                </td>
                                <td class="py-3 text-center">
                                    <a href="{{ route('admin.sliders.forceDelete', $slider->id) }}"
                                        onclick="return confirm('Bạn có chắc muốn xóa ảnh này khỏi hệ thống ?')">
                                        <i
                                            class="fa-solid fa-circle-xmark text-lg text-red-500/70 cursor-pointer hover:text-red-600 transition-all duration-150"></i>
                                    </a>
                                </td>
                            @else
                                <td class="py-3 text-center">
                                    <a href="{{ route('admin.sliders.edit', $slider->id) }}">
                                        <i
                                            class="text-md fa-solid fa-pen text-gray-500/70 cursor-pointer hover:text-green-500 transtion-all duration-150">
                                        </i>
                                    </a>
                                </td>
                                <td class="py-3 text-center">
                                    <a href="{{ route('admin.sliders.destroy', $slider->id) }}"
                                        onclick="return confirm('Bạn có chắc muốn xóa ảnh này ?')">
                                        <i
                                            class="fa-solid fa-trash text-lg text-red-500/70 cursor-pointer hover:text-red-600 transition-all duration-150"></i>
                                    </a>
                                </td>
                            @endif

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-2">
            {{ $sliders->links('pagination::tailwind', ['class' => 'slider_pagination']) }}
        </div>
    </form>
@else
    <p class="text-gray-500 px-3 pt-0 rounded-lg"> Nội dung này chưa có bản ghi nào ! </p>
@endif
