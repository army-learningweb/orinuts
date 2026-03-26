<!DOCTYPE html>
<html>

<head>
    <meta charset='UTF-8'>
</head>

<body style='background:#F4F7FA; font-family:Arial, Helvetica, sans-serif; line-height:1.5'>
    <div id='wrapper'
        style='background-color: white; font-size:14px; width:600px;margin:0px auto;min-height:500px;padding:20px;box-sizing:border-box;border-radius:7px;'>
        <h1 style="color: green; padding:0; margin:0; font-weiht:bold">Orinuts</h1>
        <p style="margin: 5px 0 5px 2px; font-size:12px">Hệ thống kinh doanh hạt ngũ cốc 100% Organic</p>
        <hr>
        <p style="margin: 5px 0 5px 2px; font-size:12px">Thư xác nhận đơn hàng: <strong>{{ $data['code'] }}</strong></p>
        <p style="margin: 5px 0 5px 2px; font-size:12px;">
            Chào <strong>{{ $data['name'] }}</strong>
            Cảm ơn bạn đã tin tưởng lựa chọn Orinuts! Đơn hàng của bạn đã được tiếp nhận và đang trong quá
            trình chuẩn bị để gửi đến bạn sớm nhất.
        </p>
        <strong style="font-size:12px">Chi tiết đơn hàng</strong>
        <table border='1'
            style='border-collapse: collapse; margin-top: 10px; border-spacing: 10px 10px; width:100%; border-radius:10px'>
            <tr>
                <th
                    style='padding: 8px; background-color: #f4f4f4; text-align: left; font-family: Arial, sans-serif; font-size: 12px; color: #333;'>
                    Tên sản phẩm</th>
                <th
                    style='padding: 8px; background-color: #f4f4f4; text-align: center; font-family: Arial, sans-serif; font-size: 12px; color: #333;'>
                    Số lượng</th>
                <th
                    style='padding: 8px; background-color: #f4f4f4; text-align: right; font-family: Arial, sans-serif; font-size: 12px; color: #333;'>
                    Giá</th>
                <th
                    style='padding: 8px; background-color: #f4f4f4; text-align: right; font-family: Arial, sans-serif; font-size: 12px; color: #333;'>
                    Tổng</th>
            </tr>
            @foreach ($data['cart'] as $item)
                <tr>
                    <td style='padding: 8px; font-family: Arial, sans-serif; font-size: 12px; color: #333;'>
                        {{ $item->name }}
                    </td>
                    <td style='padding: 8px; text-align: center; font-family: Arial, sans-serif; font-size: 12px; color: #333;'>
                        {{ $item->qty }}
                    </td>
                    <td style='padding: 8px; text-align: right; font-family: Arial, sans-serif; font-size: 12px; color: #333;'>
                        {{  number_format($item->price,0,',','.').'đ' }}
                    </td>
                    <td style='padding: 8px; text-align: right; font-family: Arial, sans-serif; font-size: 12px; color: #333;'>
                        {{ number_format($item->subtotal,0,',','.').'đ' }}
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan='4'
                    style='padding: 8px; font-family: Arial, sans-serif; font-size: 12px; color: #333; text-align: left; background-color: #f4f4f4;'>
                    <strong>Tổng cộng</strong> (Đã bao gồm phí vận chuyển): {{ number_format($data['total_price'],0,',','.').'đ' }} </td>
            </tr>
        </table>

        <strong style="font-size:12px; margin:15px 0 10px 0; display:inline-block">Thông tin giao hàng</strong>
        <div style="font-size:12px">Họ tên: {{ $data['name'] }}</div>
        <div style="font-size:12px">Địa chỉ: {{ $data['address'] }}</div>
        <div style="font-size:12px">Số điện thoại: {{ $data['tel'] }}</div>

        <strong style="font-size:12px; margin:15px 0 10px 0; display:inline-block">Phương thức thanh toán</strong>
        <div style="font-size:12px">Tiền mặt</div>

        <strong style="font-size:12px; margin:15px 0 10px 0; display:inline-block">Thông tin liên hệ</strong>
        <div style="font-size:12px">Email: orinuts.support@gmail.com</div>
        <div style="font-size:12px">Số điện thoại: 0782 345 6789</div>
        <div style="font-size:12px">Website: orinuts.test</div>

        <strong style="font-size:12px; margin:10px 0 10px 0; display:inline-block">
            Cảm ơn bạn đã chọn mua sắm tại Orinuts - Chúc bạn một ngày tuyệt vời !
        </strong>
    </div>
</body>

</html>
