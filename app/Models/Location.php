<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $table = 'pickup_times';
    protected $fillable = [
        'tenant_id','name'
    ];
    public function order()
    {
        return $this->hasMany(Order::class,'topping_id');
    }
    public function tenant()
    {
        return $this->belongsTo(Tenant::class,'tenant_id');
    }
}
