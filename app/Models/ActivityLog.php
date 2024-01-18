<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'activity',
        'description',
        'logged_by',
    ];

    public function users(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'logged_by');
    }
}
