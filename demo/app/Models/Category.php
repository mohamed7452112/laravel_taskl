<?php

namespace App\Models;
use App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    function orders(){
        return $this->hasMany(Order::class);
    }
    
    function products(){
        return $this->hasMany(Product::class);
    }

}
