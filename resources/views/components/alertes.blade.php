<x-layouts.dashboard>

    <div class="space-y-8">

        <div>
            <p class="text-sm font-medium text-[var(--forest-accent)]">
                Gestion des alertes
            </p>

            <h1 class="mt-1 text-3xl font-black text-[var(--forest-text)]">
                Alertes stock
            </h1>

            <p class="mt-2 text-sm text-[var(--forest-muted)]">
                Produits dont le stock est faible ou épuisé.
            </p>
        </div>

        @if($products->isEmpty())

            <div class="rounded-xl border border-emerald-200 bg-emerald-50 p-5">
                <h2 class="font-semibold text-emerald-700">
                    ✓ Aucun produit en alerte
                </h2>

                <p class="mt-1 text-sm text-emerald-600">
                    Tous les produits ont un stock suffisant.
                </p>
            </div>

        @else

            <div class="forest-card overflow-hidden rounded-xl border shadow-sm">

                <table class="w-full text-left">

                    <thead class="border-b bg-[var(--forest-panel)]">
                        <tr>
                            <th class="px-6 py-4 text-xs font-semibold text-[var(--forest-muted)]">Produit</th>
                            <th class="px-6 py-4 text-xs font-semibold text-[var(--forest-muted)]">Référence</th>
                            <th class="px-6 py-4 text-xs font-semibold text-[var(--forest-muted)]">Stock actuel</th>
                            <th class="px-6 py-4 text-xs font-semibold text-[var(--forest-muted)]">Seuil minimum</th>
                            <th class="px-6 py-4 text-xs font-semibold text-[var(--forest-muted)]">État</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-[var(--forest-border)]">

                        @foreach($products as $product)

                            <tr class="hover:bg-[var(--forest-panel)]">

                                <td class="px-6 py-4 font-medium text-[var(--forest-text)]">
                                    {{ $product->name }}
                                </td>

                                <td class="px-6 py-4 text-[var(--forest-muted)]">
                                    {{ $product->reference }}
                                </td>

                                <td class="px-6 py-4 font-bold
                                    {{ $product->current_stock <= 0
                                        ? 'text-red-600'
                                        : 'text-orange-600' }}">
                                    {{ $product->current_stock }}
                                </td>

                                <td class="px-6 py-4 text-[var(--forest-muted)]">
                                    {{ $product->minimum_stock }}
                                </td>

                                <td class="px-6 py-4">

                                    @if($product->current_stock <= 0)

                                        <span class="rounded-full bg-red-100 px-3 py-1 text-sm font-semibold text-red-700">
                                            Rupture
                                        </span>

                                    @else

                                        <span class="rounded-full bg-orange-100 px-3 py-1 text-sm font-semibold text-orange-700">
                                            Stock faible
                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @endif

    </div>

</x-layouts.dashboard>
