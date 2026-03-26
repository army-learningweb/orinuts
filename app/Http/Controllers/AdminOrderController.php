<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\order_item;
use App\Models\Product;
use Carbon\Carbon;

class AdminOrderController extends Controller
{
    // Danh sách
    function list(){

        $orders = Order::with('customer')->orderBy('created_at','desc')->paginate(6);
        
        $total = Order::all()->count();
        $pending_status = Order::where('status','pending')->get()->count();
        $processing_status = Order::where('status','processing')->get()->count();
        $shipped_status = Order::where('status','shipped')->get()->count();
        $delivered_status = Order::where('status','delivered')->get()->count();
        $canceled_status = Order::where('status','canceled')->get()->count();

        $revenue = Order::where('status','delivered')->get()->sum('total_price');

        return view('admin.order.list',compact('revenue','orders','total','pending_status','processing_status','shipped_status','delivered_status','canceled_status'));
    }

    // Danh sách theo bộ lọc + tìm kiếm (Ajax)
    function list_filter(Request $request)
    {
        $status_value = $request->status_value;
        $search_value = $request->search_value;
        $date_value = $request->date_value;

        if($date_value) $orders = Order::where('created_at','>',now()->subDays($date_value))->orderBy('created_at','desc')->paginate(6); 

        if (!$search_value && !$status_value && !$date_value) $orders = Order::with('customer')->orderBy('created_at', 'desc')->paginate(6);

        if ($search_value && !$status_value && !$date_value) $orders = Order::with('customer')->where('code', 'like', '%' . $search_value . '%')->orWhere('tel','like','%'.$search_value.'%')->paginate(6);

        if (!$search_value && !$date_value && $status_value) $orders = Order::with('customer')->where('status', $status_value)->orderBy('created_at', 'desc')->paginate(6);

        if ($search_value && $status_value && !$date_value) $orders = Order::with('customer')->where('code', 'like', '%' . $search_value . '%')->orWhere('tel','like','%'.$search_value.'%')->where('status', $status_value)->paginate(6);

        if (!$search_value && $status_value && $date_value) $orders = Order::where('created_at','>',now()->subDays($date_value))->where('status',$status_value)->paginate(6);

        if ($search_value && $date_value && !$status_value) $orders = Order::where('created_at','>',now()->subDays($date_value))->where('code', 'like', '%' . $search_value . '%')->orWhere('tel','like','%'.$search_value.'%')->paginate(6);
        
        $total = Order::all()->count();
        $pending_status = Order::where('status','pending')->get()->count();
        $processing_status = Order::where('status','processing')->get()->count();
        $shipped_status = Order::where('status','shipped')->get()->count();
        $delivered_status = Order::where('status','delivered')->get()->count();
        $canceled_status = Order::where('status','canceled')->get()->count();
        $revenue = Order::where('status','delivered')->get()->sum('total_price');

        $view = view('admin.order.partials.list_normal', compact('revenue','orders','canceled_status','delivered_status', 'pending_status', 'processing_status', 'shipped_status', 'total'))->render();
        $data = ['view' => $view];
        return response()->json($data);
    }

    // Hành động
    function action(Request $request){
        if ($request->order_action == NULL && !isset($request->order_id)) {
            return back()->withInput()->with('status_failed', 'Vui lòng chọn đơn hàng và hành động để tiếp tục');
        }

        if ($request->order_action == NULL) {
            return back()->withInput()->with('status_failed', 'Vui lòng chọn hành động để tiếp tục');
        }

        if (!isset($request->order_id)) {
            return back()->withInput()->with('status_failed', 'Vui lòng chọn đơn hàng để tiếp tục');
        }

        if($request->order_action == 'trash'){
            foreach($request->order_id as $id){
                Order::where('id',$id)->update(['status'=>'disable']);
            }
            Order::destroy($request->order_id);
            return back()->with('status_complete', 'Đã bỏ vào thùng rác');
        }

        if($request->order_action == 'restore'){
            foreach($request->order_id as $id){
                Order::where('id',$id)->restore();
            }
            return back()->with('status_complete', 'Khôi phục thành công');
        }

        if($request->order_action == 'forceDelete'){
            foreach($request->order_id as $id){
                Order::where('id',$id)->forceDelete();
            }
            return back()->with('status_complete', 'Khôi phục thành công');
        }

        if($request->order_action){
            foreach($request->order_id as $id){
                Order::where('id',$id)->update(['status'=>$request->order_action,'updated_at'=>now()]);
            }
            return back()->with('status_complete', 'Cập nhật trạng thái thành công');
        }
    }


    // Cập nhật nhanh trạng thái
    function updateStatus(Request $request){
        $status_value = $request->status_value;
        $order_id = $request->order_id;

        Order::where('id',$order_id)->update(['status'=>$status_value,'updated_at'=>now()]);

        $view = view('admin.order.partials.status_order',compact('status_value'))->render();

        $pending_status = Order::where('status','pending')->get()->count();
        $processing_status = Order::where('status','processing')->get()->count();
        $shipped_status = Order::where('status','shipped')->get()->count();
        $delivered_status = Order::where('status','delivered')->get()->count();
        $canceled_status = Order::where('status','canceled')->get()->count();
        $revenue = Order::where('status','delivered')->get()->sum('total_price');

        // Nếu đơn hoàn trả trừ tổng doanh thu
        if($status_value == 'refund'){
            $order_price = Order::where('id',$order_id)->get()->value('total_price');
            $revenue - $order_price;
        }

        // Trừ số lượng
        $order_item = order_item::where('order_id',$order_id)->get();
        foreach($order_item as $item){
            $product_quantity = Product::where('id',$item->product_id)->get()->value('quantity');
            Product::where('id',$item->product_id)->update([
                'quantity' => $product_quantity - $item->quantity,
                'sold_count' => $item->quantity
            ]);
        }

        $data = [
            'view' => $view,
            'order_id' => $order_id,
            'pending_status' => $pending_status,
            'processing_status' => $processing_status,
            'shipped_status' => $shipped_status,
            'delivered_status' => $delivered_status,
            'canceled_status' => $canceled_status,
            'status_value' => $status_value,
            'revenue' => number_format($revenue,0,',','.').'đ'
        ];

        return response()->json($data);
    }

    // Chi tiết đơn
    function edit($id){

        $order_details = order_item::where('order_id',$id)->get();
        $order_info = Order::with('customer')->find($id);

        return view('admin.order.edit',compact('order_details','order_info'));
    }

    // Cập nhật thông tin đơn hàng
    function update(Request $request, $id){
        
        $request->validate([
            'address' => 'required|min:5',
            'name' => 'required|min:2',
            'tel' => 'required|min:9'
        ]);

        Order::where('id',$id)->update([
            'shipping_address' => $request->address,
            'updated_at' => now(),
            'status' => $request->status
        ]);

        // Trừ số lượng
        $order_item = order_item::where('order_id',$id)->get();
        foreach($order_item as $item){
            $product_quantity = Product::where('id',$item->product_id)->get()->value('quantity');
            Product::where('id',$item->product_id)->update([
                'quantity' => $product_quantity - $item->quantity,
                'sold_count' => $item->quantity
            ]);
        }

        Customer::where('id',$request->customer_id)->update([
            'name' => $request->name,
            'tel' => $request->tel,
            'updated_at' => now()
        ]);

        return redirect()->route('admin.orders')->with('status_complete','Cập nhật đơn hàng thành công');
    }
}
