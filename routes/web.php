<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\InvoiceController;
use App\Models\Product;
use App\Models\StockEntry;
use App\Models\StockExit;


Route::get('/', function () {
    return redirect()->route('login');
});

/* Dashboar */

Route::get('/dashboard', function () {

    $totalRevenue = DB::table('invoices')->sum('amount') ?? 0;
    $invoicesCount = DB::table('invoices')->count() ?? 0;
    $clientsCount = DB::table('clients')->count() ?? 0;

    $stockAlerts = Product::whereColumn('quantity', '<=', 'minimum_stock')->count();

    $latestInvoices = DB::table('invoices')
        ->leftJoin('clients', 'invoices.client_id', '=', 'clients.id')
        ->select('invoices.*', 'clients.name as client_name')
        ->orderByDesc('invoices.invoice_date')
        ->limit(5)
        ->get();

    return view('components.⚡dashboard', [
        'totalRevenue' => $totalRevenue,
        'invoicesCount' => $invoicesCount,
        'clientsCount' => $clientsCount,
        'stockAlerts' => $stockAlerts,
        'latestInvoices' => $latestInvoices,
    ]);

})
    ->middleware('auth')
    ->name('dashboard');


/* Clients & Fournisseurs */

Route::get('/clients-fournisseurs', function () {

    $clientSearch = request('client_search');
    $supplierSearch = request('supplier_search');

    $selectedClientId = request('client_id');
    $selectedSupplierId = request('supplier_id');


    $clients = DB::table('clients')
        ->when($clientSearch, function ($query) use ($clientSearch) {

            $query->where(function ($q) use ($clientSearch) {

                $q->where('name', 'ILIKE', '%' . $clientSearch . '%')
                  ->orWhere('email', 'ILIKE', '%' . $clientSearch . '%')
                  ->orWhere('phone', 'ILIKE', '%' . $clientSearch . '%');

            });

        })
        ->orderBy('name')
        ->get();


    $suppliers = DB::table('suppliers')
        ->when($supplierSearch, function ($query) use ($supplierSearch) {

            $query->where(function ($q) use ($supplierSearch) {

                $q->where('name', 'ILIKE', '%' . $supplierSearch . '%')
                  ->orWhere('email', 'ILIKE', '%' . $supplierSearch . '%')
                  ->orWhere('phone', 'ILIKE', '%' . $supplierSearch . '%');

            });

        })
        ->orderBy('name')
        ->get();


    $selectedClient = null;
    $clientInvoices = collect();

    if ($selectedClientId) {

        $selectedClient = DB::table('clients')
            ->where('id', $selectedClientId)
            ->first();

        if ($selectedClient) {

            $clientInvoices = DB::table('invoices')
                ->where('client_id', $selectedClient->id)
                ->orderByDesc('invoice_date')
                ->get();

        }

    }


    $selectedSupplier = null;
    $supplierPurchases = collect();

    if ($selectedSupplierId) {

        $selectedSupplier = DB::table('suppliers')
            ->where('id', $selectedSupplierId)
            ->first();

        if ($selectedSupplier) {

            $supplierPurchases = DB::table('stock_entries')
                ->leftJoin(
                    'products',
                    'stock_entries.product_id',
                    '=',
                    'products.id'
                )
                ->where('stock_entries.supplier_id', $selectedSupplier->id)
                ->select(
                    'stock_entries.*',
                    'products.name as product_name',
                    'products.reference as product_reference'
                )
                ->orderByDesc('stock_entries.entry_date')
                ->get();

        }

    }


    return view('components.clients-fournisseurs', [

        'clients' => $clients,
        'suppliers' => $suppliers,

        'clientSearch' => $clientSearch,
        'supplierSearch' => $supplierSearch,

        'selectedClient' => $selectedClient,
        'clientInvoices' => $clientInvoices,

        'selectedSupplier' => $selectedSupplier,
        'supplierPurchases' => $supplierPurchases,

    ]);

})
    ->middleware('auth')
    ->name('clients-fournisseurs');


/*
|--------------------------------------------------------------------------
| STOCK
|--------------------------------------------------------------------------
*/

