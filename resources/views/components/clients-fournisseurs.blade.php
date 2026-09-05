<x-layouts.dashboard>

    <div class="space-y-8">

        {{-- HEADER --}}
        <div>
            <p class="text-sm font-medium text-[var(--forest-accent)]">
                Gestion
            </p>

            <h1 class="mt-1 text-3xl font-black text-[var(--forest-text)]">
                Clients & Fournisseurs
            </h1>

            <p class="mt-2 text-sm text-[var(--forest-muted)]">
                Consultez vos clients, fournisseurs et leurs historiques.
            </p>
        </div>


        {{-- ========================================================= --}}
        {{-- CLIENTS + FOURNISSEURS --}}
        {{-- ========================================================= --}}

        <div class="grid gap-6 xl:grid-cols-2">


            {{-- ======================= CLIENTS ======================= --}}

            <div class="forest-card overflow-hidden rounded-2xl border shadow-sm">

                <div class="border-b border-[var(--forest-border)] p-6">

                    <div class="flex items-center gap-3">

                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[var(--forest-accent-soft)] text-xl">
                            👥
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
                                class="rounded-xl bg-[var(--forest-accent)] px-4 py-3 text-xs font-semibold text-white transition hover:bg-green-700"
                            >
                                Rechercher
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
                            class="block p-5 transition hover:bg-[var(--forest-accent-soft)]"
                        >

                            <div class="flex items-start justify-between gap-4">

                                <div class="flex items-center gap-3">

                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[var(--forest-accent-soft)] font-bold text-[var(--forest-accent)]">
                                        {{ strtoupper(substr($client->name, 0, 1)) }}
                                    </div>

                                    <div>

                                        <p class="text-sm font-bold text-[var(--forest-text)]">
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


                            <div class="mt-4 grid gap-2 text-xs text-slate-500 sm:grid-cols-2">

                                @if ($client->phone)

                                    <div>
                                        📞 {{ $client->phone }}
                                    </div>

                                @endif


                                @if ($client->address)

                                    <div>
                                        📍 {{ $client->address }}
                                    </div>

                                @endif

                            </div>

                        </a>

                    @empty

                        <div class="p-8 text-center">

                            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-[var(--forest-panel)]">
                                👤
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

            <div class="forest-card overflow-hidden rounded-2xl border shadow-sm">

                <div class="border-b border-[var(--forest-border)] p-6">

                    <div class="flex items-center gap-3">

                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[var(--forest-accent-soft)] text-xl">
                            🏢
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
                                class="rounded-xl bg-[var(--forest-accent)] px-4 py-3 text-xs font-semibold text-white transition hover:bg-green-700"
                            >
                                Rechercher
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
                            class="block p-5 transition hover:bg-[var(--forest-accent-soft)]"
                        >

                            <div class="flex items-start justify-between gap-4">

                                <div class="flex items-center gap-3">

                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[var(--forest-accent-soft)] font-bold text-[var(--forest-accent)]">
                                        {{ strtoupper(substr($supplier->name, 0, 1)) }}
                                    </div>

                                    <div>

                                        <p class="text-sm font-bold text-[var(--forest-text)]">
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

                                    <div>
                                        📞 {{ $supplier->phone }}
                                    </div>

                                @endif


                                @if ($supplier->address)

                                    <div>
                                        📍 {{ $supplier->address }}
                                    </div>

                                @endif

                            </div>

                        </a>

                    @empty

                        <div class="p-8 text-center">

                            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-[var(--forest-panel)]">
                                🏢
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

            <div class="forest-card overflow-hidden rounded-2xl border shadow-sm">

                <div class="border-b border-[var(--forest-border)] bg-[var(--forest-accent-soft)] p-6">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-xs font-semibold uppercase tracking-wider text-[var(--forest-accent)]">
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
                            class="rounded-lg bg-[var(--forest-surface)] px-3 py-2 text-xs font-semibold text-[var(--forest-muted)] shadow-sm ring-1 ring-[var(--forest-border)] transition hover:bg-[var(--forest-panel)]"
                        >
                            Fermer
                        </a>

                    </div>

                </div>


                @if ($clientInvoices->count())

                    <div class="overflow-x-auto">

                        <table class="w-full text-left text-sm">

                            <thead class="border-b border-[var(--forest-border)] bg-[var(--forest-panel)]">

                                <tr>

                                    <th class="px-6 py-4 text-xs font-semibold text-[var(--forest-muted)]">
                                        N° Facture
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


                            <tbody class="divide-y divide-[var(--forest-border)]">

                                @foreach ($clientInvoices as $invoice)

                                    <tr class="transition hover:bg-[var(--forest-panel)]">

                                        <td class="px-6 py-4 font-semibold text-[var(--forest-text)]">
                                            {{ $invoice->invoice_number }}
                                        </td>

                                        <td class="px-6 py-4 text-[var(--forest-muted)]">
                                            {{ $invoice->invoice_date }}
                                        </td>

                                        <td class="px-6 py-4 font-semibold text-[var(--forest-text)]">
                                            {{ number_format($invoice->amount, 2, ',', ' ') }} DH
                                        </td>

                                        <td class="px-6 py-4">

                                            <span class="rounded-full bg-[var(--forest-panel)] px-3 py-1 text-xs font-semibold text-[var(--forest-muted)]">
                                                {{ $invoice->status }}
                                            </span>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @else

                    <div class="p-10 text-center">

                        <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-[var(--forest-panel)]">
                            🧾
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

            <div class="forest-card overflow-hidden rounded-2xl border shadow-sm">

                <div class="border-b border-[var(--forest-border)] bg-[var(--forest-accent-soft)] p-6">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-xs font-semibold uppercase tracking-wider text-[var(--forest-accent)]">
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
                            class="rounded-lg bg-[var(--forest-surface)] px-3 py-2 text-xs font-semibold text-[var(--forest-muted)] shadow-sm ring-1 ring-[var(--forest-border)] transition hover:bg-[var(--forest-panel)]"
                        >
                            Fermer
                        </a>

                    </div>

                </div>


                @if ($supplierPurchases->count())

                    <div class="overflow-x-auto">

                        <table class="w-full text-left text-sm">

                            <thead class="border-b border-[var(--forest-border)] bg-[var(--forest-panel)]">

                                <tr>

                                    <th class="px-6 py-4 text-xs font-semibold text-[var(--forest-muted)]">
                                        Référence
                                    </th>

                                    <th class="px-6 py-4 text-xs font-semibold text-[var(--forest-muted)]">
                                        Date
                                    </th>

                                    <th class="px-6 py-4 text-xs font-semibold text-[var(--forest-muted)]">
                                        Produit
                                    </th>

                                    <th class="px-6 py-4 text-xs font-semibold text-[var(--forest-muted)]">
                                        Quantité
                                    </th>

                                    <th class="px-6 py-4 text-xs font-semibold text-[var(--forest-muted)]">
                                        Prix d'achat
                                    </th>

                                </tr>

                            </thead>


                            <tbody class="divide-y divide-[var(--forest-border)]">

                                @foreach ($supplierPurchases as $purchase)

                                    <tr class="transition hover:bg-[var(--forest-panel)]">

                                        <td class="px-6 py-4 font-semibold text-[var(--forest-text)]">
                                            {{ $purchase->reference }}
                                        </td>

                                        <td class="px-6 py-4 text-[var(--forest-muted)]">
                                            {{ $purchase->entry_date }}
                                        </td>

                                        <td class="px-6 py-4">

                                            <p class="font-semibold text-[var(--forest-text)]">
                                                {{ $purchase->product_name ?? 'Produit inconnu' }}
                                            </p>

                                            @if ($purchase->product_reference)

                                                <p class="text-xs text-[var(--forest-muted)]">
                                                    Réf. {{ $purchase->product_reference }}
                                                </p>

                                            @endif

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

                    <div class="p-10 text-center">

                        <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-[var(--forest-panel)]">
                            📦
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

            <div class="rounded-2xl border border-dashed border-[var(--forest-border)] bg-[var(--forest-surface)] p-10 text-center">

                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-[var(--forest-panel)] text-xl">
                    📋
                </div>

                <p class="mt-3 text-sm font-semibold text-[var(--forest-muted)]">
                    Sélectionnez un client ou un fournisseur
                </p>

                <p class="mt-1 text-xs text-[var(--forest-muted)]">
                    Cliquez sur un élément dans les listes ci-dessus pour afficher son historique.
                </p>

            </div>

        @endif

    </div>

</x-layouts.dashboard>