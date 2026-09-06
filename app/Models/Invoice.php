<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    protected $table = 'invoices';

   protected $fillable = [
    'invoice_number',
    'client_id',
    'invoice_date',
    'amount',
    'status',
    'pdf_path',
];
    protected $casts = [
        'invoice_date' => 'date',
        'amount' => 'decimal:2',
    ];

    /**
     * Client associé à la facture.
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Produits/lignes de la facture.
     */
    public function items(): HasMany
    {
        return $this->hasMany(InvoiceItem::class);
    }
}


