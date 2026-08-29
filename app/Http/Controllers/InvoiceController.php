<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    /**
     * Afficher la page des factures.
     */
    public function index()
    {
        $clients = Client::orderBy('name')->get();

        $products = Product::where('active', true)
            ->orderBy('name')
            ->get();

        $invoices = Invoice::with('client')
            ->orderByDesc('invoice_date')
            ->orderByDesc('id')
            ->get();

        return view('factures', compact(
            'clients',
            'products',
            'invoices'
        ));
    }

    /**
     * Enregistrer une nouvelle facture.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'invoice_number' => [
                'required',
                'string',
                'max:100',
                'unique:invoices,invoice_number',
            ],

            'client_id' => [
                'required',
                'exists:clients,id',
            ],

            'invoice_date' => [
                'required',
                'date',
            ],

            'status' => [
                'required',
                'string',
                'max:50',
            ],

            'products' => [
                'required',
                'array',
                'min:1',
            ],

            'products.*.product_id' => [
                'required',
                'exists:products,id',
            ],

            'products.*.quantity' => [
                'required',
                'numeric',
                'min:0.01',
            ],

            'products.*.unit_price' => [
                'required',
                'numeric',
                'min:0',
            ],
        ]);

        DB::transaction(function () use ($validated) {

            $subtotal = 0;

            foreach ($validated['products'] as $item) {
                $subtotal +=
                    (float) $item['quantity']
                    * (float) $item['unit_price'];
            }

            $tax = $subtotal * 0.20;

            $total = $subtotal + $tax;

            $invoice = Invoice::create([
                'invoice_number' => $validated['invoice_number'],
                'client_id' => $validated['client_id'],
                'invoice_date' => $validated['invoice_date'],
                'amount' => $total,
                'status' => $validated['status'],
                'created_by' => auth()->id(),
            ]);

            foreach ($validated['products'] as $item) {

                $quantity = (float) $item['quantity'];
                $unitPrice = (float) $item['unit_price'];

                InvoiceItem::create([
                    'invoice_id' => $invoice->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'total' => $quantity * $unitPrice,
                ]);
            }
        });

        return redirect()
            ->route('factures')
            ->with('success', 'Facture enregistrée avec succès.');
    }
}