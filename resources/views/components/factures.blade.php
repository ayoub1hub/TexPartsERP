<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Factures - Texpart ERP</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>

<body class="min-h-screen bg-slate-100 text-slate-900">

<div class="flex min-h-screen">

    {{-- ================= SIDEBAR ================= --}}

    <aside class="fixed inset-y-0 left-0 z-50 flex w-64 flex-col bg-slate-950 text-white shadow-2xl">

        <div class="flex h-20 items-center border-b border-white/10 px-6">

            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-cyan-500 to-blue-700 text-lg font-black">
                T
            </div>

            <div class="ml-3">
                <h1 class="text-lg font-black tracking-[0.18em]">
                    TEXPART
                </h1>

                <p class="text-[10px] uppercase tracking-wider text-slate-400">
                    Enterprise Management
                </p>
            </div>

        </div>


        <nav class="flex-1 space-y-2 overflow-y-auto px-4 py-6">

            <a href="/dashboard"
               class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-300 transition hover:bg-white/5 hover:text-white">
                <span class="text-lg">🏠</span>
                <span>Accueil</span>
            </a>

            <a href="/clients-fournisseurs"
               class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-300 transition hover:bg-white/5 hover:text-white">
                <span class="text-lg">👥</span>
                <span>Clients & Fournisseurs</span>
            </a>

            <a href="/stock"
               class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-300 transition hover:bg-white/5 hover:text-white">
                <span class="text-lg">📦</span>
                <span>Stock</span>
            </a>

            <a href="/factures"
               class="flex items-center gap-3 rounded-xl bg-cyan-600/20 px-4 py-3 text-sm font-semibold text-cyan-400 transition hover:bg-cyan-600/30">
                <span class="text-lg">🧾</span>
                <span>Factures</span>
            </a>

            <a href="/alertes"
               class="flex items-center justify-between rounded-xl px-4 py-3 text-sm font-medium text-slate-300 transition hover:bg-white/5 hover:text-white">

                <div class="flex items-center gap-3">
                    <span class="text-lg">🔔</span>
                    <span>Alertes</span>
                </div>

                <span class="flex h-5 min-w-5 items-center justify-center rounded-full bg-red-500 px-1.5 text-[10px] font-bold">
                    0
                </span>

            </a>

        </nav>


        <div class="border-t border-white/10 p-4">

            <div class="flex items-center gap-3 rounded-xl bg-white/5 p-3">

                <div class="flex h-9 w-9 items-center justify-center rounded-full bg-gradient-to-br from-cyan-500 to-blue-700 text-sm font-bold">
                    A
                </div>

                <div class="min-w-0">

                    <p class="truncate text-sm font-semibold">
                        Admin Texpart
                    </p>

                    <p class="truncate text-[10px] text-slate-400">
                        Administrateur
                    </p>

                </div>

            </div>

        </div>

    </aside>


    {{-- ================= CONTENU ================= --}}

    <div class="ml-64 flex min-h-screen flex-1 flex-col">


        {{-- HEADER --}}

        <header class="sticky top-0 z-40 flex h-20 items-center justify-between border-b border-slate-200 bg-white/95 px-8 shadow-sm backdrop-blur">

            <div>

                <p class="text-xs font-medium uppercase tracking-wider text-slate-400">
                    TEXPART ERP
                </p>

                <h2 class="text-xl font-bold text-slate-900">
                    Factures
                </h2>

            </div>

            <div class="flex items-center gap-5">

                <a href="/alertes"
                   class="relative flex h-10 w-10 items-center justify-center rounded-xl text-slate-500 transition hover:bg-slate-100">
                    🔔
                    <span class="absolute right-1 top-1 h-2 w-2 rounded-full bg-red-500"></span>
                </a>

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-gradient-to-br from-cyan-500 to-blue-700 text-sm font-bold text-white">
                        A
                    </div>

                    <div class="hidden sm:block">

                        <p class="text-sm font-semibold text-slate-800">
                            Admin Texpart
                        </p>

                        <p class="text-[11px] text-slate-400">
                            Administrateur
                        </p>

                    </div>

                </div>

            </div>

        </header>


        {{-- ================= PAGE ================= --}}

        <main class="flex-1 p-8">

            {{-- MESSAGE DE SUCCÈS --}}

            @if(session('success'))

                <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-medium text-emerald-700">
                    {{ session('success') }}
                </div>

            @endif


            {{-- ERREURS --}}

            @if($errors->any())

                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">

                    <p class="font-semibold">
                        Vérifiez les informations suivantes :
                    </p>

                    <ul class="mt-2 list-inside list-disc">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <div class="mx-auto max-w-6xl">


                {{-- TITRE --}}

                <div class="mb-8">

                    <p class="text-sm font-medium text-cyan-600">
                        Gestion commerciale
                    </p>

                    <h1 class="mt-1 text-3xl font-black text-slate-900">
                        Nouvelle facture
                    </h1>

                    <p class="mt-2 text-sm text-slate-500">
                        Créez une facture et préparez-la pour la génération PDF.
                    </p>

                </div>


                {{-- FORMULAIRE --}}

                <form
                    method="POST"
                    action="{{ route('factures.store') }}"
                    id="invoice-form"
                >

                    @csrf


                    {{-- INFORMATIONS FACTURE --}}

                    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                        <h2 class="text-lg font-bold text-slate-900">
                            Informations de la facture
                        </h2>

                        <div class="mt-6 grid gap-5 md:grid-cols-2">


                            {{-- NUMERO --}}

                            <div>

                                <label class="text-sm font-semibold text-slate-700">
                                    Numéro de facture
                                </label>

                                <input
                                    type="text"
                                    name="invoice_number"
                                    value="{{ old('invoice_number', 'FAC-' . date('Ymd-His')) }}"
                                    required
                                    class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-100"
                                >

                            </div>


                            {{-- DATE --}}

                            <div>

                                <label class="text-sm font-semibold text-slate-700">
                                    Date
                                </label>

                                <input
                                    type="date"
                                    name="invoice_date"
                                    value="{{ old('invoice_date', date('Y-m-d')) }}"
                                    required
                                    class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-100"
                                >

                            </div>


                            {{-- CLIENT --}}

                            <div>

                                <label class="text-sm font-semibold text-slate-700">
                                    Client
                                </label>

                                <select
                                    name="client_id"
                                    required
                                    class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-100"
                                >

                                    <option value="">
                                        Sélectionner un client
                                    </option>

                                    @foreach($clients as $client)

                                        <option
                                            value="{{ $client->id }}"
                                            {{ old('client_id') == $client->id ? 'selected' : '' }}
                                        >
                                            {{ $client->name }}
                                        </option>

                                    @endforeach

                                </select>

                            </div>


                            {{-- STATUT --}}

                            <div>

                                <label class="text-sm font-semibold text-slate-700">
                                    Statut
                                </label>

                                <select
                                    name="status"
                                    required
                                    class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-100"
                                >

                                    <option value="En attente">
                                        En attente
                                    </option>

                                    <option value="Payée">
                                        Payée
                                    </option>

                                    <option value="Annulée">
                                        Annulée
                                    </option>

                                </select>

                            </div>

                        </div>

                    </div>


                    {{-- PRODUITS --}}

                    <div class="mt-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                        <div class="flex items-center justify-between">

                            <div>

                                <h2 class="text-lg font-bold text-slate-900">
                                    Produits
                                </h2>

                                <p class="mt-1 text-xs text-slate-400">
                                    Ajoutez les produits présents dans la facture.
                                </p>

                            </div>

                            <button
                                type="button"
                                id="add-product"
                                class="rounded-xl bg-cyan-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-cyan-700"
                            >
                                + Ajouter un produit
                            </button>

                        </div>


                        {{-- LIGNES PRODUITS --}}

                        <div id="products-container" class="mt-6 space-y-4">

                            <div class="product-row rounded-xl border border-slate-200 bg-slate-50 p-4">

                                <div class="grid gap-4 md:grid-cols-12 md:items-end">


                                    {{-- PRODUIT --}}

                                    <div class="md:col-span-5">

                                        <label class="text-xs font-semibold text-slate-500">
                                            Produit
                                        </label>

                                        <select
                                            name="products[0][product_id]"
                                            class="product-select mt-2 w-full rounded-lg border border-slate-200 bg-white px-3 py-2.5 text-sm outline-none focus:border-cyan-500"
                                            required
                                        >

                                            <option value="">
                                                Sélectionner un produit
                                            </option>

                                            @foreach($products as $product)

                                                <option
                                                    value="{{ $product->id }}"
                                                    data-price="{{ $product->selling_price }}"
                                                >
                                                    {{ $product->name }}
                                                    — {{ number_format($product->selling_price, 2) }} DH
                                                </option>

                                            @endforeach

                                        </select>

                                    </div>


                                    {{-- QUANTITE --}}

                                    <div class="md:col-span-2">

                                        <label class="text-xs font-semibold text-slate-500">
                                            Quantité
                                        </label>

                                        <input
                                            type="number"
                                            name="products[0][quantity]"
                                            value="1"
                                            min="0.01"
                                            step="0.01"
                                            class="quantity-input mt-2 w-full rounded-lg border border-slate-200 px-3 py-2.5 text-sm outline-none focus:border-cyan-500"
                                            required
                                        >

                                    </div>


                                    {{-- PRIX --}}

                                    <div class="md:col-span-2">

                                        <label class="text-xs font-semibold text-slate-500">
                                            Prix unitaire
                                        </label>

                                        <input
                                            type="number"
                                            name="products[0][unit_price]"
                                            value="0"
                                            min="0"
                                            step="0.01"
                                            class="price-input mt-2 w-full rounded-lg border border-slate-200 px-3 py-2.5 text-sm outline-none focus:border-cyan-500"
                                            required
                                        >

                                    </div>


                                    {{-- TOTAL --}}

                                    <div class="md:col-span-2">

                                        <label class="text-xs font-semibold text-slate-500">
                                            Total
                                        </label>

                                        <div class="line-total mt-2 rounded-lg bg-white px-3 py-2.5 text-sm font-bold text-slate-800">
                                            0.00 DH
                                        </div>

                                    </div>


                                    {{-- SUPPRIMER --}}

                                    <div class="md:col-span-1">

                                        <button
                                            type="button"
                                            class="remove-product hidden w-full rounded-lg border border-red-200 bg-white px-3 py-2.5 text-sm text-red-500 transition hover:bg-red-50"
                                        >
                                            ✕
                                        </button>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- TOTALS --}}

                    <div class="mt-6 flex justify-end">

                        <div class="w-full max-w-md rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                            <div class="flex justify-between text-sm text-slate-500">

                                <span>
                                    Sous-total
                                </span>

                                <span id="subtotal">
                                    0.00 DH
                                </span>

                            </div>


                            <div class="mt-3 flex justify-between text-sm text-slate-500">

                                <span>
                                    TVA (20 %)
                                </span>

                                <span id="tax">
                                    0.00 DH
                                </span>

                            </div>


                            <div class="my-4 border-t border-slate-200"></div>


                            <div class="flex items-center justify-between">

                                <span class="text-base font-bold text-slate-900">
                                    Total TTC
                                </span>

                                <span
                                    id="grand-total"
                                    class="text-2xl font-black text-cyan-600"
                                >
                                    0.00 DH
                                </span>

                            </div>

                        </div>

                    </div>


                    {{-- BOUTON --}}

                    <div class="mt-6 flex justify-end">

                        <button
                            type="submit"
                            class="rounded-xl bg-slate-950 px-6 py-3 text-sm font-bold text-white shadow-lg transition hover:bg-slate-800"
                        >
                            🧾 Enregistrer la facture
                        </button>

                    </div>

                </form>


                {{-- HISTORIQUE --}}

                <div class="mt-10 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                    <div class="p-6">

                        <h2 class="text-lg font-bold text-slate-900">
                            Dernières factures
                        </h2>

                        <p class="mt-1 text-xs text-slate-400">
                            Historique des factures enregistrées.
                        </p>

                    </div>


                    <div class="overflow-x-auto">

                        <table class="w-full text-left text-sm">

                            <thead class="border-y border-slate-200 bg-slate-50">

                                <tr>

                                    <th class="px-6 py-4 text-xs font-semibold text-slate-500">
                                        N° Facture
                                    </th>

                                    <th class="px-6 py-4 text-xs font-semibold text-slate-500">
                                        Client
                                    </th>

                                    <th class="px-6 py-4 text-xs font-semibold text-slate-500">
                                        Date
                                    </th>

                                    <th class="px-6 py-4 text-xs font-semibold text-slate-500">
                                        Montant
                                    </th>

                                    <th class="px-6 py-4 text-xs font-semibold text-slate-500">
                                        Statut
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                                @forelse($invoices as $invoice)

                                    <tr class="border-b border-slate-100 last:border-0">

                                        <td class="px-6 py-4 font-semibold text-slate-800">
                                            {{ $invoice->invoice_number }}
                                        </td>

                                        <td class="px-6 py-4 text-slate-600">
                                            {{ $invoice->client->name ?? '—' }}
                                        </td>

                                        <td class="px-6 py-4 text-slate-600">
                                            {{ $invoice->invoice_date?->format('d/m/Y') }}
                                        </td>

                                        <td class="px-6 py-4 font-semibold text-slate-800">
                                            {{ number_format($invoice->amount, 2) }} DH
                                        </td>

                                        <td class="px-6 py-4">

                                            <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">
                                                {{ $invoice->status }}
                                            </span>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="5" class="px-6 py-10 text-center">

                                            <p class="text-sm font-medium text-slate-500">
                                                Aucune facture enregistrée.
                                            </p>

                                            <p class="mt-1 text-xs text-slate-400">
                                                Les factures créées apparaîtront ici.
                                            </p>

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </main>


        <footer class="border-t border-slate-200 bg-white px-8 py-4">

            <p class="text-center text-xs text-slate-400">
                © {{ date('Y') }} Texpart — Tous droits réservés.
            </p>

        </footer>

    </div>

