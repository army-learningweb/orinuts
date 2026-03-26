<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdminPageController extends Controller
{
    // Danh sách
    function list(){
        $pages = Page::with('user')->orderBy('created_at','desc')->paginate(6);
        $total = Page::all()->count();
        $publish_status = Page::where('status','publish')->count();
        $draft_status = Page::where('status','draft')->count();
        $disable_status = Page::where('status','disable')->count();
        return view('admin.pages.list',compact('pages','total','publish_status','draft_status','disable_status'));
    }

    // Danh sách theo bộ lọc + tìm kiếm (Ajax)
    function list_filter(Request $request)
    {
        $status_value = $request->status_value;
        $search_value = $request->search_value;

        if (!$search_value && !$status_value) $pages = Page::with('user')->orderBy('created_at', 'desc')->paginate(6);

        if ($search_value && !$status_value) $pages = Page::with('user')->where('title', 'like', '%' . $search_value . '%')->paginate(6);

        if (!$search_value && $status_value) $pages = Page::with('user')->where('status', $status_value)->orderBy('created_at', 'desc')->paginate(6);

        if ($search_value && $status_value) $pages = Page::with('user')->where('title', 'like', '%' . $search_value . '%')->where('status', $status_value)->paginate(6);

        $total = Page::all()->count();
        $publish_status = Page::where('status','publish')->count();
        $draft_status = Page::where('status','draft')->count();
        $disable_status = Page::where('status','disable')->count();

        $view = view('admin.pages.partials.list_normal', compact('pages', 'publish_status', 'draft_status', 'disable_status', 'total'))->render();
        $data = ['view' => $view];
        return response()->json($data);
    }

    // Thêm
    function create(){
        return view('admin.pages.create');    
    }

    function store(Request $request){
        $request->validate([
            'title' => 'required|min:2|max:70|regex:/^[\p{L}\p{P}\s\0-9_-]+$/u|unique:pages',
        ]);

        Page::create([
            'title' => $request->title,
            'slug' => Str::slug($request->slug),
            'content' => $request->content,
            'status' => $request->status,
            'user_id' => Auth::user()->id
        ]);

        return redirect()->route('admin.pages.list')->with('status_complete','Thêm trang thành công');
    }

    // Cập nhật
    function edit($id){
        $page_info = Page::find($id);
        return view('admin.pages.edit',compact('page_info'));
    }

    function update(Request $request, $id){
        $request->validate([
            'title' => 'required|min:2|max:70|regex:/^[\p{L}\p{P}\s\0-9_-]+$/u',
        ]);

        Page::where('id',$id)->update([
            'title' => $request->title,
            'slug' => Str::slug($request->slug),
            'content' => $request->content,
            'status' => $request->status,
            'user_id' => Auth::user()->id
        ]);

        return redirect()->route('admin.pages.list')->with('status_complete','Cập nhật thành công');
    }

    // Xóa
    function destroy($id){
        Page::where('id',$id)->delete();
        return back()->with('status_complete','Đã bỏ vào thùng rác');
    }

    // Xóa vĩnh viễn
    function forceDelete($id){
        Page::onlyTrashed()->where('id',$id)->forceDelete();
        return back()->with('status_complete','Đã xóa trang khỏi hệ thống');
    }

    // Khôi phục
    function restore($id){
        Page::onlyTrashed()->where('id',$id)->restore();
        return back()->with('status_complete','Khôi phục thành công');
    }

    // Hành động
    function action(Request $request){
        if ($request->page_action == NULL && !isset($request->page_id)) {
            return back()->withInput()->with('status_failed', 'Vui lòng chọn trang và hành động để tiếp tục');
        }

        if ($request->page_action == NULL) {
            return back()->withInput()->with('status_failed', 'Vui lòng chọn hành động để tiếp tục');
        }

        if (!isset($request->page_id)) {
            return back()->withInput()->with('status_failed', 'Vui lòng chọn trang để tiếp tục');
        }

        if($request->page_action == 'trash'){
            foreach($request->page_id as $id){
                Page::where('id',$id)->update(['status'=>'disable']);
            }
            Page::destroy($request->page_id);
            return back()->with('status_complete', 'Đã bỏ vào thùng rác');
        }

        if($request->page_action == 'restore'){
            foreach($request->page_id as $id){
                Page::where('id',$id)->restore();
            }
            return back()->with('status_complete', 'Khôi phục thành công');
        }

        if($request->page_action == 'forceDelete'){
            foreach($request->page_id as $id){
                Page::where('id',$id)->forceDelete();
            }
            return back()->with('status_complete', 'Đã xóa các trang khỏi hệ thống');
        }

        if($request->page_action){
            foreach($request->page_id as $id){
                Page::where('id',$id)->update(['status'=>$request->page_action,'updated_at'=>now()]);
            }
            return back()->with('status_complete', 'Cập nhật thành công');
        }
    }

    // Cập nhật nhanh trạng thái
    function updateStatus(Request $request){
        $status_value = $request->status_value;
        $page_id = $request->page_id;

        Page::where('id',$page_id)->update(['status'=>$status_value,'updated_at'=>now()]);

        $view = view('admin.pages.partials.status_page',compact('status_value'))->render();

        $publish_status = Page::where('status','publish')->count();
        $draft_status = Page::where('status','draft')->count();
        $disable_status = Page::where('status','disable')->count();

        $data = [
            'view' => $view,
            'page_id' => $page_id,
            'publish_status' => $publish_status,
            'draft_status' => $draft_status,
            'disable_status' => $disable_status
        ];

        return response()->json($data);
    }

    // Thùng rác
    function trash(){
        $trashs = Page::with('user')->onlyTrashed()->orderBy('deleted_at','desc')->paginate(6);
        $total = Page::onlyTrashed()->count();
        return view('admin.pages.trash',compact('trashs','total'));
    }

    // Thùng rác ( lọc )
    function trash_filter(Request $request)
    {
        $search_value = $request->search_value;

        $trashs = Page::with('user')->onlyTrashed()->where('title', 'like', '%' . $search_value . '%')->paginate(6);
        $total = Page::onlyTrashed()->count();

        $view = view('admin.pages.partials.list_trash', compact('trashs', 'total'))->render();

        $data = ['view' => $view];

        return response()->json($data);
    }
}
