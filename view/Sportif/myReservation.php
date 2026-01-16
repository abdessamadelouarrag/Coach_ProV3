<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Mes Réservations</title>
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen">

<div class="max-w-5xl mx-auto p-6">
  <div class="flex items-center justify-between mb-6">
    <div>
      <h1 class="text-3xl font-bold">Mes Réservations</h1>
      <p class="text-slate-400 mt-1">Gérez vos séances avec les coachs</p>
    </div>
    <a href="/home" class="text-slate-300 hover:text-white">← Retour</a>
  </div>

  <!-- Flash Messages -->
  <?php if (isset($_SESSION['flash_success'])): ?>
    <div class="mb-6 bg-lime-500/20 border border-lime-500/50 text-lime-300 px-4 py-3 rounded-xl">
      <?= htmlspecialchars($_SESSION['flash_success']) ?>
      <?php unset($_SESSION['flash_success']); ?>
    </div>
  <?php endif; ?>

  <?php if (isset($_SESSION['flash_error'])): ?>
    <div class="mb-6 bg-red-500/20 border border-red-500/50 text-red-300 px-4 py-3 rounded-xl">
      <?= htmlspecialchars($_SESSION['flash_error']) ?>
      <?php unset($_SESSION['flash_error']); ?>
    </div>
  <?php endif; ?>

  <?php if (empty($reservations)): ?>
    <!-- Empty State -->
    <div class="bg-white/5 border border-white/10 rounded-2xl p-12 text-center">
      <h2 class="text-xl font-semibold mb-2">Aucune réservation</h2>
      <p class="text-slate-400 mb-6">Vous n'avez pas encore réservé de séance avec un coach</p>
      <a href="/home" class="inline-block bg-lime-400 text-slate-950 font-semibold px-6 py-3 rounded-xl hover:bg-lime-300 transition">
        Trouver un Coach
      </a>
    </div>
  <?php else: ?>
    <!-- Reservations List -->
    <div class="space-y-4">
      <?php 
      $now = new DateTime();
      foreach ($reservations as $r): 
        $reservationDateTime = new DateTime($r['date_dispo'] . ' ' . $r['start_time']);
        $isPast = $reservationDateTime < $now;
        $isCancelled = $r['status'] === 'cancelled';
      ?>
        <div class="bg-white/5 border border-white/10 rounded-2xl overflow-hidden hover:bg-white/10 transition">
          <div class="p-6">
            <div class="flex items-start justify-between gap-4 flex-wrap">
              <!-- Coach Info -->
              <div class="flex items-center gap-4 flex-1 min-w-[250px]">
                <div class="w-16 h-16 bg-white/10 rounded-xl overflow-hidden flex-shrink-0">
                  <img src="/assets/images/coach.jpg" alt="" class="w-full h-full object-cover">
                </div>
                <div>
                  <h3 class="font-semibold text-lg"><?= htmlspecialchars($r['coach_name']) ?></h3>
                  <p class="text-sm text-slate-400"><?= htmlspecialchars($r['domain'] ?? 'Coach') ?></p>
                  <?php if (!empty($r['exp'])): ?>
                    <p class="text-xs text-slate-500"><?= htmlspecialchars($r['exp']) ?> ans d'expérience</p>
                  <?php endif; ?>
                </div>
              </div>

              <!-- Date & Time -->
              <div class="flex-1 min-w-[200px]">
                <div class="text-xs text-slate-400 mb-1">📅 Date</div>
                <div class="font-semibold mb-3">
                  <?= date('d/m/Y', strtotime($r['date_dispo'])) ?>
                </div>
                
                <div class="flex items-center gap-2">
                  <span class="px-3 py-1 rounded-lg bg-emerald-500/20 text-emerald-300 text-sm">
                    <?= htmlspecialchars($r['start_time']) ?>
                  </span>
                  <span class="text-slate-400">→</span>
                  <span class="px-3 py-1 rounded-lg bg-indigo-500/20 text-indigo-300 text-sm">
                    <?= htmlspecialchars($r['end_time']) ?>
                  </span>
                </div>
              </div>

              <!-- Status & Actions -->
              <div class="flex flex-col items-end gap-2 min-w-[150px]">
                <?php if ($isCancelled): ?>
                  <span class="px-3 py-1 rounded-lg bg-red-500/20 text-red-300 text-sm">
                    Annulée
                  </span>
                <?php elseif ($isPast): ?>
                  <span class="px-3 py-1 rounded-lg bg-slate-500/20 text-slate-400 text-sm">
                    Terminée
                  </span>
                <?php else: ?>
                  <span class="px-3 py-1 rounded-lg bg-lime-500/20 text-lime-300 text-sm">
                    Confirmée
                  </span>
                  
                  <!-- Cancel Button -->
                  <form method="POST" action="/reservation/cancel" onsubmit="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?');">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($r['id']) ?>">
                    <button type="submit" class="text-sm text-red-400 hover:text-red-300 underline">
                      Annuler
                    </button>
                  </form>
                <?php endif; ?>
                
                <div class="text-xs text-slate-500">
                  Réservé le <?= date('d/m/Y', strtotime($r['created_at'])) ?>
                </div>
              </div>
            </div>

            <!-- Contact Info -->
            <?php if (!$isCancelled && !$isPast && !empty($r['coach_email'])): ?>
              <div class="mt-4 pt-4 border-t border-white/10">
                <div class="text-xs text-slate-400">Contact: 
                  <a href="mailto:<?= htmlspecialchars($r['coach_email']) ?>" class="text-indigo-300 hover:text-indigo-200">
                    <?= htmlspecialchars($r['coach_email']) ?>
                  </a>
                </div>
              </div>
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>

</body>
</html>