<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Product;
use App\Models\StockEntry;
use App\Models\StockExit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    /**
     * Afficher la page des factures.
     */
    public function index()
    {
        $clients = Client::orderBy('name')->get();

        $products = Product::orderBy('name')->get();

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
                'in:Payee,En attente,Annulee',
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

            // Vérifier le stock disponible.
            foreach ($validated['products'] as $item) {

                $productId = $item['product_id'];
                $quantityDemandee = (float) $item['quantity'];

                $stockEntrees = StockEntry::where(
                    'product_id',
                    $productId
                )->sum('quantity');

                $stockSorties = StockExit::where(
                    'product_id',
                    $productId
                )->sum('quantity');

                $stockDisponible =
                    (float) $stockEntrees - (float) $stockSorties;

                if ($quantityDemandee > $stockDisponible) {

                    $product = Product::find($productId);

                    throw ValidationException::withMessages([
                        'products' =>
                            "Stock insuffisant pour le produit \"{$product->name}\". "
                            . "Stock disponible : {$stockDisponible}. "
                            . "Quantité demandée : {$quantityDemandee}."
                    ]);
                }

                $subtotal +=
                    $quantityDemandee * (float) $item['unit_price'];
            }

            // Calcul TVA et total.
            $tax = $subtotal * 0.20;
            $total = $subtotal + $tax;

            // Créer la facture.
            $invoice = Invoice::create([
                'invoice_number' => $validated['invoice_number'],
                'client_id' => $validated['client_id'],
                'invoice_date' => $validated['invoice_date'],
                'amount' => $total,
                'status' => $validated['status'],
            ]);

            // Créer les lignes de facture et les sorties de stock.
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

                StockExit::create([
                    'product_id' => $item['product_id'],
                    'quantity' => $quantity,
                    'reason' => 'Vente',
                    'reference' => $validated['invoice_number'],
                    'exit_date' => $validated['invoice_date'],
                ]);
            }

            /*
             * Recharger la facture avec le client,
             * les lignes et les produits pour le PDF.
             */
            $invoice->load([
                'client',
                'items.product',
            ]);

            // Générer le PDF.
            $pdf = Pdf::loadView('facture.pdf', [
                'invoice' => $invoice,
            ]);

            // Nom et emplacement du fichier PDF.
            $fileName = 'factures/' . $invoice->invoice_number . '.pdf';

            // Enregistrer le PDF dans storage/app/public/factures.
            Storage::disk('public')->put(
                $fileName,
                $pdf->output()
            );

            // Enregistrer le chemin du PDF dans la base de données.
            $invoice->update([
                'pdf_path' => $fileName,
            ]);
        });

        return redirect()
            ->route('factures')
            ->with(
                'success',
                'Facture enregistrée, stock mis à jour et PDF généré avec succès.'
            );
    }
}