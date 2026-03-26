<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\ProductCategory;

class AdminProductCatController extends Controller
{
    // Danh sách danh mục
    function list()
    {
        // Lấy danh sách
        $categories = ProductCategory::with('user')->get();
        $categories = data_tree($categories);

        // Thống kê trạng thái
        $active_status = ProductCategory::where('status', 'active')->count();
        $unactive_status = ProductCategory::where('status', 'unactive')->count();
        $total_trash = ProductCategory::onlyTrashed()->count();
        $total = ProductCategory::withoutTrashed()->count();

        return view('admin.product.list_categories', compact('categories', 'active_status', 'unactive_status', 'total', 'total_trash'));
    }

    // Trang thêm danh mục
    function create()
    {
        $list_parent_cats = ProductCategory::where('parent_id', 0)->get();
        return view('admin.product.create_category', compact('list_parent_cats'));
    }

    // Chuẩn hóa dữ liệu + thêm mới danh mục
    function store(Request $request)
    {

        $cat_duplicate = ProductCategory::where('name', $request->parent_cat_name)->first();
        if ($cat_duplicate) {
            return redirect()->route('admin.product.categories.create')->withInput()->with('add_failed_parent', 'Danh mục đã tồn tại trên hệ thống, vui lòng chọn tên khác');
        }

        // Danh mục cha
        if ($request->parent_category) {
            $request->validate([
                'parent_cat_name' => 'required|min:2|max:255|regex:/^[\p{L}\s,-]+$/u',
                'parent_cat_slug' => 'required',
            ]);

            ProductCategory::create([
                'parent_id' => 0,
                'name' => $request->parent_cat_name,
                'slug' => 'san-pham/' . Str::slug($request->parent_cat_slug),
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

            ProductCategory::create([
                'parent_id' => $request->parent_cat,
                'name' => $request->child_cat_name,
                'slug' => 'san-pham/' . Str::slug($request->child_cat_slug),
                'status' => $request->child_cat_status,
                'user_id' => Auth::user()->id,
            ]);
        }

        return redirect()->route('admin.product.categories.create')->with('add_complete', 'Thêm mới thành công');
    }

    // Cập nhật nhanh trạng thái (Ajax)
    function updateStatusCategory(Request $request)
    {
        $status_value = $request->status_value;
        $category_id = $request->category_id;

        ProductCategory::where('id', $category_id)->update([
            'status' => $status_value,
            'updated_at' => now()
        ]);

        $active_status = ProductCategory::where('status', 'active')->get()->count();
        $unactive_status = ProductCategory::where('status', 'unactive')->get()->count();
        $total = ProductCategory::withoutTrashed()->get()->count();

        $view = view('admin.product.partials.status_category', compact('status_value'))->render();

        $data = [
            'view' => $view,
            'category_id' => $category_id,
            'active_status' => $active_status,
            'unactive_status' => $unactive_status,
        ];

        return response()->json($data);
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
                ProductCategory::where('parent_id', $id)->update(['status' => 'unactive']);
                ProductCategory::where('parent_id', $id)->delete();

                ProductCategory::where('id', $id)->update(['status' => 'unactive']);
                ProductCategory::where('id', $id)->delete();
            }

            // Hành động cập nhật trạng thái
            if ($category_action == 'active' || $category_action == 'unactive') {
                ProductCategory::where('id', $id)->update(['status' => $category_action, 'updated_at' => now()]);
                ProductCategory::where('parent_id', $id)->update(['status' => $category_action, 'updated_at' => now()]);
            }

            // Hành động khôi phục
            if ($category_action == 'restore') {
                ProductCategory::onlyTrashed()->where('parent_id', $id)->restore();
                ProductCategory::onlyTrashed()->where('id', $id)->restore();
            }

            // Xóa vĩnh viễn
            if ($category_action == 'force_delete') {
                ProductCategory::onlyTrashed()->where('id', $id)->forceDelete();
                ProductCategory::onlyTrashed()->where('parent_id', $id)->forceDelete();
            }
        }

        return back()->with('status_complete', 'Thao tác thành công');
    }

