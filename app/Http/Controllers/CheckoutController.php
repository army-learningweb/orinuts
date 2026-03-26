<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\support\Str;
use Illuminate\Support\Facades\Cookie;

use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Customer;
use App\Models\Order;
use App\Models\order_item;
use App\Models\Product;

use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;

class CheckoutController extends Controller
{
    // Xem hóa đơn
    function view(){

        $carts = Cart::content();
        
        if(Cart::total() >= 490000){
            $cart_total = Cart::total();
            $checkout_ship = 'Miễn phí';
        }else if(Cart::total() < 490000){
            $cart_total = Cart::total() + 30000;
            $checkout_ship = '30.000đ';
        }

        return view('client.checkout.view',compact('carts','cart_total','checkout_ship'));
    }

    // Điều chỉnh phí vận chuyển , thay đổi cách thanh toán (Ajax)
    function changePaymentMethod(Request $request){
        $payment_method = $request->payment_method;

        if($payment_method == 'cod'){
            if(Cart::total() > 490000){
                $view_ship = 'Miễn phí';
                $cart_total = number_format(Cart::total(),0,',','.').'đ';
            }else{
                $view_ship = '30.000đ';
                $cart_total = number_format(Cart::total() + 30000,0,',','.').'đ';
            }
        }else{
            $view_ship = 'Miễn phí';
            $cart_total = number_format(Cart::total(),0,',','.').'đ';
        }

        $data = [
            'view_ship' => $view_ship,
            'cart_total' => $cart_total,
            'payment_method' => $payment_method
        ];

        return response()->json($data);
    }

    // Tạo đơn, tạo khách hàng, gửi mail
    function order(Request $request){

        $request->validate([
            'name' => 'required|min:2|regex:/^[\p{L}\s]+$/u',
            'address' => 'required|min:5',
            'tel' => [
                'required',
                'nullable',
                'regex:/^(032|033|034|035|036|037|038|039|096|097|098|086|083|084|085|081|082|088|091|094|070|079|077|076|078|090|093|089|056|058|092|059|099)[0-9]{7}$/'
            ], 
            'email' => 'required|email'
        ]);

        // Tạo khách hàng
        $new_customer = Customer::create([
            'name' => $request->name,
            'tel' => $request->tel,
            'address' => $request->address,
            'gmail' => $request->email
        ]);

        // Tạo cookie lưu trữ thông tin vừa nhập
        Cookie::queue('name',$request->name,60);
        Cookie::queue('tel',$request->tel,60);
        Cookie::queue('address',$request->address,60);
        Cookie::queue('email',$request->email,60);

        // Tạo đơn
        if($request->payment_method == 'cod'){
            if(Cart::total() > 490000){
                $total = Cart::total();
            }else{
                $total = Cart::total() + 30000;
            }
        }else{
            $total = Cart::total();
        }

        $code = 'ori#'.Str::random(5);
        $new_order = Order::create([
            'code' => $code,
            'total_amount' => Cart::count(),
            'total_price' => $total,
            'shipping_address' => $request->address,
            'payment_method' => $request->payment_method,
            'customer_id' => $new_customer->id,
            'note' => $request->note,
            'tel' => $request->tel
        ]);

        // Chi tiết đơn
        foreach(Cart::content() as $row){
            $product_info = Product::where('id',$row->id)->first();
            $product_info->disscount > 0 ? $price = $product_info->price - ($product_info->price * ($product_info->disscount/100)) : $price = $row->price;

            order_item::create([
                'order_id' => $new_order->id,
                'product_id' => $row->id,
                'quantity' => $row->qty,
                'price' => $price
            ]);
        }

        // Gửi mail
        $order_date = Order::where('id',$new_order->id)->get()->value('created_at');

        $data = [
            'name' => $request->name,
            'tel' => $request->tel,
            'address' => $request->address,
            'code' => $code,
            'cart' => Cart::content(),
            'total_price' => $total,
            'payment_method' => $request->payment_method,
            'order_date' => $order_date
        ];

        Mail::to($request->email)->send(new OrderMail($data));

        Cart::destroy();

        if($request->payment_method != 'cod'){
            return redirect()->route('thanh-toan-online',$request->payment_method)->with('status_complete','Đơn đặt hàng của bạn đang được xử lý');
        }
        return redirect()->route('hoan-tat-dat-hang')->with('status_complete','Đơn đặt hàng của bạn đang được xử lý');
    }

    function payOnline($method){
        return view('client.checkout.payOnline',compact('method'));
    }

    function checkoutComplete(){
        return view('client.checkout.checkoutComplete');
    }

}
