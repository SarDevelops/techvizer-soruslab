<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Test extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name',
        'type',
        'recommended_for',
        'overview',
        'cbc_test',
    ];

    protected $casts = [
        'recommended_for' => 'json',
        'cbc_test' => 'json',
    ];
}
