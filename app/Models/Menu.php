<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'order',
        'user_id',
        'updated_at',
        'type',
        'parent_id',
        'object_id',
        'status'
    ];

    function user(){
        return $this->belongsTo('App\Models\User');
    }
}
