<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>CoachLink — Sportifs & Coachs</title>
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
    <!-- Top glow -->
    <div class="pointer-events-none fixed inset-0 -z-10">
        <div class="absolute left-[-10%] top-[-20%] h-[520px] w-[820px] rounded-full bg-cyanx/15 blur-[90px]"></div>
        <div class="absolute right-[-10%] top-[-10%] h-[520px] w-[820px] rounded-full bg-lime/10 blur-[100px]"></div>
    </div>

    <!-- Navbar -->
    <header class="sticky top-0 z-20 border-b border-white/10 bg-carbon/40 backdrop-blur-xl">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-5 py-4">
            <a href="index.html" class="flex items-center gap-3">
                <span class="grid h-10 w-10 place-items-center rounded-2xl border border-white/10 bg-white/5 shadow-soft">
                    <span class="h-2.5 w-2.5 rounded-full bg-lime"></span>
                </span>
                <div class="leading-tight">
                    <div class="font-display text-lg">CoachLink</div>
                </div>
            </a>

            <nav class="hidden items-center gap-2 md:flex">
                <a class="rounded-xl px-3 py-2 text-sm text-slate-300 hover:bg-white/5 hover:text-white" href="">Trouver un coach</a>
                <a class="rounded-xl px-3 py-2 text-sm text-slate-300 hover:bg-white/5 hover:text-white" href="">Espace coach</a>
                <a class="rounded-xl px-3 py-2 text-sm text-slate-300 hover:bg-white/5 hover:text-white" href="">Espace sportif</a>
            </nav>

            <div class="flex items-center gap-2">
                <button id="themeBtn" class="rounded-xl border border-white/10 bg-white/5 px-3 py-2 text-xs text-slate-200 hover:bg-white/10">
                    Glow: ON
                </button>
                <a href="/login" class="rounded-xl bg-lime px-4 py-2 text-sm font-semibold text-black hover:brightness-110">
                    Login
                </a>
            </div>
        </div>
    </header>

    <!-- Hero -->
    <main class="mx-auto max-w-6xl px-5">
        <section class="grid items-center gap-10 py-14 md:grid-cols-2 md:py-20">
            <div>
                <div class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-3 py-2 text-xs text-slate-300">
                    <span class="h-2 w-2 rounded-full bg-cyanx"></span>
                    Réservation en ligne • Disponibilités • Avis vérifiés
                </div>

                <h1 class="mt-5 font-display text-4xl leading-tight md:text-5xl">
                    Trouve un coach <span class="text-lime">pro</span> pour des séances
                    <span class="text-cyanx">personnalisées</span>.
                </h1>

                <p class="mt-4 max-w-xl text-base text-slate-300 md:text-lg">
                    Football, tennis, natation, athlétisme, sports de combat, préparation physique… Compare profils, spécialités,
                    prix et réserves en quelques clics.
                </p>

                <div class="mt-6 flex flex-col gap-3 sm:flex-row">
                    <a href="/signup" class="inline-flex items-center justify-center rounded-2xl bg-lime px-5 py-3 font-semibold text-black hover:brightness-110">
                        Create Account
                    </a>
                    <a href="/login" class="inline-flex items-center justify-center rounded-2xl border border-white/10 bg-white/5 px-5 py-3 font-semibold text-white hover:bg-white/10">
                        Login Now
                    </a>
                </div>

                <div class="mt-8 flex flex-wrap gap-3 text-sm text-slate-300">
                    <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3">
                        <div class="text-white font-semibold">+120</div>
                        <div class="text-xs text-slate-400">coachs actifs</div>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3">
                        <div class="text-white font-semibold">4.8/5</div>
                        <div class="text-xs text-slate-400">moyenne avis</div>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3">
                        <div class="text-white font-semibold">24h</div>
                        <div class="text-xs text-slate-400">confirmation rapide</div>
                    </div>
                </div>
            </div>

            <!-- Visual -->
            <div class="relative">
                <div class="absolute -inset-4 rounded-[32px] bg-gradient-to-tr from-lime/15 via-cyanx/10 to-white/5 blur-2xl"></div>

                <div class="relative overflow-hidden rounded-[28px] border border-white/10 bg-white/5 shadow-soft">
                    <div class="aspect-[4/3] w-full bg-gradient-to-tr from-white/5 to-white/0">
                        <img
                            class="h-full w-full object-cover opacity-90"
                            src="https://images.unsplash.com/photo-1517836357463-d25dfeac3438?auto=format&fit=crop&w=1200&q=70"
                            alt="Training" />
                    </div>

                    <div class="grid gap-4 p-5 md:p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-sm text-slate-400">Coach recommandé</div>
                                <div class="text-lg font-semibold">Sarah El Amrani • Prépa physique</div>
                            </div>
                            <span class="rounded-full bg-lime/15 px-3 py-1 text-xs font-semibold text-lime">Disponible</span>
                        </div>

                        <div class="flex flex-wrap gap-2">
                            <span class="rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs text-slate-200">Force</span>
                            <span class="rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs text-slate-200">Endurance</span>
                            <span class="rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs text-slate-200">Perte de poids</span>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="text-sm text-slate-300">À partir de <span class="font-semibold text-white">200 MAD</span></div>
                            <a href="coaches.html" class="rounded-xl bg-white/10 px-4 py-2 text-sm font-semibold hover:bg-white/15">
                                Voir profils →
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>    
    </main>

    <footer class="border-t border-white/10 bg-carbon/30">
        <div class="mx-auto flex max-w-6xl flex-col gap-3 px-5 py-8 text-sm text-slate-400 md:flex-row md:items-center md:justify-between">
            <div>© <span id="year"></span> CoachLink</div>
            <div class="flex gap-4">
                <a class="hover:text-white" href="coaches.html">Coachs</a>
                <a class="hover:text-white" href="dashboard-coach.html">Coach</a>
                <a class="hover:text-white" href="dashboard-sportif.html">Sportif</a>
            </div>
        </div>
    </footer>

    <script>
        // ------- Demo data (landing sports)
        const sports = [{
                name: "Football",
                desc: "Technique • Vitesse • Tactique",
                icon: "⚽"
            },
            {
                name: "Tennis",
                desc: "Service • Placement • Endurance",
                icon: "🎾"
            },
            {
                name: "Natation",
                desc: "Respiration • Cardio • Perf",
                icon: "🏊"
            },
            {
                name: "Athlétisme",
                desc: "Sprint • Explosivité • Forme",
                icon: "🏃"
            },
            {
                name: "Boxe",
                desc: "Footwork • Garde • Puissance",
                icon: "🥊"
            },
            {
                name: "Prépa physique",
                desc: "Force • Mobilité • Core",
                icon: "🏋️"
            },
        ];

        const sportsGrid = document.getElementById("sportsGrid");
        sportsGrid.innerHTML = sports.map(s => `
      <a href="coaches.html?sport=${encodeURIComponent(s.name)}"
         class="group rounded-3xl border border-white/10 bg-white/5 p-5 shadow-soft transition hover:-translate-y-0.5 hover:border-lime/30">
        <div class="flex items-center justify-between">
          <div class="text-2xl">${s.icon}</div>
          <div class="h-10 w-10 rounded-2xl border border-white/10 bg-gradient-to-tr from-white/10 to-white/0"></div>
        </div>
        <div class="mt-4 font-semibold text-white">${s.name}</div>
        <div class="mt-1 text-sm text-slate-400">${s.desc}</div>
        <div class="mt-4 text-sm font-semibold text-slate-200 group-hover:text-lime">Voir coachs →</div>
      </a>
    `).join("");

        document.getElementById("year").textContent = new Date().getFullYear();

        // ------- Glow toggle
        const themeBtn = document.getElementById("themeBtn");
        let glowOn = true;
        themeBtn.addEventListener("click", () => {
            glowOn = !glowOn;
            document.querySelectorAll(".pointer-events-none.fixed.inset-0 > div").forEach(el => {
                el.style.display = glowOn ? "block" : "none";
            });
            themeBtn.textContent = `Glow: ${glowOn ? "ON" : "OFF"}`;
        });
    </script>
</body>

</html>