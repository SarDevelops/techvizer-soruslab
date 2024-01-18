<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class RolePermission extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'role_permissions';

    protected $fillable = [
        'role_id',
        'module_id',
        'permissions',
    ];

    public function getPermissionsAttribute($permission_value)
    {
        return json_decode($permission_value, true);
    }

    public function module_detail(): HasOne
    {
        return $this->hasOne(RolePermissionModule::class, 'id', 'module_id');
    }
}
