<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sandwich extends Model
{
    use HasFactory;
    protected $fillable = [
        'tenant_id','sandwich_name'
    ];
    public function orders()
    {
        return $this->morphMany(Order::class, 'sandwich');
    }
    public function tenant()
    {
        return $this->belongsTo(Tenant::class,'tenant_id');
    }
}
