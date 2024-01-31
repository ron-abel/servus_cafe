<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
    public function location()
    {
        return $this->hasMany(Location::class,'tenant_id');
    }
    public function sandwich()
    {
        return $this->hasMany(Sandwich::class,'tenant_id');
    }
    public function topping()
    {
        return $this->hasMany(Topping::class,'tenant_id');
    }
    public function owner()
    {
        return $this->hasOne(User::class,'tenant_id')->where('user_role_id', 2);
    }
    public function tenantPrintNodes()
    {
        return $this->hasMany(TenantPrintNode::class, 'tenant_id');
    }
}
