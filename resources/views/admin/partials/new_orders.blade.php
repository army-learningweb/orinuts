<table class=" border-b border-gray-500/10 mt-3 min-w-[800px]">
    <tr class="font-semibold">
        <td class="px-3 py-2 select-none">#</td>
        <td class="px-3 py-2 select-none">Mã đơn hàng</td>
        <td class="px-3 py-2 select-none">Người mua</td>
        <td class="px-3 py-2 select-none text-center">Số sản phẩm</td>
        <td class="px-3 py-2 select-none">Tổng tiền</td>
        <td class="px-3 py-2 select-none text-center">Trạng thái</td>
        <td class="px-3 py-2 select-none"></td>
    </tr>
    @php
        $num = 1;
    @endphp
    @foreach ($new_orders as $item)
        <tr class="border-b border-gray-500/10">
            <td class="px-3 py-3 select-none">{{ $num++ }}</td>
            <td class="px-3 py-3 select-none">{{ $item->code }}</td>
            <td class="px-3 py-3 select-none">
                {{ $item->customer ? $item->customer->name : '(Không xác định)' }}</td>
            <td class="px-3 py-3 select-none text-center">{{ $item->total_amount }}</td>
            <td class="px-3 py-3 select-none font-semibold">
                {{ number_format($item->total_price, 0, ',', '.') . 'đ' }}</td>
            <td class="px-3 py-3 select-none text-center">
                <div class="inline-block">
                    {!! set_status_order('pending') !!}
                </div>
            </td>
            <td class="px-3 py-3 select-none">
                <a href="{{ route('admin.orders.edit', $item->id) }}" class="text-blue-600 hover:text-blue-800">
                    Xử lí đơn <i class="fa-solid fa-arrow-right-long"></i>
                </a>
            </td>
        </tr>
    @endforeach
</table>
