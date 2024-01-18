<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class RolePermissionModule extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'role_permission_modules';

    public function module_detail(): HasOne
    {
        return $this->hasOne(RolePermission::class, 'module_id');
    }
}
