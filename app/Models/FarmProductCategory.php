<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FarmProductCategory extends Model
{
    protected $fillable = [
        'name',
        'description',
        'farmer_id'
    ];
}
