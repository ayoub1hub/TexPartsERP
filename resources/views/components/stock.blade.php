<x-layouts.dashboard>

    <div class="space-y-8">

        {{-- ========================================================= --}}
        {{-- HEADER --}}
        {{-- ========================================================= --}}

        <div>

            <p class="text-sm font-medium text-cyan-600">
                Gestion du stock
            </p>

            <h1 class="mt-1 text-3xl font-black text-slate-900">
                Stock
            </h1>

            <p class="mt-2 text-sm text-slate-500">
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
                class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:border-cyan-300 hover:shadow-lg"
            >

                <div class="flex items-center gap-4">

                    <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-cyan-50 text-2xl">
                        📦
                    </div>

                    <div>

                        <h2 class="text-lg font-bold text-slate-900">
                            Visualiser le stock
                        </h2>

                        <p class="mt-1 text-xs text-slate-400">
                            Consultez les quantités actuellement disponibles.
                        </p>

                    </div>

                </div>

            </a>


            {{-- MISE À JOUR --}}

            <a
                href="{{ route('stock') }}#mise-a-jour"
                class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:border-blue-300 hover:shadow-lg"
            >

                <div class="flex items-center gap-4">

                    <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-blue-50 text-2xl">
                        ➕
                    </div>

                    <div>

                        <h2 class="text-lg font-bold text-slate-900">
                            Mise à jour du stock
                        </h2>

                        <p class="mt-1 text-xs text-slate-400">
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
            class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm"
        >

            <div class="border-b border-slate-200 p-6">

                <div>

                    <h2 class="text-lg font-bold text-slate-900">
                        Stock actuel
                    </h2>

                    <p class="mt-1 text-xs text-slate-400">
                        Quantités disponibles pour chaque produit.
                    </p>

                </div>

            </div>


            <div class="overflow-x-auto">

                <table class="w-full text-left text-sm">

                    <thead class="border-b border-slate-200 bg-slate-50">

                        <tr>

                            <th class="px-6 py-4 text-xs font-semibold text-slate-500">
                                Produit
                            </th>

                            <th class="px-6 py-4 text-xs font-semibold text-slate-500">
                                Référence
                            </th>

                            <th class="px-6 py-4 text-xs font-semibold text-slate-500">
                                Entrées
                            </th>

                            <th class="px-6 py-4 text-xs font-semibold text-slate-500">
                                Sorties
                            </th>

                            <th class="px-6 py-4 text-xs font-semibold text-slate-500">
                                Stock actuel
                            </th>

                            <th class="px-6 py-4 text-xs font-semibold text-slate-500">
                                État
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-100">

                        @forelse ($products as $product)

                            <tr class="transition hover:bg-slate-50">

                                {{-- PRODUIT --}}

                                <td class="px-6 py-4">

                                    <p class="font-semibold text-slate-800">
                                        {{ $product->name }}
                                    </p>

                                    @if ($product->description)

                                        <p class="mt-1 max-w-xs truncate text-xs text-slate-400">
                                            {{ $product->description }}
                                        </p>

                                    @endif

                                </td>


                                {{-- REFERENCE --}}

                                <td class="px-6 py-4 text-slate-500">
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

                                    <span class="text-lg font-black text-slate-900">
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

                                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-slate-50 text-xl">
                                        📦
                                    </div>

                                    <p class="mt-3 text-sm font-semibold text-slate-600">
                                        Aucun produit
                                    </p>

                                    <p class="mt-1 text-xs text-slate-400">
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
            class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm"
        >

            <div>

                <h2 class="text-lg font-bold text-slate-900">
                    Mise à jour du stock
                </h2>

                <p class="mt-1 text-xs text-slate-400">
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

                        <label class="mb-2 block text-xs font-semibold text-slate-600">
                            Produit
                        </label>

                        <select
                            name="product_id"
                            required
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-cyan-400 focus:bg-white focus:ring-2 focus:ring-cyan-100"
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

                        <label class="mb-2 block text-xs font-semibold text-slate-600">
                            Fournisseur
                        </label>

                        <select
                            name="supplier_id"
                            required
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-violet-400 focus:bg-white focus:ring-2 focus:ring-violet-100"
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

                        <label class="mb-2 block text-xs font-semibold text-slate-600">
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
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-cyan-400 focus:bg-white focus:ring-2 focus:ring-cyan-100"
                        >

                        @error('quantity')

                            <p class="mt-1 text-xs text-red-500">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- PRIX D'ACHAT --}}

                    <div>

                        <label class="mb-2 block text-xs font-semibold text-slate-600">
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
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-cyan-400 focus:bg-white focus:ring-2 focus:ring-cyan-100"
                        >

                        @error('purchase_price')

                            <p class="mt-1 text-xs text-red-500">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- REFERENCE --}}

                    <div>

                        <label class="mb-2 block text-xs font-semibold text-slate-600">
                            Référence de l'achat
                        </label>

                        <input
                            type="text"
                            name="reference"
                            value="{{ old('reference') }}"
                            placeholder="Ex : BL-2026-001"
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-cyan-400 focus:bg-white focus:ring-2 focus:ring-cyan-100"
                        >

                        @error('reference')

                            <p class="mt-1 text-xs text-red-500">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- DATE --}}

                    <div>

                        <label class="mb-2 block text-xs font-semibold text-slate-600">
                            Date d'entrée
                        </label>

                        <input
                            type="date"
                            name="entry_date"
                            required
                            value="{{ old('entry_date', date('Y-m-d')) }}"
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-cyan-400 focus:bg-white focus:ring-2 focus:ring-cyan-100"
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
                        class="rounded-xl bg-cyan-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-cyan-700 hover:shadow-md"
                    >
                        Enregistrer l'entrée
                    </button>

                </div>

            </form>

        </div>

    </div>

</x-layouts.dashboard>