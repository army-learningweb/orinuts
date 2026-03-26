@if (count($permissions) > 0)
    <form action="" method="post" class="md:max-h-[550px] overflow-y-scroll">
        @csrf
        <table class="text-sm border-gray-300 md:w-full min-width-[900px]">
            <thead>
                <tr class="font-semibold">
                    <td class="py-2 px-2 select-none text-center">#</td>
                    <td class="py-2 px-2 select-none">Tên quyền</td>
                    <td class="py-2 px-2 select-none">Mô tả</td>
                    <td class="py-2 px-2 select-none">Slug</td>
                    <td class="py-2 text-center select-none w-[50px]" colspan="2">Tùy chỉnh</td>
                </tr>
            </thead>
            {{-- Dữ liệu --}}
            <tbody class="data-permissions">
                @php
                    $num = 1;
                @endphp
                @foreach ($permissions as $key => $value)
                    <tr class="font-semibold bg-gray-200">
                        <td class=" rounded-l-sm"></td>
                        <td class="px-2 py-2 select-none">Module {{ ucfirst($key) }}</td>
                        <td colspan="5" class="rounded-r-sm"></td>
                    </tr>
                    @foreach ($value as $item)
                        <tr class="hover:bg-gray-100">
                            <td class="py-2 select-none text-center">{{ $num++ }}</td>
                            <td class="py-2 px-2 select-none">{{ $item->name }}</td>
                            <td class="py-2 px-2 select-none">{{ $item->desc }}</td>
                            <td class="py-2 px-2 select-none">{{ $item->slug }}</td>
                            <td class="py-1 text-center">
                                <a href="{{route('admin.permission.edit',$item->id)}}">
                                    <i
                                        class="open-modal-update-user text-md fa-solid fa-pen text-gray-500/70 cursor-pointer hover:text-green-500 transtion-all duration-150">
                                    </i>
                                </a>
                            </td>
                            <td class="py-1 text-center">
                                <a href="{{route('admin.permission.destroy',$item->id)}}"
                                    onclick="return confirm('Bạn có chắc muốn xóa quyền này ?')">
                                    <i
                                        class="fa-solid fa-circle-xmark text-lg text-red-500/70 cursor-pointer hover:text-red-600 transition-all duration-150"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
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
