<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slider extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'img_id',
        'redirect_url',
        'title',
        'desc',
        'order',
        'status',
        'user_id',
        'updated_at'
    ];

    function user(){
        return $this->belongsTo('App\Models\User');
    }

    function media(){
        return $this->belongsTo('App\Models\Media','img_id');
    }
}