Route::get('/stock', function () {

    /*
    |--------------------------------------------------------------------------
    | Produits + stock actuel
    |--------------------------------------------------------------------------
    */

    $products = DB::table('products')
        ->leftJoinSub(
            DB::table('stock_entries')
                ->select(
                    'product_id',
                    DB::raw('COALESCE(SUM(quantity), 0) as total_entries')
                )
                ->groupBy('product_id'),
            'entries',
            'products.id',
            '=',
            'entries.product_id'
        )
        ->leftJoinSub(
            DB::table('stock_exits')
                ->select(
                    'product_id',
                    DB::raw('COALESCE(SUM(quantity), 0) as total_exits')
                )
                ->groupBy('product_id'),
            'exits',
            'products.id',
            '=',
            'exits.product_id'
        )
        ->select(
            'products.*',
            DB::raw('COALESCE(entries.total_entries, 0) as total_entries'),
            DB::raw('COALESCE(exits.total_exits, 0) as total_exits'),
            'products.quantity as current_stock'
        )
        ->orderBy('products.name')
        ->get();


    /*
    |--------------------------------------------------------------------------
    | Fournisseurs
    |--------------------------------------------------------------------------
    */

    $suppliers = DB::table('suppliers')
        ->orderBy('name')
        ->get();


    /*
    |--------------------------------------------------------------------------
    | Notification
    |--------------------------------------------------------------------------
    */

    $success = session('success');


    return view('components.stock', [

        'products' => $products,
        'suppliers' => $suppliers,
        'success' => $success,

    ]);

})
    ->middleware('auth')
    ->name('stock');


/* ENREGISTRER UNE ENTRÉE DE STOCK */

Route::post('/stock/entry', function () {

    $data = request()->validate([

        'product_id' => ['required', 'integer', 'exists:products,id'],

        'supplier_id' => ['required', 'integer', 'exists:suppliers,id'],

        'quantity' => ['required', 'integer', 'min:1'],

        'purchase_price' => ['required', 'numeric', 'min:0'],

        'reference' => ['nullable', 'string', 'max:255'],

        'entry_date' => ['required', 'date'],

    ]);


    DB::transaction(function () use ($data): void {
        $entryId = DB::table('stock_entries')->insertGetId([

            'product_id' => $data['product_id'],

            'supplier_id' => $data['supplier_id'],

            'quantity' => $data['quantity'],

            'purchase_price' => $data['purchase_price'],

            'reference' => $data['reference'] ?? null,

            'entry_date' => $data['entry_date'],

            'created_by' => auth()->id(),

            'created_at' => now(),

            'updated_at' => now(),

        ]);

        DB::table('products')
            ->where('id', $data['product_id'])
            ->increment('quantity', $data['quantity']);

        $entry = DB::table('stock_entries')->where('id', $entryId)->first();
        $product = DB::table('products')->where('id', $data['product_id'])->first();
        $supplier = DB::table('suppliers')->where('id', $data['supplier_id'])->first();
        $user = DB::table('users')->where('id', auth()->id())->first();

        $documentPdf = Pdf::loadView('pdf.purchase-receipt', [
            'documentNumber' => 'BA-' . date('Y') . '-' . str_pad((string) $entryId, 6, '0', STR_PAD_LEFT),
            'entry' => $entry,
            'product' => $product,
            'supplier' => $supplier,
            'user' => $user,
        ])->output();

        if (DB::connection()->getDriverName() === 'pgsql') {
            DB::update(
                "UPDATE stock_entries SET document_pdf = decode(?, 'hex') WHERE id = ?",
                [bin2hex($documentPdf), $entryId]
            );
        } else {
            DB::table('stock_entries')
                ->where('id', $entryId)
                ->update(['document_pdf' => $documentPdf]);
        }
    });

    return redirect()
        ->route('stock')
        ->with('success', 'Stock mis à jour avec succès.');

})
    ->middleware('auth')
    ->name('stock.entry');


/* ENREGISTRER UNE SORTIE DE STOCK */

