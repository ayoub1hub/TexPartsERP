<x-layouts.dashboard>
    
    <div class="space-y-8">

        <!-- HEADER -->
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-[var(--forest-sidebar)] to-[var(--forest-accent)] p-8 shadow-lg">
            <div class="absolute right-0 top-0 h-32 w-32 translate-x-8 -translate-y-8 rounded-full bg-white/10 blur-2xl"></div>
            <div class="absolute bottom-0 right-20 h-24 w-24 translate-x-4 translate-y-4 rounded-full bg-white/10 blur-xl"></div>
            <div class="relative z-10">
                <p class="text-sm font-medium text-white/80">
                    Vue générale
                </p>
                <h1 class="mt-1 text-3xl font-black text-white">
                    Bonjour, {{ Auth::user()->name ?? 'Admin' }} 👋
                </h1>
                <p class="mt-2 text-sm text-white/70">
                    Voici un aperçu de l'activité de Texparts.
                </p>
            </div>
        </div>


        <!-- STATISTIQUES -->
        <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-4">

            <!-- CA -->
            <div class="group forest-card relative overflow-hidden rounded-2xl border bg-[var(--forest-surface)] p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
                <div class="absolute right-0 top-0 h-20 w-20 translate-x-8 -translate-y-8 rounded-full bg-[var(--forest-accent)] opacity-10 blur-2xl transition-opacity group-hover:opacity-20"></div>
                <div class="relative">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-[var(--forest-muted)]">
                                Chiffre d'affaires
                            </p>
                            <p class="mt-2 text-2xl font-black text-[var(--forest-text)]">
                                {{ number_format($totalRevenue, 2, ',', ' ') }} DH
                            </p>
                            <div class="mt-2 flex items-center gap-1">
                                <span class="flex h-5 w-5 items-center justify-center rounded-full bg-emerald-100 text-emerald-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                                    </svg>
                                </span>
                                <p class="text-xs text-emerald-600 font-medium">
                                    Total des ventes
                                </p>
                            </div>
                        </div>
                        <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-[var(--forest-accent)] to-green-600 text-white shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>


            <!-- VENTES -->
            <div class="group forest-card relative overflow-hidden rounded-2xl border bg-[var(--forest-surface)] p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
                <div class="absolute right-0 top-0 h-20 w-20 translate-x-8 -translate-y-8 rounded-full bg-blue-500 opacity-10 blur-2xl transition-opacity group-hover:opacity-20"></div>
                <div class="relative">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-[var(--forest-muted)]">
                                Ventes
                            </p>
                            <p class="mt-2 text-2xl font-black text-[var(--forest-text)]">
                                {{ $invoicesCount }}
                            </p>
                            <div class="mt-2 flex items-center gap-1">
                                <span class="flex h-5 w-5 items-center justify-center rounded-full bg-blue-100 text-blue-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                                    </svg>
                                </span>
                                <p class="text-xs text-blue-600 font-medium">
                                    Factures émises
                                </p>
                            </div>
                        </div>
                        <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-500 to-blue-700 text-white shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>


            <!-- CLIENTS -->
            <div class="group forest-card relative overflow-hidden rounded-2xl border bg-[var(--forest-surface)] p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
                <div class="absolute right-0 top-0 h-20 w-20 translate-x-8 -translate-y-8 rounded-full bg-purple-500 opacity-10 blur-2xl transition-opacity group-hover:opacity-20"></div>
                <div class="relative">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-[var(--forest-muted)]">
                                Clients
                            </p>
                            <p class="mt-2 text-2xl font-black text-[var(--forest-text)]">
                                {{ $clientsCount }}
                            </p>
                            <div class="mt-2 flex items-center gap-1">
                                <span class="flex h-5 w-5 items-center justify-center rounded-full bg-purple-100 text-purple-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                                    </svg>
                                </span>
                                <p class="text-xs text-purple-600 font-medium">
                                    Actifs
                                </p>
                            </div>
                        </div>
                        <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-purple-500 to-purple-700 text-white shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>


            <!-- ALERTES -->
            <div class="group forest-card relative overflow-hidden rounded-2xl border bg-[var(--forest-surface)] p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
                <div class="absolute right-0 top-0 h-20 w-20 translate-x-8 -translate-y-8 rounded-full bg-orange-500 opacity-10 blur-2xl transition-opacity group-hover:opacity-20"></div>
                <div class="relative">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-[var(--forest-muted)]">
                                Alertes stock
                            </p>
                            <p class="mt-2 text-2xl font-black text-[var(--forest-text)]">
                                {{ $stockAlerts }}
                            </p>
                            <div class="mt-2 flex items-center gap-1">
                                @if($stockAlerts > 0)
                                    <span class="flex h-5 w-5 items-center justify-center rounded-full bg-orange-100 text-orange-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                                        </svg>
                                    </span>
                                    <p class="text-xs text-orange-600 font-medium">
                                        Attention requise
                                    </p>
                                @else
                                    <span class="flex h-5 w-5 items-center justify-center rounded-full bg-emerald-100 text-emerald-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </span>
                                    <p class="text-xs text-emerald-600 font-medium">
                                        Tout est OK
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-orange-500 to-red-600 text-white shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <!-- GRAPHIQUE + ACTIONS -->
        <div class="grid gap-6 xl:grid-cols-3">

            <!-- GRAPHIQUE -->
            <div class="forest-card relative overflow-hidden rounded-2xl border bg-[var(--forest-surface)] p-6 shadow-sm xl:col-span-2">
                <div class="absolute right-0 top-0 h-32 w-32 translate-x-8 -translate-y-8 rounded-full bg-[var(--forest-accent)] opacity-5 blur-3xl"></div>
                <div class="relative">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-lg font-bold text-[var(--forest-text)]">
                                Évolution des ventes
                            </h2>
                            <p class="mt-1 text-xs text-[var(--forest-muted)]">
                                Évolution du chiffre d'affaires
                            </p>
                        </div>
                        <select class="rounded-lg border border-[var(--forest-border)] bg-[var(--forest-panel)] px-3 py-2 text-xs text-[var(--forest-text)] transition focus:border-[var(--forest-accent)] focus:outline-none focus:ring-2 focus:ring-[var(--forest-accent-soft)]">
                            <option>7 derniers jours</option>
                            <option>30 derniers jours</option>
                            <option>Cette année</option>
                        </select>
                    </div>
                    <div class="mt-6 flex h-64 items-center justify-center rounded-xl border border-dashed border-[var(--forest-border)] bg-[var(--forest-panel)]">
                        <div class="text-center">
                            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-[var(--forest-surface)] text-[var(--forest-accent)] shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                                </svg>
                            </div>
                            <p class="mt-3 text-sm font-semibold text-[var(--forest-text)]">
                                Aucune donnée de vente
                            </p>
                            <p class="mt-1 text-xs text-[var(--forest-muted)]">
                                Le graphique sera alimenté avec les données réelles.
                            </p>
                        </div>
                    </div>
                </div>
            </div>


            <!-- ACTIONS RAPIDES -->
            <div class="forest-card relative overflow-hidden rounded-2xl border bg-[var(--forest-surface)] p-6 shadow-sm">
                <div class="absolute right-0 top-0 h-24 w-24 translate-x-8 -translate-y-8 rounded-full bg-[var(--forest-accent)] opacity-5 blur-3xl"></div>
                <div class="relative">
                    <h2 class="text-lg font-bold text-[var(--forest-text)]">
                        Actions rapides
                    </h2>
                    <p class="mt-1 text-xs text-[var(--forest-muted)]">
                        Accès rapide aux fonctionnalités
                    </p>
                    <div class="mt-5 space-y-3">
                        <a href="/clients-fournisseurs"
                           class="group flex items-center gap-3 rounded-xl border border-[var(--forest-border)] bg-[var(--forest-surface)] p-4 transition-all duration-200 hover:border-[var(--forest-accent)] hover:bg-[var(--forest-accent-soft)] hover:shadow-md">
                            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-purple-500 to-purple-700 text-white shadow-lg transition-transform group-hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-[var(--forest-text)] group-hover:text-[var(--forest-accent)] transition-colors">
                                    Gérer les clients
                                </p>
                                <p class="text-[11px] text-[var(--forest-muted)]">
                                    Clients & fournisseurs
                                </p>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[var(--forest-muted)] transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>
                        </a>
                        <a href="/stock"
                           class="group flex items-center gap-3 rounded-xl border border-[var(--forest-border)] bg-[var(--forest-surface)] p-4 transition-all duration-200 hover:border-[var(--forest-accent)] hover:bg-[var(--forest-accent-soft)] hover:shadow-md">
                            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-blue-500 to-blue-700 text-white shadow-lg transition-transform group-hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-[var(--forest-text)] group-hover:text-[var(--forest-accent)] transition-colors">
                                    Consulter le stock
                                </p>
                                <p class="text-[11px] text-[var(--forest-muted)]">
                                    Produits disponibles
                                </p>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[var(--forest-muted)] transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>
                        </a>
                        <a href="/factures"
                           class="group flex items-center gap-3 rounded-xl border border-[var(--forest-border)] bg-[var(--forest-surface)] p-4 transition-all duration-200 hover:border-[var(--forest-accent)] hover:bg-[var(--forest-accent-soft)] hover:shadow-md">
                            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-[var(--forest-accent)] to-green-600 text-white shadow-lg transition-transform group-hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-[var(--forest-text)] group-hover:text-[var(--forest-accent)] transition-colors">
                                    Créer une facture
                                </p>
                                <p class="text-[11px] text-[var(--forest-muted)]">
                                    Nouvelle facture
                                </p>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[var(--forest-muted)] transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

        </div>


        <!-- DERNIÈRES FACTURES -->
        <div class="forest-card relative overflow-hidden rounded-2xl border border-[var(--forest-border)] bg-[var(--forest-surface)] shadow-sm">
            <div class="absolute right-0 top-0 h-24 w-24 translate-x-8 -translate-y-8 rounded-full bg-[var(--forest-accent)] opacity-5 blur-3xl"></div>
            <div class="relative">
                <div class="flex items-center justify-between p-6">
                    <div>
                        <h2 class="text-lg font-bold text-[var(--forest-text)]">
                            Dernières factures
                        </h2>
                        <p class="mt-1 text-xs text-[var(--forest-muted)]">
                            Les dernières factures enregistrées
                        </p>
                    </div>
                    <a href="/factures"
                       class="group flex items-center gap-1 text-xs font-semibold text-[var(--forest-accent)] hover:text-[var(--forest-text)] transition-colors">
                        Voir tout
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="border-y border-[var(--forest-border)] bg-[var(--forest-panel)]">
                            <tr>
                                <th class="px-6 py-4 text-xs font-semibold text-[var(--forest-muted)] uppercase tracking-wider">
                                    N° Facture
                                </th>
                                <th class="px-6 py-4 text-xs font-semibold text-[var(--forest-muted)] uppercase tracking-wider">
                                    Client
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
                        <tbody>
                            @forelse($latestInvoices as $invoice)
                                <tr class="border-b border-[var(--forest-border)] transition hover:bg-[var(--forest-panel)]">
                                    <td class="px-6 py-4 font-medium text-[var(--forest-text)]">
                                        <span class="inline-flex items-center gap-2">
                                            <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-[var(--forest-accent-soft)] text-[var(--forest-accent)] text-xs font-bold">
                                                {{ substr($invoice->invoice_number, -3) }}
                                            </span>
                                            {{ $invoice->invoice_number }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-[var(--forest-muted)]">
                                        <div class="flex items-center gap-2">
                                            <div class="flex h-8 w-8 items-center justify-center rounded-full bg-purple-100 text-purple-600 text-xs font-bold">
                                                {{ substr($invoice->client_name ?? 'SC', 0, 2) }}
                                            </div>
                                            <span>{{ $invoice->client_name ?? 'Sans client' }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-[var(--forest-muted)]">
                                        {{ $invoice->invoice_date ? date('d/m/Y', strtotime($invoice->invoice_date)) : '-' }}
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
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-16 text-center">
                                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-[var(--forest-panel)] text-[var(--forest-muted)]">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                            </svg>
                                        </div>
                                        <p class="mt-3 text-sm font-semibold text-[var(--forest-muted)]">
                                            Aucune facture pour le moment
                                        </p>
                                        <p class="mt-1 text-xs text-[var(--forest-muted)]">
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

    </div>

</x-layouts.dashboard>