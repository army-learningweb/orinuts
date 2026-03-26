<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = [
        'url',
        'file_name',
        'file_size',
        'is_main',
        'object_type',
        'object_id',
        'user_id',
    ];

    function product(){
        return $this->hasOne('App\Models\Product','img_id','id');
    }

    function post(){
        return $this->hasOne('App\Models\Post','img_id','id');
    }

    function slider(){
        return $this->hasOne('App\Models\Slider','img_id','id');
    }

}
