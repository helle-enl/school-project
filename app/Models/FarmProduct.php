<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FarmProduct extends Model
{
    //
    protected $fillable = [
        'name',
        'description',
        'category_id',
        'unit_of_measurement',
        'unit_price',
        'selling_price',
        'total_stock',
        'image',
        'tags',
        'status',
        'farmer_id',
        'product_image'
    ];

    public function category()
    {
        return $this->belongsTo(FarmProductCategory::class, 'category_id');
    }


    // public function orders()
    // {
    //     return $this->hasMany(ProductOrder::class, 'product_id');
    // }
    public function orders(): HasMany
    {
        return $this->hasMany(ProductOrder::class, 'product_id');
    }

    public function farmer()
    {
        return $this->belongsTo(User::class, 'farmer_id');
    }
}
