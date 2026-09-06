<x-layouts.dashboard>

    <div class="space-y-8">

        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-[var(--forest-sidebar)] to-orange-900 p-8 shadow-lg">
            <div class="absolute right-0 top-0 h-32 w-32 translate-x-8 -translate-y-8 rounded-full bg-white/10 blur-2xl"></div>
            <div class="absolute bottom-0 right-20 h-24 w-24 translate-x-4 translate-y-4 rounded-full bg-white/10 blur-xl"></div>
            <div class="relative z-10">
                <p class="text-sm font-medium text-white/80">
                    Gestion des alertes
                </p>
                <h1 class="mt-1 text-3xl font-black text-white">
                    Alertes stock
                </h1>
                <p class="mt-2 text-sm text-white/70">
                    Produits dont le stock est faible ou épuisé.
                </p>
            </div>
        </div>

        @if($products->isEmpty())
            <div class="relative overflow-hidden rounded-xl border border-emerald-200 bg-emerald-50 p-5">
                <div class="absolute right-0 top-0 h-16 w-16 translate-x-4 -translate-y-4 rounded-full bg-emerald-200 opacity-30 blur-2xl"></div>
                <div class="relative flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-emerald-100 text-emerald-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-semibold text-emerald-700">
                            Aucun produit en alerte
                        </h2>
                        <p class="mt-1 text-sm text-emerald-600">
                            Tous les produits ont un stock suffisant.
                        </p>
                    </div>
                </div>
            </div>

        @else

            <div class="forest-card relative overflow-hidden rounded-2xl border shadow-sm">
                <div class="absolute right-0 top-0 h-32 w-32 translate-x-8 -translate-y-8 rounded-full bg-orange-500 opacity-5 blur-3xl"></div>
                <div class="relative border-b border-[var(--forest-border)] p-6">
                    <div class="flex items-center gap-3">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-orange-500 to-orange-700 text-white shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-[var(--forest-text)]">
                                Produits en alerte
                            </h2>
                            <p class="mt-1 text-xs text-[var(--forest-muted)]">
                                {{ $products->count() }} produit(s) nécessite(nt) une attention.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="border-b border-[var(--forest-border)] bg-[var(--forest-panel)]">
                            <tr>
                                <th class="px-6 py-4 text-xs font-semibold text-[var(--forest-muted)] uppercase tracking-wider">Produit</th>
                                <th class="px-6 py-4 text-xs font-semibold text-[var(--forest-muted)] uppercase tracking-wider">Référence</th>
                                <th class="px-6 py-4 text-xs font-semibold text-[var(--forest-muted)] uppercase tracking-wider">Stock actuel</th>
                                <th class="px-6 py-4 text-xs font-semibold text-[var(--forest-muted)] uppercase tracking-wider">Seuil minimum</th>
                                <th class="px-6 py-4 text-xs font-semibold text-[var(--forest-muted)] uppercase tracking-wider">État</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[var(--forest-border)]">
                            @foreach($products as $product)
                                <tr class="transition hover:bg-[var(--forest-panel)]">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-orange-100 text-orange-600 text-sm font-bold">
                                                {{ substr($product->name, 0, 1) }}
                                            </div>
                                            <span class="font-medium text-[var(--forest-text)]">{{ $product->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-[var(--forest-muted)]">
                                        {{ $product->reference }}
                                    </td>
                                    <td class="px-6 py-4 font-bold {{ $product->current_stock <= 0 ? 'text-red-600' : 'text-orange-600' }}">
                                        {{ $product->current_stock }}
                                    </td>
                                    <td class="px-6 py-4 text-[var(--forest-muted)]">
                                        {{ $product->minimum_stock }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($product->current_stock <= 0)
                                            <span class="inline-flex rounded-full bg-red-100 px-3 py-1 text-sm font-semibold text-red-700">
                                                Rupture
                                            </span>
                                        @else
                                            <span class="inline-flex rounded-full bg-orange-100 px-3 py-1 text-sm font-semibold text-orange-700">
                                                Stock faible
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

        @endif

    </div>

</x-layouts.dashboard>
