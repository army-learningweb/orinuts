<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

use App\Models\ProductCategory;
use App\Models\Media;
use App\Models\Product;

class AdminProductController extends Controller
{
    // Danh sách
    function list()
    {
        $products = Product::with('user')->with('media')->orderBy('created_at', 'desc')->paginate(5);

        $active_status = Product::where('status', 'active')->get()->count();
        $unactive_status = Product::where('status', 'unactive')->get()->count();
        $total = Product::all()->count();
        $total_trash = Product::onlyTrashed()->count();

        return view('admin.product.list', compact('products', 'active_status', 'unactive_status', 'total', 'total_trash'));
    }

    // Danh sách theo bộ lọc + tìm kiếm (Ajax)
    function list_filter(Request $request)
    {

        $status_value = $request->status_value;
        $search_value = $request->search_value;

        if (!$search_value && !$status_value) $products = Product::with('user')->with('media')->orderBy('created_at', 'desc')->paginate(5);

        if ($search_value && !$status_value) $products = Product::with('user')->with('media')->where('name', 'like', '%' . $search_value . '%')->paginate(5);

        if (!$search_value && $status_value) $products = Product::with('user')->with('media')->where('status', $status_value)->orderBy('created_at', 'desc')->paginate(5);

        if ($search_value && $status_value) $products = Product::with('user')->with('media')->where('name', 'like', '%' . $search_value . '%')->where('status', $status_value)->paginate(5);

        $active_status = Product::where('status', 'active')->get()->count();
        $unactive_status = Product::where('status', 'unactive')->get()->count();
        $total = Product::all()->count();
        $total_trash = Product::onlyTrashed()->count();

        $view = view('admin.product.partials.list_normal', compact('products', 'active_status', 'unactive_status', 'total', 'total_trash'))->render();
        $data = ['view' => $view];
        return response()->json($data);
    }

    // Thêm
    function create()
    {
        $product_categories = ProductCategory::all();
        $product_categories = data_tree($product_categories);
        return view('admin.product.create', compact('product_categories'));
    }

    function store(Request $request)
    {
        $request->validate([
            'code' => 'required|min:6|regex:/^([ori#]+)([0-9]+)$/|unique:products',
            'name' => 'required|min:2|regex:/^[\p{L}\s]+$/u',
            'desc' => 'required|min:2|regex:/^[\p{L}\p{P}\p{S}\s\0-9]+$/u',
            'price' => 'required',
            'quantity' => 'required',
            'slug' => 'required',
            'code' => 'required',
            'product_cat' => 'required',
        ]);

        if (empty($request->img_id[0])) {
            return back()->withInput()->with('status_failed', 'Không để trống ảnh sản phẩm');
        }

        $new_product = Product::create([
            'code' => $request->code,
            'name' => $request->name,
            'desc' => $request->desc,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'slug' => 'san-pham/' . Str::slug($request->slug),
            'up_sale' => $request->up_sale,
            'status' => $request->status,
            'disscount' => $request->disscount,
            'details' => $request->product_details,
            'user_id' => Auth::user()->id,
            'cat_id' => $request->product_cat,
            'img_id' => $request->img_id[0]
        ]);

        foreach ($request->img_id as $id) {
            Media::where('id', $id)->update([
                'object_id' => $new_product->id
            ]);
        }

        // Xóa toàn bộ session lưu ảnh
        $request->session()->forget('main_img_product');
        $request->session()->forget('id_main_product');
        
        for($i = 1; $i <= 4; $i++){
            $request->session()->forget('sub_img_'.$i);
            $request->session()->forget('id_sub_'.$i);
        }

        return redirect()->route('admin.product.list')->with('status_complete', 'Thêm sản phẩm thành công');
    }

    // Cập nhật
    function edit($id)
    {
        $product_info = Product::with('media')->find($id);

        $product_categories = ProductCategory::all();
        $product_categories = data_tree($product_categories);
        $sub_imgs = Media::where('object_id', $id)->where('is_main', '>', 0)->where('object_type','product')->get();
        return view('admin.product.edit', compact('product_info', 'product_categories', 'sub_imgs'));
    }

