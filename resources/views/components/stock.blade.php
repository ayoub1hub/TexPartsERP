<x-layouts.dashboard>

    <div class="space-y-8">

        {{-- ========================================================= --}}
        {{-- HEADER --}}
        {{-- ========================================================= --}}

        <div>

            <p class="text-sm font-medium text-[var(--forest-accent)]">
                Gestion du stock
            </p>

            <h1 class="mt-1 text-3xl font-black text-[var(--forest-text)]">
                Stock
            </h1>

            <p class="mt-2 text-sm text-[var(--forest-muted)]">
                Consultez votre stock actuel ou ajoutez une nouvelle entrée.
            </p>

        </div>


        {{-- ========================================================= --}}
        {{-- NOTIFICATION --}}
        {{-- ========================================================= --}}

        @if ($success)

            <div
                class="flex items-center gap-3 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-700"
            >

                <div class="flex h-9 w-9 items-center justify-center rounded-full bg-emerald-100">
                    ✓
                </div>

                <div>

                    <p class="font-semibold">
                        Stock mis à jour
                    </p>

                    <p class="text-xs text-emerald-600">
                        {{ $success }}
                    </p>

                </div>

            </div>

        @endif


        {{-- ========================================================= --}}
        {{-- DEUX CHOIX --}}
        {{-- ========================================================= --}}

        <div class="grid gap-6 md:grid-cols-2">


            {{-- VISUALISER --}}

            <a
                href="{{ route('stock') }}#visualiser"
                class="group forest-card rounded-2xl border p-6 shadow-sm transition hover:-translate-y-1 hover:border-[var(--forest-accent)] hover:shadow-lg"
            >

                <div class="flex items-center gap-4">

                    <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-[var(--forest-accent-soft)] text-2xl">
                        📦
                    </div>

                    <div>

                        <h2 class="text-lg font-bold text-[var(--forest-text)]">
                            Visualiser le stock
                        </h2>

                        <p class="mt-1 text-xs text-[var(--forest-muted)]">
                            Consultez les quantités actuellement disponibles.
                        </p>

                    </div>

                </div>

            </a>


            {{-- MISE À JOUR --}}

            <a
                href="{{ route('stock') }}#mise-a-jour"
                class="group forest-card rounded-2xl border p-6 shadow-sm transition hover:-translate-y-1 hover:border-[var(--forest-accent)] hover:shadow-lg"
            >

                <div class="flex items-center gap-4">

                    <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-[var(--forest-accent-soft)] text-2xl">
                        ➕
                    </div>

                    <div>

                        <h2 class="text-lg font-bold text-[var(--forest-text)]">
                            Mise à jour du stock
                        </h2>

                        <p class="mt-1 text-xs text-[var(--forest-muted)]">
                            Enregistrez une nouvelle réception de marchandises.
                        </p>

                    </div>

                </div>

            </a>

        </div>


        {{-- ========================================================= --}}
        {{-- VISUALISATION DU STOCK --}}
        {{-- ========================================================= --}}

        <div
            id="visualiser"
            class="forest-card overflow-hidden rounded-2xl border shadow-sm"
        >

            <div class="border-b border-[var(--forest-border)] p-6">

                <div>

                    <h2 class="text-lg font-bold text-[var(--forest-text)]">
                        Stock actuel
                    </h2>

                    <p class="mt-1 text-xs text-[var(--forest-muted)]">
                        Quantités disponibles pour chaque produit.
                    </p>

                </div>

            </div>


            <div class="overflow-x-auto">

                <table class="w-full text-left text-sm">

                    <thead class="border-b border-[var(--forest-border)] bg-[var(--forest-panel)]">

                        <tr>

                            <th class="px-6 py-4 text-xs font-semibold text-[var(--forest-muted)]">
                                Produit
                            </th>

                            <th class="px-6 py-4 text-xs font-semibold text-[var(--forest-muted)]">
                                Référence
                            </th>

                            <th class="px-6 py-4 text-xs font-semibold text-[var(--forest-muted)]">
                                Entrées
                            </th>

                            <th class="px-6 py-4 text-xs font-semibold text-[var(--forest-muted)]">
                                Sorties
                            </th>

                            <th class="px-6 py-4 text-xs font-semibold text-[var(--forest-muted)]">
                                Stock actuel
                            </th>

                            <th class="px-6 py-4 text-xs font-semibold text-[var(--forest-muted)]">
                                État
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-[var(--forest-border)]">

                        @forelse ($products as $product)

                            <tr class="transition hover:bg-[var(--forest-panel)]">

                                {{-- PRODUIT --}}

                                <td class="px-6 py-4">

                                    <p class="font-semibold text-[var(--forest-text)]">
                                        {{ $product->name }}
                                    </p>

                                    @if ($product->description)

                                        <p class="mt-1 max-w-xs truncate text-xs text-[var(--forest-muted)]">
                                            {{ $product->description }}
                                        </p>

                                    @endif

                                </td>


                                {{-- REFERENCE --}}

                                <td class="px-6 py-4 text-[var(--forest-muted)]">
                                    {{ $product->reference }}
                                </td>


                                {{-- ENTREES --}}

                                <td class="px-6 py-4 font-medium text-emerald-600">
                                    + {{ $product->total_entries }}
                                </td>


                                {{-- SORTIES --}}

                                <td class="px-6 py-4 font-medium text-red-500">
                                    - {{ $product->total_exits }}
                                </td>


                                {{-- STOCK ACTUEL --}}

                                <td class="px-6 py-4">

                                    <span class="text-lg font-black text-[var(--forest-text)]">
                                        {{ $product->current_stock }}
                                    </span>

                                </td>


                                {{-- ETAT --}}

                                <td class="px-6 py-4">

                                    @if ($product->current_stock <= 0)

                                        <span class="inline-flex rounded-full bg-red-50 px-3 py-1 text-xs font-semibold text-red-600">
                                            Rupture
                                        </span>

                                    @elseif ($product->current_stock <= $product->minimum_stock)

                                        <span class="inline-flex rounded-full bg-orange-50 px-3 py-1 text-xs font-semibold text-orange-600">
                                            Stock faible
                                        </span>

                                    @else

                                        <span class="inline-flex rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-600">
                                            Disponible
                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="6"
                                    class="px-6 py-12 text-center"
                                >

                                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-[var(--forest-panel)] text-xl">
                                        📦
                                    </div>

                                    <p class="mt-3 text-sm font-semibold text-[var(--forest-muted)]">
                                        Aucun produit
                                    </p>

                                    <p class="mt-1 text-xs text-[var(--forest-muted)]">
                                        Les produits apparaîtront ici une fois enregistrés.
                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- MISE À JOUR DU STOCK --}}
        {{-- ========================================================= --}}

        <div
            id="mise-a-jour"
            class="forest-card rounded-2xl border p-6 shadow-sm"
        >

            <div>

                <h2 class="text-lg font-bold text-[var(--forest-text)]">
                    Mise à jour du stock
                </h2>

                <p class="mt-1 text-xs text-[var(--forest-muted)]">
                    Enregistrez une nouvelle réception auprès d'un fournisseur.
                </p>

            </div>


            <form
                method="POST"
                action="{{ route('stock.entry') }}"
                class="mt-6"
            >

                @csrf


                <div class="grid gap-5 md:grid-cols-2">


                    {{-- PRODUIT --}}

                    <div>

                        <label class="mb-2 block text-xs font-semibold text-[var(--forest-text)]">
                            Produit
                        </label>

                        <select
                            name="product_id"
                            required
                            class="w-full rounded-xl border border-[var(--forest-border)] bg-[var(--forest-panel)] px-4 py-3 text-sm text-[var(--forest-text)] outline-none transition focus:border-[var(--forest-accent)] focus:bg-white focus:ring-2 focus:ring-[var(--forest-accent-soft)]"
                        >

                            <option value="">
                                Sélectionner un produit
                            </option>

                            @foreach ($products as $product)

                                <option value="{{ $product->id }}">

                                    {{ $product->name }}
                                    — {{ $product->reference }}

                                </option>

                            @endforeach

                        </select>

                        @error('product_id')

                            <p class="mt-1 text-xs text-red-500">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- FOURNISSEUR --}}

                    <div>

                        <label class="mb-2 block text-xs font-semibold text-[var(--forest-text)]">
                            Fournisseur
                        </label>

                        <select
                            name="supplier_id"
                            required
                            class="w-full rounded-xl border border-[var(--forest-border)] bg-[var(--forest-panel)] px-4 py-3 text-sm text-[var(--forest-text)] outline-none transition focus:border-[var(--forest-accent)] focus:bg-white focus:ring-2 focus:ring-[var(--forest-accent-soft)]"
                        >

                            <option value="">
                                Sélectionner un fournisseur
                            </option>

                            @foreach ($suppliers as $supplier)

                                <option value="{{ $supplier->id }}">
                                    {{ $supplier->name }}
                                </option>

                            @endforeach

                        </select>

                        @error('supplier_id')

                            <p class="mt-1 text-xs text-red-500">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- QUANTITE --}}

                    <div>

                        <label class="mb-2 block text-xs font-semibold text-[var(--forest-text)]">
                            Quantité
                        </label>

                        <input
                            type="number"
                            name="quantity"
                            min="1"
                            step="1"
                            required
                            value="{{ old('quantity') }}"
                            placeholder="Ex : 50"
                            class="w-full rounded-xl border border-[var(--forest-border)] bg-[var(--forest-panel)] px-4 py-3 text-sm text-[var(--forest-text)] outline-none transition focus:border-[var(--forest-accent)] focus:bg-white focus:ring-2 focus:ring-[var(--forest-accent-soft)]"
                        >

                        @error('quantity')

                            <p class="mt-1 text-xs text-red-500">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- PRIX D'ACHAT --}}

                    <div>

                        <label class="mb-2 block text-xs font-semibold text-[var(--forest-text)]">
                            Prix d'achat unitaire (DH)
                        </label>

                        <input
                            type="number"
                            name="purchase_price"
                            min="0"
                            step="0.01"
                            required
                            value="{{ old('purchase_price') }}"
                            placeholder="Ex : 25.00"
                            class="w-full rounded-xl border border-[var(--forest-border)] bg-[var(--forest-panel)] px-4 py-3 text-sm text-[var(--forest-text)] outline-none transition focus:border-[var(--forest-accent)] focus:bg-white focus:ring-2 focus:ring-[var(--forest-accent-soft)]"
                        >

                        @error('purchase_price')

                            <p class="mt-1 text-xs text-red-500">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- REFERENCE --}}

                    <div>

                        <label class="mb-2 block text-xs font-semibold text-[var(--forest-text)]">
                            Référence de l'achat
                        </label>

                        <input
                            type="text"
                            name="reference"
                            value="{{ old('reference') }}"
                            placeholder="Ex : BL-2026-001"
                            class="w-full rounded-xl border border-[var(--forest-border)] bg-[var(--forest-panel)] px-4 py-3 text-sm text-[var(--forest-text)] outline-none transition focus:border-[var(--forest-accent)] focus:bg-white focus:ring-2 focus:ring-[var(--forest-accent-soft)]"
                        >

                        @error('reference')

                            <p class="mt-1 text-xs text-red-500">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- DATE --}}

                    <div>

                        <label class="mb-2 block text-xs font-semibold text-[var(--forest-text)]">
                            Date d'entrée
                        </label>

                        <input
                            type="date"
                            name="entry_date"
                            required
                            value="{{ old('entry_date', date('Y-m-d')) }}"
                            class="w-full rounded-xl border border-[var(--forest-border)] bg-[var(--forest-panel)] px-4 py-3 text-sm text-[var(--forest-text)] outline-none transition focus:border-[var(--forest-accent)] focus:bg-white focus:ring-2 focus:ring-[var(--forest-accent-soft)]"
                        >

                        @error('entry_date')

                            <p class="mt-1 text-xs text-red-500">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>

                </div>


                {{-- BOUTON --}}

                <div class="mt-6 flex justify-end">

                    <button
                        type="submit"
                        class="rounded-xl bg-[var(--forest-accent)] px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-green-700 hover:shadow-md"
                    >
                        Enregistrer l'entrée
                    </button>

                </div>

            </form>

        </div>


        {{-- ========================================================= --}}
        {{-- SORTIE DU STOCK --}}
        {{-- ========================================================= --}}

        <div
            id="sortie-stock"
            class="forest-card rounded-2xl border p-6 shadow-sm"
        >

            <div>

                <h2 class="text-lg font-bold text-[var(--forest-text)]">
                    Sortie de stock
                </h2>

                <p class="mt-1 text-xs text-[var(--forest-muted)]">
                    Enregistrez les pièces sorties du stock.
                </p>

            </div>


            <form
                method="POST"
                action="{{ route('stock.exit') }}"
                class="mt-6"
            >

                @csrf


                <div class="grid gap-5 md:grid-cols-2">

                    <div>

                        <label class="mb-2 block text-xs font-semibold text-[var(--forest-text)]">
                            Produit
                        </label>

                        <select
                            name="product_id"
                            required
                            class="w-full rounded-xl border border-[var(--forest-border)] bg-[var(--forest-panel)] px-4 py-3 text-sm text-[var(--forest-text)] outline-none transition focus:border-[var(--forest-accent)] focus:bg-white focus:ring-2 focus:ring-[var(--forest-accent-soft)]"
                        >

                            <option value="">
                                Sélectionner un produit
                            </option>

                            @foreach ($products as $product)

                                <option
                                    value="{{ $product->id }}"
                                    {{ old('product_id') == $product->id ? 'selected' : '' }}
                                >
                                    {{ $product->name }} — disponible : {{ $product->current_stock }}
                                </option>

                            @endforeach

                        </select>

                        @error('product_id')

                            <p class="mt-1 text-xs text-red-500">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    <div>

                        <label class="mb-2 block text-xs font-semibold text-[var(--forest-text)]">
                            Quantité
                        </label>

                        <input
                            type="number"
                            name="quantity"
                            min="1"
                            step="1"
                            required
                            value="{{ old('quantity') }}"
                            placeholder="Ex : 5"
                            class="w-full rounded-xl border border-[var(--forest-border)] bg-[var(--forest-panel)] px-4 py-3 text-sm text-[var(--forest-text)] outline-none transition focus:border-[var(--forest-accent)] focus:bg-white focus:ring-2 focus:ring-[var(--forest-accent-soft)]"
                        >

                        @error('quantity')

                            <p class="mt-1 text-xs text-red-500">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    <div>

                        <label class="mb-2 block text-xs font-semibold text-[var(--forest-text)]">
                            Motif
                        </label>

                        <input
                            type="text"
                            name="reason"
                            value="{{ old('reason') }}"
                            placeholder="Ex : Vente client"
                            class="w-full rounded-xl border border-[var(--forest-border)] bg-[var(--forest-panel)] px-4 py-3 text-sm text-[var(--forest-text)] outline-none transition focus:border-[var(--forest-accent)] focus:bg-white focus:ring-2 focus:ring-[var(--forest-accent-soft)]"
                        >

                        @error('reason')

                            <p class="mt-1 text-xs text-red-500">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    <div>

                        <label class="mb-2 block text-xs font-semibold text-[var(--forest-text)]">
                            Référence
                        </label>

                        <input
                            type="text"
                            name="reference"
                            value="{{ old('reference') }}"
                            placeholder="Ex : BL-2026-002"
                            class="w-full rounded-xl border border-[var(--forest-border)] bg-[var(--forest-panel)] px-4 py-3 text-sm text-[var(--forest-text)] outline-none transition focus:border-[var(--forest-accent)] focus:bg-white focus:ring-2 focus:ring-[var(--forest-accent-soft)]"
                        >

                        @error('reference')

                            <p class="mt-1 text-xs text-red-500">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    <div>

                        <label class="mb-2 block text-xs font-semibold text-[var(--forest-text)]">
                            Date de sortie
                        </label>

                        <input
                            type="date"
                            name="exit_date"
                            required
                            value="{{ old('exit_date', date('Y-m-d')) }}"
                            class="w-full rounded-xl border border-[var(--forest-border)] bg-[var(--forest-panel)] px-4 py-3 text-sm text-[var(--forest-text)] outline-none transition focus:border-[var(--forest-accent)] focus:bg-white focus:ring-2 focus:ring-[var(--forest-accent-soft)]"
                        >

                        @error('exit_date')

                            <p class="mt-1 text-xs text-red-500">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>

                </div>


                <div class="mt-6 flex justify-end">

                    <button
                        type="submit"
                        class="rounded-xl bg-red-500 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-red-600 hover:shadow-md"
                    >
                        Enregistrer la sortie
                    </button>

                </div>

            </form>

        </div>

    </div>

</x-layouts.dashboard>