</div>


<script>

document.addEventListener('DOMContentLoaded', function () {

    const container = document.getElementById('products-container');
    const addButton = document.getElementById('add-product');

    let productIndex = 1;


    function updateTotals() {

        let subtotal = 0;

        document.querySelectorAll('.product-row').forEach(function (row) {

            const quantity = parseFloat(
                row.querySelector('.quantity-input')?.value
            ) || 0;

            const price = parseFloat(
                row.querySelector('.price-input')?.value
            ) || 0;

            const total = quantity * price;

            const lineTotal = row.querySelector('.line-total');

            if (lineTotal) {
                lineTotal.textContent = total.toFixed(2) + ' DH';
            }

            subtotal += total;

        });


        const tax = subtotal * 0.20;
        const grandTotal = subtotal + tax;


        document.getElementById('subtotal').textContent =
            subtotal.toFixed(2) + ' DH';

        document.getElementById('tax').textContent =
            tax.toFixed(2) + ' DH';

        document.getElementById('grand-total').textContent =
            grandTotal.toFixed(2) + ' DH';
    }


    function attachRowEvents(row) {

        const productSelect = row.querySelector('.product-select');
        const quantityInput = row.querySelector('.quantity-input');
        const priceInput = row.querySelector('.price-input');
        const removeButton = row.querySelector('.remove-product');


        productSelect.addEventListener('change', function () {

            const option =
                productSelect.options[productSelect.selectedIndex];

            const price =
                option.getAttribute('data-price');

            if (price !== null) {
                priceInput.value = parseFloat(price).toFixed(2);
            }

            updateTotals();
        });


        quantityInput.addEventListener('input', updateTotals);

        priceInput.addEventListener('input', updateTotals);


        removeButton.addEventListener('click', function () {

            row.remove();

            updateTotals();

        });

    }


    attachRowEvents(
        document.querySelector('.product-row')
    );


    addButton.addEventListener('click', function () {

        const firstRow =
            document.querySelector('.product-row');

        const newRow =
            firstRow.cloneNode(true);


        newRow.querySelectorAll('input').forEach(function (input) {

            if (input.classList.contains('quantity-input')) {
                input.value = '1';
            }

            if (input.classList.contains('price-input')) {
                input.value = '0';
            }

        });


        newRow.querySelector('.product-select').value = '';

        newRow.querySelector('.line-total').textContent =
            '0.00 DH';


        newRow.querySelector('.remove-product')
            .classList.remove('hidden');


        newRow.querySelector('.product-select').name =
            `products[${productIndex}][product_id]`;

        newRow.querySelector('.quantity-input').name =
            `products[${productIndex}][quantity]`;

        newRow.querySelector('.price-input').name =
            `products[${productIndex}][unit_price]`;


        productIndex++;


        container.appendChild(newRow);

        attachRowEvents(newRow);

        updateTotals();

    });


    updateTotals();

});

</script>


@livewireScripts

</body>
</html>
