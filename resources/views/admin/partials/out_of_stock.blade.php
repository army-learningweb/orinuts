<table class="border-b border-gray-500/10 min-w-[400px] md:min-w-0 mt-3">
    <tr class="font-semibold">
        <td class="px-3 py-2 select-none text-center">Ảnh</td>
        <td class="px-3 py-2 select-none">Tên</td>
        <td class="px-3 py-2 select-none text-center">Số lượng</td>
        <td class="px-3 py-2 select-none">Tùy chỉnh</td>
    </tr>
    @foreach ($out_of_stock as $item)
        <tr class="border-b border-gray-500/10">
            <td class="px-3 py-1 select-none flex justify-center">
                <img src="{{ asset($item->media->url) }}" alt=""
                    class="rounded-md w-[70px] h-[50px] object-contain">
            </td>
            <td class="px-3 py-1 select-none">
                <div class="w-[100px] truncate">{{ $item->name }}</div>
            </td>
            <td class="px-3 py-1 select-none text-center">{{ $item->quantity }}</td>
            <td class="px-3 py-1 select-none"><a href="{{ route('admin.product.edit', $item->id) }}"
                    class="text-blue-600 hover:text-blue-800">Điều chỉnh</a></td>
        </tr>
    @endforeach
</table>
<div class="mt-3">
    {{ $out_of_stock->links('pagination::tailwind', ['class' => 'out_of_stock_pagination']) }}
</div>
