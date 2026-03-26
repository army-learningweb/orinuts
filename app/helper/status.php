<?php

function set_status_review($status){
    $arr_status = [
        'pending' => '<div class ="bg-gray-600/15 text-gray-600 rounded-md px-2 py-1 box-border text-xs font-medium">Chờ xử lý</div>',
        'publish' => '<div class ="bg-green-600/15 text-green-600 rounded-md px-2 py-1 box-border text-xs font-medium">Công khai</div>',
        'canceled' => '<div class ="bg-red-600/15 text-red-600 rounded-md px-2 py-1 box-border text-xs font-medium">Vô hiệu hóa</div>'
    ];

    return $arr_status[$status];
}

function set_status_order($status){
    $arr_status = [
        'pending' => '<div class ="bg-gray-600/15 text-gray-600 rounded-md px-2 py-1 box-border text-xs font-medium">Chờ xử lý</div>',
        'processing' => '<div class ="bg-blue-600/15 text-blue-600 rounded-md px-2 py-1 box-border text-xs font-medium">Đang xử lý</div>',
        'shipped' => '<div class ="bg-amber-600/15 text-amber-600 rounded-md px-2 py-1 box-border text-xs font-medium">Đã giao</div>',
        'delivered' => '<div class ="bg-green-600/15 text-green-600 rounded-md px-2 py-1 box-border text-xs font-medium">Đã nhận</div>',
        'refund' => '<div class ="bg-pink-600/15 text-pink-700 rounded-md px-2 py-1 box-border text-xs font-medium">Hoàn trả</div>',
        'canceled' => '<div class ="bg-red-600/15 text-red-600 rounded-md px-2 py-1 box-border text-xs font-medium">Đã hủy</div>'
    ];

    return $arr_status[$status];
}

function set_status_user($status){
    $arr_status = [
        'unactive' => '<div class ="bg-amber-600/15 text-amber-600 rounded-md px-2 py-1 box-border font-medium text-xs">Chưa kích hoạt</div>',
        'active' =>  '<div class ="bg-green-600/15 text-green-600 rounded-md px-2 py-1 box-border font-medium text-xs">Hoạt động</div>',
        'subpended' =>  '<div class ="bg-red-600/15 text-red-600 rounded-md px-2 py-1 box-border font-medium text-xs">Đình chỉ</div>'
    ];

    return $arr_status[$status];
}

function set_status_category($status){
    $arr_status = [
        'unactive' =>'<div class ="bg-red-600/15 text-red-600 rounded-md px-2 py-1 box-border font-medium text-xs">Vô hiệu hóa</div>',
        'active' =>  '<div class ="bg-green-600/15 text-green-600 rounded-md px-2 py-1 box-border font-medium text-xs">Hoạt động</div>',
    ];

    return $arr_status[$status];
}

function set_status_product($status){
    $arr_status = [
         'unactive' => '<div class ="bg-red-600/15 text-red-600 rounded-md px-2 py-1 box-border text-xs font-medium">Vô hiệu hóa</div>',
         'active' => '<div class ="bg-green-600/15 text-green-600 rounded-md px-2 py-1 box-border text-xs font-medium">Hoạt động</div>'
    ];

    return $arr_status[$status];
}

function set_status_post($status){
    $arr_status = [
        'publish' =>'<div class ="bg-green-600/15 text-green-600 rounded-md px-2 py-1 box-border font-medium text-xs">Công khai</div>',
        'draft' =>  '<div class ="bg-gray-200 text-gray-700 rounded-md px-2 py-1 box-border font-medium text-xs">Nháp</div>',
        'pending' =>'<div class ="bg-amber-600/15 text-amber-600 rounded-md px-2 py-1 box-border font-medium text-xs">Chờ duyệt</div>',
        'disable' =>  '<div class ="bg-red-600/15 text-red-600 rounded-md px-2 py-1 box-border font-medium text-xs">Vô hiệu hóa</div>'
    ];

    return $arr_status[$status];
}

function set_status_slider($status){
    $arr_status = [
        'disable' =>'<div class ="bg-red-600/15 text-red-600 rounded-md px-2 py-1 box-border font-medium text-xs">Vô hiệu hóa</div>',
        'publish' =>  '<div class ="bg-green-600/15 text-green-600 rounded-md px-2 py-1 box-border font-medium text-xs">Công khai</div>',
    ];

    return $arr_status[$status];
}

function set_status_page($status){
    $arr_status = [
        'publish' =>'<div class ="bg-green-600/15 text-green-600 rounded-md py-1 px-2 box-border font-medium text-xs">Công khai</div>',
        'draft' =>  '<div class ="bg-gray-200 text-gray-700 rounded-md py-1 px-2 box-border font-medium text-xs">Nháp</div>',
        'disable' =>  '<div class ="bg-red-600/15 text-red-600 rounded-md py-1 px-2 box-border font-medium text-xs">Vô hiệu hóa</div>'
    ];

    return $arr_status[$status];
}

function set_status_menu($status){
    $arr_status = [
        'active' =>'<div class ="bg-green-600/15 text-green-600 rounded-md px-2 py-1 box-border font-medium text-xs">Hoạt động</div>',
        'disable' =>  '<div class ="bg-red-600/15 text-red-600 rounded-md px-2 py-1 box-border font-medium text-xs">Vô hiệu hóa</div>'
    ];

    return $arr_status[$status];
}
