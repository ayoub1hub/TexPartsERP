<x-layouts.dashboard>

    <div class="p-8">

        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">
                Alertes stock
            </h1>

            <p class="mt-1 text-gray-500">
                Produits dont le stock est faible ou épuisé.
            </p>
        </div>

        @if($products->isEmpty())

            <div class="rounded-xl border border-green-200 bg-green-50 p-5">
                <h2 class="font-semibold text-green-700">
                    ✓ Aucun produit en alerte
                </h2>

                <p class="mt-1 text-sm text-green-600">
                    Tous les produits ont un stock suffisant.
                </p>
            </div>

        @else

            <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">

                <table class="w-full text-left">

                    <thead class="border-b bg-gray-50">
                        <tr>
                            <th class="px-6 py-4">Produit</th>
                            <th class="px-6 py-4">Référence</th>
                            <th class="px-6 py-4">Stock actuel</th>
                            <th class="px-6 py-4">Seuil minimum</th>
                            <th class="px-6 py-4">État</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">

                        @foreach($products as $product)

                            <tr class="hover:bg-gray-50">

                                <td class="px-6 py-4 font-medium text-gray-900">
                                    {{ $product->name }}
                                </td>

                                <td class="px-6 py-4 text-gray-600">
                                    {{ $product->reference }}
                                </td>

                                <td class="px-6 py-4 font-bold
                                    {{ $product->current_stock <= 0
                                        ? 'text-red-600'
                                        : 'text-orange-600' }}">
                                    {{ $product->current_stock }}
                                </td>

                                <td class="px-6 py-4 text-gray-600">
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
