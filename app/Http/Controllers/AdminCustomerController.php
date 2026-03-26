<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class AdminCustomerController extends Controller
{
    // Danh sách
    function list() {

        // Lấy danh sách customer
        $customers = Customer::orderBy('created_at', 'asc')->paginate(7);
        // Lấy số liệu thống kê
        $total_customers = Customer::all()->count();
       
        return view('admin.customer.list', compact('customers', 'total_customers'));
    }

    // Danh sách theo tìm kiếm (Ajax)
    function list_filter(Request $request) {

        // Lấy giá trị từ Ajax
        $search_value = $request->search_value;

        if(!$search_value){
            $customers = Customer::orderBy('created_at', 'asc')->paginate(7);
        }else{
            $customers = Customer::where('name','like','%'.$search_value.'%')->orderBy('created_at', 'desc')->paginate(7);
        }
       
        $view = view('admin.customer.partials.list_normal', compact('customers'))->render();
       
        // Trả dữ liệu json về cho Ajax
        $data = [
            'view' => $view,
        ];
        return response()->json($data);
    }

    // Thùng rác
    function trash() {
        $total_customers = Customer::onlyTrashed()->count();
        $customers = Customer::onlyTrashed()->orderBy('deleted_at','desc')->paginate(7);

        return view('admin.customer.trash',compact('customers','total_customers'));
    }

    // Thùng theo tìm kiếm (Ajax)
    function trash_filter(Request $request) {
        $search_value = $request->search_value_trash;

        if ($search_value) {
            $customers = Customer::onlyTrashed()->where('name', 'like', '%' . $search_value . '%')->orderBy('deleted_at', 'desc')->paginate(7);
        } else {
            $customers = Customer::onlyTrashed()->orderBy('deleted_at', 'desc')->paginate(7);
        }

        $view = view('admin.customer.partials.list_trash', compact('customers'))->render();

        $data = ['view' => $view];

        return response()->json($data);
    }

    // Bỏ vào thùng rác
    function destroy($id) {
        Customer::find($id)->delete();
        return back()->with('status_complete','Đã bỏ vào thùng rác');
    }

    // Xóa vĩnh viễn
    function forceDelete($id) {
        Customer::onlyTrashed()->where('id',$id)->forceDelete();
        return back()->with('status_complete','Đã xóa khách hàng này khỏi hệ thống');
    }

    // Hành động
    function action(Request $request) {
        // Lấy giá trị từ request
        $action = $request->action;
        $customer_id = $request->customer_id;

        // Kiểm tra
        if (!$action && !$customer_id) {
            return back()->withInput()->with('status_failed', 'Chọn để thực hiện hành động');
        }

        if ($customer_id && !$action) {
            return back()->withInput()->with('status_failed', 'Chọn hành động để thực hiện');
        }

        if ($action == NULL) {
            return back()->withInput()->with('status_failed', 'Bạn cần chọn hành động');
        }

        if ($customer_id == NULL) {
            return back()->withInput()->with('status_failed', 'Chọn khách hàng để hành động');
        }

        if($action == 'delete'){
            Customer::destroy($customer_id);
            return back()->with('status_complete','Đã bỏ vào thùng rác');
        }

        if($action == 'restore'){
            foreach($customer_id as $id){
                Customer::onlyTrashed()->where('id',$id)->restore();
            }
            return redirect()->route('admin.customers')->with('status_complete','Khôi phục thành công');
        }

        if($action == 'forceDelete'){
            foreach($customer_id as $id){
                Customer::onlyTrashed()->where('id',$id)->forceDelete();
            }
            return back()->with('status_complete','Đã xóa khách hàng khỏi hệ thống');
        }

    }

    // Khôi phục
    function restore($id) {}
}
