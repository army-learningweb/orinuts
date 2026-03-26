<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{

    use SoftDeletes;
    
    protected $fillable = [
        'name',
        'tel',
        'address',
        'gmail',
        'password',
        'updated_at'
    ];

    function order(){
        return $this->hasOne('App\Models\Order');
    }

}
