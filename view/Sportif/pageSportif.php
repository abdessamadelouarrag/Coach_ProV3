<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>CoachLink — Espace Sportif</title>
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
          <div class="text-xs text-slate-400">Sportif</div>
        </div>
      </a>

      <div class="flex items-center gap-2">
        <a href="dashboard-sportif.html" class="rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold hover:bg-white/10">
          Mes réservations
        </a>
        <a href="login.html" class="rounded-xl bg-lime px-4 py-2 text-sm font-semibold text-black hover:brightness-110">
          Logout
        </a>
      </div>
    </div>
  </header>

  <main class="mx-auto max-w-6xl px-5 py-10">
    <div class="flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
      <div>
        <h1 class="font-display text-3xl">Coachs disponibles</h1>
        <p class="mt-1 text-slate-400">Clique sur un coach pour voir ses heures libres.</p>
      </div>

      <div class="flex flex-col gap-2 sm:flex-row sm:items-center">
        <input id="q" type="text" placeholder="Search: nom, sport, ville..."
          class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm outline-none placeholder:text-slate-500 focus:border-cyanx/40 sm:w-[320px]"/>
        <select id="sport"
          class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm outline-none focus:border-cyanx/40">
          <option value="all">Tous sports</option>
        </select>
      </div>
    </div>

    <div class="mt-6 flex items-center justify-between">
      <div id="count" class="text-sm text-slate-400"></div>
      <div class="text-xs text-slate-500">Disponibilité = au moins 1 séance “libre”.</div>
    </div>

    <div id="grid" class="mt-4 grid gap-4 sm:grid-cols-2 lg:grid-cols-3"></div>
  </main>

  <script>
    // ====== Demo data (replace with DB later)
    const coaches = [
      { id: 1, nom: "Yassine", prenom:"A.", sport: "Football", ville:"Agadir", price: 250, rating: 4.9,
        img:"https://images.unsplash.com/photo-1521412644187-c49fa049e84d?auto=format&fit=crop&w=1200&q=70"
      },
      { id: 2, nom: "Sara", prenom:"E.", sport: "Prépa physique", ville:"Marrakech", price: 200, rating: 4.8,
        img:"https://images.unsplash.com/photo-1517836357463-d25dfeac3438?auto=format&fit=crop&w=1200&q=70"
      },
      { id: 3, nom: "Hamza", prenom:"K.", sport: "Boxe", ville:"Casablanca", price: 300, rating: 4.7,
        img:"https://images.unsplash.com/photo-1549719386-74dfcbf7dbed?auto=format&fit=crop&w=1200&q=70"
      }
    ];

    // ====== Demo seances (coach schedule)
    // status: libre | reserve
    const seances = [
      { id_seance: 101, coach_id: 1, date:"2026-01-20", time:"18:00", status:"libre" },
      { id_seance: 102, coach_id: 1, date:"2026-01-21", time:"10:00", status:"libre" },
      { id_seance: 103, coach_id: 1, date:"2026-01-21", time:"18:00", status:"reserve" },

      { id_seance: 201, coach_id: 2, date:"2026-01-19", time:"09:00", status:"libre" },
      { id_seance: 202, coach_id: 2, date:"2026-01-19", time:"18:00", status:"libre" },

      { id_seance: 301, coach_id: 3, date:"2026-01-22", time:"20:00", status:"reserve" } // no free => coach not shown
    ];

    // ====== Helpers
    const grid = document.getElementById("grid");
    const count = document.getElementById("count");
    const q = document.getElementById("q");
    const sportSel = document.getElementById("sport");

    // sports options
    const sports = [...new Set(coaches.map(c => c.sport))];
    sportSel.innerHTML += sports.map(s => `<option value="${s}">${s}</option>`).join("");

    function coachHasFreeSeance(coachId) {
      return seances.some(s => s.coach_id === coachId && s.status === "libre");
    }

    function render() {
      const query = q.value.trim().toLowerCase();
      const sport = sportSel.value;

      // only coaches who have at least one free seance
      let list = coaches.filter(c => coachHasFreeSeance(c.id));

      // filter
      if (sport !== "all") list = list.filter(c => c.sport === sport);
      if (query) {
        list = list.filter(c => (`${c.nom} ${c.prenom} ${c.sport} ${c.ville}`).toLowerCase().includes(query));
      }

      count.textContent = `${list.length} coach(s) disponible(s)`;

      if (!list.length) {
        grid.innerHTML = `
          <div class="col-span-full rounded-[26px] border border-white/10 bg-white/5 p-8 text-center text-slate-300">
            Aucun coach disponible avec ces filtres.
          </div>
        `;
        return;
      }

      grid.innerHTML = list.map(c => `
        <a href="/details"
           class="group overflow-hidden rounded-[26px] border border-white/10 bg-white/5 shadow-soft transition hover:-translate-y-0.5 hover:border-lime/30">
          <div class="relative aspect-[4/3]">
            <img class="h-full w-full object-cover opacity-90" src="${c.img}" alt="${c.nom}">
            <div class="absolute inset-0 bg-gradient-to-t from-carbon/80 via-carbon/10 to-transparent"></div>
            <div class="absolute left-4 top-4 flex gap-2">
              <span class="rounded-full border border-white/10 bg-white/10 px-3 py-1 text-xs text-slate-200">${c.sport}</span>
              <span class="rounded-full border border-lime/40 bg-lime/10 px-3 py-1 text-xs text-lime">Disponible</span>
            </div>
          </div>

          <div class="p-5">
            <div class="flex items-start justify-between gap-3">
              <div>
                <div class="text-lg font-semibold">${c.nom} ${c.prenom}</div>
                <div class="mt-1 text-sm text-slate-400">${c.ville}</div>
              </div>
              <div class="rounded-xl border border-white/10 bg-white/5 px-3 py-2 text-sm">
                ⭐ <span class="font-semibold text-white">${c.rating.toFixed(1)}</span>
              </div>
            </div>

            <div class="mt-4 flex items-center justify-between">
              <div class="text-sm text-slate-300">
                À partir de <span class="font-semibold text-white">${c.price} MAD</span>
              </div>
              <div class="text-sm font-semibold text-slate-200 group-hover:text-lime">Voir heures →</div>
            </div>
          </div>
        </a>
      `).join("");
    }

    q.addEventListener("input", render);
    sportSel.addEventListener("change", render);

    render();
  </script>
</body>
</html>
