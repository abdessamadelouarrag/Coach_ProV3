<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Mes Réservations</title>
</head>

<body class="bg-slate-950 text-slate-100 min-h-screen">
    <div class="max-w-5xl mx-auto p-6">
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold">Mes Réservations</h1>
            <a href="/sportif" class="text-slate-300 hover:text-white">← Retour</a>
        </div>

        <!-- Flash Messages -->
        <?php if (isset($_SESSION['flash_success'])): ?>
            <div class="mt-4 bg-lime-500/20 border border-lime-500/50 text-lime-300 px-4 py-3 rounded-xl">
                <?= htmlspecialchars($_SESSION['flash_success']) ?>
                <?php unset($_SESSION['flash_success']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['flash_error'])): ?>
            <div class="mt-4 bg-red-500/20 border border-red-500/50 text-red-300 px-4 py-3 rounded-xl">
                <?= htmlspecialchars($_SESSION['flash_error']) ?>
                <?php unset($_SESSION['flash_error']); ?>
            </div>
        <?php endif; ?>

        <div class="mt-8 bg-white/5 border border-white/10 rounded-2xl overflow-hidden">
            <?php if (empty($reservations)): ?>
                <div class="p-8 text-center text-slate-400">
                    <div class="text-4xl mb-4">📅</div>
                    <p class="text-lg">Aucune réservation pour le moment</p>
                    <a href="/sportif" class="inline-block mt-4 bg-lime-400 text-slate-950 font-semibold px-6 py-2 rounded-xl hover:bg-lime-300 transition">
                        Trouver un coach
                    </a>
                </div>
            <?php else: ?>
                <div class="p-4 space-y-4">
                    <?php foreach ($reservations as $res): ?>
                        <div class="bg-white/5 border border-white/10 rounded-2xl p-6">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <div class="flex items-start justify-between">
                                        <div>
                                            <h3 class="text-xl font-semibold"><?= htmlspecialchars($res['coach_name']) ?></h3>
                                            <p class="text-sm text-slate-400"><?= htmlspecialchars($res['coach_email']) ?></p>
                                        </div>
                                        <div>
                                            <?php if ($res['status'] === 'pending'): ?>
                                                <span class="px-3 py-1 rounded-lg bg-yellow-500/20 text-yellow-300 text-sm font-semibold">
                                                    En attente
                                                </span>
                                            <?php elseif ($res['status'] === 'confirmed'): ?>
                                                <span class="px-3 py-1 rounded-lg bg-green-500/20 text-green-300 text-sm font-semibold">
                                                    ✓ Confirmé
                                                </span>
                                            <?php elseif ($res['status'] === 'refused'): ?>
                                                <span class="px-3 py-1 rounded-lg bg-red-500/20 text-red-300 text-sm font-semibold">
                                                    ✗ Refusé
                                                </span>
                                            <?php elseif ($res['status'] === 'cancelled'): ?>
                                                <span class="px-3 py-1 rounded-lg bg-gray-500/20 text-gray-300 text-sm font-semibold">
                                                    ⊘ Annulé
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-3">
                                        <?php if (isset($res['domain'])): ?>
                                            <div class="bg-white/5 border border-white/10 rounded-xl p-3">
                                                <div class="text-xs text-slate-400">Domaine</div>
                                                <div class="font-semibold"><?= htmlspecialchars($res['domain']) ?></div>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (isset($res['exp'])): ?>
                                            <div class="bg-white/5 border border-white/10 rounded-xl p-3">
                                                <div class="text-xs text-slate-400">Expérience</div>
                                                <div class="font-semibold"><?= htmlspecialchars($res['exp']) ?> ans</div>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="mt-4">
                                        <div class="text-xs text-slate-400 mb-2">Créneau réservé</div>
                                        <div class="flex items-center gap-2">
                                            <span class="text-slate-300">📅 <?= htmlspecialchars($res['date_dispo']) ?></span>
                                        </div>
                                        <div class="mt-2 flex items-center gap-2">
                                            <span class="px-3 py-1 rounded-lg bg-emerald-500/20 text-emerald-300 text-sm">
                                                <?= htmlspecialchars($res['start_time']) ?>
                                            </span>
                                            <span class="text-slate-400">→</span>
                                            <span class="px-3 py-1 rounded-lg bg-indigo-500/20 text-indigo-300 text-sm">
                                                <?= htmlspecialchars($res['end_time']) ?>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="mt-4 text-xs text-slate-500">
                                        Réservé le <?= date('d/m/Y à H:i', strtotime($res['created_at'])) ?>
                                    </div>

                                    <?php if ($res['status'] === 'pending' || $res['status'] === 'confirmed'): ?>
                                        <div class="mt-4">
                                            <form method="POST" action="/reservation/cancel" onsubmit="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?');">
                                                <input type="hidden" name="id" value="<?= htmlspecialchars($res['id']) ?>">
                                                <button type="submit" class="bg-red-500/20 text-red-300 hover:bg-red-500/30 font-semibold px-4 py-2 rounded-xl transition">
                                                    Annuler la réservation
                                                </button>
                                            </form>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>