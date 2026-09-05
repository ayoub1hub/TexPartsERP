<x-layouts.dashboard>

    <div class="space-y-8">

        {{-- HEADER --}}
        <div>
            <p class="text-sm font-medium text-[var(--forest-accent)]">
                Gestion commerciale
            </p>

            <h1 class="mt-1 text-3xl font-black text-[var(--forest-text)]">
                Nouvelle facture
            </h1>

            <p class="mt-2 text-sm text-[var(--forest-muted)]">
                Créez une facture et préparez-la pour la génération PDF.
            </p>
        </div>

        {{-- MESSAGE DE SUCCÈS --}}

        @if(session('success'))

            <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-medium text-emerald-700">
                {{ session('success') }}
            </div>

        @endif


        {{-- ERREURS --}}

        @if($errors->any())

            <div class="rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">

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


                {{-- FORMULAIRE --}}

                <form
                    method="POST"
                    action="{{ route('factures.store') }}"
                    id="invoice-form"
                >

                    @csrf


                    {{-- INFORMATIONS FACTURE --}}

                    <div class="forest-card rounded-2xl border p-6 shadow-sm">

                        <h2 class="text-lg font-bold text-[var(--forest-text)]">
                            Informations de la facture
                        </h2>

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

                    <div class="mt-6 forest-card rounded-2xl border p-6 shadow-sm">

                        <div class="flex items-center justify-between">

                            <div>

                                <h2 class="text-lg font-bold text-[var(--forest-text)]">
                                    Produits
                                </h2>

                                <p class="mt-1 text-xs text-[var(--forest-muted)]">
                                    Ajoutez les produits présents dans la facture.
                                </p>

                            </div>

                            <button
                                type="button"
                                id="add-product"
                                class="rounded-xl bg-[var(--forest-accent)] px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-green-700"
                            >
                                + Ajouter un produit
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

                        <div class="w-full max-w-md forest-card rounded-2xl border p-6 shadow-sm">

                            <div class="flex justify-between text-sm text-[var(--forest-muted)]">

                                <span>
                                    Sous-total
                                </span>

                                <span id="subtotal">
                                    0.00 DH
                                </span>

                            </div>


                            <div class="mt-3 flex justify-between text-sm text-[var(--forest-muted)]">

                                <span>
                                    TVA (20 %)
                                </span>

                                <span id="tax">
                                    0.00 DH
                                </span>

                            </div>


                            <div class="my-4 border-t border-[var(--forest-border)]"></div>


                            <div class="flex items-center justify-between">

                                <span class="text-base font-bold text-[var(--forest-text)]">
                                    Total TTC
                                </span>

                                <span
                                    id="grand-total"
                                    class="text-2xl font-black text-[var(--forest-accent)]"
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
                            class="rounded-xl bg-[var(--forest-sidebar)] px-6 py-3 text-sm font-bold text-white shadow-lg transition hover:bg-[var(--forest-sidebar-active)]"
                        >
                            🧾 Enregistrer la facture
                        </button>

                    </div>

                </form>


        {{-- HISTORIQUE --}}

        <div class="overflow-hidden rounded-2xl border border-[var(--forest-border)] bg-[var(--forest-surface)] shadow-sm">

            <div class="p-6">

                <h2 class="text-lg font-bold text-[var(--forest-text)]">
                    Dernières factures
                </h2>

                <p class="mt-1 text-xs text-[var(--forest-muted)]">
                    Historique des factures enregistrées.
                </p>

            </div>


            <div class="overflow-x-auto">

                <table class="w-full text-left text-sm">

                    <thead class="border-y border-[var(--forest-border)] bg-[var(--forest-panel)]">

                        <tr>

                            <th class="px-6 py-4 text-xs font-semibold text-[var(--forest-muted)]">
                                N° Facture
                            </th>

                            <th class="px-6 py-4 text-xs font-semibold text-[var(--forest-muted)]">
                                Client
                            </th>

                            <th class="px-6 py-4 text-xs font-semibold text-[var(--forest-muted)]">
                                Date
                            </th>

                            <th class="px-6 py-4 text-xs font-semibold text-[var(--forest-muted)]">
                                Montant
                            </th>

                            <th class="px-6 py-4 text-xs font-semibold text-[var(--forest-muted)]">
                                Statut
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($invoices as $invoice)

                            <tr class="border-b border-[var(--forest-border)] last:border-0">

                                <td class="px-6 py-4 font-semibold text-[var(--forest-text)]">
                                    {{ $invoice->invoice_number }}
                                </td>

                                <td class="px-6 py-4 text-[var(--forest-muted)]">
                                    {{ $invoice->client->name ?? '—' }}
                                </td>

                                <td class="px-6 py-4 text-[var(--forest-muted)]">
                                    {{ $invoice->invoice_date?->format('d/m/Y') }}
                                </td>

                                <td class="px-6 py-4 font-semibold text-[var(--forest-text)]">
                                    {{ number_format($invoice->amount, 2) }} DH
                                </td>

                                <td class="px-6 py-4">

                                    <span class="rounded-full bg-[var(--forest-panel)] px-3 py-1 text-xs font-semibold text-[var(--forest-muted)]">
                                        {{ $invoice->status }}
                                    </span>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5" class="px-6 py-10 text-center">

                                    <p class="text-sm font-medium text-[var(--forest-muted)]">
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
