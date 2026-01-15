<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>CoachLink — Trouver un coach</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Sora:wght@500;600;700&display=swap" rel="stylesheet">
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: { sans: ["Inter","system-ui","sans-serif"], display:["Sora","Inter","sans-serif"] },
          colors: { midnight:"#0B1220", carbon:"#0E0E10", lime:"#9AFF00", cyanx:"#4DE1FF" },
          boxShadow: { soft:"0 18px 40px rgba(0,0,0,.35)" }
        }
      }
    }
  </script>
</head>
<body class="min-h-screen bg-gradient-to-b from-midnight to-carbon text-slate-50">
  <div class="pointer-events-none fixed inset-0 -z-10">
    <div class="absolute left-[-10%] top-[-20%] h-[520px] w-[820px] rounded-full bg-cyanx/12 blur-[90px]"></div>
    <div class="absolute right-[-10%] top-[-10%] h-[520px] w-[820px] rounded-full bg-lime/10 blur-[100px]"></div>
  </div>

  <header class="sticky top-0 z-20 border-b border-white/10 bg-carbon/40 backdrop-blur-xl">
    <div class="mx-auto flex max-w-6xl items-center justify-between px-5 py-4">
      <a href="index.html" class="flex items-center gap-3">
        <span class="grid h-10 w-10 place-items-center rounded-2xl border border-white/10 bg-white/5 shadow-soft">
          <span class="h-2.5 w-2.5 rounded-full bg-lime"></span>
        </span>
        <div class="leading-tight">
          <div class="font-display text-lg">CoachLink</div>
          <div class="text-xs text-slate-400">Trouver un coach</div>
        </div>
      </a>
      <nav class="hidden items-center gap-2 md:flex">
        <a class="rounded-xl px-3 py-2 text-sm text-slate-300 hover:bg-white/5 hover:text-white" href="coaches.html">Coachs</a>
        <a class="rounded-xl px-3 py-2 text-sm text-slate-300 hover:bg-white/5 hover:text-white" href="dashboard-coach.html">Espace coach</a>
        <a class="rounded-xl px-3 py-2 text-sm text-slate-300 hover:bg-white/5 hover:text-white" href="dashboard-sportif.html">Espace sportif</a>
      </nav>
      <div class="flex items-center gap-2">
        <button id="resetBtn" class="rounded-xl border border-white/10 bg-white/5 px-3 py-2 text-xs text-slate-200 hover:bg-white/10">Reset</button>
        <a href="dashboard-sportif.html" class="rounded-xl bg-lime px-4 py-2 text-sm font-semibold text-black hover:brightness-110">Mes réservations</a>
      </div>
    </div>
  </header>

  <main class="mx-auto max-w-6xl px-5 py-10">
    <div class="flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
      <div>
        <h1 class="font-display text-3xl">Choisir un coach</h1>
        <p class="mt-1 text-slate-400">Filtre par sport, ville, prix et disponibilité.</p>
      </div>

      <div class="flex flex-col gap-2 sm:flex-row sm:items-center">
        <div class="relative">
          <input id="q" type="text" placeholder="Rechercher: nom, sport, ville..."
                 class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm outline-none placeholder:text-slate-500 focus:border-cyanx/40 sm:w-[320px]"/>
          <div class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-slate-400">⌘K</div>
        </div>

        <select id="sort"
                class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm outline-none focus:border-cyanx/40">
          <option value="recommended">Tri: recommandé</option>
          <option value="price_asc">Prix: bas → haut</option>
          <option value="price_desc">Prix: haut → bas</option>
          <option value="rating_desc">Note: haut → bas</option>
        </select>
      </div>
    </div>

    <!-- Filters -->
    <section class="mt-6 rounded-[28px] border border-white/10 bg-white/5 p-5 shadow-soft">
      <div class="grid gap-4 md:grid-cols-4">
        <div>
          <div class="text-xs font-semibold text-slate-300">Sport</div>
          <div id="sportChips" class="mt-2 flex flex-wrap gap-2"></div>
        </div>

        <div>
          <div class="text-xs font-semibold text-slate-300">Ville</div>
          <select id="city"
                  class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm outline-none focus:border-cyanx/40">
          </select>
        </div>

        <div>
          <div class="text-xs font-semibold text-slate-300">Budget (MAD)</div>
          <div class="mt-2 flex items-center gap-3">
            <input id="minPrice" type="number" placeholder="Min"
              class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm outline-none placeholder:text-slate-500 focus:border-cyanx/40">
            <input id="maxPrice" type="number" placeholder="Max"
              class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm outline-none placeholder:text-slate-500 focus:border-cyanx/40">
          </div>
        </div>

        <div>
          <div class="text-xs font-semibold text-slate-300">Disponibilité</div>
          <label class="mt-3 inline-flex cursor-pointer items-center gap-3 rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm">
            <input id="availableOnly" type="checkbox" class="h-4 w-4 accent-lime">
            <span>Seulement disponibles</span>
          </label>
        </div>
      </div>
    </section>

    <!-- Results -->
    <section class="mt-6">
      <div class="flex items-center justify-between">
        <div id="count" class="text-sm text-slate-400"></div>
        <div class="text-xs text-slate-500">Clique sur un coach pour réserver.</div>
      </div>

      <div id="grid" class="mt-4 grid gap-4 sm:grid-cols-2 lg:grid-cols-3"></div>
    </section>
  </main>

  <script>
    // ---- Demo data (replace later with DB/API)
    const coaches = [
      { id: 1, name: "Yassine A.", sport: "Football", city: "Agadir", price: 250, rating: 4.9, available: true, tags:["Tactique","Vitesse"], img:"https://images.unsplash.com/photo-1521412644187-c49fa049e84d?auto=format&fit=crop&w=1200&q=70" },
      { id: 2, name: "Sara E.", sport: "Prépa physique", city: "Marrakech", price: 200, rating: 4.8, available: true, tags:["Force","Mobilité"], img:"https://images.unsplash.com/photo-1517836357463-d25dfeac3438?auto=format&fit=crop&w=1200&q=70" },
      { id: 3, name: "Hamza K.", sport: "Boxe", city: "Casablanca", price: 300, rating: 4.7, available: false, tags:["Footwork","Garde"], img:"https://images.unsplash.com/photo-1549719386-74dfcbf7dbed?auto=format&fit=crop&w=1200&q=70" },
      { id: 4, name: "Imane R.", sport: "Natation", city: "Rabat", price: 220, rating: 4.9, available: true, tags:["Technique","Cardio"], img:"https://images.unsplash.com/photo-1530549387789-4c1017266635?auto=format&fit=crop&w=1200&q=70" },
      { id: 5, name: "Nabil S.", sport: "Tennis", city: "Agadir", price: 280, rating: 4.6, available: true, tags:["Service","Placement"], img:"https://images.unsplash.com/photo-1622163642998-1ea32b0a0b60?auto=format&fit=crop&w=1200&q=70" },
      { id: 6, name: "Kawtar M.", sport: "Athlétisme", city: "Fès", price: 190, rating: 4.5, available: true, tags:["Sprint","Explosivité"], img:"https://images.unsplash.com/photo-1526401485004-2fda9f6a0a58?auto=format&fit=crop&w=1200&q=70" }
    ];

    const allSports = [...new Set(coaches.map(c => c.sport))];
    const allCities = ["Toutes"].concat([...new Set(coaches.map(c => c.city))]);

    // ---- State
    const state = {
      sport: null,
      city: "Toutes",
      q: "",
      minPrice: "",
      maxPrice: "",
      availableOnly: false,
      sort: "recommended",
    };

    // ---- Elements
    const sportChips = document.getElementById("sportChips");
    const citySel = document.getElementById("city");
    const qInput = document.getElementById("q");
    const minPrice = document.getElementById("minPrice");
    const maxPrice = document.getElementById("maxPrice");
    const availableOnly = document.getElementById("availableOnly");
    const sortSel = document.getElementById("sort");
    const grid = document.getElementById("grid");
    const count = document.getElementById("count");
    const resetBtn = document.getElementById("resetBtn");

    // ---- URL prefill: ?sport=Football
    const params = new URLSearchParams(location.search);
    const sportFromUrl = params.get("sport");
    if (sportFromUrl) state.sport = sportFromUrl;

    // ---- Render chips
    function renderSportChips() {
      const chips = ["Tous"].concat(allSports);
      sportChips.innerHTML = chips.map(s => {
        const active = (s === "Tous" && !state.sport) || (s === state.sport);
        return `<button class="px-3 py-2 rounded-full border ${active ? "border-lime/50 bg-lime/10 text-lime" : "border-white/10 bg-white/5 text-slate-200 hover:border-lime/30"} text-xs font-semibold"
                  data-sport="${s}">${s}</button>`;
      }).join("");

      sportChips.querySelectorAll("button").forEach(btn => {
        btn.addEventListener("click", () => {
          const v = btn.dataset.sport;
          state.sport = (v === "Tous") ? null : v;
          renderSportChips();
          render();
        });
      });
    }

    function renderCities() {
      citySel.innerHTML = allCities.map(c => `<option ${c===state.city?"selected":""} value="${c}">${c}</option>`).join("");
    }

    function matchesFilters(c) {
      if (state.sport && c.sport !== state.sport) return false;
      if (state.city !== "Toutes" && c.city !== state.city) return false;
      if (state.availableOnly && !c.available) return false;

      const q = state.q.trim().toLowerCase();
      if (q) {
        const hay = `${c.name} ${c.sport} ${c.city} ${c.tags.join(" ")}`.toLowerCase();
        if (!hay.includes(q)) return false;
      }

      const min = state.minPrice !== "" ? Number(state.minPrice) : null;
      const max = state.maxPrice !== "" ? Number(state.maxPrice) : null;
      if (min !== null && c.price < min) return false;
      if (max !== null && c.price > max) return false;

      return true;
    }

    function sortList(list) {
      const arr = [...list];
      switch (state.sort) {
        case "price_asc": return arr.sort((a,b)=>a.price-b.price);
        case "price_desc": return arr.sort((a,b)=>b.price-a.price);
        case "rating_desc": return arr.sort((a,b)=>b.rating-a.rating);
        default:
          // recommended: available first then rating desc
          return arr.sort((a,b)=>(Number(b.available)-Number(a.available)) || (b.rating-a.rating));
      }
    }

    function card(c) {
      return `
        <a href="coach.html?id=${c.id}"
           class="group overflow-hidden rounded-[26px] border border-white/10 bg-white/5 shadow-soft transition hover:-translate-y-0.5 hover:border-lime/30">
          <div class="relative aspect-[4/3]">
            <img class="h-full w-full object-cover opacity-90" src="${c.img}" alt="${c.name}">
            <div class="absolute inset-0 bg-gradient-to-t from-carbon/80 via-carbon/10 to-transparent"></div>
            <div class="absolute left-4 top-4 flex gap-2">
              <span class="rounded-full border border-white/10 bg-white/10 px-3 py-1 text-xs text-slate-200">${c.sport}</span>
              <span class="rounded-full border ${c.available ? "border-lime/40 bg-lime/10 text-lime":"border-white/10 bg-white/10 text-slate-200"} px-3 py-1 text-xs">
                ${c.available ? "Disponible" : "Complet"}
              </span>
            </div>
          </div>

          <div class="p-5">
            <div class="flex items-start justify-between gap-3">
              <div>
                <div class="text-lg font-semibold">${c.name}</div>
                <div class="mt-1 text-sm text-slate-400">${c.city}</div>
              </div>
              <div class="rounded-xl border border-white/10 bg-white/5 px-3 py-2 text-sm">
                ⭐ <span class="font-semibold text-white">${c.rating.toFixed(1)}</span>
              </div>
            </div>

            <div class="mt-3 flex flex-wrap gap-2">
              ${c.tags.slice(0,3).map(t=>`<span class="rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs text-slate-200">${t}</span>`).join("")}
            </div>

            <div class="mt-4 flex items-center justify-between">
              <div class="text-sm text-slate-300">
                À partir de <span class="font-semibold text-white">${c.price} MAD</span>
              </div>
              <div class="text-sm font-semibold text-slate-200 group-hover:text-lime">Voir →</div>
            </div>
          </div>
        </a>
      `;
    }

    function render() {
      const filtered = coaches.filter(matchesFilters);
      const sorted = sortList(filtered);

      count.textContent = `${sorted.length} coach(s) trouvés`;
      grid.innerHTML = sorted.map(card).join("");

      if (!sorted.length) {
        grid.innerHTML = `
          <div class="col-span-full rounded-[26px] border border-white/10 bg-white/5 p-8 text-center text-slate-300">
            Aucun résultat. Modifie les filtres ou clique <span class="text-white font-semibold">Reset</span>.
          </div>
        `;
      }
    }

    // ---- Events
    qInput.addEventListener("input", e => { state.q = e.target.value; render(); });
    citySel.addEventListener("change", e => { state.city = e.target.value; render(); });
    minPrice.addEventListener("input", e => { state.minPrice = e.target.value; render(); });
    maxPrice.addEventListener("input", e => { state.maxPrice = e.target.value; render(); });
    availableOnly.addEventListener("change", e => { state.availableOnly = e.target.checked; render(); });
    sortSel.addEventListener("change", e => { state.sort = e.target.value; render(); });

    resetBtn.addEventListener("click", () => {
      state.sport = null;
      state.city = "Toutes";
      state.q = "";
      state.minPrice = "";
      state.maxPrice = "";
      state.availableOnly = false;
      state.sort = "recommended";
      qInput.value = "";
      minPrice.value = "";
      maxPrice.value = "";
      availableOnly.checked = false;
      sortSel.value = "recommended";
      renderSportChips();
      renderCities();
      render();
    });

    // Keyboard shortcut: Cmd/Ctrl+K focus search
    window.addEventListener("keydown", (e) => {
      if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === "k") {
        e.preventDefault();
        qInput.focus();
      }
    });

    // Init
    renderSportChips();
    renderCities();
    render();
  </script>
</body>
</html>
