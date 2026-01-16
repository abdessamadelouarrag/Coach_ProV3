<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>CoachLink — Dashboard Coach</title>
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
          <div class="text-xs text-slate-400">Dashboard Coach</div>
        </div>
      </a>

      <div class="flex items-center gap-2">
        <a href="coach-profile.html" class="rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold hover:bg-white/10">
          Mon profil
        </a>
        <a href="login.html" class="rounded-xl bg-lime px-4 py-2 text-sm font-semibold text-black hover:brightness-110">
          Logout
        </a>
      </div>
    </div>
  </header>

  <main class="mx-auto max-w-6xl px-5 py-10">
    <!-- header -->
    <div class="flex flex-col gap-2 md:flex-row md:items-end md:justify-between">
      <div>
        <h1 class="font-display text-3xl">Bonjour, Coach</h1>
        <p class="mt-1 text-slate-400">Gère tes disponibilités et tes réservations.</p>
      </div>

      <div class="flex gap-2">
        <button id="seedBtn" class="rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold hover:bg-white/10">
          Demo data
        </button>
        <button id="clearBtn" class="rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold hover:bg-white/10">
          Reset
        </button>
      </div>
    </div>

    <!-- stats -->
    <section class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
      <div class="rounded-[26px] border border-white/10 bg-white/5 p-5 shadow-soft">
        <div class="text-xs text-slate-400">Réservations (total)</div>
        <div id="statTotal" class="mt-2 font-display text-3xl">0</div>
        <div class="mt-2 text-xs text-slate-500">Toutes demandes</div>
      </div>

      <div class="rounded-[26px] border border-white/10 bg-white/5 p-5 shadow-soft">
        <div class="text-xs text-slate-400">En attente</div>
        <div id="statPending" class="mt-2 font-display text-3xl">0</div>
        <div class="mt-2 text-xs text-slate-500">à accepter / refuser</div>
      </div>

      <div class="rounded-[26px] border border-white/10 bg-white/5 p-5 shadow-soft">
        <div class="text-xs text-slate-400">Acceptées</div>
        <div id="statAccepted" class="mt-2 font-display text-3xl">0</div>
        <div class="mt-2 text-xs text-slate-500">séances validées</div>
      </div>

      <div class="rounded-[26px] border border-white/10 bg-white/5 p-5 shadow-soft">
        <div class="text-xs text-slate-400">Disponibilités libres</div>
        <div id="statFreeSlots" class="mt-2 font-display text-3xl">0</div>
        <div class="mt-2 text-xs text-slate-500">créneaux ouverts</div>
      </div>
    </section>

    <!-- content -->
    <section class="mt-6 grid gap-4 lg:grid-cols-3">
      <!-- Add availability -->
      <div class="lg:col-span-1 rounded-[30px] border border-white/10 bg-white/5 p-6 shadow-soft">
        <div class="flex items-end justify-between">
          <div>
            <h2 class="font-display text-xl">Ajouter disponibilité</h2>
            <p class="mt-1 text-sm text-slate-400">Crée des séances “libres”.</p>
          </div>
          <span class="rounded-full border border-lime/40 bg-lime/10 px-3 py-1 text-xs text-lime">Dispo</span>
        </div>

        <form id="dispoForm" class="mt-5 grid gap-3">
          <div>
            <label class="text-xs font-semibold text-slate-300">Date</label>
            <input id="dDate" type="date" required
              class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm outline-none focus:border-cyanx/40" />
          </div>
          <div>
            <label class="text-xs font-semibold text-slate-300">Heure Debut</label>
            <input name="date_start" type="time" required
              class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm outline-none focus:border-cyanx/40" />
          </div>
          <div>
            <label class="text-xs font-semibold text-slate-300">Heure Fin</label>
            <input name="date_end" type="time" required
              class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm outline-none focus:border-cyanx/40" />
          </div>

          <button type="submit" class="mt-2 w-full rounded-2xl bg-lime px-5 py-3 font-semibold text-black hover:brightness-110">
            Ajouter
          </button>

          <p id="msg" class="hidden rounded-2xl border border-lime/30 bg-lime/10 p-3 text-sm text-lime"></p>
          <p id="err" class="hidden rounded-2xl border border-red-500/30 bg-red-500/10 p-3 text-sm text-red-200"></p>
        </form>
      </div>

      <!-- Reservations -->
      <div class="lg:col-span-2 rounded-[30px] border border-white/10 bg-white/5 p-6 shadow-soft">
        <div class="flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
          <div>
            <h2 class="font-display text-xl">Réservations</h2>
            <p class="mt-1 text-sm text-slate-400">Accepte / Refuse les demandes.</p>
          </div>

          <select id="filterRes"
            class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm outline-none focus:border-cyanx/40">
            <option value="all">Toutes</option>
            <option value="en_attent">En attente</option>
            <option value="accept">Acceptées</option>
            <option value="refuser">Refusées</option>
          </select>
        </div>

        <div id="reservations" class="mt-5 grid gap-3"></div>
      </div>
    </section>

    <!-- All availabilities -->
    <section class="mt-4 rounded-[30px] border border-white/10 bg-white/5 p-6 shadow-soft">
      <div class="flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
        <div>
          <h2 class="font-display text-xl">Toutes mes disponibilités</h2>
          <p class="mt-1 text-sm text-slate-400">Supprime un créneau si besoin.</p>
        </div>

        <select id="filterSlots"
          class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm outline-none focus:border-cyanx/40">
          <option value="all">Tout</option>
          <option value="libre">Libre</option>
          <option value="reserve">Réservé</option>
        </select>
      </div>

      <div id="slots" class="mt-5 grid gap-3 sm:grid-cols-2 lg:grid-cols-3"></div>
    </section>
  </main>
</body>
</html>
