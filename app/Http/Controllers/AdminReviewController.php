<?php

namespace App\Http\Controllers;

use App\Models\ProductReview;
use Illuminate\Http\Request;

class AdminReviewController extends Controller
{

    // Danh sách
    function list(){

        $total_review = ProductReview::all()->count();

        $pending_status = ProductReview::where('status','pending')->get()->count();
        $publish_status = ProductReview::where('status','publish')->get()->count();
        $canceled_status = ProductReview::where('status','canceled')->get()->count();

        $reviews = ProductReview::with('product')->orderBy('created_at','desc')->paginate(7);

        return view('admin.review.list',compact('total_review','reviews','pending_status','publish_status','canceled_status'));
    }

    // Danh sách lọc theo tìm kiếm (Ajax) -------------------------------------------
    function list_filter(Request $request)
    {
        // Lấy giá trị từ Ajax
        $search_value = $request->search_value;
        $reviews = ProductReview::with('product')->where('name','like','%'.$search_value.'%')->orderBy('created_at', 'desc')->paginate(7);
        if (!$search_value) $reviews = ProductReview::with('product')->orderBy('created_at', 'desc')->paginate(7);

        $view = view('admin.review.partials.list_normal',compact('reviews'))->render();

        // Trả dữ liệu json về cho Ajax
        $data = [
            'view' => $view,
        ];
        return response()->json($data);
    }

    // Cập nhật nhanh trạng thái -------------------------------------------
    function updateStatus(Request $request)
    {
        // Lấy giá trị từ Ajax
        $status_value = $request->status_value;
        $review_id = $request->review_id;

        ProductReview::where('id',$review_id)->update([
            'status' => $status_value,
            'updated_at' => now()
        ]);

        // Trả view
        $view = view('admin.review.partials.status_review', compact('status_value'))->render();

        $pending_status = ProductReview::where('status','pending')->get()->count();
        $publish_status = ProductReview::where('status','publish')->get()->count();
        $canceled_status = ProductReview::where('status','canceled')->get()->count();

        // Trả view cho Ajax
        $data = [
            'view' => $view,
            'review_id' => $review_id,
            'pending_status' => $pending_status,
            'publish_status' => $publish_status,
            'canceled_status' => $canceled_status
        ];
        return response()->json($data);
    }

    // Xóa vĩnh viễn
    function forceDelete($id){
        ProductReview::find($id)->delete();
        return back()->with('status_complete','Đã xóa bình luận khỏi hệ thống');
    }

    // Hành động
    function action(Request $request) {
        // Lấy giá trị từ request
        $action = $request->action;
        $review_id = $request->review_id;

        // Kiểm tra
        if (!$action && !$review_id) {
            return back()->withInput()->with('status_failed', 'Chọn để thực hiện hành động');
        }

        if ($review_id && !$action) {
            return back()->withInput()->with('status_failed', 'Chọn hành động để thực hiện');
        }

        if ($action == NULL) {
            return back()->withInput()->with('status_failed', 'Bạn cần chọn hành động');
        }

        if ($review_id == NULL) {
            return back()->withInput()->with('status_failed', 'Chọn bình luận để hành động');
        }

        if($action == 'forceDelete'){
            ProductReview::destroy($review_id);
            return back()->with('status_complete','Đã xóa khách hàng khỏi hệ thống');
        }

        if($action){
            foreach($review_id as $id){
                ProductReview::where('id',$id)->update([
                    'status' => $action,
                    'updated_at' => now()
                ]);
            }
        }

        return back()->with('status_complete','Cập nhật trạng thái thành công');

    }
}
