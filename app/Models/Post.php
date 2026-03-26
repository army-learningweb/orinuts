<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'title',
        'desc',
        'slug',
        'details',
        'status',
        'user_id',
        'img_id',
        'cat_id',
        'updated_at'
    ];

    function media(){
        return $this->belongsTo('App\Models\Media','img_id');
    }

    function user(){
        return $this->belongsTo('App\Models\User');
    }

    function category(){
        return $this->belongsto('App\Models\PostCategory','cat_id');
    }
}
