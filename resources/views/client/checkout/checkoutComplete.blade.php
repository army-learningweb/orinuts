<x-client-app-layout>

    <div class="mt-2 overflow-hidden flex flex-col justify-center items-center bg-white rounded-md shadow-sm py-5 animation_content_slide_up h-[400px] md:h-[600px] w-full md:w-[990px] mx-auto">
        <div class="p-4 text-green-600 rounded-md text-center select-none">
            <i class="fa-solid fa-circle-check text-4xl"></i>
            <p class="text-xl mt-2">Đơn đặt hàng của bạn đang được xử lý</p>
        </div>
        <div class="w-[350px]">
            <p class="text-center font-semibold mb-1 select-none">Cảm ơn bạn đã tin tưởng , mua sắm tại Orinuts !</p>
            <p class="text-center font-semibold mb-3 select-none">Đơn hàng sẽ được xử lý trong 24h</p>
            <a href="https://mail.google.com" target="blank"
                class="text-xs font-semibold py-1 bg-white text-center rounded-md flex items-center justify-center border border-1 hover:shadow-sm transition-all duration-150">
                <span><img src="{{ asset('images/gmail.jpg') }}" alt="gmail" width="40px"></span>
                <span>Chúng tôi đã gửi đơn xác nhận đến Mail của bạn</span>
            </a>
            <div class="bg-amber-500/30 p-2 rounded-md mt-1 text-center shadow-sm select-none">
                <div>Không tìm thấy Email xác nhận ?</div>
                <div>Kiểm tra thư mục Spam/Quảng cáo</div>
            </div>
            <a href="{{ route('/') }}" class="bg-gradient-to-r from-green-500 to-green-700 w-full py-2 rounded-md shadow-sm text-white inline-block text-center mt-1 hover:brightness-110">Tiếp tục mua sắm</a>
        </div>
    </div>

</x-client-app-layout>
