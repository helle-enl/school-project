<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FarmProductCategory extends Model
{
    protected $fillable = [
        'name',
        'description',
        'farmer_id'
    ];

    public function products(): HasMany
    {
        return $this->hasMany(FarmProduct::class, 'category_id');
    }


    public function publishedProducts(): HasMany
    {
        return $this->hasMany(FarmProduct::class, 'category_id')
            ->where('status', 'published');
    }
}
