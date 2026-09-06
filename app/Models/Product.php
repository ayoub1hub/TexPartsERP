<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'reference',
        'name',
        'description',
        'purchase_price',
        'selling_price',
        'minimum_stock',
        'quantity',
        'active',
    ];

    protected $casts = [
        'quantity' => 'integer',
    ];

    public $timestamps = false;
}
