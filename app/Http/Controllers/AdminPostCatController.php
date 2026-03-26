<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdminPostCatController extends Controller
{

    // Danh sách
    function list(){
        // Lấy danh sách
        $categories = PostCategory::with('user')->get();
        $categories = data_tree($categories);

        // Thống kê trạng thái
        $active_status = PostCategory::where('status', 'active')->count();
        $unactive_status = PostCategory::where('status', 'unactive')->count();
        $total_trash = PostCategory::onlyTrashed()->count();
        $total = PostCategory::withoutTrashed()->count();

        return view('admin.post.list_categories', compact('categories', 'active_status', 'unactive_status', 'total', 'total_trash'));
    }

    // Thêm
    function create(){
        $list_parent_cats = PostCategory::where('parent_id',0)->get();
        return view('admin.post.create_category',compact('list_parent_cats'));
    }

    function store(Request $request){
        $cat_duplicate = PostCategory::where('name', $request->parent_cat_name)->first();
        if ($cat_duplicate) {
            return redirect()->route('admin.post.categories.create')->withInput()->with('add_failed_parent', 'Danh mục đã tồn tại trên hệ thống, vui lòng chọn tên khác');
        }

        // Danh mục cha
        if ($request->parent_category) {
            $request->validate([
                'parent_cat_name' => 'required|min:2|max:255|regex:/^[\p{L}\s,-]+$/u',
                'parent_cat_slug' => 'required',
            ]);

            PostCategory::create([
                'parent_id' => 0,
                'name' => $request->parent_cat_name,
                'slug' => 'bai-viet/' . Str::slug($request->parent_cat_slug),
                'status' => $request->parent_cat_status,
                'user_id' => Auth::user()->id,
            ]);
        }

        // Danh mục con
        if ($request->child_category) {
            $request->validate([
                'child_cat_name' => 'required|min:2|max:255|regex:/^[\p{L}\s,-]+$/u',
                'child_cat_slug' => 'required',
                'parent_cat' => 'required'
            ]);

            PostCategory::create([
                'parent_id' => $request->parent_cat,
                'name' => $request->child_cat_name,
                'slug' => 'bai-viet/' . Str::slug($request->child_cat_slug),
                'status' => $request->child_cat_status,
                'user_id' => Auth::user()->id,
            ]);
        }

        return redirect()->route('admin.post.categories.create')->with('add_complete', 'Thêm mới thành công');
    }

    // Cập nhật
    function edit($id){
        $category_details = PostCategory::find($id);
        $parent_categories = PostCategory::where('parent_id', 0)->get();
        return view('admin.post.edit_category',compact('category_details','parent_categories'));
    }

    function update(Request $request, $id){

        $request -> validate([
                'cat_name' => 'required|min:2|max:255|regex:/^[\p{L}\s,-]+$/u',
                'cat_slug' => 'required'
        ]);

        // Lấy thông tin category
        $parent_id = $request->parent_id;
        $category_id = $id;

        // Kiểm tra slug mới và cũ
        $category_slug = PostCategory::where('id',$category_id)->value('slug');

        if($parent_id == 0){
            PostCategory::where('id',$category_id)->update([
                'name' => $request->cat_name,
                'slug' => $request->cat_slug == $category_slug ? $request->cat_slug : 'san-pham/'.Str::slug($request->cat_slug),
                'status' => $request->cat_status,
            ]);
        }

        if($parent_id > 0 || $parent_id == NULL){
            $request->validate([
                'parent_cat' => 'required'
            ]);
            PostCategory::where('id',$category_id)->update([
                'name' => $request->cat_name,
                'slug' => $request->cat_slug == $category_slug ? $request->cat_slug : 'san-pham/'.Str::slug($request->cat_slug),
                'status' => $request->cat_status,
                'parent_id' => $request->parent_cat
            ]);
        }
        
        return redirect()->route('admin.post.categories.list')->with('status_complete','Cập nhật thành công');
       
    }

    // Thùng rác
    function trash()
    {
        $trashs = PostCategory::with('user')->onlyTrashed()->get();
        $total = $trashs->count();
        $trashs = data_tree($trashs);
    
        return view('admin.post.trash_categories', compact('trashs', 'total'));
    }

    // Bỏ vào thùng rác
    function destroy($id)
    {        
        $child_categories = PostCategory::where('parent_id',$id)->get();

        // Nếu là danh mục cha có con
        if($child_categories->count() > 0){
            // Xử lý danh mục con
            foreach($child_categories as $child){
                PostCategory::where('id',$child->id)->update(['status'=>'unactive']);
            }
            PostCategory::destroy($child_categories);

            // Xử lí danh mục cha
            PostCategory::where('id',$id)->update(['status'=>'unactive']);
            PostCategory::where('id',$id)->delete();

        // Nếu là danh mục cha mồ côi hoặc con mồ côi    
        }else{  
            $parent_categories = PostCategory::where('id',$id)->get();
            foreach($parent_categories as $item){
                if($item->parent_id == 0){
                    // Nếu là danh mục cha
                    PostCategory::where('id',$id)->update(['status' => 'unactive']);
                    PostCategory::where('id',$id)->delete();
                }else{
                    // Nếu là danh mục con
                    PostCategory::where('id',$id)->update(['parent_id'=> NULL,'status'=>'unactive']);
                    PostCategory::where('id',$id)->delete();
                }
            }
        }
        return back()->with('status_complete', 'Đã bỏ vào thùng rác');
    }

    // Khôi phục
    function restore($id){

        $child_categories = PostCategory::onlyTrashed()->where('parent_id',$id)->get();
        // Nếu thư mục có con
        if($child_categories->count() > 0){
            foreach($child_categories as $cat){
                PostCategory::onlyTrashed()->where('id',$cat->id)->restore();
            }
            PostCategory::onlyTrashed()->where('id',$id)->restore();
        // Nếu là thư mục đơn hoặc danh mục mồ côi chưa có liên kết
        }else{
            $is_parent = PostCategory::onlyTrashed()->where('id',$id)->get()->value('parent_id');
            if($is_parent === NULL || $is_parent === 0){
                PostCategory::onlyTrashed()->where('id',$id)->restore();
            }
            if($is_parent > 0){
                PostCategory::onlyTrashed()->where('id',$id)->update(['parent_id'=>NULL]);
                PostCategory::onlyTrashed()->where('id',$id)->restore();
            }
        }
        return back()->with('status_complete','Khôi phục thành công');
    }

    // Xóa vĩnh viễn
    function forceDelete($id){

        $child_categories = PostCategory::onlyTrashed()->where('parent_id',$id)->get();
        // Nếu là danh mục cha có con
        if($child_categories->count() > 0){
            foreach($child_categories as $cat){
                PostCategory::onlyTrashed()->where('id',$cat->id)->forceDelete();
            }
            PostCategory::onlyTrashed()->where('id',$id)->forceDelete();
        // Nếu là thư mục đơn hoặc danh mục mồ côi chưa có liên kết
        }else{
            PostCategory::onlyTrashed()->where('id',$id)->forceDelete();
        }
        return back()->with('status_complete','Xóa thành công');
    }

    // Hành động
    function action(Request $request)
    {
        $category_action = $request->category_action;
        $cats_id = $request->cat_id;

        // Kiểm tra
        if ($category_action == NULL && empty($cats_id)) {
            return back()->withInput()->with('status_failed', 'Vui lòng chọn danh mục, và hành động để tiếp tục');
        }

        if ($category_action == NULL) {
            return back()->withInput()->with('status_failed', 'Vui lòng chọn hành động để tiếp tục');
        }

        if (empty($cats_id)) {
            return back()->withInput()->with('status_failed', 'Vui lòng chọn để tiếp tục hành động');
        }

        // Thực thi hành động
        foreach ($cats_id as $id) {

            // Bỏ vào thùng rác
            if ($category_action == 'trash') {
                PostCategory::where('parent_id', $id)->update(['status' => 'unactive']);
                PostCategory::where('parent_id', $id)->delete();

                PostCategory::where('id', $id)->update(['status' => 'unactive']);
                PostCategory::where('id', $id)->delete();
            }

            // Hành động cập nhật trạng thái
            if ($category_action == 'active' || $category_action == 'unactive') {
                PostCategory::where('id', $id)->update(['status' => $category_action, 'updated_at' => now()]);
                PostCategory::where('parent_id', $id)->update(['status' => $category_action, 'updated_at' => now()]);
            }

            // Hành động khôi phục
            if ($category_action == 'restore') {
                PostCategory::onlyTrashed()->where('parent_id', $id)->restore();
                PostCategory::onlyTrashed()->where('id', $id)->restore();
            }

            // Xóa vĩnh viễn
            if ($category_action == 'force_delete') {
                PostCategory::onlyTrashed()->where('id', $id)->forceDelete();
                PostCategory::onlyTrashed()->where('parent_id', $id)->forceDelete();
            }
        }

        return back()->with('status_complete', 'Thao tác thành công');
    }

    // Cập nhật nhanh trạng thái (Ajax)
    function updateStatusCategory(Request $request)
    {
        $status_value = $request->status_value;
        $category_id = $request->category_id;

        PostCategory::where('id', $category_id)->update([
            'status' => $status_value,
            'updated_at' => now()
        ]);

        $active_status = count(PostCategory::where('status', 'active')->get());
        $unactive_status = count(PostCategory::where('status', 'unactive')->get());
        $total = count(PostCategory::withoutTrashed()->get());

        $view = view('admin.post.partials.status_category', compact('status_value', 'category_id'))->render();
        $data = [
            'view' => $view,
            'category_id' => $category_id,
            'active_status' => $active_status,
            'unactive_status' => $unactive_status,
            'total' => $total
        ];

        return response()->json($data);
    }
}
