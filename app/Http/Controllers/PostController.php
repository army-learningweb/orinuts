<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\PostCategory;

class PostController extends Controller
{
    
    function view(){

        $posts = Post::with('media')->where('status','publish')->orderBy('created_at','desc')->paginate(6);
        $new_posts = Post::with('media')->where('status','publish')->orderBy('created_at','desc')->limit(6)->get();
        
        $post_categories = PostCategory::where('status','active')->where('parent_id',0)->get();

        return view('client.post.view',compact('posts','post_categories','new_posts'));
    }

    // Danh sách
    function list($post_slug){
            
        $category_id = PostCategory::where('slug','like','%'.$post_slug.'%')->get()->value('id');
        $child_categories = PostCategory::where('parent_id',$category_id)->get()->pluck('id');
        $posts = Post::with('media')->whereIn('cat_id',$child_categories)->where('status','publish')->get()->groupBy(function($parent_cat){
            return $parent_cat->category->name;
        });
        $post_categories = PostCategory::where('parent_id',0)->where('status','active')->get();
        
        return view('client.post.list',compact('posts','post_categories'));
    }

    // Chi tiết bài viết
    function details($post_slug){

        $post_categories = PostCategory::where('status','active')->where('parent_id',0)->get();
        $post_details = Post::with('media')->where('slug','like','%'.$post_slug.'%')->where('status','publish')->first();
        $posts = Post::with('media')->where('status','publish')->orderBy('created_at','desc')->get();
        return view('client.post.details',compact('post_categories','post_details','posts'));
    }
}