Route::post('/stock/exit', function () {

    $data = request()->validate([

        'product_id' => ['required', 'integer', 'exists:products,id'],

        'quantity' => ['required', 'integer', 'min:1'],

        'reason' => ['nullable', 'string', 'max:255'],

        'reference' => ['nullable', 'string', 'max:255'],

        'exit_date' => ['required', 'date'],

    ]);

    $insufficientStock = false;
    $currentStock = 0;

    DB::transaction(function () use ($data, &$insufficientStock, &$currentStock): void {
        $product = DB::table('products')
            ->where('id', $data['product_id'])
            ->lockForUpdate()
            ->first();

        $currentStock = $product->quantity;

        if ($data['quantity'] > $currentStock) {
            $insufficientStock = true;
            return;
        }

        $exitId = DB::table('stock_exits')->insertGetId([

            'product_id' => $data['product_id'],

            'quantity' => $data['quantity'],

            'reason' => $data['reason'] ?? null,

            'reference' => $data['reference'] ?? null,

            'exit_date' => $data['exit_date'],

            'created_by' => auth()->id(),

            'created_at' => now(),

            'updated_at' => now(),

        ]);

        DB::table('products')
            ->where('id', $data['product_id'])
            ->decrement('quantity', $data['quantity']);

        $exit = DB::table('stock_exits')->where('id', $exitId)->first();
        $product = DB::table('products')->where('id', $data['product_id'])->first();
        $user = DB::table('users')->where('id', auth()->id())->first();

        $documentPdf = Pdf::loadView('pdf.delivery-note', [
            'documentNumber' => 'BL-' . date('Y') . '-' . str_pad((string) $exitId, 6, '0', STR_PAD_LEFT),
            'exit' => $exit,
            'product' => $product,
            'user' => $user,
        ])->output();

        if (DB::connection()->getDriverName() === 'pgsql') {
            DB::update(
                "UPDATE stock_exits SET document_pdf = decode(?, 'hex') WHERE id = ?",
                [bin2hex($documentPdf), $exitId]
            );
        } else {
            DB::table('stock_exits')
                ->where('id', $exitId)
                ->update(['document_pdf' => $documentPdf]);
        }
    });

    if ($insufficientStock) {
        return back()
            ->withInput()
            ->withErrors([
                'quantity' => "Stock insuffisant. Quantité disponible : {$currentStock}.",
            ]);
    }

    return redirect()
        ->route('stock')
        ->with('success', 'Sortie de stock enregistrée avec succès.');

})
    ->middleware('auth')
    ->name('stock.exit');


/* TÉLÉCHARGER LES DOCUMENTS DE STOCK */

Route::get('/stock/entry/{entry}/document', function (int $entry) {
    $document = DB::table('stock_entries')
        ->where('id', $entry)
        ->first(['id', 'document_pdf']);

    abort_unless($document && $document->document_pdf, 404);

    $pdfContent = is_resource($document->document_pdf)
        ? stream_get_contents($document->document_pdf)
        : $document->document_pdf;

    return response($pdfContent)
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'attachment; filename="bon-achat-' . $document->id . '.pdf"');
})->middleware('auth')->name('stock.entry.document');

Route::get('/stock/exit/{exit}/document', function (int $exit) {
    $document = DB::table('stock_exits')
        ->where('id', $exit)
        ->first(['id', 'document_pdf']);

    abort_unless($document && $document->document_pdf, 404);

    $pdfContent = is_resource($document->document_pdf)
        ? stream_get_contents($document->document_pdf)
        : $document->document_pdf;

    return response($pdfContent)
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'attachment; filename="bon-livraison-' . $document->id . '.pdf"');
})->middleware('auth')->name('stock.exit.document');


/*  FACTURES  */ 
Route::middleware('auth')->group(function () { 
    Route::get('/factures', [InvoiceController::class, 'index']) ->name('factures'); 
    Route::post('/factures', [InvoiceController::class, 'store']) ->name('factures.store'); 
});

/* ALERTES */
Route::get('/alertes', function () {

    $products = Product::whereColumn('quantity', '<=', 'minimum_stock')
        ->get()
        ->each(function ($product): void {
            $product->current_stock = $product->quantity;
        });

    return view('alertes', compact('products'));

})->middleware('auth')->name('alertes');