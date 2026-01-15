<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>CoachLink — Disponibilités coach</title>
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

  <header class="border-b border-white/10 bg-carbon/30 backdrop-blur-xl">
    <div class="mx-auto flex max-w-6xl items-center justify-between px-5 py-4">
      <a href="sportif.html" class="text-sm text-slate-300 hover:text-white">← Retour</a>
      <div class="font-display">Disponibilités</div>
      <a href="dashboard-sportif.html" class="rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold hover:bg-white/10">
        Mes réservations
      </a>
    </div>
  </header>

  <main class="mx-auto max-w-6xl px-5 py-10">
    <section id="coachCard" class="overflow-hidden rounded-[30px] border border-white/10 bg-white/5 shadow-soft"></section>

    <section class="mt-6 rounded-[30px] border border-white/10 bg-white/5 p-6 shadow-soft">
      <div class="flex items-end justify-between gap-3">
        <div>
          <h2 class="font-display text-2xl">Heures disponibles</h2>
          <p class="mt-1 text-sm text-slate-400">Choisis une séance libre pour réserver.</p>
        </div>
        <span id="freeCount" class="rounded-full border border-white/10 bg-white/10 px-3 py-1 text-xs text-slate-200"></span>
      </div>

      <div id="slots" class="mt-5 grid gap-3 sm:grid-cols-2 lg:grid-cols-3"></div>
      <p id="toast" class="mt-4 hidden rounded-2xl border border-lime/30 bg-lime/10 p-3 text-sm text-lime"></p>
    </section>
  </main>

  <script>
    // ===== Demo data (same as sportif.html)
    const coaches = [
      { id: 1, nom: "Yassine", prenom:"A.", sport: "Football", ville:"Agadir", price: 250, rating: 4.9,
        img:"https://images.unsplash.com/photo-1521412644187-c49fa049e84d?auto=format&fit=crop&w=1400&q=70"
      },
      { id: 2, nom: "Sara", prenom:"E.", sport: "Prépa physique", ville:"Marrakech", price: 200, rating: 4.8,
        img:"https://images.unsplash.com/photo-1517836357463-d25dfeac3438?auto=format&fit=crop&w=1400&q=70"
      },
      { id: 3, nom: "Hamza", prenom:"K.", sport: "Boxe", ville:"Casablanca", price: 300, rating: 4.7,
        img:"https://images.unsplash.com/photo-1549719386-74dfcbf7dbed?auto=format&fit=crop&w=1400&q=70"
      }
    ];

    let seances = [
      { id_seance: 101, coach_id: 1, date:"2026-01-20", time:"18:00", status:"libre" },
      { id_seance: 102, coach_id: 1, date:"2026-01-21", time:"10:00", status:"libre" },
      { id_seance: 103, coach_id: 1, date:"2026-01-21", time:"18:00", status:"reserve" },

      { id_seance: 201, coach_id: 2, date:"2026-01-19", time:"09:00", status:"libre" },
      { id_seance: 202, coach_id: 2, date:"2026-01-19", time:"18:00", status:"libre" },

      { id_seance: 301, coach_id: 3, date:"2026-01-22", time:"20:00", status:"reserve" }
    ];

    const RES_KEY = "coachlink_reservations_demo";
    const toast = document.getElementById("toast");

    // get coach id from url
    const params = new URLSearchParams(location.search);
    const id = Number(params.get("id") || 1);
    const coach = coaches.find(c => c.id === id) || coaches[0];

    // render coach top card
    const coachCard = document.getElementById("coachCard");
    coachCard.innerHTML = `
      <div class="relative">
        <div class="aspect-[16/6]">
          <img class="h-full w-full object-cover opacity-90" src="${coach.img}" alt="${coach.nom}">
        </div>
        <div class="absolute inset-0 bg-gradient-to-t from-carbon/90 via-carbon/20 to-transparent"></div>

        <div class="absolute bottom-0 left-0 right-0 p-6">
          <div class="flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
            <div>
              <h1 class="font-display text-3xl">${coach.nom} ${coach.prenom}</h1>
              <div class="mt-2 text-slate-300">${coach.sport} • ${coach.ville}</div>
              <div class="mt-2 text-sm text-slate-400">⭐ ${coach.rating.toFixed(1)} • Tarif: ${coach.price} MAD</div>
            </div>
            <a href="sportif.html" class="rounded-2xl border border-white/10 bg-white/10 px-5 py-3 text-sm font-semibold hover:bg-white/15">
              Changer de coach
            </a>
          </div>
        </div>
      </div>
    `;

    // render free slots
    const slotsEl = document.getElementById("slots");
    const freeCount = document.getElementById("freeCount");

    function loadReservations(){
      return JSON.parse(localStorage.getItem(RES_KEY) || "[]");
    }
    function saveReservations(items){
      localStorage.setItem(RES_KEY, JSON.stringify(items));
    }

    function renderSlots() {
      const free = seances.filter(s => s.coach_id === coach.id && s.status === "libre");
      freeCount.textContent = `${free.length} séance(s) libre(s)`;

      if (!free.length) {
        slotsEl.innerHTML = `
          <div class="col-span-full rounded-2xl border border-white/10 bg-white/5 p-6 text-center text-slate-300">
            Aucune séance libre pour ce coach.
          </div>
        `;
        return;
      }

      slotsEl.innerHTML = free.map(s => `
        <button data-id="${s.id_seance}"
          class="text-left rounded-[24px] border border-white/10 bg-white/5 p-4 shadow-soft transition hover:-translate-y-0.5 hover:border-lime/30">
          <div class="text-xs text-slate-400">Séance</div>
          <div class="mt-1 text-lg font-semibold">${s.date}</div>
          <div class="mt-1 text-sm text-slate-300">⏰ ${s.time}</div>
          <div class="mt-3 inline-flex items-center gap-2 rounded-full border border-lime/40 bg-lime/10 px-3 py-1 text-xs text-lime">
            Libre
          </div>
          <div class="mt-4 text-sm font-semibold text-slate-200">Réserver →</div>
        </button>
      `).join("");

      document.querySelectorAll("#slots button").forEach(btn => {
        btn.addEventListener("click", () => reserve(Number(btn.dataset.id)));
      });
    }

    function reserve(seanceId) {
      // mark seance reserved (demo)
      const idx = seances.findIndex(s => s.id_seance === seanceId);
      if (idx === -1) return;
      if (seances[idx].status !== "libre") return;

      seances[idx].status = "reserve";

      // save reservation demo
      const reservations = loadReservations();
      reservations.unshift({
        id_reserv: Date.now(),
        id_seance: seanceId,
        coach_id: coach.id,
        coach_name: coach.nom + " " + coach.prenom,
        sport: coach.sport,
        date: seances[idx].date,
        time: seances[idx].time,
        status: "en_attent"
      });
      saveReservations(reservations);

      toast.textContent = "✅ Réservation envoyée (status: en_attent). Va sur 'Mes réservations' pour la voir.";
      toast.classList.remove("hidden");

      renderSlots();
    }

    renderSlots();
  </script>
</body>
</html>
