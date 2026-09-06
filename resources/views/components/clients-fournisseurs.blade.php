<x-layouts.dashboard>

    <div class="space-y-8">

        {{-- HEADER --}}
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-[var(--forest-sidebar)] to-purple-900 p-8 shadow-lg">
            <div class="absolute right-0 top-0 h-32 w-32 translate-x-8 -translate-y-8 rounded-full bg-white/10 blur-2xl"></div>
            <div class="absolute bottom-0 right-20 h-24 w-24 translate-x-4 translate-y-4 rounded-full bg-white/10 blur-xl"></div>
            <div class="relative z-10">
                <p class="text-sm font-medium text-white/80">
                    Gestion
                </p>
                <h1 class="mt-1 text-3xl font-black text-white">
                    Clients & Fournisseurs
                </h1>
                <p class="mt-2 text-sm text-white/70">
                    Consultez vos clients, fournisseurs et leurs historiques.
                </p>
            </div>
        </div>


        {{-- ========================================================= --}}
        {{-- CLIENTS + FOURNISSEURS --}}
        {{-- ========================================================= --}}

        <div class="grid gap-6 xl:grid-cols-2">


            {{-- ======================= CLIENTS ======================= --}}

            <div class="forest-card relative overflow-hidden rounded-2xl border shadow-sm">
                <div class="absolute right-0 top-0 h-24 w-24 translate-x-8 -translate-y-8 rounded-full bg-purple-500 opacity-5 blur-3xl"></div>
                <div class="relative border-b border-[var(--forest-border)] p-6">
                    <div class="flex items-center gap-3">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-purple-500 to-purple-700 text-white shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-[var(--forest-text)]">
                                Clients
                            </h2>
                            <p class="text-xs text-[var(--forest-muted)]">
                                {{ $clients->count() }}
                                {{ $clients->count() > 1 ? 'clients' : 'client' }}
                            </p>
                        </div>
                    </div>


                    {{-- RECHERCHE CLIENT --}}

                    <form
                        method="GET"
                        action="{{ route('clients-fournisseurs') }}"
                        class="mt-5"
                    >

                        <div class="flex gap-2">

                            <input
                                type="text"
                                name="client_search"
                                value="{{ $clientSearch }}"
                                placeholder="Rechercher un client..."
                                class="flex-1 rounded-xl border border-[var(--forest-border)] bg-[var(--forest-panel)] px-4 py-3 text-sm text-[var(--forest-text)] outline-none transition focus:border-[var(--forest-accent)] focus:bg-white focus:ring-2 focus:ring-[var(--forest-accent-soft)]"
                            >

                            <button
                                type="submit"
                                class="rounded-xl bg-gradient-to-r from-purple-500 to-purple-700 px-4 py-3 text-xs font-semibold text-white shadow-md transition hover:from-purple-600 hover:to-purple-800 hover:shadow-lg"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </button>

                        </div>

                    </form>

                </div>


                {{-- LISTE CLIENTS --}}

                <div class="divide-y divide-slate-100">

                    @forelse ($clients as $client)

                        <a
                            href="{{ route('clients-fournisseurs', [
                                'client_id' => $client->id
                            ]) }}"
                            class="group block p-5 transition hover:bg-[var(--forest-panel)]"
                        >
                            <div class="flex items-start justify-between gap-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-purple-500 to-purple-700 font-bold text-white shadow-md transition-transform group-hover:scale-110">
                                        {{ strtoupper(substr($client->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-[var(--forest-text)] group-hover:text-purple-600 transition-colors">
                                            {{ $client->name }}
                                        </p>
                                        @if ($client->email)
                                            <p class="mt-1 text-xs text-[var(--forest-muted)]">
                                                {{ $client->email }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                <span class="rounded-lg bg-[var(--forest-panel)] px-2 py-1 text-[10px] font-semibold text-[var(--forest-muted)]">
                                    #{{ $client->id }}
                                </span>
                            </div>
                            <div class="mt-4 grid gap-2 text-xs text-[var(--forest-muted)] sm:grid-cols-2">
                                @if ($client->phone)
                                    <div class="flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                                        </svg>
                                        {{ $client->phone }}
                                    </div>
                                @endif
                                @if ($client->address)
                                    <div class="flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                        </svg>
                                        {{ $client->address }}
                                    </div>
                                @endif
                            </div>
                        </a>

                    @empty

                        <div class="p-8 text-center">
                            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-[var(--forest-panel)] text-purple-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                </svg>
                            </div>
                            <p class="mt-3 text-sm font-semibold text-[var(--forest-muted)]">
                                Aucun client trouvé
                            </p>
                            <p class="mt-1 text-xs text-[var(--forest-muted)]">
                                Aucun client ne correspond à votre recherche.
                            </p>
                        </div>

                    @endforelse

                </div>

            </div>



            {{-- ==================== FOURNISSEURS ==================== --}}

            <div class="forest-card relative overflow-hidden rounded-2xl border shadow-sm">
                <div class="absolute right-0 top-0 h-24 w-24 translate-x-8 -translate-y-8 rounded-full bg-blue-500 opacity-5 blur-3xl"></div>
                <div class="relative border-b border-[var(--forest-border)] p-6">
                    <div class="flex items-center gap-3">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-blue-500 to-blue-700 text-white shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-[var(--forest-text)]">
                                Fournisseurs
                            </h2>
                            <p class="text-xs text-[var(--forest-muted)]">
                                {{ $suppliers->count() }}
                                {{ $suppliers->count() > 1 ? 'fournisseurs' : 'fournisseur' }}
                            </p>
                        </div>
                    </div>


                    {{-- RECHERCHE FOURNISSEUR --}}

                    <form
                        method="GET"
                        action="{{ route('clients-fournisseurs') }}"
                        class="mt-5"
                    >

                        <div class="flex gap-2">

                            <input
                                type="text"
                                name="supplier_search"
                                value="{{ $supplierSearch }}"
                                placeholder="Rechercher un fournisseur..."
                                class="flex-1 rounded-xl border border-[var(--forest-border)] bg-[var(--forest-panel)] px-4 py-3 text-sm text-[var(--forest-text)] outline-none transition focus:border-[var(--forest-accent)] focus:bg-white focus:ring-2 focus:ring-[var(--forest-accent-soft)]"
                            >

                            <button
                                type="submit"
                                class="rounded-xl bg-gradient-to-r from-blue-500 to-blue-700 px-4 py-3 text-xs font-semibold text-white shadow-md transition hover:from-blue-600 hover:to-blue-800 hover:shadow-lg"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </button>

                        </div>

                    </form>

                </div>


                {{-- LISTE FOURNISSEURS --}}

                <div class="divide-y divide-[var(--forest-border)]">

                    @forelse ($suppliers as $supplier)

                        <a
                            href="{{ route('clients-fournisseurs', [
                                'supplier_id' => $supplier->id
                            ]) }}"
                            class="group block p-5 transition hover:bg-[var(--forest-panel)]"
                        >
                            <div class="flex items-start justify-between gap-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-blue-500 to-blue-700 font-bold text-white shadow-md transition-transform group-hover:scale-110">
                                        {{ strtoupper(substr($supplier->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-[var(--forest-text)] group-hover:text-blue-600 transition-colors">
                                            {{ $supplier->name }}
                                        </p>
                                        @if ($supplier->email)
                                            <p class="mt-1 text-xs text-[var(--forest-muted)]">
                                                {{ $supplier->email }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                <span class="rounded-lg bg-[var(--forest-panel)] px-2 py-1 text-[10px] font-semibold text-[var(--forest-muted)]">
                                    #{{ $supplier->id }}
                                </span>
                            </div>
                            <div class="mt-4 grid gap-2 text-xs text-[var(--forest-muted)] sm:grid-cols-2">
                                @if ($supplier->phone)
                                    <div class="flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                                        </svg>
                                        {{ $supplier->phone }}
                                    </div>
                                @endif
                                @if ($supplier->address)
                                    <div class="flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                        </svg>
                                        {{ $supplier->address }}
                                    </div>
                                @endif
                            </div>
                        </a>

                    @empty

                        <div class="p-8 text-center">
                            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-[var(--forest-panel)] text-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                </svg>
                            </div>
                            <p class="mt-3 text-sm font-semibold text-[var(--forest-muted)]">
                                Aucun fournisseur trouvé
                            </p>
                            <p class="mt-1 text-xs text-[var(--forest-muted)]">
                                Aucun fournisseur ne correspond à votre recherche.
                            </p>
                        </div>

                    @endforelse

                </div>

            </div>

        </div>



        {{-- ========================================================= --}}
        {{-- HISTORIQUE CLIENT --}}
        {{-- ========================================================= --}}

        @if ($selectedClient)

            <div class="forest-card relative overflow-hidden rounded-2xl border shadow-sm">
                <div class="absolute right-0 top-0 h-24 w-24 translate-x-8 -translate-y-8 rounded-full bg-purple-500 opacity-5 blur-3xl"></div>
                <div class="relative border-b border-[var(--forest-border)] bg-gradient-to-r from-purple-50 to-[var(--forest-accent-soft)] p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-purple-600">
                                Historique client
                            </p>
                            <h2 class="mt-1 text-xl font-bold text-[var(--forest-text)]">
                                {{ $selectedClient->name }}
                            </h2>
                            <p class="mt-1 text-xs text-[var(--forest-muted)]">
                                Historique des factures associées à ce client.
                            </p>
                        </div>
                        <a
                            href="{{ route('clients-fournisseurs') }}"
                            class="group flex items-center gap-1 rounded-lg bg-white px-3 py-2 text-xs font-semibold text-purple-600 shadow-sm ring-1 ring-purple-200 transition hover:bg-purple-50"
                        >
                            Fermer
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </a>
                    </div>
                </div>


                @if ($clientInvoices->count())
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead class="border-b border-[var(--forest-border)] bg-[var(--forest-panel)]">
                                <tr>
                                    <th class="px-6 py-4 text-xs font-semibold text-[var(--forest-muted)] uppercase tracking-wider">
                                        N° Facture
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
                                @foreach ($clientInvoices as $invoice)
                                    <tr class="transition hover:bg-[var(--forest-panel)]">
                                        <td class="px-6 py-4 font-semibold text-[var(--forest-text)]">
                                            <span class="inline-flex items-center gap-2">
                                                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-purple-100 text-purple-600 text-xs font-bold">
                                                    {{ substr($invoice->invoice_number, -3) }}
                                                </span>
                                                {{ $invoice->invoice_number }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-[var(--forest-muted)]">
                                            {{ $invoice->invoice_date }}
                                        </td>
                                        <td class="px-6 py-4 font-semibold text-[var(--forest-text)]">
                                            {{ number_format($invoice->amount, 2, ',', ' ') }} DH
                                        </td>
                                        <td class="px-6 py-4">
                                            @php
                                                $statusClass = match($invoice->status) {
                                                    'payée' => 'bg-emerald-100 text-emerald-700',
                                                    'en_attente' => 'bg-amber-100 text-amber-700',
                                                    'annulée' => 'bg-red-100 text-red-700',
                                                    default => 'bg-slate-100 text-slate-700'
                                                };
                                            @endphp
                                            <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $statusClass }}">
                                                {{ ucfirst($invoice->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                @else
                    <div class="p-16 text-center">
                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-[var(--forest-panel)] text-purple-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                        </div>
                        <p class="mt-3 text-sm font-semibold text-[var(--forest-muted)]">
                            Aucune facture
                        </p>
                        <p class="mt-1 text-xs text-[var(--forest-muted)]">
                            Ce client n'a encore aucune facture enregistrée.
                        </p>
                    </div>
                @endif

            </div>

        @endif



        {{-- ========================================================= --}}
        {{-- HISTORIQUE FOURNISSEUR --}}
        {{-- ========================================================= --}}

        @if ($selectedSupplier)

            <div class="forest-card relative overflow-hidden rounded-2xl border shadow-sm">
                <div class="absolute right-0 top-0 h-24 w-24 translate-x-8 -translate-y-8 rounded-full bg-blue-500 opacity-5 blur-3xl"></div>
                <div class="relative border-b border-[var(--forest-border)] bg-gradient-to-r from-blue-50 to-[var(--forest-accent-soft)] p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-blue-600">
                                Historique fournisseur
                            </p>
                            <h2 class="mt-1 text-xl font-bold text-[var(--forest-text)]">
                                {{ $selectedSupplier->name }}
                            </h2>
                            <p class="mt-1 text-xs text-[var(--forest-muted)]">
                                Historique de nos achats auprès de ce fournisseur.
                            </p>
                        </div>
                        <a
                            href="{{ route('clients-fournisseurs') }}"
                            class="group flex items-center gap-1 rounded-lg bg-white px-3 py-2 text-xs font-semibold text-blue-600 shadow-sm ring-1 ring-blue-200 transition hover:bg-blue-50"
                        >
                            Fermer
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </a>
                    </div>
                </div>


                @if ($supplierPurchases->count())
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead class="border-b border-[var(--forest-border)] bg-[var(--forest-panel)]">
                                <tr>
                                    <th class="px-6 py-4 text-xs font-semibold text-[var(--forest-muted)] uppercase tracking-wider">
                                        Référence
                                    </th>
                                    <th class="px-6 py-4 text-xs font-semibold text-[var(--forest-muted)] uppercase tracking-wider">
                                        Date
                                    </th>
                                    <th class="px-6 py-4 text-xs font-semibold text-[var(--forest-muted)] uppercase tracking-wider">
                                        Produit
                                    </th>
                                    <th class="px-6 py-4 text-xs font-semibold text-[var(--forest-muted)] uppercase tracking-wider">
                                        Quantité
                                    </th>
                                    <th class="px-6 py-4 text-xs font-semibold text-[var(--forest-muted)] uppercase tracking-wider">
                                        Prix d'achat
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[var(--forest-border)]">
                                @foreach ($supplierPurchases as $purchase)
                                    <tr class="transition hover:bg-[var(--forest-panel)]">
                                        <td class="px-6 py-4 font-semibold text-[var(--forest-text)]">
                                            <span class="inline-flex items-center gap-2">
                                                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-100 text-blue-600 text-xs font-bold">
                                                    {{ substr($purchase->reference ?? 'N/A', 0, 2) }}
                                                </span>
                                                {{ $purchase->reference ?? 'N/A' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-[var(--forest-muted)]">
                                            {{ $purchase->entry_date }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-2">
                                                <div class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-100 text-blue-600 text-xs font-bold">
                                                    {{ substr($purchase->product_name ?? 'P', 0, 1) }}
                                                </div>
                                                <div>
                                                    <p class="font-semibold text-[var(--forest-text)]">
                                                        {{ $purchase->product_name ?? 'Produit inconnu' }}
                                                    </p>
                                                    @if ($purchase->product_reference)
                                                        <p class="text-xs text-[var(--forest-muted)]">
                                                            Réf. {{ $purchase->product_reference }}
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 font-semibold text-[var(--forest-text)]">
                                            {{ $purchase->quantity }}
                                        </td>
                                        <td class="px-6 py-4 font-semibold text-[var(--forest-text)]">
                                            {{ number_format($purchase->purchase_price, 2, ',', ' ') }} DH
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                @else
                    <div class="p-16 text-center">
                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-[var(--forest-panel)] text-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                        <p class="mt-3 text-sm font-semibold text-[var(--forest-muted)]">
                            Aucun achat
                        </p>
                        <p class="mt-1 text-xs text-[var(--forest-muted)]">
                            Aucun achat n'est enregistré pour ce fournisseur.
                        </p>
                    </div>
                @endif

            </div>

        @endif



        {{-- ========================================================= --}}
        {{-- MESSAGE INITIAL --}}
        {{-- ========================================================= --}}

        @if (!$selectedClient && !$selectedSupplier)
            <div class="relative overflow-hidden rounded-2xl border border-dashed border-[var(--forest-border)] bg-[var(--forest-surface)] p-10 text-center">
                <div class="absolute right-0 top-0 h-24 w-24 translate-x-8 -translate-y-8 rounded-full bg-[var(--forest-accent)] opacity-5 blur-3xl"></div>
                <div class="relative">
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-[var(--forest-panel)] text-[var(--forest-accent)]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                        </svg>
                    </div>
                    <p class="mt-3 text-sm font-semibold text-[var(--forest-muted)]">
                        Sélectionnez un client ou un fournisseur
                    </p>
                    <p class="mt-1 text-xs text-[var(--forest-muted)]">
                        Cliquez sur un élément dans les listes ci-dessus pour afficher son historique.
                    </p>
                </div>
            </div>
        @endif

    </div>

</x-layouts.dashboard>