    function update(Request $request, $id)
    {

        $request->validate([
            'code' => 'nullable|min:6|regex:/^([ori#]+)([0-9]+)$/|unique:products',
            'name' => 'required|min:2|regex:/^[\p{L}\s]+$/u',
            'desc' => 'required|min:2|regex:/^[\p{L}\p{P}\p{S}\s\0-9]+$/u',
            'price' => 'required',
            'quantity' => 'required',
            'slug' => 'required',
            'code' => 'required',
            'product_cat' => 'required',
        ]);

        if (empty($request->img_id[0])) {
            return back()->with('status_failed', 'Không để trống ảnh sản phẩm');
        }

        $new_img_id = $request->img_id;
        $old_img_id = $request->old_img_id;

        for ($i = 0; $i <= count($old_img_id) - 1; $i++) {

            // Trường hợp thêm ảnh
            if ($new_img_id[$i] && $old_img_id[$i] == NULL) {
                Media::where('id', $new_img_id[$i])->update(['object_id' => $id]);
            }

            // Trường hợp xóa ảnh
            if ($new_img_id[$i] == NULL) {
                $old_img_path = Media::where('id', $old_img_id[$i])->get()->value('url');
                if (File::exists(public_path($old_img_path))) {
                    File::delete(public_path($old_img_path));
                }
                Media::where('id', $old_img_id[$i])->delete();
            }

            // Trường hợp thay đổi ảnh
            if ($new_img_id[$i] != $old_img_id[$i]) {

                if ($old_img_id[$i] != NULL) {
                    $old_img_path = Media::where('id', $old_img_id[$i])->get()->value('url');
                    if (File::exists(public_path($old_img_path))) {
                        File::delete(public_path($old_img_path));
                    }

                    $new_img_info = Media::where('id', $new_img_id[$i])->get();
                    foreach ($new_img_info as $info) {
                        Media::where('id', $old_img_id[$i])->update([
                            'url' => $info->url,
                            'file_name' => $info->file_name,
                            'file_size' => $info->file_size,
                            'is_main' => $info->is_main,
                            'object_type' => 'product',
                            'object_id' => $id,
                            'user_id' => Auth::user()->id,
                            'updated_at' => now()
                        ]);
                    }
                    Media::where('id', $new_img_id[$i])->delete();
                }
            }
        }

        $old_slug = Product::where('id',$id)->get()->value('slug');
        Product::where('id',$id)->update([
            'code' => $request->code,
            'name' => $request->name,
            'desc' => $request->desc,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'slug' => $request->slug == $old_slug ? $request->slug : 'san-pham/'.Str::slug($request->slug),
            'up_sale' => $request->up_sale,
            'status' => $request->status,
            'disscount' => $request->disscount,
            'details' => $request->product_details,
            'user_id' => Auth::user()->id,
            'cat_id' => $request->product_cat,
            'updated_at' => now()
        ]);

        // Xóa toàn bộ session lưu ảnh
        $request->session()->forget('main_img_product');
        $request->session()->forget('id_main_product');
        
        for($i = 1; $i <= 4; $i++){
            $request->session()->forget('sub_img_'.$i);
            $request->session()->forget('id_sub_'.$i);
        }
        
        return redirect()->route('admin.product.list')->with('status_complete', 'Cập nhật thành công');
    }

    // Bỏ vào thùng rác
    function destroy($id)
    {
        Product::where('id', $id)->update(['status' => 'unactive']);
        Product::find($id)->delete();
        return back()->with('admin.product.list')->with('status_complete', 'Đã bỏ vào thùng rác');
    }

