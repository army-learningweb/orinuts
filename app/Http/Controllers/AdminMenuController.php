<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductCategory;
use App\Models\PostCategory;
use App\Models\Page;
use App\Models\Menu;

class AdminMenuController extends Controller
{
    // Khu vực quản lí menu
    function manager(){

        $product_categories = ProductCategory::where('status','active')->get();
        $post_categories = PostCategory::where('status','active')->get();
        $pages = Page::where('status','publish')->get();
        $menus = Menu::where('status','active')->get(); 

        $list_menu = Menu::all();

        $product_categories = data_tree($product_categories);
        $post_categories = data_tree($post_categories);
        $menus = data_tree($menus);
        $list_menu = data_tree($list_menu);
        
        return view('admin.menu.manager',compact('pages','product_categories','post_categories','menus','list_menu'));
    }

    // Thêm
    function store(Request $request){
        $request->validate([
            'order' => 'required',      
        ]);

        $order = $request->order;
        $status = $request->status;
        $page = $request->page;
        $post = $request->post;
        $product = $request->product;
        $parent_id = $request->parent_id ? $request->parent_id : 0;

        if($page == null && $post == null && $product == null) return back()->withInput()->with('status_failed','Chưa chọn liên kết');
        
        if($page && $post) return back()->withInput()->with('status_failed','Chỉ được chọn 1 liên kết');
        if($post && $product) return back()->withInput()->with('status_failed','Chỉ được chọn 1 liên kết');
        if($product && $page) return back()->withInput()->with('status_failed','Chỉ được chọn 1 liên kết');

        if($page && $post == null && $product == null){
            $type = 'page';
            $slug = Page::where('id',$page)->get()->value('slug');
            $name = Page::where('id',$page)->get()->value('title');
            $object_id = Page::where('id',$page)->get()->value('id');
        }

        if($post && $product == null && $page == null){
            $type = 'post';
            $slug = PostCategory::where('id',$post)->get()->value('slug');
            $name = PostCategory::where('id',$post)->get()->value('name');
            $object_id = PostCategory::where('id',$post)->get()->value('id');
        }

        if($product && $page == null && $post == null){
            $type = 'product';
            $slug = ProductCategory::where('id',$product)->get()->value('slug');
            $name = ProductCategory::where('id',$product)->get()->value('name');
            $object_id = ProductCategory::where('id',$product)->get()->value('id');
        } 

        Menu::create([
            'name' => $name,
            'slug' => $slug,
            'order' => $order,
            'status' => $status,
            'type' => $type,
            'object_id'=> $object_id,
            'parent_id' => $parent_id,
            'user_id' => Auth::user()->id
        ]);
    
        return back()->with('status_complete','Thêm mới thành công');
    }

    // Xóa
    function forceDelete($id){

        $this_menu = Menu::where('id',$id)->delete();
        $this_child_menu = Menu::where('parent_id',$id)->get()->value('id');
        $this_sub_child_menu = Menu::where('parent_id',$this_child_menu)->delete();

        $this_child_menu = Menu::where('parent_id',$id)->delete();

        return back()->with('status_complete','Xóa thành công');
    }

    // Cập nhật nhanh trạng thái
    function updateStatus(Request $request){

        $status_value = $request->status_value;
        $menu_id = $request->menu_id;

        Menu::where('id',$menu_id)->update(['status'=>$status_value,'updated_at'=>now()]);

        $view = view('admin.menu.partials.status_menu',compact('status_value'))->render();
        $data = [
            'view' => $view,
            'menu_id' => $menu_id
        ];

        return response()->json($data);
    }

    function changeOrder(Request $request){
        $order_value = $request->order_value;
        $menu_id = $request->menu_id;

        Menu::where('id',$menu_id)->update([
            'order' => $order_value,
            'updated_at' => now()
        ]);

        $data = [
            'order_value' => $order_value,
            'menu_id' => $menu_id
        ];

        return response()->json($data);
        

    }
}
