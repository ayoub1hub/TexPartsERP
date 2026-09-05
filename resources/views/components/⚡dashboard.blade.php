<x-layouts.dashboard>
    
    <div class="space-y-8">

        <!-- HEADER -->
        <div>
            <p class="text-sm font-medium text-[var(--forest-accent)]">
                Vue générale
            </p>

            <h1 class="mt-1 text-3xl font-black text-[var(--forest-text)]">
                Bonjour, {{ Auth::user()->name ?? 'Admin' }} 👋
            </h1>

            <p class="mt-2 text-sm forest-muted">
                Voici un aperçu de l'activité de Texparts.
            </p>
        </div>


        <!-- STATISTIQUES -->
        <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-4">

            <!-- CA -->
            <div class="forest-card rounded-2xl border p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-sm font-medium text-[var(--forest-muted)]">
                            Chiffre d'affaires
                        </p>

                        <p class="mt-2 text-2xl font-black text-[var(--forest-text)]">
                            {{ number_format($totalRevenue, 2, ',', ' ') }} DH
                        </p>

                        <p class="mt-2 text-xs text-[var(--forest-accent)]">
                            Total des factures enregistrées
                        </p>
                    </div>

                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-[var(--forest-accent-soft)] text-[var(--forest-accent)]">
                        💰
                    </div>

                </div>
            </div>


            <!-- VENTES -->
            <div class="forest-card rounded-2xl border p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-sm font-medium text-[var(--forest-muted)]">
                            Ventes
                        </p>

                        <p class="mt-2 text-2xl font-black text-[var(--forest-text)]">
                            {{ $invoicesCount }}
                        </p>

                        <p class="mt-2 text-xs text-[var(--forest-muted)]">
                            Ce mois
                        </p>
                    </div>

                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-[var(--forest-accent-soft)] text-[var(--forest-accent)]">
                        📈
                    </div>

                </div>
            </div>


            <!-- CLIENTS -->
            <div class="forest-card rounded-2xl border p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-sm font-medium text-[var(--forest-muted)]">
                            Clients
                        </p>

                        <p class="mt-2 text-2xl font-black text-[var(--forest-text)]">
                            {{ $clientsCount }}
                        </p>

                        <p class="mt-2 text-xs text-[var(--forest-muted)]">
                            Clients enregistrés
                        </p>
                    </div>

                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-[var(--forest-accent-soft)] text-[var(--forest-accent)]">
                        👥
                    </div>

                </div>
            </div>


            <!-- ALERTES -->
            <div class="forest-card rounded-2xl border p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-sm font-medium text-[var(--forest-muted)]">
                            Alertes stock
                        </p>

                        <p class="mt-2 text-2xl font-black text-[var(--forest-text)]">
                            {{ $stockAlerts }}
                        </p>

                        <p class="mt-2 text-xs text-[var(--forest-accent)]">
                            Stock faible ou rupture
                        </p>
                    </div>

                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-[var(--forest-accent-soft)] text-[var(--forest-accent)]">
                        🔔
                    </div>

                </div>
            </div>

        </div>


        <!-- GRAPHIQUE + ACTIONS -->
        <div class="grid gap-6 xl:grid-cols-3">

            <!-- GRAPHIQUE -->
            <div class="forest-card rounded-2xl border p-6 shadow-sm xl:col-span-2">

                <div class="flex items-center justify-between">

                    <div>

                        <h2 class="text-lg font-bold text-[var(--forest-text)]">
                            Évolution des ventes
                        </h2>

                        <p class="mt-1 text-xs text-[var(--forest-muted)]">
                            Évolution du chiffre d'affaires
                        </p>
                    </div>

                    <select class="rounded-lg border border-[var(--forest-border)] bg-[var(--forest-panel)] px-3 py-2 text-xs text-[var(--forest-text)]">
                        <option>7 derniers jours</option>
                        <option>30 derniers jours</option>
                        <option>Cette année</option>
                    </select>

                </div>


                <div class="mt-6 flex h-64 items-center justify-center rounded-xl border border-dashed border-[var(--forest-border)] bg-[var(--forest-panel)]">

                    <div class="text-center">

                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-[var(--forest-surface)] text-[var(--forest-accent)] shadow-sm">
                            📊
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


            <!-- ACTIONS RAPIDES -->
            <div class="forest-card rounded-2xl border p-6 shadow-sm">

                <h2 class="text-lg font-bold text-[var(--forest-text)]">
                    Actions rapides
                </h2>

                <p class="mt-1 text-xs text-[var(--forest-muted)]">
                    Accès rapide aux fonctionnalités
                </p>


                <div class="mt-5 space-y-3">

                    <a href="/clients-fournisseurs"
                       class="flex items-center gap-3 rounded-xl border border-[var(--forest-border)] bg-[var(--forest-surface)] p-3 transition hover:border-[var(--forest-accent)] hover:bg-[var(--forest-accent-soft)]">

                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-[var(--forest-accent-soft)] text-[var(--forest-accent)]">
                            👥
                        </div>

                        <div>
                            <p class="text-sm font-semibold text-[var(--forest-text)]">
                                Gérer les clients
                            </p>

                            <p class="text-[11px] text-[var(--forest-muted)]">
                                Clients & fournisseurs
                            </p>
                        </div>

                    </a>


                    <a href="/stock"
                       class="flex items-center gap-3 rounded-xl border border-[var(--forest-border)] bg-[var(--forest-surface)] p-3 transition hover:border-[var(--forest-accent)] hover:bg-[var(--forest-accent-soft)]">

                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-[var(--forest-accent-soft)] text-[var(--forest-accent)]">
                            📦
                        </div>

                        <div>
                            <p class="text-sm font-semibold text-[var(--forest-text)]">
                                Consulter le stock
                            </p>

                            <p class="text-[11px] text-[var(--forest-muted)]">
                                Produits disponibles
                            </p>
                        </div>

                    </a>


                    <a href="/factures"
                       class="flex items-center gap-3 rounded-xl border border-[var(--forest-border)] bg-[var(--forest-surface)] p-3 transition hover:border-[var(--forest-accent)] hover:bg-[var(--forest-accent-soft)]">

                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-[var(--forest-accent-soft)] text-[var(--forest-accent)]">
                            🧾
                        </div>

                        <div>
                            <p class="text-sm font-semibold text-[var(--forest-text)]">
                                Créer une facture
                            </p>

                            <p class="text-[11px] text-[var(--forest-muted)]">
                                Nouvelle facture
                            </p>

                    </a>

                </div>

            </div>

        </div>


        <!-- DERNIÈRES FACTURES -->
        <div class="overflow-hidden rounded-2xl border border-[var(--forest-border)] bg-[var(--forest-surface)] shadow-sm">

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
                   class="text-xs font-semibold text-[var(--forest-accent)] hover:text-[var(--forest-text)]">
                    Voir tout →
                </a>

            </div>


            <div class="overflow-x-auto">

                <table class="w-full text-left text-sm">

                    <thead class="border-y border-[var(--forest-border)] bg-[var(--forest-panel)]">

                        <tr>

                            <th class="px-6 py-4 text-xs font-semibold text-[var(--forest-muted)]">
                                N° Facture
                            </th>

                            <th class="px-6 py-4 text-xs font-semibold text-[var(--forest-muted)]">
                                Client
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

                    <tbody>
                        @forelse($latestInvoices as $invoice)
                            <tr class="border-b border-[var(--forest-border)]">
                                <td class="px-6 py-4 font-medium text-[var(--forest-text)]">
                                    {{ $invoice->invoice_number }}
                                </td>
                                <td class="px-6 py-4 text-[var(--forest-muted)]">
                                    {{ $invoice->client_name ?? 'Sans client' }}
                                </td>
                                <td class="px-6 py-4 text-[var(--forest-muted)]">
                                    {{ $invoice->invoice_date ? date('d/m/Y', strtotime($invoice->invoice_date)) : '-' }}
                                </td>
                                <td class="px-6 py-4 text-[var(--forest-muted)]">
                                    {{ number_format($invoice->amount, 2, ',', ' ') }} DH
                                </td>
                                <td class="px-6 py-4 text-[var(--forest-muted)]">
                                    {{ ucfirst($invoice->status) }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center">
                                    <p class="text-sm font-medium text-[var(--forest-muted)]">
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

</x-layouts.dashboard>