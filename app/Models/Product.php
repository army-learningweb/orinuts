<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'code',
        'name',
        'desc',
        'price',
        'quantity',
        'slug',
        'up_sale',
        'status',
        'disscount',
        'details',
        'user_id',
        'cat_id',
        'updated_at',
        'img_id'
    ];

    function user(){
        return $this->belongsTo('App\Models\User');
    }

    function media(){
        return $this->belongsTo('App\Models\Media','img_id');
    }

    function category(){
        return $this->belongsTo('App\Models\ProductCategory','cat_id');
    }

    function review(){
        return $this->hasMany('App\Models\ProductReview');
    }
}
