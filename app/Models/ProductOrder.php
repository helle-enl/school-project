<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class ProductOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'buyer_id',
        'farmer_id',
        'product_id',
        'quantity',
        'unit_price',
        'total_price',
        'status',
        'payment_method',
        'paid_at',
        'delivered_at',
    ];

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function farmer()
    {
        return $this->belongsTo(User::class, 'farmer_id');
    }

    public function product()
    {
        return $this->belongsTo(FarmProduct::class, 'product_id');
    }
}
