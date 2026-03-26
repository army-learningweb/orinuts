<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\Slider;

class HomeController extends Controller
{
    // Trang chủ
    function index(Request $request){
        $product_categories = ProductCategory::where('parent_id',0)->where('status','active')->get();
        $img_sliders =  Slider::where('status','publish')->get();

        $products_sales = Product::with('media')->with('review')->where('status','active')->where('up_sale','yes')->orderBy('updated_at','desc')->get();
        $products_disscount = Product::with('media')->with('review')->where('status','active')->where('disscount','>',0)->orderBy('updated_at','desc')->get();
        $products_new = Product::with('media')->with('review')->where('status','active')->orderBy('created_at','desc')->limit(6)->get();
        
        return view('client.index',compact('product_categories','products_sales','products_disscount','products_new','img_sliders'));
    }

    // Tìm kiếm sản phẩm
    function search(Request $request){
        $search_value = $request->search_value;
        $products_info = Product::where('status','active')->where('name','like','%'.$search_value.'%')->limit(10)->get()->pluck('name','slug');

        if(!$search_value) $products_info = Product::where('status','active')->limit(7)->get()->pluck('name','slug');
        $view = view('client.partials.list_search',compact('products_info'))->render();

        $data = ['view' => $view];
        return response()->json($data);
    }
}
