<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Media;
use Illuminate\Support\Facades\File;

abstract class Controller
{
    function __construct(Request $request)
    {
        // Kích hoạt menu active admin
        $request->session()->put('module_active', $request->segment(2));
        $request->session()->put('sub_module_active', $request->segment(3));
        $request->session()->put('segment_4', $request->segment(4));

        // Kích hoạt menu active client
        $request->session()->put('page_active',$request->segment(1));
        $request->session()->put('category_active', $request->segment(2));
        
        // Xóa ảnh rác ở thư mục
        $trash_media = Media::where('created_at', '<', now()->subMinute(30))->where('object_id',null)->get();

        if($trash_media->count() > 0){
            foreach ($trash_media as $file){
                if(File::exists(public_path($file->url)));
                File::delete(public_path($file->url));
            }

            // Xóa session lưu path ảnh và id ảnh
            $request->session()->forget('main_img_product');
            $request->session()->forget('id_main_product');
            $request->session()->forget('main_img_post');
            $request->session()->forget('id_main_post');

            $request->session()->forget('sub_img_1');
            $request->session()->forget('id_sub_1');

            $request->session()->forget('sub_img_2');
            $request->session()->forget('id_sub_2');

            $request->session()->forget('sub_img_3');
            $request->session()->forget('id_sub_3');

            $request->session()->forget('sub_img_4');
            $request->session()->forget('id_sub_4');
        }
       
        // Xóa ảnh rác trong DB
        Media::whereNull('object_id')->where('created_at', '<', now()->subMinute(30))->delete();
        
        // $request->session()->flush();
    }
}
