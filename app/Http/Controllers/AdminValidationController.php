<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminValidationController extends Controller
{
    function validation(Request $request){
        
        $request->validate([
            'name' => 'nullable|min:2|regex:/^[\p{L}\s]+$/u',
            'email' => 'nullable|email',
            'password' => 'nullable|min:6|regex:/^[a-zA-Z0-9]+$/',
            'current_password' => 'nullable|min:6|regex:/^[a-zA-Z0-9]+$/',
            'password_confirmation' => 'nullable|min:6|regex:/^[a-zA-Z0-9]+$/',
            'password_destroy' => 'nullable|min:6|regex:/^[a-zA-Z0-9]+$/',
            'child_cat_name' => 'nullable|min:2|regex:/^[\p{L}\s]+$/u',
            'parent_cat_name' => 'nullable|min:2|regex:/^[\p{L}\s]+$/u',
            'cat_name' => 'nullable|min:2|regex:/^[\p{L}\s]+$/u',
            'child_cat_slug' => 'nullable|min:2|',
            'parent_cat_slug' => 'nullable|min:2|',
            'cat_slug' => 'nullable|min:2',
            'desc' => 'nullable|min:2|regex:/^[\p{L}\p{P}\s\0-9_-]+$/u',
            'code' => 'nullable|min:6|regex:/^([ori#]+)([0-9]+)$/|unique:products',
            'title' => 'nullable|min:2|regex:/^[\p{L}\p{P}\s\0-9_-]+$/u',
            'address' => 'nullable|min:5',
            'tel' => [
                'nullable',
                'regex:/^(032|033|034|035|036|037|038|039|096|097|098|086|083|084|085|081|082|088|091|094|070|079|077|076|078|090|093|089|056|058|092|059|099)[0-9]{7}$/'
            ]
        ]);
    
        return response()->json();
    }
}
