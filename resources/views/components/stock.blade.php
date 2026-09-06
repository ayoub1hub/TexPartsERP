<x-layouts.dashboard>

    <div class="space-y-8">

        {{-- ========================================================= --}}
        {{-- HEADER --}}
        {{-- ========================================================= --}}

        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-[var(--forest-sidebar)] to-blue-900 p-8 shadow-lg">
            <div class="absolute right-0 top-0 h-32 w-32 translate-x-8 -translate-y-8 rounded-full bg-white/10 blur-2xl"></div>
            <div class="absolute bottom-0 right-20 h-24 w-24 translate-x-4 translate-y-4 rounded-full bg-white/10 blur-xl"></div>
            <div class="relative z-10">
                <p class="text-sm font-medium text-white/80">
                    Gestion du stock
                </p>
                <h1 class="mt-1 text-3xl font-black text-white">
                    Stock
                </h1>
                <p class="mt-2 text-sm text-white/70">
                    Consultez votre stock actuel ou ajoutez une nouvelle entrée.
                </p>
            </div>
        </div>


        {{-- ========================================================= --}}
        {{-- NOTIFICATION --}}
        {{-- ========================================================= --}}

        @if ($success)
            <div class="relative overflow-hidden rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-700">
                <div class="absolute right-0 top-0 h-16 w-16 translate-x-4 -translate-y-4 rounded-full bg-emerald-200 opacity-30 blur-2xl"></div>
                <div class="relative flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-emerald-100 text-emerald-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
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
            </div>
        @endif


        {{-- ========================================================= --}}
        {{-- DEUX CHOIX --}}
        {{-- ========================================================= --}}

        <div class="grid gap-6 md:grid-cols-2">
            {{-- ACHAT (ENTRÉE) --}}
            <button
                onclick="toggleForm('entry-form')"
                class="group forest-card relative overflow-hidden rounded-2xl border p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:border-[var(--forest-accent)] hover:shadow-lg text-left"
            >
                <div class="absolute right-0 top-0 h-24 w-24 translate-x-8 -translate-y-8 rounded-full bg-[var(--forest-accent)] opacity-5 blur-3xl transition-opacity group-hover:opacity-10"></div>
                <div class="relative flex items-center gap-4">
                    <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-gradient-to-br from-[var(--forest-accent)] to-green-600 text-white shadow-lg transition-transform group-hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-[var(--forest-text)] group-hover:text-[var(--forest-accent)] transition-colors">
                            Achat (Entrée)
                        </h2>
                        <p class="mt-1 text-xs text-[var(--forest-muted)]">
                            Enregistrez une nouvelle réception de marchandises.
                        </p>
                    </div>
                </div>
            </button>

            {{-- VENTE (SORTIE) --}}
            <button
                onclick="toggleForm('exit-form')"
                class="group forest-card relative overflow-hidden rounded-2xl border p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:border-red-500 hover:shadow-lg text-left"
            >
                <div class="absolute right-0 top-0 h-24 w-24 translate-x-8 -translate-y-8 rounded-full bg-red-500 opacity-5 blur-3xl transition-opacity group-hover:opacity-10"></div>
                <div class="relative flex items-center gap-4">
                    <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-gradient-to-br from-red-500 to-red-700 text-white shadow-lg transition-transform group-hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-[var(--forest-text)] group-hover:text-red-600 transition-colors">
                            Vente (Sortie)
                        </h2>
                        <p class="mt-1 text-xs text-[var(--forest-muted)]">
                            Enregistrez les pièces sorties du stock.
                        </p>
                    </div>
                </div>
            </button>
        </div>


        {{-- ========================================================= --}}
        {{-- VISUALISATION DU STOCK --}}
        {{-- ========================================================= --}}

        <div
            id="visualiser"
            class="forest-card relative overflow-hidden rounded-2xl border shadow-sm"
        >
            <div class="absolute right-0 top-0 h-32 w-32 translate-x-8 -translate-y-8 rounded-full bg-blue-500 opacity-5 blur-3xl"></div>
            <div class="relative border-b border-[var(--forest-border)] p-6">
                <div class="flex items-center gap-3">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-blue-500 to-blue-700 text-white shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-[var(--forest-text)]">
                            Stock actuel
                        </h2>
                        <p class="mt-1 text-xs text-[var(--forest-muted)]">
                            Quantités disponibles pour chaque produit.
                        </p>
                    </div>
                </div>
            </div>


            <div class="overflow-x-auto">

                <table class="w-full text-left text-sm">

                    <thead class="border-b border-[var(--forest-border)] bg-[var(--forest-panel)]">
                        <tr>
                            <th class="px-6 py-4 text-xs font-semibold text-[var(--forest-muted)] uppercase tracking-wider">
                                Produit
                            </th>
                            <th class="px-6 py-4 text-xs font-semibold text-[var(--forest-muted)] uppercase tracking-wider">
                                Référence
                            </th>
                            <th class="px-6 py-4 text-xs font-semibold text-[var(--forest-muted)] uppercase tracking-wider">
                                Entrées
                            </th>
                            <th class="px-6 py-4 text-xs font-semibold text-[var(--forest-muted)] uppercase tracking-wider">
                                Sorties
                            </th>
                            <th class="px-6 py-4 text-xs font-semibold text-[var(--forest-muted)] uppercase tracking-wider">
                                Stock actuel
                            </th>
                            <th class="px-6 py-4 text-xs font-semibold text-[var(--forest-muted)] uppercase tracking-wider">
                                État
                            </th>
                        </tr>
                    </thead>


                    <tbody class="divide-y divide-[var(--forest-border)]">

                        @forelse ($products as $product)
                            <tr class="transition hover:bg-[var(--forest-panel)]">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-100 text-blue-600 text-sm font-bold">
                                            {{ substr($product->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="font-semibold text-[var(--forest-text)]">
                                                {{ $product->name }}
                                            </p>
                                            @if ($product->description)
                                                <p class="mt-1 max-w-xs truncate text-xs text-[var(--forest-muted)]">
                                                    {{ $product->description }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-[var(--forest-muted)]">
                                    {{ $product->reference }}
                                </td>
                                <td class="px-6 py-4 font-medium text-emerald-600">
                                    + {{ $product->total_entries }}
                                </td>
                                <td class="px-6 py-4 font-medium text-red-500">
                                    - {{ $product->total_exits }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-lg font-black text-[var(--forest-text)]">
                                        {{ $product->current_stock }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if ($product->current_stock <= 0)
                                        <span class="inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                            Rupture
                                        </span>
                                    @elseif ($product->current_stock <= $product->minimum_stock)
                                        <span class="inline-flex rounded-full bg-orange-100 px-3 py-1 text-xs font-semibold text-orange-700">
                                            Stock faible
                                        </span>
                                    @else
                                        <span class="inline-flex rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">
                                            Disponible
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-16 text-center">
                                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-[var(--forest-panel)] text-blue-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                        </svg>
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
        {{-- FORMULAIRE ENTRÉE (ACHAT) --}}
        {{-- ========================================================= --}}

        <div
            id="entry-form"
            class="hidden forest-card relative overflow-hidden rounded-2xl border p-6 shadow-sm"
        >
            <div class="absolute right-0 top-0 h-24 w-24 translate-x-8 -translate-y-8 rounded-full bg-[var(--forest-accent)] opacity-5 blur-3xl"></div>
            <div class="relative flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-[var(--forest-accent)] to-green-600 text-white shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-[var(--forest-text)]">
                            Achat (Entrée de stock)
                        </h2>
                        <p class="mt-1 text-xs text-[var(--forest-muted)]">
                            Enregistrez une nouvelle réception auprès d'un fournisseur.
                        </p>
                    </div>
                </div>
                <button
                    onclick="toggleForm('entry-form')"
                    class="flex h-10 w-10 items-center justify-center rounded-lg border border-[var(--forest-border)] bg-[var(--forest-panel)] text-[var(--forest-muted)] transition hover:bg-red-50 hover:text-red-600"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
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
                        class="group flex items-center gap-2 rounded-xl bg-gradient-to-r from-[var(--forest-accent)] to-green-600 px-6 py-3 text-sm font-semibold text-white shadow-md transition hover:from-green-600 hover:to-green-700 hover:shadow-lg"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        Enregistrer l'entrée
                    </button>
                </div>

            </form>

        </div>


        {{-- ========================================================= --}}
        {{-- FORMULAIRE SORTIE (VENTE) --}}
        {{-- ========================================================= --}}

        <div
            id="exit-form"
            class="hidden forest-card relative overflow-hidden rounded-2xl border p-6 shadow-sm"
        >
            <div class="absolute right-0 top-0 h-24 w-24 translate-x-8 -translate-y-8 rounded-full bg-red-500 opacity-5 blur-3xl"></div>
            <div class="relative flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-red-500 to-red-700 text-white shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-[var(--forest-text)]">
                            Vente (Sortie de stock)
                        </h2>
                        <p class="mt-1 text-xs text-[var(--forest-muted)]">
                            Enregistrez les pièces sorties du stock.
                        </p>
                    </div>
                </div>
                <button
                    onclick="toggleForm('exit-form')"
                    class="flex h-10 w-10 items-center justify-center rounded-lg border border-[var(--forest-border)] bg-[var(--forest-panel)] text-[var(--forest-muted)] transition hover:bg-red-50 hover:text-red-600"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
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
                        class="group flex items-center gap-2 rounded-xl bg-gradient-to-r from-red-500 to-red-700 px-6 py-3 text-sm font-semibold text-white shadow-md transition hover:from-red-600 hover:to-red-800 hover:shadow-lg"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                        </svg>
                        Enregistrer la sortie
                    </button>
                </div>

            </form>

        </div>

    </div>

</x-layouts.dashboard>

<script>
function toggleForm(formId) {
    const form = document.getElementById(formId);
    if (form) {
        form.classList.toggle('hidden');
    }
}
</script>