    // Bỏ vào thùng rác
    function destroy($id)
    {
        
        $child_categories = ProductCategory::where('parent_id',$id)->get();

        // Nếu là danh mục cha có con
        if($child_categories->count() > 0){
            // Xử lý danh mục con
            foreach($child_categories as $child){
                ProductCategory::where('id',$child->id)->update(['status'=>'unactive']);
            }
            ProductCategory::destroy($child_categories);

            // Xử lí danh mục cha
            ProductCategory::where('id',$id)->update(['status'=>'unactive']);
            ProductCategory::where('id',$id)->delete();

        // Nếu là danh mục cha mồ côi hoặc con mồ côi    
        }else{  
            $parent_categories = ProductCategory::where('id',$id)->get();
            foreach($parent_categories as $item){
                if($item->parent_id == 0){
                    // Nếu là danh mục cha
                    ProductCategory::where('id',$id)->update(['status' => 'unactive']);
                    ProductCategory::where('id',$id)->delete();
                }else{
                    // Nếu là danh mục con
                    ProductCategory::where('id',$id)->update(['parent_id'=> NULL,'status'=>'unactive']);
                    ProductCategory::where('id',$id)->delete();
                }
            }
        }
        return back()->with('status_complete', 'Đã bỏ vào thùng rác');
    }

    // Thùng rác
    function trash()
    {
        $trashs = ProductCategory::with('user')->onlyTrashed()->get();
        $total = $trashs->count();
        $trashs = data_tree($trashs);
    
        return view('admin.product.trash_categories', compact('trashs', 'total'));
    }

    // Cập nhật danh mục
    function edit($id){
        $category_details = ProductCategory::find($id);
        $parent_categories = ProductCategory::where('parent_id', 0)->get();
        return view('admin.product.edit_category',compact('category_details','parent_categories'));
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
        $category_slug = ProductCategory::where('id',$category_id)->value('slug');

        if($parent_id == 0){
            ProductCategory::where('id',$category_id)->update([
                'name' => $request->cat_name,
                'slug' => $request->cat_slug == $category_slug ? $request->cat_slug : 'san-pham/'.Str::slug($request->cat_slug),
                'status' => $request->cat_status,
            ]);
        }

        if($parent_id > 0 || $parent_id == NULL){
            $request->validate([
                'parent_cat' => 'required'
            ]);
            ProductCategory::where('id',$category_id)->update([
                'name' => $request->cat_name,
                'slug' => $request->cat_slug == $category_slug ? $request->cat_slug : 'san-pham/'.Str::slug($request->cat_slug),
                'status' => $request->cat_status,
                'parent_id' => $request->parent_cat
            ]);
        }
        
        return redirect()->route('admin.product.categories.list')->with('status_complete','Cập nhật thành công');
       
    }

    // Khôi phục
    function restore($id){

        $child_categories = ProductCategory::onlyTrashed()->where('parent_id',$id)->get();
        // Nếu thư mục có con
        if($child_categories->count() > 0){
            foreach($child_categories as $cat){
                ProductCategory::onlyTrashed()->where('id',$cat->id)->restore();
            }
            ProductCategory::onlyTrashed()->where('id',$id)->restore();
        // Nếu là thư mục đơn hoặc danh mục mồ côi chưa có liên kết
        }else{
            $is_parent = ProductCategory::onlyTrashed()->where('id',$id)->get()->value('parent_id');
            if($is_parent === NULL || $is_parent === 0){
                ProductCategory::onlyTrashed()->where('id',$id)->restore();
            }
            if($is_parent > 0){
                ProductCategory::onlyTrashed()->where('id',$id)->update(['parent_id'=>NULL]);
                ProductCategory::onlyTrashed()->where('id',$id)->restore();
            }
        }
        return back()->with('status_complete','Khôi phục thành công');
    }

    // Xóa vĩnh viễn
    function forceDelete($id){

        $child_categories = ProductCategory::onlyTrashed()->where('parent_id',$id)->get();
        // Nếu là danh mục cha có con
        if($child_categories->count() > 0){
            foreach($child_categories as $cat){
                ProductCategory::onlyTrashed()->where('id',$cat->id)->forceDelete();
            }
            ProductCategory::onlyTrashed()->where('id',$id)->forceDelete();
        // Nếu là thư mục đơn hoặc danh mục mồ côi chưa có liên kết
        }else{
            ProductCategory::onlyTrashed()->where('id',$id)->forceDelete();
        }
        return back()->with('status_complete','Xóa thành công');
    }

}
