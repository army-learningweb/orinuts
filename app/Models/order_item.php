<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class order_item extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price'
    ];

    function media(){
        return $this->belongsTo('App\Models\Media','object_id');
    }

    function product(){
        return $this->belongsTo('App\Models\Product');
    }

}
