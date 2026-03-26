<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostCategory extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'status',
        'user_id',
        'updated_at'
    ];

    function user(){
        return $this->belongsTo('App\Models\User');
    }

    function parent(){
        return $this->belongsTo('App\Models\PostCategory');
    }

    
}
