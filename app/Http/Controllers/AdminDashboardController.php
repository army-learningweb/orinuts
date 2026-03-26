<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Media;
use App\Models\Order;
use App\Models\order_item;
use App\Models\Post;
use App\Models\Product;

class AdminDashboardController extends Controller
{
    // Thống kê
    function show(){

        $role = Auth::user()->roles[0]->name;
        if($role != 'Admin'){
            return view('admin.work_space');
        }

        $revenue = Order::where('status','delivered')->sum('total_price');
        $total_product = Product::all()->count();
        $total_post = Post::all()->count();
        $total_order_pending = Order::where('status','pending')->count();
        $new_orders = Order::where('status','pending')->orderBy('created_at','desc')->limit(7)->get();
        $out_of_stock = Product::where('quantity','<=',10)->paginate(5);
        
        return view('admin.dashboard',compact('revenue','total_product','total_post','total_order_pending','new_orders','out_of_stock'));
    }

    // Chuyển trang sản phẩm sắp hết hạn (Ajax)
    function paginate_out_of_stock(Request $request){
        $quantity_limit = $request->quantity;

        $out_of_stock = Product::where('quantity','<=',10)->paginate(5);
        $view = view('admin.partials.out_of_stock',compact('out_of_stock'))->render();

        $data = ['view'=>$view];

        return response()->json($data);
    }

    // Lấy đơn hàng mới
    function getNewOrder(){
        $new_orders = Order::with('customer')->where('status','pending')->orderBy('created_at','desc')->limit(7)->get();
        $view = view('admin.partials.new_orders',compact('new_orders'))->render();
        $data = ['view'=>$view];
        return response()->json($data);
    }

    // Lấy thông báo mới
    function getNewAlert(){
        $new_orders = Order::where('status','pending')->orderBy('created_at','desc')->get();
        $alert_count = Order::where('status','pending')->get()->count();

        $view = view('admin.partials.new_orders_alert',compact('new_orders'))->render();

        $data = [
            'view' => $view,
            'alert_count' => $alert_count
        ];

        return response()->json($data);
    }
}
