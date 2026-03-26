@if (count($customers) > 0)
    {{-- Cập nhật tất cả --}}
    <form action="{{ route('admin.customers.action') }}" method="POST" id="update_all"
        class="bg-white shadow-md p-4 rounded-md">
        @csrf
        <div class="md:flex gap-1 items-center">
            {{-- Hành động --}}
            <select name="action" id="action"
                class="w-full md:w-auto text-sm font-semibold rounded-md py-1 focus:border-green-500 focus:ring-1 focus:ring-green-500 border-gray-500/30 shadow-sm">
                <option value="">- Hành động hàng loạt -</option>
                <option value="delete" @if (old('action') == 'delete') selected @endif>Bỏ vào thùng rác</option>
            </select>
            {{-- button --}}
            <x-button-customize type="submit" class="mt-1 md:mt-0 w-full md:w-auto">Áp dụng</x-button-customize>
            {{-- thông báo --}}
            <x-flash-session-normal key="status_failed" class="text-red-700 mt-2 md:mt-0">
                <i class="fa-solid fa-circle-exclamation"></i>
            </x-flash-session-normal>
        </div>
        {{-- Bảng customer --}}
        <div class="overflow-x-auto mt-2">
            <table class="text-sm border-gray-300 min-w-[1200px] md:w-full mt-3">
                <thead>
                    <tr class="font-semibold">
                        <td class="px-1 py-1">
                            <input type="checkbox" name="check_all" class="check_all rounded-sm cursor-pointer">
                        </td>
                        <td class="py-1 px-2 select-none">#</td>
                        <td class="py-1 select-none">Họ tên</td>
                        <td class="py-1 select-none">Email</td>
                        <td class="py-1 select-none">Số điện thoại</td>
                        <td class="py-1 select-none">Đơn hàng của khách</td>
                        <td class="py-1 select-none">Địa chỉ</td>
                        <td class="py-1 select-none">Ngày đăng ký</td>
                        <td class="py-1 text-center select-none w-[50px]">Xóa</td>
                    </tr>
                </thead>
                {{-- Dữ liệu customer --}}
                <tbody>
                    @foreach ($customers as $customer)
                        <tr class="border-gray-300 border-b border-gray-500/15 hover:bg-gray-300/20 transition-all duration-150">
                            <td class="py-3 px-1">
                                <input type="checkbox" name="customer_id[]" value="{{ $customer->id }}"
                                    {{ is_array(old('customer_id')) && in_array($customer->id, old('customer_id')) ? 'checked' : '' }}
                                    class="check_single rounded-sm cursor-pointer">
                            </td>
                            <td class="py-3 px-2 select-none w-[50px]">{{ ($customers->currentPage() - 1) * $customers->perPage() + $loop->iteration }}</td>
                            <td class="py-3 select-none w-[150px]">{{ $customer->name }}</td>
                            <td class="py-3 select-none">
                                <div class="w-[150px] truncate">
                                    {{ $customer->gmail }}
                                </div>
                            </td>
                            <td class="py-3 select-none w-[150px]">{{ $customer->tel }}</td>
                            <td class="py-3 select-none">{{ $customer->order->code }}</td>
                            <td class="py-3 select-none">{{ $customer->address }}</td>
                            <td class="py-3 select-none">{{ $customer->created_at }}</td>    
                            <td class="py-3 text-center">
                                <a href="{{ route('admin.customers.destroy', $customer->id) }}"
                                    onclick="return confirm('Bạn có chắc muốn xóa thành viên này ?')">
                                    <i class="fa-solid fa-trash text-lg text-red-500/70 cursor-pointer hover:text-red-600 transition-all duration-150"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        {{-- panigation --}}
        <div class="mt-4">
            {{ $customers->links('pagination::tailwind', ['class' => 'customer_pagination']) }}
        </div>

    </form>
@else
    <p class="text-gray-500 px-3 pt-0 rounded-lg"> Nội dung này chưa có bản ghi nào ! </p>
@endif
