@if ($new_orders->count() > 0)
    @foreach ($new_orders as $order)
        <div class="text-xs flex justify-between mt-4">
            <div><i class="fa-solid fa-receipt text-green-600"></i> Đơn hàng <span
                    class="font-semibold">{{ $order->code }}</span> chưa được xử lý</div>
            <div class="text-gray-500 italic text-xs">
                {{ $order->created_at->format('d/m/Y') }}</div>
        </div>
    @endforeach
@else
    <div class="mt-3 text-gray-500">Không có thông báo !</div>
@endif
