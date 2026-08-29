<x-layouts.dashboard>

    <div class="space-y-8">

        {{-- HEADER --}}
        <div>
            <p class="text-sm font-medium text-cyan-600">
                Gestion
            </p>

            <h1 class="mt-1 text-3xl font-black text-slate-900">
                Clients & Fournisseurs
            </h1>

            <p class="mt-2 text-sm text-slate-500">
                Consultez vos clients, fournisseurs et leurs historiques.
            </p>
        </div>


        {{-- ========================================================= --}}
        {{-- CLIENTS + FOURNISSEURS --}}
        {{-- ========================================================= --}}

        <div class="grid gap-6 xl:grid-cols-2">


            {{-- ======================= CLIENTS ======================= --}}

            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-200 p-6">

                    <div class="flex items-center gap-3">

                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-cyan-50 text-xl">
                            👥
                        </div>

                        <div>

                            <h2 class="text-lg font-bold text-slate-900">
                                Clients
                            </h2>

                            <p class="text-xs text-slate-400">
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
                                class="flex-1 rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-cyan-400 focus:bg-white focus:ring-2 focus:ring-cyan-100"
                            >

                            <button
                                type="submit"
                                class="rounded-xl bg-cyan-600 px-4 py-3 text-xs font-semibold text-white transition hover:bg-cyan-700"
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
                            class="block p-5 transition hover:bg-cyan-50/50"
                        >

                            <div class="flex items-start justify-between gap-4">

                                <div class="flex items-center gap-3">

                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-cyan-50 font-bold text-cyan-600">
                                        {{ strtoupper(substr($client->name, 0, 1)) }}
                                    </div>

                                    <div>

                                        <p class="text-sm font-bold text-slate-800">
                                            {{ $client->name }}
                                        </p>

                                        @if ($client->email)

                                            <p class="mt-1 text-xs text-slate-400">
                                                {{ $client->email }}
                                            </p>

                                        @endif

                                    </div>

                                </div>


                                <span class="rounded-lg bg-slate-100 px-2 py-1 text-[10px] font-semibold text-slate-500">
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

                            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-slate-50">
                                👤
                            </div>

                            <p class="mt-3 text-sm font-semibold text-slate-600">
                                Aucun client trouvé
                            </p>

                            <p class="mt-1 text-xs text-slate-400">
                                Aucun client ne correspond à votre recherche.
                            </p>

                        </div>

                    @endforelse

                </div>

            </div>



            {{-- ==================== FOURNISSEURS ==================== --}}

            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-200 p-6">

                    <div class="flex items-center gap-3">

                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-violet-50 text-xl">
                            🏢
                        </div>

                        <div>

                            <h2 class="text-lg font-bold text-slate-900">
                                Fournisseurs
                            </h2>

                            <p class="text-xs text-slate-400">
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
                                class="flex-1 rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-violet-400 focus:bg-white focus:ring-2 focus:ring-violet-100"
                            >

                            <button
                                type="submit"
                                class="rounded-xl bg-violet-600 px-4 py-3 text-xs font-semibold text-white transition hover:bg-violet-700"
                            >
                                Rechercher
                            </button>

                        </div>

                    </form>

                </div>


                {{-- LISTE FOURNISSEURS --}}

                <div class="divide-y divide-slate-100">

                    @forelse ($suppliers as $supplier)

                        <a
                            href="{{ route('clients-fournisseurs', [
                                'supplier_id' => $supplier->id
                            ]) }}"
                            class="block p-5 transition hover:bg-violet-50/50"
                        >

                            <div class="flex items-start justify-between gap-4">

                                <div class="flex items-center gap-3">

                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-violet-50 font-bold text-violet-600">
                                        {{ strtoupper(substr($supplier->name, 0, 1)) }}
                                    </div>

                                    <div>

                                        <p class="text-sm font-bold text-slate-800">
                                            {{ $supplier->name }}
                                        </p>

                                        @if ($supplier->email)

                                            <p class="mt-1 text-xs text-slate-400">
                                                {{ $supplier->email }}
                                            </p>

                                        @endif

                                    </div>

                                </div>


                                <span class="rounded-lg bg-slate-100 px-2 py-1 text-[10px] font-semibold text-slate-500">
                                    #{{ $supplier->id }}
                                </span>

                            </div>


                            <div class="mt-4 grid gap-2 text-xs text-slate-500 sm:grid-cols-2">

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

                            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-slate-50">
                                🏢
                            </div>

                            <p class="mt-3 text-sm font-semibold text-slate-600">
                                Aucun fournisseur trouvé
                            </p>

                            <p class="mt-1 text-xs text-slate-400">
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

            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-200 bg-cyan-50/50 p-6">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-xs font-semibold uppercase tracking-wider text-cyan-600">
                                Historique client
                            </p>

                            <h2 class="mt-1 text-xl font-bold text-slate-900">
                                {{ $selectedClient->name }}
                            </h2>

                            <p class="mt-1 text-xs text-slate-500">
                                Historique des factures associées à ce client.
                            </p>

                        </div>


                        <a
                            href="{{ route('clients-fournisseurs') }}"
                            class="rounded-lg bg-white px-3 py-2 text-xs font-semibold text-slate-600 shadow-sm ring-1 ring-slate-200 transition hover:bg-slate-50"
                        >
                            Fermer
                        </a>

                    </div>

                </div>


                @if ($clientInvoices->count())

                    <div class="overflow-x-auto">

                        <table class="w-full text-left text-sm">

                            <thead class="border-b border-slate-200 bg-slate-50">

                                <tr>

                                    <th class="px-6 py-4 text-xs font-semibold text-slate-500">
                                        N° Facture
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


                            <tbody class="divide-y divide-slate-100">

                                @foreach ($clientInvoices as $invoice)

                                    <tr class="transition hover:bg-slate-50">

                                        <td class="px-6 py-4 font-semibold text-slate-800">
                                            {{ $invoice->invoice_number }}
                                        </td>

                                        <td class="px-6 py-4 text-slate-500">
                                            {{ $invoice->invoice_date }}
                                        </td>

                                        <td class="px-6 py-4 font-semibold text-slate-800">
                                            {{ number_format($invoice->amount, 2, ',', ' ') }} DH
                                        </td>

                                        <td class="px-6 py-4">

                                            <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">
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

                        <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-slate-50">
                            🧾
                        </div>

                        <p class="mt-3 text-sm font-semibold text-slate-600">
                            Aucune facture
                        </p>

                        <p class="mt-1 text-xs text-slate-400">
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

            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-200 bg-violet-50/50 p-6">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-xs font-semibold uppercase tracking-wider text-violet-600">
                                Historique fournisseur
                            </p>

                            <h2 class="mt-1 text-xl font-bold text-slate-900">
                                {{ $selectedSupplier->name }}
                            </h2>

                            <p class="mt-1 text-xs text-slate-500">
                                Historique de nos achats auprès de ce fournisseur.
                            </p>

                        </div>


                        <a
                            href="{{ route('clients-fournisseurs') }}"
                            class="rounded-lg bg-white px-3 py-2 text-xs font-semibold text-slate-600 shadow-sm ring-1 ring-slate-200 transition hover:bg-slate-50"
                        >
                            Fermer
                        </a>

                    </div>

                </div>


                @if ($supplierPurchases->count())

                    <div class="overflow-x-auto">

                        <table class="w-full text-left text-sm">

                            <thead class="border-b border-slate-200 bg-slate-50">

                                <tr>

                                    <th class="px-6 py-4 text-xs font-semibold text-slate-500">
                                        Référence
                                    </th>

                                    <th class="px-6 py-4 text-xs font-semibold text-slate-500">
                                        Date
                                    </th>

                                    <th class="px-6 py-4 text-xs font-semibold text-slate-500">
                                        Produit
                                    </th>

                                    <th class="px-6 py-4 text-xs font-semibold text-slate-500">
                                        Quantité
                                    </th>

                                    <th class="px-6 py-4 text-xs font-semibold text-slate-500">
                                        Prix d'achat
                                    </th>

                                </tr>

                            </thead>


                            <tbody class="divide-y divide-slate-100">

                                @foreach ($supplierPurchases as $purchase)

                                    <tr class="transition hover:bg-slate-50">

                                        <td class="px-6 py-4 font-semibold text-slate-800">
                                            {{ $purchase->reference }}
                                        </td>

                                        <td class="px-6 py-4 text-slate-500">
                                            {{ $purchase->entry_date }}
                                        </td>

                                        <td class="px-6 py-4">

                                            <p class="font-semibold text-slate-800">
                                                {{ $purchase->product_name ?? 'Produit inconnu' }}
                                            </p>

                                            @if ($purchase->product_reference)

                                                <p class="text-xs text-slate-400">
                                                    Réf. {{ $purchase->product_reference }}
                                                </p>

                                            @endif

                                        </td>

                                        <td class="px-6 py-4 font-semibold text-slate-800">
                                            {{ $purchase->quantity }}
                                        </td>

                                        <td class="px-6 py-4 font-semibold text-slate-800">
                                            {{ number_format($purchase->purchase_price, 2, ',', ' ') }} DH
                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @else

                    <div class="p-10 text-center">

                        <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-slate-50">
                            📦
                        </div>

                        <p class="mt-3 text-sm font-semibold text-slate-600">
                            Aucun achat
                        </p>

                        <p class="mt-1 text-xs text-slate-400">
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

            <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-10 text-center">

                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-slate-50 text-xl">
                    📋
                </div>

                <p class="mt-3 text-sm font-semibold text-slate-600">
                    Sélectionnez un client ou un fournisseur
                </p>

                <p class="mt-1 text-xs text-slate-400">
                    Cliquez sur un élément dans les listes ci-dessus pour afficher son historique.
                </p>

            </div>

        @endif

    </div>

</x-layouts.dashboard>