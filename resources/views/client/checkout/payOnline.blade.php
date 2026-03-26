<x-client-app-layout>

    <div class="mt-2 flex flex-col md:flex-row items-start gap-2 md:w-[1250px] md:max-h-[600px] mx-auto overflow-hidden">
        <div class="bg-white shadow-sm rounded-md p-5 w-full md:w-[30%]">
            @if (session('status_complete'))
                <div class="p-4 bg-green-600/20 text-green-600 rounded-md text-center select-none mb-2">
                    <i class="fa-solid fa-circle-check"></i>
                    &nbsp; {{session('status_complete')}}
                </div>
            @endif
            <p class="text-center font-semibold mb-1 select-none">Cảm ơn bạn đã tin tưởng , mua sắm tại Orinuts !</p>
            <p class="text-center font-semibold mb-3 select-none">Đơn hàng sẽ được xử lý trong 24h</p>
            <div class="mt-2">
                <a href="https://mail.google.com" target="blank"
                    class="text-xs font-semibold py-1 bg-white text-center rounded-md flex items-center justify-center border border-1 hover:shadow-sm transition-all duration-150">
                    <span><img src="{{ asset('images/gmail.jpg') }}" alt="gmail" width="40px"></span>
                    <span>Chúng tôi đã gửi đơn xác nhận đến Mail của bạn</span>
                </a>
            </div>
            <div class="mt-5 font-semibold text-center flex gap-2 items-center select-none">
                <p>Vui lòng quét mã QR để thanh toán cho hóa đơn</p>
                <i class="fa-solid fa-arrow-right"></i>
            </div>
            <div class="mt-5 text-gray-500 text-xs select-none">
                <p>Sau khi nhận thanh toán, bộ phận chăm sóc khách hàng sẽ sớm liên lạc với bạn để xác nhận khoản thanh toán</p>
            </div>
        </div>
        <div class="flex-1 bg-white shadow-sm rounded-md p-5 flex justify-center overflow-hidden">
            @if ($method == 'momo')
                <img src="{{asset('images/momo.jpg')}}" alt="" class="h-[500px] object-cover">
            @endif

            @if ($method == 'zalo')
                <img src="{{asset('images/zalopay.jpg')}}" alt="" class="h-[500px] object-cover">
            @endif

             @if ($method == 'banking')
                <img src="{{asset('images/banking.jpg')}}" alt="" class="h-[500px] object-cover">
            @endif
            
        </div>
    </div>



</x-client-app-layout>
