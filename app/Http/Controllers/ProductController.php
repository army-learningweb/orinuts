<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\Menu;
use App\Models\Media;
use App\Models\ProductReview;

class ProductController extends Controller
{
    // Sản phẩm theo danh mục
    function view($product_slug)
    {
        $category_id = ProductCategory::where('slug','like','%'.$product_slug.'%')->get()->value('id');
        $child_categories = ProductCategory::where('parent_id',$category_id)->get()->pluck('id');
        $products = Product::with('media')->whereIn('cat_id',$child_categories)->where('status','active')->get()->groupBy(function($parent_cat){
            return $parent_cat->category->name;
        });
        return view('client.product.view',compact('products'));
    }

    // Tất cả sản phẩm
    function list(){
        $products = Product::with('media')->where('status','active')->orderBy('created_at','desc')->paginate(15);
        return view('client.product.list',compact('products'));
    }

    // Tất cả sản phẩm (theo bộ tìm kiếm + lọc)
    function list_filter(Request $request){
        $filter_value = $request->filter_value;
        $filter_search = $request->filter_search;

        if($filter_search && $filter_value != ''){
            if($filter_value == 'high-to-low') $products = Product::with('media')->where('status','active')->where('name','like','%'.$filter_value.'%')->orderBy('price','desc')->paginate(15);
            if($filter_value == 'low-to-high') $products = Product::with('media')->where('status','active')->where('name','like','%'.$filter_value.'%')->orderBy('price','asc')->paginate(15);
        }

        if(!$filter_search){
            if(!$filter_value) $products = Product::with('media')->where('status','active')->orderBy('created_at','desc')->paginate(15);
            if($filter_value == 'high-to-low') $products = Product::with('media')->where('status','active')->orderBy('price','desc')->paginate(15);
            if($filter_value == 'low-to-high') $products = Product::with('media')->where('status','active')->orderBy('price','asc')->paginate(15);
        }else{
            $products = Product::with('media')->where('name','like','%'.$filter_search.'%')->where('status','active')->orderBy('created_at','desc')->paginate(15);
        }
        
        $view = view('client.product.partials.list_product',compact('products'))->render();
        $data = ['view' => $view];

        return response()->json($data);
    }

    // Chi tiết sản phẩm
    function details($product_slug){

        $product_info = Product::with('media')->with('review')->where('slug','like','%'.$product_slug.'%')->first();

        // return $product_info;
        $products_disscount = Product::with('media')->where('status','active')->where('disscount','>',0)->orderBy('updated_at','desc')->get();
        $product_sub_img = Media::where('object_id',$product_info->id)->where('is_main',1)->get();
        $product_reviews = ProductReview::where('product_id',$product_info->id)->where('status','publish')->get();
        return view('client.product.details',compact('product_info','products_disscount','product_sub_img','product_reviews'));
    }

    // Tạm tính ở trang chi tiết sản phẩm
    function provisionalTotal(Request $request){
        $product_quantity = $request->product_quantity;
        $product_id = $request->product_id;

        $product_info = Product::where('id',$product_id)->first();
        $new_price = $product_info->price * $product_quantity;

        if($product_info->disscount > 0){
            $disscount_price = $product_info->price - $product_info->price * ($product_info->disscount / 100);
            $new_price = $disscount_price * $product_quantity;
        }

        $data = [
            'new_price' => number_format($new_price,0,',','.').'đ',
            'price_value' => $new_price
        ];

        return response()->json($data);
    }

    // Đánh giá sản phẩm
    function createReview(Request $request){

        $request->validate([
            'name' => 'required|min:2|regex:/^[\p{L}\s]+$/u',
        ]);

        if(!$request->starVote) return back()->withInput()->with('status_failed','Bạn chưa Vote cho sản phẩm');

        ProductReview::create([
            'name' => $request->name,
            'review' => $request->review,
            'product_id' => $request->product_id,
            'vote_star' => $request->starVote
        ]);

        return back()->with('status_complete','Gửi đánh giá thành công');
    }
}
