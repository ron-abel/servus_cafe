<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topping extends Model
{
    use HasFactory;
    protected $fillable = [
        'tenant_id','topping_name'
    ];
    public function order() {
        return $this->belongsToMany(Order::class, 'order_toppings');
    }
    public function tenant()
    {
        return $this->belongsTo(Tenant::class,'tenant_id');
    }
}
