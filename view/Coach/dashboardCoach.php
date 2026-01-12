<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>CoachLink — Trouve ton coach</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Sora:wght@500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ["Inter", "system-ui"],
                        display: ["Sora", "Inter", "system-ui"]
                    },
                    colors: {
                        midnight: "#0B1220",
                        carbon: "#0E0E10",
                        lime: "#9AFF00",
                        cyan: "#4DE1FF",
                    },
                    boxShadow: {
                        soft: "0 18px 50px rgba(0,0,0,.40)"
                    }
                }
            }
        }
    </script>
</head>

<body class="min-h-screen bg-[radial-gradient(1200px_500px_at_15%_0%,rgba(77,225,255,.12),transparent_60%),radial-gradient(1000px_600px_at_85%_10%,rgba(154,255,0,.10),transparent_55%),linear-gradient(180deg,#0B1220,#0E0E10_70%)] text-slate-100">

    <!-- Top Nav -->
    <header class="sticky top-0 z-40 border-b border-white/10 bg-carbon/60 backdrop-blur-xl">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-6 py-4">
            <a href="index.html" class="flex items-center gap-3">
                <div class="grid h-10 w-10 place-items-center rounded-2xl bg-white/5 ring-1 ring-white/10">
                    <span class="font-display text-lg text-lime">CL</span>
                </div>
                <div class="leading-tight">
                    <div class="font-display text-base">CoachLink</div>
                    <div class="text-xs text-slate-400">Sportifs ↔ Coachs</div>
                </div>
            </a>

            <nav class="hidden items-center gap-2 md:flex">
                <a class="rounded-xl px-3 py-2 text-sm text-slate-300 hover:bg-white/5" href="coaches.html">Coachs</a>
                <a class="rounded-xl px-3 py-2 text-sm text-slate-300 hover:bg-white/5" href="dashboard-sportif.html">Espace Sportif</a>
                <a class="rounded-xl px-3 py-2 text-sm text-slate-300 hover:bg-white/5" href="dashboard-coach.html">Espace Coach</a>
            </nav>

            <div class="flex items-center gap-2">
                <button id="openSearch" class="hidden md:inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/5 px-4 py-2 text-sm text-slate-200 hover:border-white/20">
                    <span class="text-slate-400">Rechercher…</span>
                    <span class="rounded-full border border-white/10 bg-white/5 px-2 py-1 text-xs text-slate-400">Ctrl K</span>
                </button>
                <a href="coaches.html" class="inline-flex items-center justify-center rounded-2xl bg-lime px-4 py-2 text-sm font-semibold text-black hover:brightness-95">
                    Réserver
                </a>

                <button id="mobileMenuBtn" class="md:hidden rounded-xl border border-white/10 bg-white/5 p-2">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none">
                        <path d="M5 7h14M5 12h14M5 17h14" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                    </svg>
                </button>
            </div>
        </div>

        <div id="mobileMenu" class="hidden border-t border-white/10 bg-carbon/70 backdrop-blur-xl md:hidden">
            <div class="mx-auto max-w-6xl px-6 py-4 grid gap-2">
                <a class="rounded-xl px-3 py-2 text-sm text-slate-300 hover:bg-white/5" href="coaches.html">Coachs</a>
                <a class="rounded-xl px-3 py-2 text-sm text-slate-300 hover:bg-white/5" href="dashboard-sportif.html">Espace Sportif</a>
                <a class="rounded-xl px-3 py-2 text-sm text-slate-300 hover:bg-white/5" href="dashboard-coach.html">Espace Coach</a>
            </div>
        </div>
    </header>

    <!-- Hero -->
    <main class="mx-auto max-w-6xl px-6">
        <section class="relative py-14 md:py-20">
            <div class="grid items-center gap-10 md:grid-cols-2">
                <div>
                    <div class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-4 py-2 text-sm text-slate-300">
                        <span class="h-2 w-2 rounded-full bg-cyan shadow-[0_0_20px_rgba(77,225,255,.6)]"></span>
                        Coaching pro • Réservation en ligne • Paiement sécurisé
                    </div>

                    <h1 class="mt-6 font-display text-4xl md:text-5xl leading-tight">
                        Réserve une séance <span class="text-lime">sur-mesure</span> avec un coach pro.
                    </h1>

                    <p class="mt-4 text-slate-300 text-base md:text-lg">
                        Football, tennis, natation, athlétisme, sports de combat, préparation physique…
                        Compare les profils, vois les dispos, réserve en quelques clics.
                    </p>

                    <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                        <a href="coaches.html" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-lime px-5 py-3 font-semibold text-black hover:brightness-95">
                            Explorer les coachs
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none">
                                <path d="M13 7l5 5-5 5M6 12h11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                        <a href="dashboard-coach.html" class="inline-flex items-center justify-center gap-2 rounded-2xl border border-white/10 bg-white/5 px-5 py-3 font-semibold text-slate-100 hover:border-white/20">
                            Devenir coach
                        </a>
                    </div>

                    <div class="mt-10 grid grid-cols-3 gap-3 text-sm">
                        <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                            <div class="font-display text-2xl">+120</div>
                            <div class="text-slate-400">coachs vérifiés</div>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                            <div class="font-display text-2xl">4.8/5</div>
                            <div class="text-slate-400">notes moyennes</div>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                            <div class="font-display text-2xl">24/7</div>
                            <div class="text-slate-400">réservation</div>
                        </div>
                    </div>
                </div>

                <div class="relative">
                    <div class="absolute -inset-6 rounded-[32px] bg-gradient-to-tr from-lime/15 via-cyan/10 to-transparent blur-2xl"></div>
                    <div class="relative overflow-hidden rounded-[32px] border border-white/10 bg-white/5 shadow-soft">
                        <div class="aspect-[4/5] w-full bg-[url('https://images.unsplash.com/photo-1517836357463-d25dfeac3438?auto=format&fit=crop&w=1200&q=80')] bg-cover bg-center"></div>
                        <div class="p-5">
                            <div class="flex items-center justify-between">
                                <div>
                                    <div class="text-sm text-slate-400">Coach du jour</div>
                                    <div class="font-display text-xl">Sarah B.</div>
                                    <div class="mt-1 text-sm text-slate-300">Prépa physique • Athlétisme</div>
                                </div>
                                <a href="coach.html?id=1" class="rounded-2xl bg-white/5 px-4 py-2 text-sm font-semibold hover:bg-white/10">
                                    Voir profil
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="pointer-events-none absolute -bottom-6 -left-6 hidden md:block">
                        <div class="rounded-2xl border border-white/10 bg-carbon/70 px-4 py-3 backdrop-blur-xl">
                            <div class="text-xs text-slate-400">Prochaine séance</div>
                            <div class="mt-1 text-sm font-semibold">Jeu • 18:30 • Rabat</div>
                            <div class="text-xs text-slate-400">Football • 60 min</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Sports grid -->
        <section class="pb-16">
            <div class="flex items-end justify-between gap-4">
                <div>
                    <h2 class="font-display text-2xl md:text-3xl">Choisis ton sport</h2>
                    <p class="mt-2 text-slate-400">Des coachs spécialisés, filtres rapides, réservation simple.</p>
                </div>
                <a href="coaches.html" class="hidden sm:inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold hover:border-white/20">
                    Tout voir
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none">
                        <path d="M13 7l5 5-5 5M6 12h11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
            </div>

            <div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                <button class="sportCard group rounded-3xl border border-white/10 bg-white/5 p-5 text-left hover:border-white/20" data-sport="football">
                    <div class="flex items-center justify-between">
                        <div class="font-display text-xl">Football</div>
                        <div class="h-9 w-9 rounded-2xl bg-lime/10 grid place-items-center text-lime group-hover:bg-lime/15">⚡</div>
                    </div>
                    <div class="mt-2 text-sm text-slate-400">Tactique, technique, cardio</div>
                </button>

                <button class="sportCard group rounded-3xl border border-white/10 bg-white/5 p-5 text-left hover:border-white/20" data-sport="tennis">
                    <div class="flex items-center justify-between">
                        <div class="font-display text-xl">Tennis</div>
                        <div class="h-9 w-9 rounded-2xl bg-cyan/10 grid place-items-center text-cyan group-hover:bg-cyan/15">🎾</div>
                    </div>
                    <div class="mt-2 text-sm text-slate-400">Service, échange, mobilité</div>
                </button>

                <button class="sportCard group rounded-3xl border border-white/10 bg-white/5 p-5 text-left hover:border-white/20" data-sport="natation">
                    <div class="flex items-center justify-between">
                        <div class="font-display text-xl">Natation</div>
                        <div class="h-9 w-9 rounded-2xl bg-white/5 grid place-items-center text-slate-200 group-hover:bg-white/10">🏊</div>
                    </div>
                    <div class="mt-2 text-sm text-slate-400">Endurance, technique, souffle</div>
                </button>

                <button class="sportCard group rounded-3xl border border-white/10 bg-white/5 p-5 text-left hover:border-white/20" data-sport="athletisme">
                    <div class="flex items-center justify-between">
                        <div class="font-display text-xl">Athlétisme</div>
                        <div class="h-9 w-9 rounded-2xl bg-lime/10 grid place-items-center text-lime group-hover:bg-lime/15">🏃</div>
                    </div>
                    <div class="mt-2 text-sm text-slate-400">Vitesse, explosivité, forme</div>
                </button>

                <button class="sportCard group rounded-3xl border border-white/10 bg-white/5 p-5 text-left hover:border-white/20" data-sport="combat">
                    <div class="flex items-center justify-between">
                        <div class="font-display text-xl">Combat</div>
                        <div class="h-9 w-9 rounded-2xl bg-cyan/10 grid place-items-center text-cyan group-hover:bg-cyan/15">🥊</div>
                    </div>
                    <div class="mt-2 text-sm text-slate-400">Boxe, MMA, self-defense</div>
                </button>

                <button class="sportCard group rounded-3xl border border-white/10 bg-white/5 p-5 text-left hover:border-white/20" data-sport="prepa">
                    <div class="flex items-center justify-between">
                        <div class="font-display text-xl">Prépa physique</div>
                        <div class="h-9 w-9 rounded-2xl bg-white/5 grid place-items-center text-slate-200 group-hover:bg-white/10">🏋️</div>
                    </div>
                    <div class="mt-2 text-sm text-slate-400">Force, mobilité, programme</div>
                </button>
            </div>
        </section>
    </main>

    <!-- Search modal -->
    <div id="searchModal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/60"></div>
        <div class="relative mx-auto mt-20 w-[min(720px,calc(100%-32px))] rounded-3xl border border-white/10 bg-carbon/80 p-4 backdrop-blur-xl shadow-soft">
            <div class="flex items-center gap-3">
                <input id="searchInput" class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-slate-100 placeholder:text-slate-400 outline-none focus:border-lime/40"
                    placeholder="Rechercher un coach, un sport, une ville…" />
                <button id="closeSearch" class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3 hover:bg-white/10">Esc</button>
            </div>
            <div id="searchResults" class="mt-3 grid gap-2"></div>
            <div class="mt-3 text-xs text-slate-400">Astuce: tape “football rabat”</div>
        </div>
    </div>

    <script>
        // Mobile menu
        const mobileMenuBtn = document.getElementById("mobileMenuBtn");
        const mobileMenu = document.getElementById("mobileMenu");
        mobileMenuBtn?.addEventListener("click", () => mobileMenu.classList.toggle("hidden"));

        // Sport cards -> go coaches.html?sport=
        document.querySelectorAll(".sportCard").forEach(btn => {
            btn.addEventListener("click", () => {
                const sport = btn.dataset.sport || "";
                window.location.href = `coaches.html?sport=${encodeURIComponent(sport)}`;
            });
        });

        // Search modal
        const openSearch = document.getElementById("openSearch");
        const searchModal = document.getElementById("searchModal");
        const closeSearch = document.getElementById("closeSearch");
        const searchInput = document.getElementById("searchInput");
        const searchResults = document.getElementById("searchResults");

        const sample = [{
                id: 1,
                name: "Sarah B.",
                sport: "prépa",
                city: "Rabat",
                price: 200,
                rating: 4.9
            },
            {
                id: 2,
                name: "Yassine K.",
                sport: "football",
                city: "Casablanca",
                price: 150,
                rating: 4.7
            },
            {
                id: 3,
                name: "Nora H.",
                sport: "tennis",
                city: "Marrakech",
                price: 220,
                rating: 4.8
            }
        ];

        function showSearch(open) {
            searchModal.classList.toggle("hidden", !open);
            if (open) {
                setTimeout(() => searchInput?.focus(), 0);
            }
        }

        openSearch?.addEventListener("click", () => showSearch(true));
        closeSearch?.addEventListener("click", () => showSearch(false));
        window.addEventListener("keydown", (e) => {
            const k = e.key.toLowerCase();
            if ((e.ctrlKey || e.metaKey) && k === "k") {
                e.preventDefault();
                showSearch(true);
            }
            if (k === "escape") {
                showSearch(false);
            }
        });
        searchModal?.addEventListener("click", (e) => {
            if (e.target === searchModal.firstElementChild) showSearch(false);
        });

        function renderResults(items) {
            searchResults.innerHTML = "";
            if (items.length === 0) {
                searchResults.innerHTML = `<div class="rounded-2xl border border-white/10 bg-white/5 p-4 text-sm text-slate-400">Aucun résultat.</div>`;
                return;
            }
            items.slice(0, 6).forEach(c => {
                const el = document.createElement("a");
                el.href = `coach.html?id=${c.id}`;
                el.className = "rounded-2xl border border-white/10 bg-white/5 p-4 hover:border-white/20";
                el.innerHTML = `
          <div class="flex items-center justify-between">
            <div>
              <div class="font-semibold">${c.name} <span class="text-slate-400 text-sm">• ${c.city}</span></div>
              <div class="text-sm text-slate-400">${c.sport} • ${c.price} MAD • ⭐ ${c.rating}</div>
            </div>
            <div class="text-lime font-semibold">Voir</div>
          </div>
        `;
                searchResults.appendChild(el);
            });
        }

        searchInput?.addEventListener("input", () => {
            const q = searchInput.value.trim().toLowerCase();
            const items = sample.filter(c => (c.name + c.sport + c.city).toLowerCase().includes(q));
            renderResults(q ? items : sample);
        });

        renderResults(sample);
    </script>
</body>

</html>