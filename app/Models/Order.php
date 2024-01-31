<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public function toppings() {
        return $this->belongsToMany(Topping::class, 'order_toppings');
    }
    public function sandwich()
    {
        return $this->belongsTo(Sandwich::class,'id');
    }
    public function location()
    {
        return $this->belongsTo(Location::class,'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
