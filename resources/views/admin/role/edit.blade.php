<x-app-layout>

    <x-flash-session key="status_complete"><i class="fa-solid fa-circle-check"></i></x-flash-session>

    {{-- topbar --}}
    <x-topbar-content>
        <x-breadcrum href="{{ route('admin.role.manager') }}" page_name="Cập nhật vai trò ({{$role->name}})" />
    </x-topbar-content>

    {{-- manager area --}}
    <div
        class="md:flex items-start gap-3 p-3 
    {{ session('status_failed') || session('status_action_failed') || session('status_complete') || $errors->any() ? '' : 'animation_content_slide_up' }}">
        <div class="bg-white shadow-md rounded-md p-3 md:w-[60%]">
            <p class="text-[17px] font-semibold">Cập nhật</p>
            <hr class="my-3">
            <form action="{{ route('admin.role.update',$role->id) }}" method="post">
                @csrf

                {{-- Tên vai trò --}}
                <div class="mt-2">
                    <x-label for="name">
                        <span>Tên vai trò</span>
                        <span class="text-lg text-red-600">*</span>
                    </x-label>
                    <x-input type="text" name="name" id="name" value="{{old('name',$role->name)}}" />
                    <x-error-php error_field="name" />
                    <x-error-ajax error_field="name" />
                </div>

                {{-- Mô tả --}}
                <div class="mt-2">
                    <x-label for="desc">
                        <span>Mô tả</span>
                        <span class="text-lg text-red-600">*</span>
                    </x-label>
                    <textarea name="desc" id="desc" cols="30" rows="10"
                        class="textarea_desc w-full h-[50px] border-gray-300 shadow-sm rounded-md mt-1 focus:ring-green-500 focus:border-green-500 {{ $errors->has('desc') ? 'border-red-700 ring-red-700 ring-1' : '' }}">{{old('desc',$role->desc)}}</textarea>
                    <x-error-php error_field="desc" />
                    <x-error-ajax error_field="desc" />
                </div>

                <p class="font-semibold mt-2">Quyền của vai trò</p>
                <p class="text-xs text-gray-500 mt-1"> Có thể thay đổi phân quyền
                </p>

                <div class="md:max-h-[300px] overflow-y-auto">
                    <table class="mt-2 w-full">
                        @foreach ($permissions as $key => $value)
                            <tr class="font-semibold">
                                <tr class="h-4"></tr>
                                <td class="px-2 py-3 bg-gray-200" colspan="5" class="rounded-md">
                                    <input type="checkbox" name="Module{{ ucfirst($key) }}"
                                        class="check-all rounded-sm border-gray-500 mr-1 shadow-sm">
                                    <span>Module {{ ucfirst($key) }}</span>
                                </td>
                            </tr>
                            <tr class="border-b">
                                @foreach ($value as $item)
                                    <td class="px-2 py-3">
                                        <span>
                                            <input type="checkbox" name="permission_id[]" value="{{$item->id}}" {{ in_array($item->id,$role_permission) ? 'checked' : '' }}
                                                class="permission rounded-sm border-gray-500 mr-1 shadow-sm">
                                        </span>
                                        <span>{{ $item->name }}</span>
                                    </td>
                                @endforeach
                            </tr>      
                        @endforeach
                    </table>
                </div>

                <x-flash-session-normal key="status_failed" class="mt-2 text-red-700"><i class="fa-solid fa-circle-exclamation"></i></x-flash-session-normal>

                <div class="mt-3">
                    <x-button-customize type="submit" class="w-full py-3 text-center"> Cập nhật </x-button-customize>
                </div>
            </form>
        </div>

        <div class="bg-white shadow-md rounded-md p-3 md:w-[40%] mt-3 md:mt-0">
            <div class="flex justify-between items-center">
                <p class="text-[17px] font-semibold">Danh sách vai trò</p>
            </div>
            <hr class="my-3">
            <div class="list_menu">
                @include('admin.role.partials.list_normal')
            </div>
        </div>
    </div>


</x-app-layout>
