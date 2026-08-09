<x-layouts.dashboard>
    
    <div class="space-y-8">

        <!-- HEADER -->
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


        <!-- STATISTIQUES -->
        <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-4">

            <!-- CA -->
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Chiffre d'affaires
                        </p>

                        <p class="mt-2 text-2xl font-black text-slate-900">
                            0 DH
                        </p>

                        <p class="mt-2 text-xs text-emerald-600">
                            ↑ 0% ce mois
                        </p>
                    </div>

                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-cyan-50 text-cyan-600">
                        💰
                    </div>

                </div>
            </div>


            <!-- VENTES -->
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Ventes
                        </p>

                        <p class="mt-2 text-2xl font-black text-slate-900">
                            0
                        </p>

                        <p class="mt-2 text-xs text-slate-400">
                            Ce mois
                        </p>
                    </div>

                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                        📈
                    </div>

                </div>
            </div>


            <!-- CLIENTS -->
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Clients
                        </p>

                        <p class="mt-2 text-2xl font-black text-slate-900">
                            0
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


            <!-- ALERTES -->
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Alertes stock
                        </p>

                        <p class="mt-2 text-2xl font-black text-slate-900">
                            0
                        </p>

                        <p class="mt-2 text-xs text-orange-500">
                            Stock faible ou rupture
                        </p>
                    </div>

                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-orange-50 text-orange-500">
                        🔔
                    </div>

                </div>
            </div>

        </div>


        <!-- GRAPHIQUE + ACTIONS -->
        <div class="grid gap-6 xl:grid-cols-3">

            <!-- GRAPHIQUE -->
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm xl:col-span-2">

                <div class="flex items-center justify-between">

                    <div>
                        <h2 class="text-lg font-bold text-slate-900">
                            Évolution des ventes
                        </h2>

                        <p class="mt-1 text-xs text-slate-400">
                            Évolution du chiffre d'affaires
                        </p>
                    </div>

                    <select class="rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 text-xs text-slate-600">
                        <option>7 derniers jours</option>
                        <option>30 derniers jours</option>
                        <option>Cette année</option>
                    </select>

                </div>


                <div class="mt-6 flex h-64 items-center justify-center rounded-xl border border-dashed border-slate-200 bg-slate-50">

                    <div class="text-center">

                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-white text-cyan-500 shadow-sm">
                            📊
                        </div>

                        <p class="mt-3 text-sm font-semibold text-slate-600">
                            Aucune donnée de vente
                        </p>

                        <p class="mt-1 text-xs text-slate-400">
                            Le graphique sera alimenté avec les données réelles.
                        </p>

                    </div>

                </div>

            </div>


            <!-- ACTIONS RAPIDES -->
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                <h2 class="text-lg font-bold text-slate-900">
                    Actions rapides
                </h2>

                <p class="mt-1 text-xs text-slate-400">
                    Accès rapide aux fonctionnalités
                </p>


                <div class="mt-5 space-y-3">

                    <a href="/clients-fournisseurs"
                       class="flex items-center gap-3 rounded-xl border border-slate-200 p-3 transition hover:border-cyan-300 hover:bg-cyan-50">

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


                    <a href="/stock"
                       class="flex items-center gap-3 rounded-xl border border-slate-200 p-3 transition hover:border-blue-300 hover:bg-blue-50">

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


                    <a href="/factures"
                       class="flex items-center gap-3 rounded-xl border border-slate-200 p-3 transition hover:border-violet-300 hover:bg-violet-50">

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

                </div>

            </div>

        </div>


        <!-- DERNIÈRES FACTURES -->
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

                <a href="/factures"
                   class="text-xs font-semibold text-cyan-600 hover:text-cyan-700">
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

                        <tr>

                            <td colspan="5" class="px-6 py-10 text-center">

                                <p class="text-sm font-medium text-slate-500">
                                    Aucune facture pour le moment
                                </p>

                                <p class="mt-1 text-xs text-slate-400">
                                    Les nouvelles factures apparaîtront ici.
                                </p>

                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</x-layouts.dashboard>