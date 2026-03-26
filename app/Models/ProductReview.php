<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    protected $fillable = [
        'name',
        'review',
        'vote_star',
        'status',
        'product_id',
        'updated_at'
    ];

    function product(){
        return $this->belongsTo('App\Models\Product');
    }
}
