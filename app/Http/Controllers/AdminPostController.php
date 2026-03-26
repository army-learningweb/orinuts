<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostCategory;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Models\Media;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class AdminPostController extends Controller
{
    // Danh sách
    function list()
    {
        $posts = Post::with('user')->with('media')->orderBy('created_at', 'desc')->paginate(5);
        
        $publish_status = Post::where('status', 'publish')->get()->count();
        $draft_status = Post::where('status', 'draft')->get()->count();
        $pending_status = Post::where('status', 'pending')->get()->count();
        $disable_status = Post::where('status', 'disable')->get()->count();

        $total = Post::all()->count();
        // $total_trash = Post::onlyTrashed()->count();

        return view('admin.post.list', compact('posts', 'publish_status', 'draft_status', 'pending_status', 'disable_status', 'total'));
    }

    // Danh sách theo bộ lọc + tìm kiếm (Ajax)
    function list_filter(Request $request)
    {
        $status_value = $request->status_value;
        $search_value = $request->search_value;

        if (!$search_value && !$status_value) $posts = Post::with('user')->with('media')->orderBy('created_at', 'desc')->paginate(5);

        if ($search_value && !$status_value) $posts = Post::with('user')->with('media')->where('title', 'like', '%' . $search_value . '%')->paginate(5);

        if (!$search_value && $status_value) $posts = Post::with('user')->with('media')->where('status', $status_value)->orderBy('created_at', 'desc')->paginate(5);

        if ($search_value && $status_value) $posts = Post::with('user')->with('media')->where('title', 'like', '%' . $search_value . '%')->where('status', $status_value)->paginate(5);

        $publish_status = Post::where('status', 'publish')->get()->count();
        $draft_status = Post::where('status', 'draft')->get()->count();
        $pending_status = Post::where('status', 'pending')->get()->count();
        $disable_status = Post::where('status', 'disable')->get()->count();
        $total = Post::all()->count();

        $view = view('admin.post.partials.list_normal', compact('posts', 'publish_status', 'draft_status', 'pending_status', 'disable_status', 'total'))->render();
        $data = ['view' => $view];
        return response()->json($data);
    }

    // Thêm
    function create()
    {
        $post_categories = PostCategory::all();
        $post_categories = data_tree($post_categories);
        return view('admin.post.create', compact('post_categories'));
    }

    function store(Request $request)
    {

        $request->validate([
            'title' => 'required|min:6|regex:/^[\p{L}\p{P}\s\0-9_-]+$/u',
            'desc' => 'regex:/^[\p{L}\p{P}\s\0-9_-]+$/u',
            'slug' => 'required|min:2',
            'post_cat' => 'required'
        ]);

        if ($request->img_id[0] == NULL) return back()->withInput()->with('status_failed', 'Không để trống ảnh bài viết');

        $new_post = Post::create([
            'title' => $request->title,
            'desc' => $request->desc,
            'details' => $request->details,
            'status' => $request->status,
            'user_id' => Auth::user()->id,
            'img_id' => $request->img_id[0],
            'cat_id' => $request->post_cat,
            'slug' => 'bai-viet/' . Str::slug($request->slug)
        ]);

        Media::where('id', $request->img_id[0])->update(['object_id' => $new_post->id]);

        // Xóa toàn bộ session lưu ảnh
        $request->session()->forget('main_img_post');
        $request->session()->forget('id_main_post');

        return redirect()->route('admin.post.list')->with('status_complete', 'Thêm bài viết thành công');
    }

    // Cập nhật
    function edit($id)
    {
        $post_info = Post::with('media')->find($id);

        $post_categories = PostCategory::all();
        $post_categories = data_tree($post_categories);
        return view('admin.post.edit', compact('post_info', 'post_categories'));
    }

    function update(Request $request, $id)
    {

        $request->validate([
            'title' => 'required|min:6|regex:/^[\p{L}\p{P}\s\0-9_-]+$/u',
            'desc' => 'regex:/^[\p{L}\p{P}\s\0-9_-]+$/u',
            'slug' => 'required|min:2',
            'post_cat' => 'required'
        ]);

        if (empty($request->img_id[0])) {
            return back()->with('status_failed', 'Không để trống ảnh sản phẩm');
        }

        $new_img_id = $request->img_id;
        $old_img_id = $request->old_img_id;

        if ($new_img_id[0] != $old_img_id[0]) {
            $old_img_path = Media::where('id', $old_img_id[0])->get()->value('url');
            if (File::exists(public_path($old_img_path))) {
                File::delete(public_path($old_img_path));
            }

            $new_img_info = Media::where('id', $new_img_id[0])->get();
            foreach ($new_img_info as $info) {
                Media::where('id', $old_img_id[0])->update([
                    'url' => $info->url,
                    'file_name' => $info->file_name,
                    'file_size' => $info->file_size,
                    'is_main' => $info->is_main,
                    'object_type' => 'post',
                    'object_id' => $id,
                    'user_id' => Auth::user()->id,
                    'updated_at' => now()
                ]);
            }
            Media::where('id', $new_img_id[0])->delete();
        }

        $old_slug = Post::where('id', $id)->get()->value('slug');

        Post::where('id', $id)->update([
            'title' => $request->title,
            'desc' => $request->desc,
            'details' => $request->details,
            'status' => $request->status,
            'user_id' => Auth::user()->id,
            'cat_id' => $request->post_cat,
            'slug' => $request->slug == $old_slug ? $request->slug : 'bai-viet/' . Str::slug($request->slug)
        ]);

        // Xóa toàn bộ session lưu ảnh
        $request->session()->forget('main_img_post');
        $request->session()->forget('id_main_post');

        return redirect()->route('admin.post.list')->with('status_complete', 'Cập nhật thành công');
    }

    // Bỏ vào thùng rác
    function destroy($id){
        Post::where('id',$id)->update(['status'=>'disable']);
        Post::find($id)->delete();
        return back()->with('status_complete','Đã bỏ vào thùng rác');
    }

    // Thùng rác
    function trash(){
        $trashs = Post::with('user')->with('media')->onlyTrashed()->orderBy('deleted_at')->paginate(5);
        $total = Post::onlyTrashed()->count();
        return view('admin.post.trash', compact('trashs', 'total'));
    }

    // Thùng rác ( lọc )
    function trash_filter(Request $request)
    {
        $search_value = $request->search_value;

        $trashs = Post::with('user')->with('media')->onlyTrashed()->where('title', 'like', '%' . $search_value . '%')->paginate(5);
        $total = Post::onlyTrashed()->count();

        $view = view('admin.post.partials.list_trash', compact('trashs', 'total'))->render();

        $data = ['view' => $view];

        return response()->json($data);
    }

    // Hành động
    function action(Request $request)
    {
        if ($request->post_action == NULL && !isset($request->post_id)) {
            return back()->withInput()->with('status_failed', 'Vui lòng chọn bài viết và hành động để tiếp tục');
        }

        if ($request->post_action == NULL) {
            return back()->withInput()->with('status_failed', 'Vui lòng chọn hành động để tiếp tục');
        }

        if (!isset($request->post_id)) {
            return back()->withInput()->with('status_failed', 'Vui lòng chọn bài viết để tiếp tục');
        }

        // Khôi phục
        if ($request->post_action == 'restore') {
            foreach ($request->post_id as $id) {
                Post::onlyTrashed()->where('id', $id)->restore();
            }
            return back()->with('status_complete', 'Khôi phục thành công');
        }

        // Xóa vĩnh viễn
        if ($request->post_action == 'forceDelete') {
            foreach ($request->post_id as $id) {

                Post::onlyTrashed()->where('id', $id)->forceDelete();

                $this_product_img = Media::where('object_id', $id)->where('object_type','post')->get();
                foreach ($this_product_img as $file) {
                    if (File::exists(public_path($file->url))) {
                        File::delete(public_path($file->url));
                    }
                }

                // Xóa dữ liệu trong db
                Media::where('object_id', $id)->where('object_type','post')->forceDelete();
            }
            return back()->with('status_complete', 'Xóa thành công');
        }

        // Bỏ vào thùng rác
        if ($request->post_action == 'trash') {
            foreach ($request->post_id as $id) {
                Post::find($id)->update(['status' => 'disable']);
                Post::find($id)->delete();
            }
            return back()->with('status_complete', 'Đã bỏ vào thùng rác');
        } else {
            // Thay đổi trạng thái
            foreach ($request->post_id as $id) {
                Post::find($id)->update(['status' => $request->post_action]);
            }
            return back()->with('status_complete', 'Cập nhật thành công');
        }

    }

    // Cập nhật nhanh trạng thái (Ajax)
    function updateStatus(Request $request)
    {
        $status_value = $request->status_value;
        $post_id = $request->post_id;

        Post::where('id', $post_id)->update(['status' => $status_value]);
        $view = view('admin.post.partials.status_post', compact('status_value'))->render();

        $publish_status = Post::where('status', 'publish')->get()->count();
        $draft_status = Post::where('status', 'draft')->get()->count();
        $pending_status = Post::where('status', 'pending')->get()->count();
        $disable_status = Post::where('status', 'disable')->get()->count();

        $data = [
            'view' => $view,
            'post_id' => $post_id,
            'publish_status' => $publish_status,
            'draft_status' => $draft_status,
            'pending_status' => $pending_status,
            'disable_status' => $disable_status
        ];

        return response()->json($data);
    }

    // Khôi phục
    function restore($id)
    {
        Post::onlyTrashed()->where('id', $id)->restore();
        return back()->with('status_complete', 'Khôi phục thành công');
    }

    // Xóa vĩnh viễn
    function forceDelete($id)
    {
        // Xóa sản phẩm
        Post::onlyTrashed()->where('id', $id)->forceDelete();

        // Xóa file
        $this_product_img = Media::where('object_id', $id)->get()->value('url');
            if (File::exists(public_path($this_product_img))) {
                File::delete(public_path($this_product_img));
            }

        // Xóa dữ liệu trong db
        Media::where('object_id', $id)->where('object_type','post')->forceDelete();

        return back()->with('status_complete', 'Xóa thành công');
    }

}
