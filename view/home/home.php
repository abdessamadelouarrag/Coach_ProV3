<!doctype html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Coachs — CoachLink</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Sora:wght@500;600;700&display=swap" rel="stylesheet">
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: { sans: ["Inter","system-ui"], display: ["Sora","Inter","system-ui"] },
          colors: { midnight:"#0B1220", carbon:"#0E0E10", lime:"#9AFF00", cyan:"#4DE1FF" },
          boxShadow: { soft: "0 18px 50px rgba(0,0,0,.40)" }
        }
      }
    }
  </script>
</head>
<body class="min-h-screen bg-[radial-gradient(1200px_500px_at_15%_0%,rgba(77,225,255,.12),transparent_60%),radial-gradient(1000px_600px_at_85%_10%,rgba(154,255,0,.10),transparent_55%),linear-gradient(180deg,#0B1220,#0E0E10_70%)] text-slate-100">

  <header class="sticky top-0 z-40 border-b border-white/10 bg-carbon/60 backdrop-blur-xl">
    <div class="mx-auto flex max-w-6xl items-center justify-between px-6 py-4">
      <a href="index.html" class="flex items-center gap-3">
        <div class="grid h-10 w-10 place-items-center rounded-2xl bg-white/5 ring-1 ring-white/10">
          <span class="font-display text-lg text-lime">CL</span>
        </div>
        <div class="font-display">CoachLink</div>
      </a>
      <div class="flex items-center gap-2">
        <a href="dashboard-sportif.html" class="rounded-xl px-3 py-2 text-sm text-slate-300 hover:bg-white/5">Sportif</a>
        <a href="dashboard-coach.html" class="rounded-xl px-3 py-2 text-sm text-slate-300 hover:bg-white/5">Coach</a>
        <a href="index.html" class="rounded-2xl border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold hover:border-white/20">Retour</a>
      </div>
    </div>
  </header>

  <main class="mx-auto max-w-6xl px-6 py-10">
    <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
      <div>
        <h1 class="font-display text-3xl md:text-4xl">Trouver un coach</h1>
        <p class="mt-2 text-slate-400">Filtre par sport, ville, prix, note et disponibilité.</p>
      </div>

      <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
        <div class="relative">
          <input id="q" class="w-full sm:w-80 rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-slate-100 placeholder:text-slate-400 outline-none focus:border-lime/40"
                 placeholder="Nom, sport, ville…" />
          <div class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-slate-500">⌘K</div>
        </div>
        <select id="sort" class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-slate-200 outline-none focus:border-white/20">
          <option value="reco">Recommandés</option>
          <option value="priceAsc">Prix (croissant)</option>
          <option value="priceDesc">Prix (décroissant)</option>
          <option value="rating">Meilleure note</option>
        </select>
      </div>
    </div>

    <!-- Filter chips -->
    <section class="mt-8 rounded-3xl border border-white/10 bg-white/5 p-5">
      <div class="flex flex-wrap gap-2">
        <button class="chip is-active" data-filter="sport" data-value="all">Tous</button>
        <button class="chip" data-filter="sport" data-value="football">Football</button>
        <button class="chip" data-filter="sport" data-value="tennis">Tennis</button>
        <button class="chip" data-filter="sport" data-value="natation">Natation</button>
        <button class="chip" data-filter="sport" data-value="athletisme">Athlétisme</button>
        <button class="chip" data-filter="sport" data-value="combat">Combat</button>
        <button class="chip" data-filter="sport" data-value="prepa">Prépa physique</button>
      </div>

      <div class="mt-4 grid gap-3 md:grid-cols-3">
        <select id="city" class="rounded-2xl border border-white/10 bg-carbon/30 px-4 py-3 text-slate-200 outline-none focus:border-white/20">
          <option value="all">Toutes les villes</option>
          <option value="Rabat">Rabat</option>
          <option value="Casablanca">Casablanca</option>
          <option value="Marrakech">Marrakech</option>
          <option value="Agadir">Agadir</option>
        </select>

        <div class="rounded-2xl border border-white/10 bg-carbon/30 px-4 py-3">
          <div class="flex items-center justify-between text-sm">
            <span class="text-slate-300">Prix max</span>
            <span id="priceLabel" class="text-lime font-semibold">300 MAD</span>
          </div>
          <input id="price" type="range" min="100" max="500" value="300" class="mt-2 w-full accent-lime">
        </div>

        <label class="flex items-center gap-3 rounded-2xl border border-white/10 bg-carbon/30 px-4 py-3">
          <input id="onlyAvailable" type="checkbox" class="h-5 w-5 accent-lime">
          <div>
            <div class="text-sm font-semibold">Uniquement disponibles</div>
            <div class="text-xs text-slate-400">Affiche ceux qui ont un créneau cette semaine</div>
          </div>
        </label>
      </div>
    </section>

    <!-- Cards -->
    <section class="mt-8">
      <div class="flex items-center justify-between">
        <div class="text-sm text-slate-400">Résultats: <span id="count" class="text-slate-200 font-semibold">0</span></div>
        <button id="reset" class="rounded-2xl border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold hover:border-white/20">Reset</button>
      </div>

      <div id="grid" class="mt-5 grid gap-4 sm:grid-cols-2 lg:grid-cols-3"></div>
      <div id="empty" class="mt-6 hidden rounded-3xl border border-white/10 bg-white/5 p-8 text-center text-slate-400">
        Aucun coach ne correspond à ces filtres.
      </div>
    </section>
  </main>

  <style>
    .chip{
      border:1px solid rgba(255,255,255,.10);
      background:rgba(255,255,255,.03);
      padding:10px 12px; border-radius:9999px;
      font-size:14px;
      transition: transform .14s cubic-bezier(.2,.8,.2,1), border-color .14s;
    }
    .chip:hover{ transform:translateY(-1px); border-color:rgba(154,255,0,.35); }
    .chip.is-active{ border-color:rgba(154,255,0,.55); background:rgba(154,255,0,.08); }
  </style>

  <script>
    // Sample data (replace later with API / backend)
    const coaches = [
      { id:1, name:"Sarah B.", sport:"prepa", sportLabel:"Prépa physique", city:"Rabat", price:200, rating:4.9, available:true,
        img:"https://images.unsplash.com/photo-1517836357463-d25dfeac3438?auto=format&fit=crop&w=900&q=80",
        tags:["Force","Mobility","Plan"],
      },
      { id:2, name:"Yassine K.", sport:"football", sportLabel:"Football", city:"Casablanca", price:150, rating:4.7, available:true,
        img:"https://images.unsplash.com/photo-1521412644187-c49fa049e84d?auto=format&fit=crop&w=900&q=80",
        tags:["Tactique","Technique","Cardio"],
      },
      { id:3, name:"Nora H.", sport:"tennis", sportLabel:"Tennis", city:"Marrakech", price:220, rating:4.8, available:false,
        img:"https://images.unsplash.com/photo-1530549387789-4c1017266634?auto=format&fit=crop&w=900&q=80",
        tags:["Service","Footwork","Match"],
      },
      { id:4, name:"Khalid M.", sport:"natation", sportLabel:"Natation", city:"Agadir", price:180, rating:4.6, available:true,
        img:"https://images.unsplash.com/photo-1526676037777-05a232554f77?auto=format&fit=crop&w=900&q=80",
        tags:["Technique","Souffle","Endurance"],
      },
      { id:5, name:"Aya Z.", sport:"combat", sportLabel:"Combat", city:"Casablanca", price:250, rating:4.9, available:true,
        img:"https://images.unsplash.com/photo-1549719386-74dfcbf7dbed?auto=format&fit=crop&w=900&q=80",
        tags:["Boxe","MMA","Conditioning"],
      },
      { id:6, name:"Omar T.", sport:"athletisme", sportLabel:"Athlétisme", city:"Rabat", price:160, rating:4.5, available:false,
        img:"https://images.unsplash.com/photo-1526401485004-2aa7b1b4f9c4?auto=format&fit=crop&w=900&q=80",
        tags:["Sprint","Explosivité","Forme"],
      },
    ];

    const els = {
      q: document.getElementById("q"),
      sort: document.getElementById("sort"),
      city: document.getElementById("city"),
      price: document.getElementById("price"),
      priceLabel: document.getElementById("priceLabel"),
      onlyAvailable: document.getElementById("onlyAvailable"),
      grid: document.getElementById("grid"),
      empty: document.getElementById("empty"),
      count: document.getElementById("count"),
      reset: document.getElementById("reset"),
      chips: Array.from(document.querySelectorAll(".chip"))
    };

    const state = { sport:"all" };

    function getQuerySport(){
      const params = new URLSearchParams(window.location.search);
      return params.get("sport") || "";
    }

    function setActiveChip(value){
      els.chips.forEach(c => c.classList.toggle("is-active", c.dataset.value === value));
    }

    function card(c){
      const avail = c.available
        ? `<span class="inline-flex items-center gap-2 rounded-full border border-lime/30 bg-lime/10 px-3 py-1 text-xs text-lime">
             <span class="h-2 w-2 rounded-full bg-lime"></span> Disponible
           </span>`
        : `<span class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs text-slate-300">
             <span class="h-2 w-2 rounded-full bg-slate-500"></span> Complet
           </span>`;

      return `
        <a href="coach.html?id=${c.id}"
           class="group overflow-hidden rounded-3xl border border-white/10 bg-white/5 shadow-soft transition hover:border-white/20">
          <div class="relative">
            <img src="${c.img}" alt="${c.name}" class="h-44 w-full object-cover brightness-90 transition group-hover:brightness-100">
            <div class="absolute inset-0 bg-gradient-to-t from-black/65 via-black/10 to-transparent"></div>
            <div class="absolute left-4 top-4">${avail}</div>
            <div class="absolute bottom-3 left-4 right-4">
              <div class="flex items-end justify-between">
                <div>
                  <div class="font-semibold text-lg">${c.name}</div>
                  <div class="text-sm text-slate-300">${c.sportLabel} • ${c.city}</div>
                </div>
                <div class="rounded-2xl bg-black/35 px-3 py-2 text-sm">
                  <span class="text-lime font-semibold">${c.price}</span> <span class="text-slate-300">MAD</span>
                </div>
              </div>
            </div>
          </div>

          <div class="p-4">
            <div class="flex items-center justify-between">
              <div class="text-sm text-slate-400">⭐ <span class="text-slate-200 font-semibold">${c.rating}</span></div>
              <div class="text-sm text-slate-400">${c.tags.slice(0,2).join(" • ")}</div>
            </div>
            <button class="mt-3 w-full rounded-2xl bg-lime px-4 py-2 text-sm font-semibold text-black hover:brightness-95">
              Voir profil
            </button>
          </div>
        </a>
      `;
    }

    function apply(){
      const q = els.q.value.trim().toLowerCase();
      const city = els.city.value;
      const maxPrice = +els.price.value;
      const onlyAvailable = els.onlyAvailable.checked;
      const sport = state.sport;
      const sort = els.sort.value;

      let list = coaches.filter(c => {
        const hit = (c.name + " " + c.sportLabel + " " + c.city).toLowerCase().includes(q);
        const sportOk = (sport === "all") || (c.sport === sport);
        const cityOk = (city === "all") || (c.city === city);
        const priceOk = c.price <= maxPrice;
        const availOk = !onlyAvailable || c.available;
        return hit && sportOk && cityOk && priceOk && availOk;
      });

      if(sort === "priceAsc") list.sort((a,b)=>a.price-b.price);
      if(sort === "priceDesc") list.sort((a,b)=>b.price-a.price);
      if(sort === "rating") list.sort((a,b)=>b.rating-a.rating);

      els.grid.innerHTML = list.map(card).join("");
      els.count.textContent = list.length;
      els.empty.classList.toggle("hidden", list.length !== 0);
    }

    // Init from URL param
    const urlSport = getQuerySport();
    if(urlSport){
      state.sport = urlSport;
      setActiveChip(urlSport);
    } else {
      setActiveChip("all");
    }

    els.priceLabel.textContent = `${els.price.value} MAD`;
    els.price.addEventListener("input", ()=>{
      els.priceLabel.textContent = `${els.price.value} MAD`;
      apply();
    });

    els.q.addEventListener("input", apply);
    els.sort.addEventListener("change", apply);
    els.city.addEventListener("change", apply);
    els.onlyAvailable.addEventListener("change", apply);

    els.chips.forEach(ch => ch.addEventListener("click", ()=>{
      state.sport = ch.dataset.value;
      setActiveChip(state.sport);
      apply();
    }));

    els.reset.addEventListener("click", ()=>{
      els.q.value = "";
      els.sort.value = "reco";
      els.city.value = "all";
      els.price.value = 300;
      els.priceLabel.textContent = `300 MAD`;
      els.onlyAvailable.checked = false;
      state.sport = "all";
      setActiveChip("all");
      apply();
    });

    // Cmd/Ctrl + K focus search
    window.addEventListener("keydown", (e)=>{
      const k = e.key.toLowerCase();
      if((e.ctrlKey || e.metaKey) && k === "k"){ e.preventDefault(); els.q.focus(); }
    });

    apply();
  </script>
</body>
</html>
