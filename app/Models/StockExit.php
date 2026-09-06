<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockExit extends Model
{
    protected $table = 'stock_exits';

    protected $fillable = [
        'product_id',
        'quantity',
        'reason',
        'reference',
        'exit_date',
        'created_by',
        'document_pdf',
    ];

    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

