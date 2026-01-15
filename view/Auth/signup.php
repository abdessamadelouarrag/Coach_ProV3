<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>CoachLink — Inscription</title>
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
                    <div class="text-xs text-slate-400">Inscription</div>
                </div>
            </a>

            <a href="login.html" class="rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold hover:bg-white/10">
                J’ai déjà un compte
            </a>
        </div>
    </header>

    <!-- ✅ CENTERED MAIN -->
    <main class="min-h-[calc(100vh-80px)] flex items-center justify-center px-5 py-10">
        <!-- ✅ fixed width + centered card -->
        <section class="w-full max-w-lg rounded-[30px] border border-white/10 bg-white/5 p-6 shadow-soft">
            <div class="flex items-end justify-between gap-3">
                <div>
                    <h2 class="font-display text-2xl">Créer un compte</h2>
                    <p class="mt-1 text-sm text-slate-400">Sportif ou Coach</p>
                </div>
                <span class="rounded-full border border-white/10 bg-white/10 px-3 py-1 text-xs text-slate-200">Signup</span>
            </div>

            <form action="#" method="post" class="mt-6 grid gap-4">
                <div class="grid gap-3 md:grid-cols-2">
                    <div>
                        <label class="text-xs font-semibold text-slate-300">Nom complet</label>
                        <input name="name" type="text" required placeholder="ex: Othmane Haiba"
                            class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm outline-none placeholder:text-slate-500 focus:border-cyanx/40" />
                    </div>
                </div>

                <div>
                    <label class="text-xs font-semibold text-slate-300">Email</label>
                    <input name="email" type="email" required placeholder="ex: you@domain.com"
                        class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm outline-none placeholder:text-slate-500 focus:border-cyanx/40" />
                </div>

                <div class="grid gap-3 md:grid-cols-2">
                    <div>
                        <label class="text-xs font-semibold text-slate-300">Mot de passe</label>
                        <input name="password" type="password" required placeholder="••••••••"
                            class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm outline-none placeholder:text-slate-500 focus:border-cyanx/40" />
                    </div>
                </div>

                <!-- Role -->
                <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                    <div class="text-xs font-semibold text-slate-300">Je suis</div>
                    <div class="mt-3 grid grid-cols-2 gap-2">
                        <label class="flex cursor-pointer items-center justify-between rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm font-semibold hover:border-lime/30">
                            <span>Sportif</span>
                            <input type="radio" name="role" value="sportif" checked class="choix-sportif h-4 w-4 accent-lime">
                        </label>
                        <label class="flex cursor-pointer items-center justify-between rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm font-semibold hover:border-lime/30">
                            <span>Coach</span>
                            <input type="radio" name="role" value="coach" class="choix-coach h-4 w-4 accent-lime">
                        </label>
                    </div>
                </div>

                <!-- Coach info (toggle with JS) -->
                <section class="info-coach rounded-2xl border border-white/10 bg-white/5 p-4 hidden">
                    <div class="mt-2 text-xs font-semibold text-slate-300">Infos coach</div>

                    <div class="mt-4 grid gap-3 md:grid-cols-2">
                        <div>
                            <label class="text-xs text-slate-400">Sport principal</label>
                            <input name="sport" type="text" placeholder="ex: FootBall"
                                class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm outline-none placeholder:text-slate-500 focus:border-cyanx/40" />
                        </div>
                        <div>
                            <label class="text-xs text-slate-400">Combien d'experiences</label>
                            <input name="coach_price" type="number" placeholder="ex: 2 ans"
                                class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm outline-none placeholder:text-slate-500 focus:border-cyanx/40" />
                        </div>
                    </div>

                    <div class="mt-3">
                        <label class="text-xs text-slate-400">Bio courte</label>
                        <textarea name="coach_bio" rows="3" placeholder="Ton expérience, spécialités..."
                            class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm outline-none placeholder:text-slate-500 focus:border-cyanx/40"></textarea>
                    </div>
                </section>

                <label class="inline-flex items-start gap-2 text-sm text-slate-300">
                    <input name="terms" type="checkbox" required class="mt-1 h-4 w-4 accent-lime">
                    <span>J’accepte les conditions et la politique de confidentialité.</span>
                </label>

                <button type="submit"
                    class="mt-1 w-full rounded-2xl bg-lime px-5 py-3 font-semibold text-black hover:brightness-110">
                    Créer mon compte
                </button>

                <div class="text-center text-sm text-slate-400">
                    Déjà inscrit ?
                    <a href="login.php" class="font-semibold text-slate-200 hover:text-lime">Se connecter</a>
                </div>
            </form>
        </section>
    </main>

    <script>
        const choixCoach = document.querySelector(".choix-coach");
        const choixSportif = document.querySelector(".choix-sportif");
        const infoCoach = document.querySelector(".info-coach");

        choixCoach.addEventListener("click", () => infoCoach.classList.remove("hidden"));
        choixSportif.addEventListener("click", () => infoCoach.classList.add("hidden"));
    </script>
</body>

</html>