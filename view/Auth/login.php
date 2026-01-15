<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>CoachLink — Connexion</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Sora:wght@500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ["Inter", "system-ui", "sans-serif"],
                        display: ["Sora", "Inter", "sans-serif"]
                    },
                    colors: {
                        midnight: "#0B1220",
                        carbon: "#0E0E10",
                        lime: "#9AFF00",
                        cyanx: "#4DE1FF"
                    },
                    boxShadow: {
                        soft: "0 18px 40px rgba(0,0,0,.35)"
                    }
                }
            }
        }
    </script>
</head>

<body class="min-h-screen bg-gradient-to-b from-midnight to-carbon text-slate-50">
    <!-- glows -->
    <div class="pointer-events-none fixed inset-0 -z-10">
        <div class="absolute left-[-10%] top-[-20%] h-[520px] w-[820px] rounded-full bg-cyanx/12 blur-[90px]"></div>
        <div class="absolute right-[-10%] top-[-10%] h-[520px] w-[820px] rounded-full bg-lime/10 blur-[100px]"></div>
    </div>

    <!-- navbar -->
    <header class="border-b border-white/10 bg-carbon/30 backdrop-blur-xl">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-5 py-4">
            <a href="index.html" class="flex items-center gap-3">
                <span class="grid h-10 w-10 place-items-center rounded-2xl border border-white/10 bg-white/5 shadow-soft">
                    <span class="h-2.5 w-2.5 rounded-full bg-lime"></span>
                </span>
                <div class="leading-tight">
                    <div class="font-display text-lg">CoachLink</div>
                    <div class="text-xs text-slate-400">Connexion</div>
                </div>
            </a>

            <a href="signup.html" class="rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold hover:bg-white/10">
                Créer un compte
            </a>
        </div>
    </header>

    <main class="mx-auto grid max-w-6xl items-center gap-8 px-5 py-10 md:grid-cols-2 md:py-16">
        <!-- left -->
        <section class="relative overflow-hidden rounded-[30px] border border-white/10 bg-white/5 p-6 shadow-soft">
            <div class="absolute -inset-6 rounded-[40px] bg-gradient-to-tr from-lime/10 via-cyanx/10 to-white/0 blur-2xl"></div>
            <div class="relative">
                <h1 class="font-display text-3xl leading-tight md:text-4xl">
                    Reviens à l’entraînement <span class="text-lime">plus vite</span>.
                </h1>
                <p class="mt-3 max-w-lg text-slate-300">
                    Accède à tes réservations, explore des coachs, et gère tes séances en quelques clics.
                </p>

                <div class="mt-6 grid gap-3 sm:grid-cols-2">
                    <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                        <div class="text-sm font-semibold">Sportif</div>
                        <div class="mt-1 text-xs text-slate-400">Réserver • Historique</div>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                        <div class="text-sm font-semibold">Coach</div>
                        <div class="mt-1 text-xs text-slate-400">Dispos • Réservations</div>
                    </div>
                </div>

                <div class="mt-6 rounded-2xl border border-white/10 bg-white/5 p-4 text-sm text-slate-300">
                    <span class="text-slate-400">Astuce:</span> Choisis ton rôle avant de te connecter.
                </div>
            </div>
        </section>

        <!-- right: form -->
        <section class="rounded-[30px] border border-white/10 bg-white/5 p-6 shadow-soft">
            <div class="flex items-end justify-between gap-3">
                <div>
                    <h2 class="font-display text-2xl">Se connecter</h2>
                    <p class="mt-1 text-sm text-slate-400">Bienvenue 👋</p>
                </div>
                <span class="rounded-full border border-white/10 bg-white/10 px-3 py-1 text-xs text-slate-200">Login</span>
            </div>

            <!-- No JS: action points to a backend route later -->
            <form action="#" method="post" class="mt-6 grid gap-4">
                <div>
                    <label class="text-xs font-semibold text-slate-300">Email</label>
                    <input name="email" type="email" required placeholder="ex: you@domain.com"
                        class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm outline-none placeholder:text-slate-500 focus:border-cyanx/40" />
                </div>

                <div>
                    <label class="text-xs font-semibold text-slate-300">Mot de passe</label>
                    <input name="password" type="password" required placeholder="••••••••"
                        class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm outline-none placeholder:text-slate-500 focus:border-cyanx/40" />
                </div>

                <div class="flex items-center justify-between">
                    <label class="inline-flex items-center gap-2 text-sm text-slate-300">
                        <input name="remember" type="checkbox" class="h-4 w-4 accent-lime">
                        Se souvenir de moi
                    </label>
                    <a href="#" class="text-sm font-semibold text-slate-200 hover:text-lime">
                        Mot de passe oublié?
                    </a>
                </div>

                <!-- Role -->
                <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                    <div class="text-xs font-semibold text-slate-300">Rôle</div>
                    <div class="mt-3 grid grid-cols-2 gap-2">
                        <label class="flex cursor-pointer items-center justify-between rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm font-semibold hover:border-lime/30">
                            <span>Sportif</span>
                            <input type="radio" name="role" value="sportif" checked class="h-4 w-4 accent-lime">
                        </label>
                        <label class="flex cursor-pointer items-center justify-between rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm font-semibold hover:border-lime/30">
                            <span>Coach</span>
                            <input type="radio" name="role" value="coach" class="h-4 w-4 accent-lime">
                        </label>
                    </div>
                </div>

                <button type="submit"
                    class="mt-1 w-full rounded-2xl bg-lime px-5 py-3 font-semibold text-black hover:brightness-110">
                    Connexion
                </button>

                <div class="text-center text-sm text-slate-400">
                    Pas de compte ?
                    <a href="signup.php" class="font-semibold text-slate-200 hover:text-lime">Créer un compte</a>
                </div>
            </form>
        </section>
    </main>
</body>

</html>