<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'code',
        'total_amount',
        'total_price',
        'shipping_address',
        'payment_method',
        'customer_id',
        'note',
        'status',
        'updated_at',
        'tel'
    ];

    function customer(){
        return $this->belongsTo('App\Models\Customer');
    }
}
