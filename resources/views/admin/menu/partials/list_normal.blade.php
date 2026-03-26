@if (count($list_menu) > 0)
    <form action="{{ route('admin.sliders.action') }}" method="post">
        @csrf

        <table class="text-sm border-gray-300 md:w-full min-width-[800px]">
            <thead>
                <tr class="font-semibold">
                    <td class="px-2 select-none w-[100px]">Tên</td>
                    <td class="px-2 select-none text-center w-[100px]">Thứ tự</td>
                    <td class="px-2 select-none text-center w-[100px]">Đổi thứ tự</td>
                    <td class="px-2 select-none w-[100px] text-center">Slug</td>
                    <td class="px-2 select-none text-center w-[200px]">Trạng thái</td>
                    <td class="px-2 select-none">Thay đổi trạng thái</td>
                    <td class="text-center select-none w-[50px]">Xóa</td>
                </tr>
            </thead>
            {{-- Dữ liệu --}}
            <tbody class="data-menus">
                @foreach ($list_menu as $menu)
                    <tr class=hover:bg-gray-300/20 transition-all duration-150">
                        <td class="py-1 px-2 select-none">
                            <div class="w-[100px] truncate {{ $menu->level === 0 ? 'font-semibold' : '' }}">
                                @if ($menu->level == 0)
                                    <i class="fa-solid fa-folder text-amber-400"></i> &nbsp; {{$menu->name}}
                                @endif

                                @if ($menu->level == 1)
                                    └─ &nbsp;{{$menu->name}}
                                @endif

                                @if ($menu->level == 2)
                                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; |-- {{$menu->name}}
                                @endif
                            </div>
                        </td>
                        <td class="px-2 select-none text-center order-num-{{ $menu->id }}">
                            {{ $menu->order }}
                        </td>
                        <td class="px-2 select-none text-center">
                            <input type="number" name="" id="" data-id="{{ $menu->id }}" value="{{ $menu->order }}" class="menu-order w-[40px] text-center border p-1 rounded-md border-gray-200 shadow-sm focus:border-green-500 focus:ring-green-500">
                        </td>
                         <td class="px-2 select-none">
                            <div class="w-[100px] truncate text-center">
                                 {{ $menu->slug }}
                            </div>
                           
                        </td>
                        <td class="px-2 select-none menu_status_{{ $menu->id }}">
                            <div class="text-center flex justify-center">
                                {!! set_status_menu($menu->status) !!}
                            </div>
                        </td>
                        <td class="px-2">
                            <select name="menu_status" id="menu_status" data-id = "{{ $menu->id }}"
                                class="menu_status text-xs rounded-md py-1 focus:border-green-500 focus:ring-1 focus:ring-green-500  w-[120px] shadow-sm border-gray-500/30">
                                <option value="active" {{ $menu->status == 'active' ? 'selected' : '' }}>Hoạt động
                                </option>
                                <option value="disable" {{ $menu->status == 'disable' ? 'selected' : '' }}>Vô hiệu
                                    hóa
                                </option>
                            </select>
                        </td>
                        <td class="py-2 text-center">
                            <a href="{{ route('admin.menu.forceDelete', $menu->id) }}"
                                onclick="return confirm('Bạn có chắc muốn xóa menu này, kiểm tra lại phân cấp của menu trước khi xóa ?')">
                                <i
                                    class="fa-solid fa-circle-xmark text-lg text-red-500/70 cursor-pointer hover:text-red-600 transition-all duration-150"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-2">
            {{-- {{$sliders->links('pagination::tailwind',['class'=>'slider_pagination'])}} --}}
        </div>
    </form>
@else
    <p class="text-gray-500 px-3 pt-0 rounded-lg"> Nội dung này chưa có bản ghi nào ! </p>
@endif
