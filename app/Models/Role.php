<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'roles';

    protected $fillable = [
        'is_active',
    ];

    public function permissions(): HasMany
    {
        return $this->hasMany(RolePermission::class, 'role_id');
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'role');
    }
}
