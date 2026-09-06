<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'reference',
        'name',
        'purchase_price',
        'selling_price',
        'minimum_stock',
    ];

    public $timestamps = false;
}
