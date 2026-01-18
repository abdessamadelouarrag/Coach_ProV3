<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Coach Details</title>
</head>

<body class="bg-slate-950 text-slate-100 min-h-screen">

    <div class="max-w-5xl mx-auto p-6">
        <a href="/sportif" class="text-slate-300 hover:text-white">← Back</a>

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

        <!-- Coach info -->
        <div class="mt-4 bg-white/5 border border-white/10 rounded-2xl p-6">
            <h1 class="text-2xl font-bold"><?= htmlspecialchars($coach['full_name']) ?></h1>
            <p class="text-slate-300 text-sm"><?= htmlspecialchars($coach['email'] ?? '') ?></p>

            <div class="w-24 h-24 overflow-hidden rounded-2xl mt-4">
                <img src="/assets/images/coach.jpg" alt="" class="w-full h-full object-cover">
            </div>

            <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-3">
                <div class="bg-white/5 border border-white/10 rounded-xl p-4">
                    <div class="text-xs text-slate-400">Domain</div>
                    <div class="font-semibold"><?= htmlspecialchars($profile['domain'] ?? '—') ?></div>
                </div>
                <div class="bg-white/5 border border-white/10 rounded-xl p-4">
                    <div class="text-xs text-slate-400">Experience</div>
                    <div class="font-semibold"><?= htmlspecialchars($profile['exp'] ?? '—') ?> Ans</div>
                </div>
            </div>

            <div class="mt-4 text-slate-300">
                <div class="text-xs text-slate-400">Bio</div>
                <p class="mt-1"><?= nl2br(htmlspecialchars($profile['bio'] ?? '—')) ?></p>
            </div>
        </div>

        <!-- Dispos -->
        <div class="mt-6 bg-white/5 border border-white/10 rounded-2xl overflow-hidden">
            <div class="p-4 border-b border-white/10">
                <h2 class="font-semibold">Disponibilités</h2>
                <p class="text-sm text-slate-400">Choisis un créneau.</p>
            </div>

            <?php if (empty($dispos)): ?>
                <div class="p-4 text-slate-300">Aucune disponibilité pour le moment.</div>
            <?php else: ?>
                <div class="p-4 space-y-3">
                    <?php foreach ($dispos as $d): ?>
                        <?php
                        $stmt = Database::getInstance()->getConnection()->prepare("
                            SELECT id, status FROM reservations WHERE id_disponibilite = :id_dispo
                        ");
                        $stmt->execute([':id_dispo' => $d['id']]);
                        $reservation = $stmt->fetch(PDO::FETCH_ASSOC);
                        $isReserved = $reservation !== false;
                        $status = $reservation ? $reservation['status'] : '';
                        ?>

                        <div class="flex items-center justify-between gap-4 bg-white/5 border border-white/10 rounded-2xl p-4 <?= $isReserved ? 'opacity-70' : 'hover:bg-white/10' ?> transition">
                            <div>
                                <div class="text-sm text-slate-400">📅 <?= htmlspecialchars($d['date_dispo']) ?></div>
                                <div class="mt-1 flex items-center gap-2">
                                    <span class="px-2 py-1 rounded-lg bg-emerald-500/20 text-emerald-300 text-xs">
                                        <?= htmlspecialchars($d['start_time']) ?>
                                    </span>
                                    <span class="text-slate-400">→</span>
                                    <span class="px-2 py-1 rounded-lg bg-indigo-500/20 text-indigo-300 text-xs">
                                        <?= htmlspecialchars($d['end_time']) ?>
                                    </span>
                                </div>
                                <?php if ($isReserved): ?>
                                    <div class="mt-2">
                                        <?php if ($status === 'pending'): ?>
                                            <span class="px-2 py-1 rounded-lg bg-yellow-500/20 text-yellow-300 text-xs">
                                                En attente
                                            </span>
                                        <?php elseif ($status === 'confirmed'): ?>
                                            <span class="px-2 py-1 rounded-lg bg-green-500/20 text-green-300 text-xs">
                                                ✓ Confirmé
                                            </span>
                                        <?php elseif ($status === 'refused'): ?>
                                            <span class="px-2 py-1 rounded-lg bg-red-500/20 text-red-300 text-xs">
                                                ✗ Refusé
                                            </span>
                                        <?php elseif ($status === 'cancelled'): ?>
                                            <span class="px-2 py-1 rounded-lg bg-gray-500/20 text-gray-300 text-xs">
                                                ⊘ Annulé
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Reservation button -->
                            <?php if ($isReserved): ?>
                                <span class="bg-slate-600 text-slate-400 font-semibold px-4 py-2 rounded-xl cursor-not-allowed">
                                    Réservé
                                </span>
                            <?php else: ?>
                                <a href="/reserve?id=<?= htmlspecialchars($d['id']) ?>">
                                    <button class="bg-lime-400 text-slate-950 font-semibold px-4 py-2 rounded-xl hover:bg-lime-300 transition">
                                        Réserver
                                    </button>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

    </div>
</body>

</html>