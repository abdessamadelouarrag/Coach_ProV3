<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>CoachLink – Espace Sportif</title>
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
      <a href="/" class="flex items-center gap-3">
        <span class="grid h-10 w-10 place-items-center rounded-2xl border border-white/10 bg-white/5 shadow-soft">
          <span class="h-2.5 w-2.5 rounded-full bg-lime"></span>
        </span>
        <div class="leading-tight">
          <div class="font-display text-lg">CoachLink</div>
          <div class="text-xs text-slate-400">Sportif</div>
        </div>
      </a>

      <div class="flex items-center gap-2">
        <span class="text-sm text-slate-300">
          Bonjour, <span class="font-semibold"><?= htmlspecialchars($_SESSION['user']['full_name'] ?? 'Sportif') ?></span>
        </span>
        <a href="/logout" class="rounded-xl bg-lime px-4 py-2 text-sm font-semibold text-black hover:brightness-110">
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
    </div>

    <?php if (isset($_SESSION['flash_success'])): ?>
      <div class="mt-4 rounded-2xl border border-lime/30 bg-lime/10 p-4 text-lime">
        <?= htmlspecialchars($_SESSION['flash_success']) ?>
      </div>
      <?php unset($_SESSION['flash_success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['flash_error'])): ?>
      <div class="mt-4 rounded-2xl border border-red-500/30 bg-red-500/10 p-4 text-red-200">
        <?= htmlspecialchars($_SESSION['flash_error']) ?>
      </div>
      <?php unset($_SESSION['flash_error']); ?>
    <?php endif; ?>

    <div class="mt-6 flex items-center justify-between">
      <div id="count" class="text-sm text-slate-400">
        <?= count($all) ?> coach(es) disponible(s)
      </div>
    </div>

    <div id="grid" class="mt-4 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
      <?php if (empty($all)): ?>
        <div class="col-span-full text-center py-12">
          <p class="text-slate-400">Aucun coach disponible pour le moment.</p>
        </div>
      <?php else: ?>
        <?php foreach($all as $coach): ?>
          <a href="/coach/profile?id=<?= $coach['coach_id'] ?>" 
             class="group overflow-hidden rounded-[26px] border border-white/10 bg-white/5 shadow-soft transition hover:-translate-y-0.5 hover:border-lime/30 block">
            
            <div class="relative aspect-[4/3] bg-gradient-to-br from-cyanx/20 to-lime/20">
              <div class="absolute inset-0 bg-gradient-to-t from-carbon/90 via-carbon/40 to-transparent"></div>
              
              <div class="absolute left-4 top-4 flex gap-2">
                <span class="rounded-full border border-white/10 bg-white/10 px-3 py-1 text-xs text-slate-200">
                  <?= htmlspecialchars($coach['domain'] ?? 'Sport') ?>
                </span>
                <span class="rounded-full border border-lime/40 bg-lime/10 px-3 py-1 text-xs text-lime">
                  Disponible
                </span>
              </div>

              <div class="absolute bottom-4 left-4 right-4">
                <h3 class="text-xl font-semibold text-white">
                  <?= htmlspecialchars($coach['full_name']) ?>
                </h3>
              </div>
            </div>

            <div class="p-5">
              <div class="flex items-start justify-between gap-3">
                <div class="flex-1">
                  <div class="text-sm text-slate-400 line-clamp-2">
                    <?= htmlspecialchars($coach['bio'] ?? 'Coach professionnel') ?>
                  </div>
                </div>
                <div class="rounded-xl border border-white/10 bg-white/5 px-3 py-2 text-sm whitespace-nowrap">
                  <span class="font-semibold text-white"><?= (int)($coach['exp'] ?? 0) ?>+ ans</span>
                </div>
              </div>

              <div class="mt-4 flex items-center justify-between">
                <div class="text-sm text-slate-300">
                  <span class="font-semibold text-white"><?= htmlspecialchars($coach['email']) ?></span>
                </div>
                <div class="text-sm font-semibold text-slate-200 group-hover:text-lime">
                  Voir heures →
                </div>
              </div>
            </div>
          </a>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </main>
</body>
</html>