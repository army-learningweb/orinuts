@if (count($roles) > 0)
    <form action="{{route('admin.role.store')}}" method="post">
        @csrf
        
        <table class="text-sm border-gray-300 md:w-full min-width-[800px]">
            <thead>
                <tr class="font-semibold">
                    <td class="py-2 px-2 select-none text-center">#</td>
                    <td class="py-2 px-2 select-none">Tên vai trò</td>
                    <td class="py-2 px-2 select-none">Mô tả</td>
                    
                    <td class="py-2 text-center select-none w-[50px]" colspan="2">Tác vụ</td>
                </tr>
            </thead>
            {{-- Dữ liệu --}}
            <tbody class="data-roles">
                @php
                    $num = 1;
                @endphp
                @foreach ($roles as $role)
                    <tr class="hover:bg-gray-100 border-b border-gray-200">
                        <td class="py-3 select-none text-center">{{ $num++ }}</td>
                        <td class="py-3 px-2 select-none"><a href="{{route('admin.role.edit',$role->id)}}" class="text-blue-600 hover:underline underline-offset-2">{{ $role->name }}</a></td>
                        <td class="py-3 px-2 select-none">{{ $role->desc }}</td>
                       
                        <td class="py-3 text-center">
                            <a href="{{ route('admin.role.edit', $role->id) }}">
                                <i
                                    class="open-modal-update-user text-md fa-solid fa-pen text-gray-500/70 cursor-pointer hover:text-green-500 transtion-all duration-150">
                                </i>
                            </a>
                        </td>
                        <td class="py-1 text-center">
                            <a href="{{ route('admin.role.destroy', $role->id) }}"
                                onclick="return confirm('Bạn có chắc muốn xóa vai trò này ?')">
                                <i
                                    class="fa-solid fa-circle-xmark text-lg text-red-500/70 cursor-pointer hover:text-red-600 transition-all duration-150"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
       
    </form>
@else
    <p class="text-gray-500 px-3 pt-0 rounded-lg"> Nội dung này chưa có bản ghi nào ! </p>
@endif
