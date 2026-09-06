<x-layouts.dashboard>

    @php

        /*
        |--------------------------------------------------------------------------
        | STATISTIQUES
        |--------------------------------------------------------------------------
        */

        // Nombre de clients
        $clientsCount = \Illuminate\Support\Facades\DB::table('clients')->count();

        // Nombre de factures
        $salesCount = \Illuminate\Support\Facades\DB::table('invoices')->count();

        // Chiffre d'affaires
        $totalRevenue = \Illuminate\Support\Facades\DB::table('invoices')->sum('amount');


        /*
        |--------------------------------------------------------------------------
        | ALERTES STOCK
        |--------------------------------------------------------------------------
        */

        $products = \Illuminate\Support\Facades\DB::table('products')->get();

        $alertCount = 0;

        foreach ($products as $product) {

            $entries = \Illuminate\Support\Facades\DB::table('stock_entries')
                ->where('product_id', $product->id)
                ->sum('quantity');

            $exits = \Illuminate\Support\Facades\DB::table('stock_exits')
                ->where('product_id', $product->id)
                ->sum('quantity');

            $stock = $entries - $exits;

            if ($stock <= $product->minimum_stock) {
                $alertCount++;
            }
        }


        /*
        |--------------------------------------------------------------------------
        | FACTURES DU MOIS
        |--------------------------------------------------------------------------
        */

        $monthlyRevenue = \Illuminate\Support\Facades\DB::table('invoices')
            ->whereMonth('invoice_date', now()->month)
            ->whereYear('invoice_date', now()->year)
            ->sum('amount');

        $monthlySales = \Illuminate\Support\Facades\DB::table('invoices')
            ->whereMonth('invoice_date', now()->month)
            ->whereYear('invoice_date', now()->year)
            ->count();


        /*
        |--------------------------------------------------------------------------
        | DERNIÈRES FACTURES
        |--------------------------------------------------------------------------
        */

        $latestInvoices = \Illuminate\Support\Facades\DB::table('invoices')
            ->leftJoin(
                'clients',
                'invoices.client_id',
                '=',
                'clients.id'
            )
            ->select(
                'invoices.*',
                'clients.name as client_name'
            )
            ->orderByDesc('invoices.invoice_date')
            ->limit(5)
            ->get();

    @endphp


    <div class="space-y-8">


        {{-- ================= HEADER ================= --}}

        <div>

            <p class="text-sm font-medium text-cyan-600">
                Vue générale
            </p>

            <h1 class="mt-1 text-3xl font-black text-slate-900">
                Bonjour, Admin 👋
            </h1>

            <p class="mt-2 text-sm text-slate-500">
                Voici un aperçu de l'activité de Texpart.
            </p>

        </div>


        {{-- ================= STATISTIQUES ================= --}}

        <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-4">


            {{-- CA --}}

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-sm font-medium text-slate-500">
                            Chiffre d'affaires
                        </p>

                        <p class="mt-2 text-2xl font-black text-slate-900">
                            {{ number_format($totalRevenue, 2, ',', ' ') }} DH
                        </p>

                        <p class="mt-2 text-xs text-emerald-600">
                            {{ number_format($monthlyRevenue, 2, ',', ' ') }} DH ce mois
                        </p>

                    </div>

                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-cyan-50 text-cyan-600">
                        💰
                    </div>

                </div>

            </div>


            {{-- VENTES --}}

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-sm font-medium text-slate-500">
                            Ventes
                        </p>

                        <p class="mt-2 text-2xl font-black text-slate-900">
                            {{ $salesCount }}
                        </p>

                        <p class="mt-2 text-xs text-slate-400">
                            {{ $monthlySales }} ce mois
                        </p>

                    </div>

                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                        📈
                    </div>

                </div>

            </div>


            {{-- CLIENTS --}}

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-sm font-medium text-slate-500">
                            Clients
                        </p>

                        <p class="mt-2 text-2xl font-black text-slate-900">
                            {{ $clientsCount }}
                        </p>

                        <p class="mt-2 text-xs text-slate-400">
                            Clients enregistrés
                        </p>

                    </div>

                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-violet-50 text-violet-600">
                        👥
                    </div>

                </div>

            </div>


            {{-- ALERTES --}}

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-sm font-medium text-slate-500">
                            Alertes stock
                        </p>

                        <p class="mt-2 text-2xl font-black
                            {{ $alertCount > 0 ? 'text-red-600' : 'text-slate-900' }}">
                            {{ $alertCount }}
                        </p>

                        <p class="mt-2 text-xs
                            {{ $alertCount > 0 ? 'text-red-500' : 'text-emerald-600' }}">

                            @if($alertCount > 0)
                                Stock faible ou rupture
                            @else
                                Aucun produit en alerte
                            @endif

                        </p>

                    </div>

                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-orange-50 text-orange-500">
                        🔔
                    </div>

                </div>

            </div>

        </div>


        {{-- ================= GRAPHIQUE + ACTIONS ================= --}}

        <div class="grid gap-6 xl:grid-cols-3">


            {{-- GRAPHIQUE --}}

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm xl:col-span-2">

                <div class="flex items-center justify-between">

                    <div>

                        <h2 class="text-lg font-bold text-slate-900">
                            Évolution des ventes
                        </h2>

                        <p class="mt-1 text-xs text-slate-400">
                            Chiffre d'affaires enregistré
                        </p>

                    </div>

                    <span class="rounded-lg bg-slate-50 px-3 py-2 text-xs text-slate-600">
                        {{ now()->format('F Y') }}
                    </span>

                </div>


                <div class="mt-6 rounded-xl border border-slate-200 bg-slate-50 p-6">

                    <div class="grid grid-cols-7 gap-3 items-end h-52">

                        @php

                            $days = [];

                            for ($i = 6; $i >= 0; $i--) {

                                $date = now()->subDays($i);

                                $value = \Illuminate\Support\Facades\DB::table('invoices')
                                    ->whereDate(
                                        'invoice_date',
                                        $date->format('Y-m-d')
                                    )
                                    ->sum('amount');

                                $days[] = [
                                    'date' => $date,
                                    'value' => $value
                                ];
                            }

                            $maxValue = collect($days)->max('value');

                            if ($maxValue <= 0) {
                                $maxValue = 1;
                            }

                        @endphp


                        @foreach($days as $day)

                            @php
                                $height = ($day['value'] / $maxValue) * 100;
                            @endphp

                            <div class="flex h-full flex-col items-center justify-end">

                                <div class="mb-2 text-[10px] font-semibold text-slate-500">
                                    {{ number_format($day['value'], 0, ',', ' ') }}
                                </div>

                                <div
                                    class="w-full max-w-10 rounded-t-lg bg-cyan-500 transition hover:bg-cyan-600"
                                    style="height: {{ max($height, 3) }}%;"
                                    title="{{ number_format($day['value'], 2, ',', ' ') }} DH"
                                ></div>

                                <div class="mt-2 text-[10px] text-slate-400">
                                    {{ $day['date']->format('d/m') }}
                                </div>

                            </div>

                        @endforeach

                    </div>

                </div>

            </div>


            {{-- ACTIONS RAPIDES --}}

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                <h2 class="text-lg font-bold text-slate-900">
                    Actions rapides
                </h2>

                <p class="mt-1 text-xs text-slate-400">
                    Accès rapide aux fonctionnalités
                </p>


                <div class="mt-5 space-y-3">


                    <a
                        href="{{ route('clients-fournisseurs') }}"
                        class="flex items-center gap-3 rounded-xl border border-slate-200 p-3 transition hover:border-cyan-300 hover:bg-cyan-50"
                    >

                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-cyan-50">
                            👥
                        </div>

                        <div>

                            <p class="text-sm font-semibold text-slate-800">
                                Gérer les clients
                            </p>

                            <p class="text-[11px] text-slate-400">
                                Clients & fournisseurs
                            </p>

                        </div>

                    </a>


                    <a
                        href="{{ route('stock') }}"
                        class="flex items-center gap-3 rounded-xl border border-slate-200 p-3 transition hover:border-blue-300 hover:bg-blue-50"
                    >

                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-50">
                            📦
                        </div>

                        <div>

                            <p class="text-sm font-semibold text-slate-800">
                                Consulter le stock
                            </p>

                            <p class="text-[11px] text-slate-400">
                                Produits disponibles
                            </p>

                        </div>

                    </a>


                    <a
                        href="{{ route('factures') }}"
                        class="flex items-center gap-3 rounded-xl border border-slate-200 p-3 transition hover:border-violet-300 hover:bg-violet-50"
                    >

                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-violet-50">
                            🧾
                        </div>

                        <div>

                            <p class="text-sm font-semibold text-slate-800">
                                Créer une facture
                            </p>

                            <p class="text-[11px] text-slate-400">
                                Nouvelle facture
                            </p>

                        </div>

                    </a>


                    <a
                        href="{{ route('alertes') }}"
                        class="flex items-center gap-3 rounded-xl border border-slate-200 p-3 transition hover:border-red-300 hover:bg-red-50"
                    >

                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-red-50">
                            🔔
                        </div>

                        <div>

                            <p class="text-sm font-semibold text-slate-800">
                                Voir les alertes
                            </p>

                            <p class="text-[11px] text-slate-400">
                                {{ $alertCount }} produit(s) à vérifier
                            </p>

                        </div>

                    </a>

                </div>

            </div>

        </div>


        {{-- ================= DERNIÈRES FACTURES ================= --}}

        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">


            <div class="flex items-center justify-between p-6">

                <div>

                    <h2 class="text-lg font-bold text-slate-900">
                        Dernières factures
                    </h2>

                    <p class="mt-1 text-xs text-slate-400">
                        Les dernières factures enregistrées
                    </p>

                </div>


                <a
                    href="{{ route('factures') }}"
                    class="text-xs font-semibold text-cyan-600 hover:text-cyan-700"
                >
                    Voir tout →
                </a>

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

                        @forelse($latestInvoices as $invoice)

                            <tr class="border-b border-slate-100 last:border-0 hover:bg-slate-50">

                                <td class="px-6 py-4 font-semibold text-slate-800">
                                    {{ $invoice->invoice_number }}
                                </td>

                                <td class="px-6 py-4 text-slate-600">
                                    {{ $invoice->client_name ?? '—' }}
                                </td>

                                <td class="px-6 py-4 text-slate-600">
                                    {{ $invoice->invoice_date
                                        ? date('d/m/Y', strtotime($invoice->invoice_date))
                                        : '—'
                                    }}
                                </td>

                                <td class="px-6 py-4 font-semibold text-slate-800">
                                    {{ number_format($invoice->amount, 2, ',', ' ') }} DH
                                </td>

                                <td class="px-6 py-4">

                                    @if($invoice->status === 'Payée')

                                        <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">
                                            {{ $invoice->status }}
                                        </span>

                                    @elseif($invoice->status === 'Annulée')

                                        <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                            {{ $invoice->status }}
                                        </span>

                                    @else

                                        <span class="rounded-full bg-orange-100 px-3 py-1 text-xs font-semibold text-orange-700">
                                            {{ $invoice->status }}
                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="5"
                                    class="px-6 py-10 text-center"
                                >

                                    <p class="text-sm font-medium text-slate-500">
                                        Aucune facture pour le moment
                                    </p>

                                    <p class="mt-1 text-xs text-slate-400">
                                        Les nouvelles factures apparaîtront ici.
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