    // Xóa vĩnh viễn
    function forceDelete($id)
    {
        // Xóa sản phẩm
        Product::onlyTrashed()->where('id', $id)->forceDelete();

        // Xóa file
        $this_product_img = Media::where('object_id', $id)->where('object_type','product')->get();
        foreach ($this_product_img as $file) {
            if (File::exists(public_path($file->url))) {
                File::delete(public_path($file->url));
            }
        }

        // Xóa dữ liệu trong db
        Media::where('object_id', $id)->where('object_type','product')->forceDelete();
        return back()->with('status_complete', 'Xóa thành công');
    }

    // Khôi phục
    function restore($id)
    {
        Product::onlyTrashed()->where('id', $id)->restore();
        return back()->with('status_complete', 'Khôi phục thành công');
    }

    // Hành động
    function action(Request $request)
    {
        if ($request->product_action == NULL && !isset($request->product_id)) {
            return back()->withInput()->with('status_failed', 'Vui lòng chọn sản phẩm và hành động để tiếp tục');
        }

        if ($request->product_action == NULL) {
            return back()->withInput()->with('status_failed', 'Vui lòng chọn hành động để tiếp tục');
        }

        if (!isset($request->product_id)) {
            return back()->withInput()->with('status_failed', 'Vui lòng chọn sản phẩm để tiếp tục');
        }

        // Thay đổi trạng thái
        if ($request->product_action == 'active' || $request->product_action == 'unactive') {
            foreach ($request->product_id as $id) {
                Product::find($id)->update(['status' => $request->product_action]);
            }
            return back()->with('status_complete', 'Cập nhật thành công');
        }

        // Bỏ vào thùng rác
        if ($request->product_action == 'trash') {
            foreach ($request->product_id as $id) {
                Product::find($id)->update(['status' => 'unactive']);
                Product::find($id)->delete();
            }
            return back()->with('status_complete', 'Đã bỏ vào thùng rác');
        }

        // Khôi phục
        if ($request->product_action == 'restore') {
            foreach ($request->product_id as $id) {
                Product::onlyTrashed()->where('id', $id)->restore();
            }
            return back()->with('status_complete', 'Khôi phục thành công');
        }

        // Xóa vĩnh viễn
        if ($request->product_action == 'forceDelete') {
            foreach ($request->product_id as $id) {

                Product::onlyTrashed()->where('id', $id)->forceDelete();

                $this_product_img = Media::where('object_id', $id)->where('object_type','product')->get();
                foreach ($this_product_img as $file) {
                    if (File::exists(public_path($file->url))) {
                        File::delete(public_path($file->url));
                    }
                }

                // Xóa dữ liệu trong db
                Media::where('object_id', $id)->where('object_type','product')->forceDelete();
            }
            return back()->with('status_complete', 'Xóa thành công');
        }
    }

    // Cập nhật nhanh trạng thái (Ajax)
    function updateStatus(Request $request)
    {
        $status_value = $request->status_value;
        $product_id = $request->product_id;

        Product::where('id', $product_id)->update(['status' => $status_value]);
        $view = view('admin.product.partials.status_product', compact('status_value'))->render();

        $active_status = Product::where('status', 'active')->get()->count();
        $unactive_status = Product::where('status', 'unactive')->get()->count();

        $data = [
            'view' => $view,
            'product_id' => $product_id,
            'active_status' => $active_status,
            'unactive_status' => $unactive_status,
        ];

        return response()->json($data);
    }

    // Thùng rác
    function trash()
    {
        $trashs = Product::with('user')->with('media')->onlyTrashed()->orderBy('deleted_at')->paginate(5);
        $total = Product::onlyTrashed()->count();
        return view('admin.product.trash', compact('trashs', 'total'));
    }

    // Thùng rác ( lọc )
    function trash_filter(Request $request)
    {
        $search_value = $request->search_value;

        $trashs = Product::with('user')->with('media')->onlyTrashed()->where('name', 'like', '%' . $search_value . '%')->paginate(5);
        $total = Product::onlyTrashed()->count();

        $view = view('admin.product.partials.list_trash', compact('trashs', 'total'))->render();

        $data = ['view' => $view];

        return response()->json($data);
    }
}
