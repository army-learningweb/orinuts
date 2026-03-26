<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
    function view($page){
        $page_info = Page::where('slug',$page)->where('status','publish')->first();

        return view('client.page.view',compact('page_info'));
    }
}
