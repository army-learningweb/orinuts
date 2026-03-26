<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Media;

class AdminSliderController extends Controller
{
    // Quản lí ảnh
    function manager(Request $request){

        $sliders = Slider::with('media')->orderBy('order','asc')->paginate(6);
        $sliders->appends(['list'=>'normal']);

        if($request->input('list') == 'trash'){
            $sliders = Slider::with('media')->onlyTrashed()->orderBy('deleted_at','asc')->paginate(6);
            $sliders->appends(['list'=>'trash']);
        }

        return view('admin.slider.manager',compact('sliders'));
    }

    // Thêm
    function store(Request $request){

        if($request->img_id[0] == NULL){
            return back()->withInput()->with('status_failed','Không để trống ảnh');
        }

        $request->validate([
            'order' => 'required|unique:sliders'
        ]);

        $new_slider = Slider::create([
            'img_id' => $request->img_id[0],
            'redirect_url' => $request->redirect_url,
            'title' => $request->title,
            'desc' => $request->desc,
            'order' => $request->order,
            'status' => $request->status,
            'user_id' => Auth::user()->id
        ]);

        Media::where('id',$request->img_id[0])->update(['object_id'=>$new_slider->id]);
        
        $request->session()->forget('main_img_slider');
        $request->session()->forget('id_main_slider');

        return back()->with('status_complete','Thêm ảnh thành công');
    }

    // Hành động
    function action(Request $request)
    {

        if ($request->slider_action == NULL && !isset($request->slider_id)) {
            return back()->withInput()->with('status_action_failed', 'Vui lòng chọn ảnh và hành động để tiếp tục');
        }

        if ($request->slider_action == NULL) {
            return back()->withInput()->with('status_action_failed', 'Vui lòng chọn hành động để tiếp tục');
        }

        if (!isset($request->slider_id)) {
            return back()->withInput()->with('status_action_failed', 'Vui lòng chọn ảnh để tiếp tục');
        }

        // Khôi phục
        if ($request->slider_action == 'restore') {
            foreach ($request->slider_id as $id) {
                Slider::onlyTrashed()->where('id', $id)->restore();
            }
            return back()->with('status_complete', 'Khôi phục thành công');
        }

        // Xóa vĩnh viễn
        if ($request->slider_action == 'forceDelete') {
            foreach ($request->slider_id as $id) {

                Slider::onlyTrashed()->where('id', $id)->forceDelete();

                $this_product_img = Media::where('object_id', $id)->where('object_type','slider')->get();
                foreach ($this_product_img as $file) {
                    if (File::exists(public_path($file->url))) {
                        File::delete(public_path($file->url));
                    }
                }

                // Xóa dữ liệu trong db
                Media::where('object_id', $id)->where('object_type','slider')->forceDelete();
            }
            return back()->with('status_complete', 'Xóa thành công');
        }

        // Bỏ vào thùng rác
        if ($request->slider_action == 'trash') {
            foreach ($request->slider_id as $id) {
                Slider::find($id)->update(['status' => 'disable']);
                Slider::find($id)->delete();
            }
            return back()->with('status_complete', 'Đã bỏ vào thùng rác');
        } else {
            // Thay đổi trạng thái
            foreach ($request->slider_id as $id) {
                Slider::find($id)->update(['status' => $request->slider_action]);
            }
            return back()->with('status_complete', 'Cập nhật thành công');
        }

    }

    // Cập nhật
    function edit(Request $request, $id){
        $sliders = Slider::with('media')->orderBy('order','asc')->paginate(6);
        $sliders->appends(['list'=>'normal']);

        if($request->input('list') == 'trash'){
            $sliders = Slider::onlyTrashed()->orderBy('deleted_at','asc')->paginate(6);
            $sliders->appends(['list'=>'trash']);
        }

        $slider_info = Slider::with('media')->find($id);
        return view('admin.slider.edit',compact('sliders','slider_info'));
    }

    function update(Request $request, $id)
    {

        if($request->img_id[0] == NULL){
            return back()->withInput()->with('status_failed','Không để trống ảnh');
        }

        $request->validate([
            'order' => 'required'
        ]);

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
                    'object_type' => 'slider',
                    'object_id' => $id,
                    'user_id' => Auth::user()->id,
                    'updated_at' => now()
                ]);
            }
            Media::where('id', $new_img_id[0])->delete();
        }

        Slider::where('id', $id)->update([
            'title' => $request->title,
            'desc' => $request->desc,
            'redirect_url' => $request->redirect_url,
            'order' => $request->order,
            'status' => $request->status,
            'user_id' => Auth::user()->id,
            'updated_at' => now()
        ]);

        // Xóa toàn bộ session lưu ảnh
        $request->session()->forget('main_img_slider');
        $request->session()->forget('id_main_slider');

        return back()->with('status_complete', 'Cập nhật thành công');
    }

    // Bỏ vào thùng rác
    function destroy($id){
        Slider::where('id',$id)->update(['status' => 'disable']);
        Slider::find($id)->delete();
        return back()->with('status_complete','Đã bỏ vào thùng rác');
    }

    // Khôi phục
    function restore($id){
        Slider::onlyTrashed()->where('id',$id)->restore();
        return back()->with('status_complete','Khôi phục thành công');
    }

    // Xóa vĩnh viễn
    function forceDelete($id)
    {
        // Xóa slider
        Slider::onlyTrashed()->where('id', $id)->forceDelete();

        // Xóa file
        $this_slider_img = Media::where('object_id', $id)->where('object_type','slider')->get()->value('url');
            if (File::exists(public_path($this_slider_img))) {
                File::delete(public_path($this_slider_img));
            }
        // Xóa dữ liệu trong db
        Media::where('object_id', $id)->where('object_type','slider')->forceDelete();
        return back()->with('status_complete', 'Xóa thành công');
    }

    function updateStatus(Request $request){
        $status_value = $request->status_value;
        $slider_id = $request->slider_id;

        Slider::where('id', $slider_id)->update(['status' => $status_value]);
        $view = view('admin.slider.partials.status_slider', compact('status_value'))->render();

        $data = [
            'view' => $view,
            'slider_id' => $slider_id,
        ];

        return response()->json($data);
    }

}
