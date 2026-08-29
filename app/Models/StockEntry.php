<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockEntry extends Model
{
    protected $table = 'stock_entries';

    protected $fillable = [
        'product_id',
        'supplier_id',
        'quantity',
        'purchase_price',
        'reference',
        'entry_date',
        'created_by',
    ];

    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}