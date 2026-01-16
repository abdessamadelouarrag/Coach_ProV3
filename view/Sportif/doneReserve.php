<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Réservation Confirmée</title>
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen flex items-center justify-center p-6">

<div class="max-w-2xl w-full">
  <!-- Success Animation Container -->
  <div class="text-center mb-8">
    <div class="inline-flex items-center justify-center w-24 h-24 bg-lime-400/20 rounded-full mb-4 animate-pulse">
      <svg class="w-12 h-12 text-lime-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
      </svg>
    </div>
    <h1 class="text-3xl font-bold text-lime-400 mb-2">Réservation Confirmée !</h1>
    <p class="text-slate-300">Votre séance avec le coach est réservée</p>
  </div>

  <!-- Reservation Details Card -->
  <div class="bg-white/5 border border-white/10 rounded-2xl overflow-hidden">
    <div class="bg-gradient-to-r from-lime-500/20 to-emerald-500/20 p-6 border-b border-white/10">
      <h2 class="text-xl font-semibold">Détails de la Réservation</h2>
    </div>

    <div class="p-6 space-y-4">
      <!-- Coach Info -->
      <div class="flex items-center gap-4 pb-4 border-b border-white/10">
        <div class="w-16 h-16 bg-white/10 rounded-xl overflow-hidden">
          <img src="/assets/images/coach.jpg" alt="" class="w-full h-full object-cover">
        </div>
        <div>
          <div class="font-semibold text-lg"><?= htmlspecialchars($coach['full_name'] ?? 'Coach') ?></div>
          <div class="text-sm text-slate-400"><?= htmlspecialchars($profile['domain'] ?? '') ?></div>
        </div>
      </div>

      <!-- Session Details -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-white/5 border border-white/10 rounded-xl p-4">
          <div class="text-xs text-slate-400 mb-1">📅 Date</div>
          <div class="font-semibold">
            <?php 
            // Format date nicely if available
            if (isset($_GET['date'])) {
                echo htmlspecialchars($_GET['date']);
            }
            ?>
          </div>
        </div>

        <div class="bg-white/5 border border-white/10 rounded-xl p-4">
          <div class="text-xs text-slate-400 mb-1">⏰ Horaire</div>
          <div class="font-semibold">
            <?php 
            if (isset($_GET['start']) && isset($_GET['end'])) {
                echo htmlspecialchars($_GET['start']) . ' - ' . htmlspecialchars($_GET['end']);
            }
            ?>
          </div>
        </div>
      </div>

      <!-- Contact Info -->
      <?php if (!empty($coach['email'])): ?>
      <div class="bg-indigo-500/10 border border-indigo-500/20 rounded-xl p-4">
        <div class="text-xs text-indigo-300 mb-1">📧 Contact</div>
        <div class="text-indigo-200"><?= htmlspecialchars($coach['email']) ?></div>
      </div>
      <?php endif; ?>

      <!-- Info Message -->
      <div class="bg-blue-500/10 border border-blue-500/20 rounded-xl p-4">
        <p class="text-sm text-blue-200">
          💡 Un email de confirmation a été envoyé. N'oubliez pas d'arriver 5 minutes en avance !
        </p>
      </div>
    </div>
  </div>

  <!-- Action Buttons -->
  <div class="mt-6 flex gap-4">
    <a href="/reservations" class="flex-1 bg-lime-400 text-slate-950 font-semibold px-6 py-3 rounded-xl hover:bg-lime-300 transition text-center">
      Voir Mes Réservations
    </a>
    <a href="/home" class="flex-1 bg-white/5 border border-white/10 text-slate-100 font-semibold px-6 py-3 rounded-xl hover:bg-white/10 transition text-center">
      Retour à l'Accueil
    </a>
  </div>
</div>

</body>
</html>