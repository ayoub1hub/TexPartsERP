<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Connexion - Texpart</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-dvh overflow-y-auto">

    {{-- BACKGROUND --}}

    <div class="fixed inset-0">

        <div
            class="absolute inset-0 bg-cover bg-center"
            style="background-image: url('/images/texpart.jpg');"
        ></div>

        <div class="absolute inset-0 bg-slate-950/75"></div>

        <div class="absolute inset-0 bg-gradient-to-br from-slate-950/90 via-slate-900/50 to-cyan-950/80"></div>

        <div class="absolute -left-32 -top-32 h-80 w-80 rounded-full bg-cyan-500/20 blur-3xl"></div>

        <div class="absolute -bottom-32 -right-32 h-80 w-80 rounded-full bg-blue-600/20 blur-3xl"></div>

    </div>


    {{-- PAGE --}}

    <main class="relative z-10 flex min-h-dvh w-full items-start justify-center px-4 py-8 sm:py-10">

        <div class="w-full max-w-[380px]">

            {{-- LOGIN CARD --}}

            <div class="w-full rounded-2xl border border-white/20 bg-white/95 px-7 py-6 shadow-2xl backdrop-blur-xl">

                {{-- LOGO --}}

                <div class="mb-5 text-center">

                    <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-cyan-500 to-blue-700 text-xl font-black text-white shadow-lg">
                        T
                    </div>

                    <h1 class="text-2xl font-black tracking-[0.25em] text-slate-900">
                        TEXPART
                    </h1>

                    <p class="mt-1 text-xs text-slate-500">
                        Enterprise Management System
                    </p>

                </div>


                {{-- WELCOME --}}

                <div class="mb-5">

                    <h2 class="text-xl font-bold text-slate-900">
                        Bienvenue 👋
                    </h2>

                    <p class="mt-1 text-xs text-slate-500">
                        Connectez-vous à votre espace professionnel.
                    </p>

                </div>


                {{-- LOGIN FORM --}}

                <form
                    method="POST"
                    action="{{ route('login.store') }}"
                    class="space-y-4"
                >

                    @csrf


                    {{-- EMAIL --}}

                    <div>

                        <label
                            for="email"
                            class="mb-1.5 block text-sm font-semibold text-slate-700"
                        >
                            Adresse email
                        </label>

                        <div class="relative">

                            <div class="pointer-events-none absolute inset-y-0 left-0 flex w-11 items-center justify-center text-slate-400">

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.7"
                                    stroke="currentColor"
                                    class="h-5 w-5"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0l-7.5-4.615A2.25 2.25 0 012.25 6.993V6.75"
                                    />
                                </svg>

                            </div>

                            <input
                                id="email"
                                name="email"
                                type="email"
                                value="{{ old('email') }}"
                                placeholder="admin@texpart.ma"
                                autocomplete="email"
                                required
                                autofocus
                                class="h-12 w-full rounded-xl border border-slate-200 bg-slate-50 pl-11 pr-4 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 hover:border-slate-300 focus:border-cyan-500 focus:bg-white focus:ring-4 focus:ring-cyan-500/10"
                            >

                        </div>

                        @error('email')
                            <p class="mt-1 text-xs font-medium text-red-500">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- PASSWORD --}}

                    <div>

                        <label
                            for="password"
                            class="mb-1.5 block text-sm font-semibold text-slate-700"
                        >
                            Mot de passe
                        </label>

                        <div class="relative">

                            <div class="pointer-events-none absolute inset-y-0 left-0 flex w-11 items-center justify-center text-slate-400">

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.7"
                                    stroke="currentColor"
                                    class="h-5 w-5"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 0h10.5A2.25 2.25 0 0119.5 12.75v6A2.25 2.25 0 0117.25 21h-10.5A2.25 2.25 0 014.5 18.75v-6A2.25 2.25 0 016.75 10.5z"
                                    />
                                </svg>

                            </div>

                            <input
                                id="password"
                                name="password"
                                type="password"
                                placeholder="Votre mot de passe"
                                autocomplete="current-password"
                                required
                                class="h-12 w-full rounded-xl border border-slate-200 bg-slate-50 pl-11 pr-4 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 hover:border-slate-300 focus:border-cyan-500 focus:bg-white focus:ring-4 focus:ring-cyan-500/10"
                            >

                        </div>

                        @error('password')
                            <p class="mt-1 text-xs font-medium text-red-500">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- OPTIONS --}}

                    <div class="flex items-center justify-between pt-1">

                        <label class="flex cursor-pointer items-center gap-2">

                            <input
                                type="checkbox"
                                name="remember"
                                value="1"
                                class="h-4 w-4 rounded border-slate-300 text-cyan-600 focus:ring-cyan-500"
                            >

                            <span class="text-xs text-slate-600">
                                Se souvenir de moi
                            </span>

                        </label>

                        <a
                            href="{{ route('password.request') }}"
                            class="text-xs font-semibold text-cyan-600 transition hover:text-cyan-700"
                        >
                            Mot de passe oublié ?
                        </a>

                    </div>


                    {{-- BUTTON --}}

                    <button
                        type="submit"
                        class="group flex h-12 w-full items-center justify-center gap-3 rounded-xl bg-gradient-to-r from-cyan-600 to-blue-700 font-bold text-white shadow-lg shadow-cyan-600/20 transition duration-300 hover:-translate-y-0.5 hover:from-cyan-500 hover:to-blue-600 hover:shadow-xl"
                    >

                        <span>
                            Se connecter
                        </span>

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                            class="h-5 w-5 transition duration-300 group-hover:translate-x-1"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"
                            />
                        </svg>

                    </button>

                </form>


                {{-- FOOTER --}}

                <div class="mt-5 text-center">

                    <div class="mb-3 flex items-center gap-3">

                        <div class="h-px flex-1 bg-slate-200"></div>

                        <span class="text-[10px] font-medium uppercase tracking-wider text-slate-400">
                            Texpart
                        </span>

                        <div class="h-px flex-1 bg-slate-200"></div>

                    </div>

                    <p class="text-[10px] text-slate-400">
                        © {{ date('Y') }} Texpart — Tous droits réservés.
                    </p>

                </div>

            </div>


            {{-- SECURITY --}}

            <p class="mt-3 text-center text-[11px] text-white/60">
                🔒 Connexion sécurisée · Espace professionnel Texpart
            </p>

        </div>

    </main>

</body>

</html>