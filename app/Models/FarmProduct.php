<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
