<x-layouts.dashboard>

    <div class="space-y-8">

        {{-- HEADER --}}
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-[var(--forest-sidebar)] to-[var(--forest-accent)] p-8 shadow-lg">
            <div class="absolute right-0 top-0 h-32 w-32 translate-x-8 -translate-y-8 rounded-full bg-white/10 blur-2xl"></div>
            <div class="absolute bottom-0 right-20 h-24 w-24 translate-x-4 translate-y-4 rounded-full bg-white/10 blur-xl"></div>
            <div class="relative z-10">
                <p class="text-sm font-medium text-white/80">
                    Gestion commerciale
                </p>
                <h1 class="mt-1 text-3xl font-black text-white">
                    Nouvelle facture
                </h1>
                <p class="mt-2 text-sm text-white/70">
                    Créez une facture et préparez-la pour la génération PDF.
                </p>
            </div>
        </div>

        {{-- MESSAGE DE SUCCÈS --}}

        @if(session('success'))
            <div class="relative overflow-hidden rounded-xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-medium text-emerald-700">
                <div class="absolute right-0 top-0 h-16 w-16 translate-x-4 -translate-y-4 rounded-full bg-emerald-200 opacity-30 blur-2xl"></div>
                <div class="relative flex items-center gap-3">
                    <div class="flex h-8 w-8 items-center justify-center rounded-full bg-emerald-100 text-emerald-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    {{ session('success') }}
                </div>
            </div>
        @endif


        {{-- ERREURS --}}

        @if($errors->any())
            <div class="relative overflow-hidden rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">
                <div class="absolute right-0 top-0 h-16 w-16 translate-x-4 -translate-y-4 rounded-full bg-red-200 opacity-30 blur-2xl"></div>
                <div class="relative">
                    <div class="flex items-center gap-3">
                        <div class="flex h-8 w-8 items-center justify-center rounded-full bg-red-100 text-red-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                            </svg>
                        </div>
                        <p class="font-semibold">
                            Vérifiez les informations suivantes :
                        </p>
                    </div>
                    <ul class="mt-2 list-inside list-disc">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif


                {{-- FORMULAIRE --}}

                <form
                    method="POST"
                    action="{{ route('factures.store') }}"
                    id="invoice-form"
                >

                    @csrf


                    {{-- INFORMATIONS FACTURE --}}

                    <div class="forest-card relative overflow-hidden rounded-2xl border p-6 shadow-sm">
                        <div class="absolute right-0 top-0 h-24 w-24 translate-x-8 -translate-y-8 rounded-full bg-[var(--forest-accent)] opacity-5 blur-3xl"></div>
                        <div class="relative flex items-center gap-3">
                            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-[var(--forest-accent)] to-green-600 text-white shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-[var(--forest-text)]">
                                    Informations de la facture
                                </h2>
                            </div>
                        </div>

                        <div class="mt-6 grid gap-5 md:grid-cols-2">


                            {{-- NUMERO --}}

                            <div>

                                <label class="text-sm font-semibold text-[var(--forest-text)]">
                                    Numéro de facture
                                </label>

                                <input
                                    type="text"
                                    name="invoice_number"
                                    value="{{ old('invoice_number', 'FAC-' . date('Ymd-His')) }}"
                                    required
                                    class="mt-2 w-full rounded-xl border border-[var(--forest-border)] bg-[var(--forest-panel)] px-4 py-3 text-sm outline-none transition focus:border-[var(--forest-accent)] focus:bg-white focus:ring-2 focus:ring-[var(--forest-accent-soft)]"
                                >

                            </div>


                            {{-- DATE --}}

                            <div>

                                <label class="text-sm font-semibold text-[var(--forest-text)]">
                                    Date
                                </label>

                                <input
                                    type="date"
                                    name="invoice_date"
                                    value="{{ old('invoice_date', date('Y-m-d')) }}"
                                    required
                                    class="mt-2 w-full rounded-xl border border-[var(--forest-border)] bg-[var(--forest-panel)] px-4 py-3 text-sm outline-none transition focus:border-[var(--forest-accent)] focus:bg-white focus:ring-2 focus:ring-[var(--forest-accent-soft)]"
                                >

                            </div>


                            {{-- CLIENT --}}

                            <div>

                                <label class="text-sm font-semibold text-[var(--forest-text)]">
                                    Client
                                </label>

                                <select
                                    name="client_id"
                                    required
                                    class="mt-2 w-full rounded-xl border border-[var(--forest-border)] bg-[var(--forest-surface)] px-4 py-3 text-sm outline-none transition focus:border-[var(--forest-accent)] focus:ring-2 focus:ring-[var(--forest-accent-soft)]"
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

                                <label class="text-sm font-semibold text-[var(--forest-text)]">
                                    Statut
                                </label>

                                <select
                                    name="status"
                                    required
                                    class="mt-2 w-full rounded-xl border border-[var(--forest-border)] bg-[var(--forest-surface)] px-4 py-3 text-sm outline-none transition focus:border-[var(--forest-accent)] focus:ring-2 focus:ring-[var(--forest-accent-soft)]"
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

                    <div class="mt-6 forest-card relative overflow-hidden rounded-2xl border p-6 shadow-sm">
                        <div class="absolute right-0 top-0 h-24 w-24 translate-x-8 -translate-y-8 rounded-full bg-blue-500 opacity-5 blur-3xl"></div>
                        <div class="relative flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-blue-500 to-blue-700 text-white shadow-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                </div>
                                <div>
                                    <h2 class="text-lg font-bold text-[var(--forest-text)]">
                                        Produits
                                    </h2>
                                    <p class="mt-1 text-xs text-[var(--forest-muted)]">
                                        Ajoutez les produits présents dans la facture.
                                    </p>
                                </div>
                            </div>

                            <button
                                type="button"
                                id="add-product"
                                class="group flex items-center gap-2 rounded-xl bg-gradient-to-r from-[var(--forest-accent)] to-green-600 px-4 py-2.5 text-sm font-semibold text-white shadow-md transition hover:from-green-600 hover:to-green-700 hover:shadow-lg"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                Ajouter un produit
                            </button>

                        </div>


                        {{-- LIGNES PRODUITS --}}

                        <div id="products-container" class="mt-6 space-y-4">

                            <div class="product-row rounded-xl border border-[var(--forest-border)] bg-[var(--forest-panel)] p-4">

                                <div class="grid gap-4 md:grid-cols-12 md:items-end">


                                    {{-- PRODUIT --}}

                                    <div class="md:col-span-5">

                                        <label class="text-xs font-semibold text-[var(--forest-muted)]">
                                            Produit
                                        </label>

                                        <select
                                            name="products[0][product_id]"
                                            class="product-select mt-2 w-full rounded-lg border border-[var(--forest-border)] bg-[var(--forest-surface)] px-3 py-2.5 text-sm outline-none focus:border-[var(--forest-accent)]"
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

                                        <label class="text-xs font-semibold text-[var(--forest-muted)]">
                                            Quantité
                                        </label>

                                        <input
                                            type="number"
                                            name="products[0][quantity]"
                                            value="1"
                                            min="0.01"
                                            step="0.01"
                                            class="quantity-input mt-2 w-full rounded-lg border border-[var(--forest-border)] px-3 py-2.5 text-sm outline-none focus:border-[var(--forest-accent)]"
                                            required
                                        >

                                    </div>


                                    {{-- PRIX --}}

                                    <div class="md:col-span-2">

                                        <label class="text-xs font-semibold text-[var(--forest-muted)]">
                                            Prix unitaire
                                        </label>

                                        <input
                                            type="number"
                                            name="products[0][unit_price]"
                                            value="0"
                                            min="0"
                                            step="0.01"
                                            class="price-input mt-2 w-full rounded-lg border border-[var(--forest-border)] px-3 py-2.5 text-sm outline-none focus:border-[var(--forest-accent)]"
                                            required
                                        >

                                    </div>


                                    {{-- TOTAL --}}

                                    <div class="md:col-span-2">

                                        <label class="text-xs font-semibold text-[var(--forest-muted)]">
                                            Total
                                        </label>

                                        <div class="line-total mt-2 rounded-lg bg-[var(--forest-surface)] px-3 py-2.5 text-sm font-bold text-[var(--forest-text)]">
                                            0.00 DH
                                        </div>

                                    </div>


                                    {{-- SUPPRIMER --}}

                                    <div class="md:col-span-1">

                                        <button
                                            type="button"
                                            class="remove-product hidden w-full rounded-lg border border-red-200 bg-[var(--forest-surface)] px-3 py-2.5 text-sm text-red-500 transition hover:bg-red-50"
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
                        <div class="w-full max-w-md forest-card relative overflow-hidden rounded-2xl border p-6 shadow-sm">
                            <div class="absolute right-0 top-0 h-24 w-24 translate-x-8 -translate-y-8 rounded-full bg-[var(--forest-accent)] opacity-5 blur-3xl"></div>
                            <div class="relative">
                                <div class="flex justify-between text-sm text-[var(--forest-muted)]">
                                    <span>Sous-total</span>
                                    <span id="subtotal">0.00 DH</span>
                                </div>
                                <div class="mt-3 flex justify-between text-sm text-[var(--forest-muted)]">
                                    <span>TVA (20 %)</span>
                                    <span id="tax">0.00 DH</span>
                                </div>
                                <div class="my-4 border-t border-[var(--forest-border)]"></div>
                                <div class="flex items-center justify-between">
                                    <span class="text-base font-bold text-[var(--forest-text)]">Total TTC</span>
                                    <span id="grand-total" class="text-2xl font-black text-[var(--forest-accent)]">0.00 DH</span>
                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- BOUTON --}}

                    <div class="mt-6 flex justify-end">

                        <button
                            type="submit"
                            class="group flex items-center gap-2 rounded-xl bg-gradient-to-r from-[var(--forest-sidebar)] to-[var(--forest-accent)] px-6 py-3 text-sm font-bold text-white shadow-lg transition hover:from-[var(--forest-accent)] hover:to-green-700 hover:shadow-xl"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            Enregistrer la facture
                        </button>

                    </div>

                </form>


        {{-- HISTORIQUE --}}

        <div class="forest-card relative overflow-hidden rounded-2xl border border-[var(--forest-border)] bg-[var(--forest-surface)] shadow-sm">
            <div class="absolute right-0 top-0 h-24 w-24 translate-x-8 -translate-y-8 rounded-full bg-[var(--forest-accent)] opacity-5 blur-3xl"></div>
            <div class="relative p-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-[var(--forest-accent)] to-green-600 text-white shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-[var(--forest-text)]">
                                Dernières factures
                            </h2>
                            <p class="mt-1 text-xs text-[var(--forest-muted)]">
                                Historique des factures enregistrées.
                            </p>
                        </div>
                    </div>
                    <a href="/factures" class="group flex items-center gap-1 text-xs font-semibold text-[var(--forest-accent)] hover:text-[var(--forest-text)] transition-colors">
                        Voir tout
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </a>
                </div>
            </div>


            <div class="overflow-x-auto">

                <table class="w-full text-left text-sm">

                    <thead class="border-y border-[var(--forest-border)] bg-[var(--forest-panel)]">
                        <tr>
                            <th class="px-6 py-4 text-xs font-semibold text-[var(--forest-muted)] uppercase tracking-wider">
                                N° Facture
                            </th>
                            <th class="px-6 py-4 text-xs font-semibold text-[var(--forest-muted)] uppercase tracking-wider">
                                Client
                            </th>
                            <th class="px-6 py-4 text-xs font-semibold text-[var(--forest-muted)] uppercase tracking-wider">
                                Date
                            </th>
                            <th class="px-6 py-4 text-xs font-semibold text-[var(--forest-muted)] uppercase tracking-wider">
                                Montant
                            </th>
                            <th class="px-6 py-4 text-xs font-semibold text-[var(--forest-muted)] uppercase tracking-wider">
                                Statut
                            </th>
                        </tr>
                    </thead>


                    <tbody class="divide-y divide-[var(--forest-border)]">
                        @forelse($invoices as $invoice)
                            <tr class="transition hover:bg-[var(--forest-panel)]">
                                <td class="px-6 py-4 font-semibold text-[var(--forest-text)]">
                                    <span class="inline-flex items-center gap-2">
                                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-[var(--forest-accent-soft)] text-[var(--forest-accent)] text-xs font-bold">
                                            {{ substr($invoice->invoice_number, -3) }}
                                        </span>
                                        {{ $invoice->invoice_number }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-[var(--forest-muted)]">
                                    <div class="flex items-center gap-2">
                                        <div class="flex h-8 w-8 items-center justify-center rounded-full bg-purple-100 text-purple-600 text-xs font-bold">
                                            {{ substr($invoice->client->name ?? 'SC', 0, 2) }}
                                        </div>
                                        <span>{{ $invoice->client->name ?? '—' }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-[var(--forest-muted)]">
                                    {{ $invoice->invoice_date?->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 font-semibold text-[var(--forest-text)]">
                                    {{ number_format($invoice->amount, 2) }} DH
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $statusClass = match(strtolower($invoice->status)) {
                                            'payée' => 'bg-emerald-100 text-emerald-700',
                                            'en attente' => 'bg-amber-100 text-amber-700',
                                            'annulée' => 'bg-red-100 text-red-700',
                                            default => 'bg-slate-100 text-slate-700'
                                        };
                                    @endphp
                                    <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $statusClass }}">
                                        {{ ucfirst($invoice->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-16 text-center">
                                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-[var(--forest-panel)] text-[var(--forest-accent)]">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                        </svg>
                                    </div>
                                    <p class="mt-3 text-sm font-semibold text-[var(--forest-muted)]">
                                        Aucune facture enregistrée.
                                    </p>
                                    <p class="mt-1 text-xs text-[var(--forest-muted)]">
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

</x-layouts.dashboard>

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
