<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Texpart ERP</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>

<body class="min-h-screen bg-slate-100 text-slate-900">

    <div class="flex min-h-screen">

        {{-- ================= SIDEBAR ================= --}}

        <aside class="fixed inset-y-0 left-0 z-50 flex w-64 flex-col bg-slate-950 text-white shadow-2xl">

            {{-- LOGO --}}

            <div class="flex h-20 items-center border-b border-white/10 px-6">

                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-cyan-500 to-blue-700 text-lg font-black shadow-lg">
                    T
                </div>

                <div class="ml-3">
                    <h1 class="text-lg font-black tracking-[0.18em]">
                        TEXPART
                    </h1>

                    <p class="text-[10px] uppercase tracking-wider text-slate-400">
                        Enterprise Management
                    </p>
                </div>

            </div>


            {{-- NAVIGATION --}}

            <nav class="flex-1 space-y-2 overflow-y-auto px-4 py-6">

                {{-- ACCUEIL --}}

                <a
                    href="/dashboard"
                    class="flex items-center gap-3 rounded-xl bg-cyan-600/20 px-4 py-3 text-sm font-semibold text-cyan-400 transition hover:bg-cyan-600/30"
                >
                    <span class="text-lg">🏠</span>
                    <span>Accueil</span>
                </a>


                {{-- CLIENTS / FOURNISSEURS --}}

                <a
                    href="/clients-fournisseurs"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-300 transition hover:bg-white/5 hover:text-white"
                >
                    <span class="text-lg">👥</span>
                    <span>Clients & Fournisseurs</span>
                </a>


                {{-- STOCK --}}

                <a
                    href="/stock"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-300 transition hover:bg-white/5 hover:text-white"
                >
                    <span class="text-lg">📦</span>
                    <span>Stock</span>
                </a>


                {{-- FACTURES --}}

                <a
                    href="/factures"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-300 transition hover:bg-white/5 hover:text-white"
                >
                    <span class="text-lg">🧾</span>
                    <span>Factures</span>
                </a>


                {{-- ALERTES --}}

                <a
                    href="/alertes"
                    class="flex items-center justify-between rounded-xl px-4 py-3 text-sm font-medium text-slate-300 transition hover:bg-white/5 hover:text-white"
                >

                    <div class="flex items-center gap-3">
                        <span class="text-lg">🔔</span>
                        <span>Alertes</span>
                    </div>

                    <span class="flex h-5 min-w-5 items-center justify-center rounded-full bg-red-500 px-1.5 text-[10px] font-bold text-white">
                        0
                    </span>

                </a>

            </nav>


            {{-- BOTTOM SIDEBAR --}}

            <div class="border-t border-white/10 p-4">

                <div class="flex items-center gap-3 rounded-xl bg-white/5 p-3">

                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-cyan-500 to-blue-700 text-sm font-bold">
                        A
                    </div>

                    <div class="min-w-0">

                        <p class="truncate text-sm font-semibold">
                            Admin Texpart
                        </p>

                        <p class="truncate text-[10px] text-slate-400">
                            Administrateur
                        </p>

                    </div>

                </div>

            </div>

        </aside>


        {{-- ================= CONTENU PRINCIPAL ================= --}}

        <div class="ml-64 flex min-h-screen flex-1 flex-col">


            {{-- NAVBAR --}}

            <header class="sticky top-0 z-40 flex h-20 items-center justify-between border-b border-slate-200 bg-white/95 px-8 shadow-sm backdrop-blur">

                <div>

                    <p class="text-xs font-medium uppercase tracking-wider text-slate-400">
                        TEXPART ERP
                    </p>

                    <h2 class="text-xl font-bold text-slate-900">
                        Accueil
                    </h2>

                </div>


                <div class="flex items-center gap-5">

                    {{-- NOTIFICATIONS --}}

                    <a
                        href="/alertes"
                        class="relative flex h-10 w-10 items-center justify-center rounded-xl text-slate-500 transition hover:bg-slate-100 hover:text-slate-900"
                    >
                        🔔

                        <span class="absolute right-1 top-1 h-2 w-2 rounded-full bg-red-500"></span>
                    </a>


                    {{-- USER --}}

                    <div class="flex items-center gap-3">

                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-gradient-to-br from-cyan-500 to-blue-700 text-sm font-bold text-white">
                            A
                        </div>

                        <div class="hidden sm:block">

                            <p class="text-sm font-semibold text-slate-800">
                                Admin Texpart
                            </p>

                            <p class="text-[11px] text-slate-400">
                                Administrateur
                            </p>

                        </div>

                    </div>

                </div>

            </header>


            {{-- ================= PAGE ================= --}}

            <main class="flex-1 p-8">

                {{ $slot }}

            </main>


            {{-- FOOTER --}}

            <footer class="border-t border-slate-200 bg-white px-8 py-4">

                <p class="text-center text-xs text-slate-400">
                    © {{ date('Y') }} Texpart — Tous droits réservés.
                </p>

            </footer>

        </div>

    </div>


    @livewireScripts

</body>

</html>