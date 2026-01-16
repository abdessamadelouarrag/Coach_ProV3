<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title><?= $errorCode ?? '404' ?> - Erreur</title>
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen flex items-center justify-center p-6">

<div class="max-w-2xl w-full text-center">
  <!-- Error Icon -->
  <div class="mb-8">
    <?php if (($errorCode ?? 404) == 404): ?>
      <!-- 404 Icon -->
      <div class="text-9xl font-bold text-lime-400/20 mb-4">404</div>
      <svg class="w-24 h-24 mx-auto text-lime-400/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
      </svg>
    <?php elseif (($errorCode ?? 404) == 403): ?>
      <!-- 403 Icon -->
      <div class="text-9xl font-bold text-red-400/20 mb-4">403</div>
      <svg class="w-24 h-24 mx-auto text-red-400/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
      </svg>
    <?php elseif (($errorCode ?? 404) == 500): ?>
      <!-- 500 Icon -->
      <div class="text-9xl font-bold text-orange-400/20 mb-4">500</div>
      <svg class="w-24 h-24 mx-auto text-orange-400/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
      </svg>
    <?php else: ?>
      <!-- Generic Error Icon -->
      <div class="text-9xl font-bold text-slate-400/20 mb-4"><?= $errorCode ?? 'ERR' ?></div>
      <svg class="w-24 h-24 mx-auto text-slate-400/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
      </svg>
    <?php endif; ?>
  </div>

  <!-- Error Message -->
  <div class="bg-white/5 border border-white/10 rounded-2xl p-8 mb-6">
    <h1 class="text-3xl font-bold mb-3">
      <?php
      $titles = [
        404 => 'Page introuvable',
        403 => 'Accès refusé',
        500 => 'Erreur serveur',
      ];
      echo $titles[$errorCode ?? 404] ?? 'Une erreur est survenue';
      ?>
    </h1>
    
    <p class="text-slate-300 text-lg mb-6">
      <?php
      if (isset($errorMessage)) {
        echo htmlspecialchars($errorMessage);
      } else {
        $messages = [
          404 => 'La page que vous recherchez n\'existe pas ou a été déplacée.',
          403 => 'Vous n\'avez pas l\'autorisation d\'accéder à cette ressource.',
          500 => 'Une erreur inattendue s\'est produite. Nos équipes ont été notifiées.',
        ];
        echo $messages[$errorCode ?? 404] ?? 'Quelque chose s\'est mal passé.';
      }
      ?>
    </p>

    <?php if (isset($errorDetails) && !empty($errorDetails)): ?>
      <div class="bg-red-500/10 border border-red-500/20 rounded-xl p-4 mb-6 text-left">
        <div class="text-xs text-red-300 font-mono">
          <?= htmlspecialchars($errorDetails) ?>
        </div>
      </div>
    <?php endif; ?>

    <!-- Action Buttons -->
    <div class="flex flex-col sm:flex-row gap-3 justify-center">
      <a href="javascript:history.back()" class="inline-block bg-white/5 border border-white/10 text-slate-100 font-semibold px-6 py-3 rounded-xl hover:bg-white/10 transition">
        ← Retour
      </a>
      
      <a href="/" class="inline-block bg-lime-400 text-slate-950 font-semibold px-6 py-3 rounded-xl hover:bg-lime-300 transition">
        Accueil
      </a>
      
      <?php if (isset($_SESSION['user'])): ?>
        <?php if ($_SESSION['user']['role'] === 'coach'): ?>
          <a href="/coach" class="inline-block bg-indigo-500 text-white font-semibold px-6 py-3 rounded-xl hover:bg-indigo-600 transition">
            Mon Dashboard
          </a>
        <?php else: ?>
          <a href="/sportif" class="inline-block bg-indigo-500 text-white font-semibold px-6 py-3 rounded-xl hover:bg-indigo-600 transition">
            Mon Espace
          </a>
        <?php endif; ?>
      <?php endif; ?>
    </div>
  </div>

  <!-- Help Section -->
  <div class="text-sm text-slate-400">
    <p>Besoin d'aide ? 
      <a href="mailto:support@coachpro.com" class="text-lime-400 hover:text-lime-300 underline">
        Contactez le support
      </a>
    </p>
  </div>
</div>

</body>
</html>