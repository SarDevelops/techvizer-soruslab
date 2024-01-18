<?php

namespace App\Models;

use App\Models\PackageCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Package extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'name',
        'image',
        'type',
        'package_categories_id',
        'recommended_for',
        'overview',
        'cbc_test',
        'includes_pack'
    ];

    protected $casts = [
        'recommended_for' => 'json',
        'cbc_test' => 'json',
        'includes_pack' => 'json',
    ];

    public function category()
    {
        return $this->hasOne(PackageCategory::class,'id','package_categories_id' );
    }

}
