<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\InvoiceController;
use App\Models\Product;
use App\Models\StockEntry;
use App\Models\StockExit;


Route::get('/', function () {
    return redirect()->route('login');
});

/* Dashboar */

Route::view('/dashboard', 'components.⚡dashboard')
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
            DB::raw('
                COALESCE(entries.total_entries, 0)
                -
                COALESCE(exits.total_exits, 0)
                as current_stock
            ')
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

    request()->validate([

        'product_id' => ['required', 'integer', 'exists:products,id'],

        'supplier_id' => ['required', 'integer', 'exists:suppliers,id'],

        'quantity' => ['required', 'numeric', 'min:1'],

        'purchase_price' => ['required', 'numeric', 'min:0'],

        'reference' => ['nullable', 'string', 'max:255'],

        'entry_date' => ['required', 'date'],

    ]);


    DB::table('stock_entries')->insert([

        'product_id' => request('product_id'),

        'supplier_id' => request('supplier_id'),

        'quantity' => request('quantity'),

        'purchase_price' => request('purchase_price'),

        'reference' => request('reference'),

        'entry_date' => request('entry_date'),

        'created_by' => auth()->id(),

        'created_at' => now(),

        'updated_at' => now(),

    ]);


    return redirect()
        ->route('stock')
        ->with('success', 'Stock mis à jour avec succès.');

})
    ->middleware('auth')
    ->name('stock.entry');


/*  FACTURES  */ 
Route::middleware('auth')->group(function () { 
    Route::get('/factures', [InvoiceController::class, 'index']) ->name('factures'); 
    Route::post('/factures', [InvoiceController::class, 'store']) ->name('factures.store'); 
});

/* ALERTES */
Route::get('/alertes', function () {

    $products = Product::all()->map(function ($product) {

        $entries = StockEntry::where('product_id', $product->id)
            ->sum('quantity');

        $exits = StockExit::where('product_id', $product->id)
            ->sum('quantity');

        $product->current_stock = $entries - $exits;

        return $product;

    })->filter(function ($product) {

        return $product->current_stock <= $product->minimum_stock;

    });

    return view('alertes', compact('products'));

})->middleware('auth')->name('alertes');