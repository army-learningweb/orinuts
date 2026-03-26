<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Media;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class AdminFileController extends Controller
{

    // Upload ảnh
    function uploadFile(Request $request)
    {
        if ($request->hasFile('file')) {

            // Kiểm tra
            $request->validate([
                'file' => 'image|mimes:jpg,png,jpeg|max:2048'
            ], [
                'image' => 'Lỗi File...',
                'mimes' => 'Chỉ cho phép định dạng :mimes'
            ]);

            // Lấy thông tin ảnh
            $file = $request->file('file');
            $base_name = $file->getClientOriginalName();
            $file_name = Str::slug(pathinfo($base_name, PATHINFO_FILENAME));
            $file_type = $file->getClientOriginalExtension();
            $file_size = $file->getSize();
            
            // Kiểm tra module hiện hành
            if($request->module == 'post') $upload_dir = 'uploads/post/';
            if($request->module == 'product') $upload_dir = 'uploads/product/';
            if($request->module == 'slider') $upload_dir = 'uploads/slider/';

            // Di chuyển file vào folder
            $upload_file_name = $file_name . '.' . $file_type;
            $file_path = $upload_dir . $upload_file_name;
            $k = 1;
            while (File::exists(public_path($file_path))) {
                $upload_file_name = $file_name . '-copy-' . $k . '.' . $file_type;
                $file_path = $upload_dir . $upload_file_name;
                $k++;
            }
            $file->move($upload_dir, $upload_file_name);
            
            // Thêm vào database
            $new_img = Media::create([
                'url' => $file_path,
                'file_name' => $upload_file_name,
                'file_size' => $file_size,
                'is_main' => $request->role == 'main_img_'.$request->module ? 0 : 1,
                'object_type' => $request->module,
                'object_id' => NULL,
                'user_id' => Auth::user()->id,
            ]);

            // Tạo session lưu trữ hình ảnh 
            $request->session()->put($request->role,$file_path);
            $request->session()->put($request->id,$new_img->id);

            // Trả dữ liệu cho Ajax
            $data = [
                'img_url' => asset($file_path),
                'img_id' => $new_img->id,
                'module' => $request->module
            ];

            return response()->json($data);
        }
    }

    // Xóa ảnh upload
    function deleteFile(Request $request){
        $url = Media::where('id',$request->id_media)->get()->value('url');
        if(File::exists(public_path($url))){
            File::delete(public_path($url));
        }
        Media::where('id',$request->id_media)->delete();
        $request->session()->forget($request->role);
        $request->session()->forget($request->id);
    }
}
