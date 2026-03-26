<?php

return [

  //   VALIDATE ==========================================================
    'confirmed' => ':attribute xác nhận không khớp.',
    'date' => ':attribute không phải là ngày hợp lệ.',
    'email' => ':attribute không đúng định dạng.',
    'exists' => ':attribute không hợp lệ.',
    'array' => ':attribute phải là một mảng',
    'image' => ':attribute phải là hình ảnh.',
    'integer' => ':attribute phải là số nguyên.',
    'max' => [
        'numeric' => ':attribute không được lớn hơn :max.',
        'file' => ':attribute không được lớn hơn :max kilobytes.',
        'string' => ':attribute không được lớn hơn :max ký tự.',
    ],
    'min' => [
        'numeric' => ':attribute phải ít nhất :min.',
        'file' => ':attribute phải ít nhất :min kilobytes.',
        'string' => ':attribute phải ít nhất :min ký tự.',
    ],
    'numeric' => ':attribute phải là số.',
    'password' => 'Mật khẩu không chính xác.',
    'regex' => ':attribute không hợp lệ.',
    'required' => ':attribute không được để trống.',
    'string' => ':attribute phải là chuỗi.',
    'unique' => ':attribute đã tồn tại.',

//   ATTRIBUTE NAME ==========================================================
    'attributes' => [
        'name' => 'Tên',
        'email' => 'Email',
        'password' => 'Mật khẩu',
        'current_password' => 'Mật khẩu hiện tại',
        'password_confirmation' => 'Xác nhận mật khẩu',
        'parent_cat_name' => 'Tên danh mục',
        'child_cat_name' => 'Tên danh mục',
        'cat_name' => 'Tên danh mục',
        'parent_cat_slug' => 'Slug',
        'child_cat_slug' => 'Slug',
        'cat_slug' => 'Slug',
        'parent_cat' => 'Danh mục cha',
        'password_destroy' => 'Mật khẩu',
        'desc' => 'Mô tả',
        'prod_name' => 'Tên sản phẩm',
        'file' => 'Ảnh',
        'price' => 'Giá',
        'code' => 'Mã sản phẩm',
        'product_cat' => 'Danh mục sản phẩm',
        'post_cat' => 'Danh mục bài viết',
        'quantity' => 'Số lượng',
        'slug' => 'Slug',
        'title' => 'Tiêu đề',
        'order' => 'Thứ tự hiển thị',
        'address' => 'Địa chỉ',
        'tel' => 'Số điện thoại'
    ],

];
