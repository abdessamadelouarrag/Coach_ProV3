<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Coach Dashboard</title>
</head>

<body class="bg-slate-950 text-slate-100 min-h-screen">
    <div class="max-w-6xl mx-auto p-6">
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold">Tableau de bord Coach</h1>
            <a href="/logout" class="text-slate-300 hover:text-white">Se déconnecter</a>
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

        <!-- Reservations Section -->
        <div class="mt-8 bg-white/5 border border-white/10 rounded-2xl overflow-hidden">
            <div class="p-4 border-b border-white/10">
                <h2 class="text-xl font-semibold">Demandes de réservation</h2>
                <p class="text-sm text-slate-400">Gérez les réservations de vos sportifs</p>
            </div>

            <?php if (empty($reservations)): ?>
                <div class="p-6 text-center text-slate-400">
                    Aucune réservation pour le moment
                </div>
            <?php else: ?>
                <div class="p-4 space-y-3">
                    <?php foreach ($reservations as $res): ?>
                        <div class="bg-white/5 border border-white/10 rounded-xl p-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-semibold text-lg"><?= htmlspecialchars($res['sportif_name']) ?></h3>
                                    <p class="text-sm text-slate-400"><?= htmlspecialchars($res['sportif_email']) ?></p>
                                    
                                    <div class="mt-3 flex items-center gap-2">
                                        <span class="text-slate-300"><?= htmlspecialchars($res['date_dispo']) ?></span>
                                    </div>
                                    
                                    <div class="mt-2 flex items-center gap-2">
                                        <span class="px-2 py-1 rounded-lg bg-emerald-500/20 text-emerald-300 text-xs">
                                            <?= htmlspecialchars($res['start_time']) ?>
                                        </span>
                                        <span class="text-slate-400">→</span>
                                        <span class="px-2 py-1 rounded-lg bg-indigo-500/20 text-indigo-300 text-xs">
                                            <?= htmlspecialchars($res['end_time']) ?>
                                        </span>
                                    </div>

                                    <div class="mt-2">
                                        <?php if ($res['status'] === 'pending'): ?>
                                            <span class="px-3 py-1 rounded-lg bg-yellow-500/20 text-yellow-300 text-sm">
                                                En attente
                                            </span>
                                        <?php elseif ($res['status'] === 'confirmed'): ?>
                                            <span class="px-3 py-1 rounded-lg bg-green-500/20 text-green-300 text-sm">
                                                ✓ Confirmé
                                            </span>
                                        <?php elseif ($res['status'] === 'refused'): ?>
                                            <span class="px-3 py-1 rounded-lg bg-red-500/20 text-red-300 text-sm">
                                                ✗ Refusé
                                            </span>
                                        <?php elseif ($res['status'] === 'cancelled'): ?>
                                            <span class="px-3 py-1 rounded-lg bg-gray-500/20 text-gray-300 text-sm">
                                                ⊘ Annulé
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <?php if ($res['status'] === 'pending'): ?>
                                    <div class="flex gap-2">
                                        <form method="POST" action="/coach/acceptReservation">
                                            <input type="hidden" name="id" value="<?= htmlspecialchars($res['id']) ?>">
                                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-semibold px-4 py-2 rounded-xl transition">
                                                ✓ Accepter
                                            </button>
                                        </form>
                                        <form method="POST" action="/coach/refuseReservation">
                                            <input type="hidden" name="id" value="<?= htmlspecialchars($res['id']) ?>">
                                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded-xl transition">
                                                ✗ Refuser
                                            </button>
                                        </form>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Add Disponibilite Form -->
        <div class="mt-8 bg-white/5 border border-white/10 rounded-2xl p-6">
            <h2 class="text-xl font-semibold mb-4">Ajouter une disponibilité</h2>
            <form method="POST" action="/coach/addDisponibilite" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm text-slate-400 mb-2">Date</label>
                        <input type="date" name="date_dispo" required 
                            class="w-full bg-white/10 border border-white/20 rounded-xl px-4 py-2 text-slate-100">
                    </div>
                    <div>
                        <label class="block text-sm text-slate-400 mb-2">Heure début</label>
                        <input type="time" name="start_time" required 
                            class="w-full bg-white/10 border border-white/20 rounded-xl px-4 py-2 text-slate-100">
                    </div>
                    <div>
                        <label class="block text-sm text-slate-400 mb-2">Heure fin</label>
                        <input type="time" name="end_time" required 
                            class="w-full bg-white/10 border border-white/20 rounded-xl px-4 py-2 text-slate-100">
                    </div>
                </div>
                <button type="submit" class="bg-lime-400 text-slate-950 font-semibold px-6 py-2 rounded-xl hover:bg-lime-300 transition">
                    Ajouter
                </button>
            </form>
        </div>

        <!-- Disponibilites List -->
        <div class="mt-8 bg-white/5 border border-white/10 rounded-2xl overflow-hidden">
            <div class="p-4 border-b border-white/10">
                <h2 class="text-xl font-semibold">Mes disponibilités</h2>
            </div>

            <?php if (empty($dispos)): ?>
                <div class="p-6 text-center text-slate-400">
                    Aucune disponibilité
                </div>
            <?php else: ?>
                <div class="p-4 space-y-3">
                    <?php foreach ($dispos as $d): ?>
                        <div class="flex items-center justify-between bg-white/5 border border-white/10 rounded-xl p-4">
                            <div>
                                <div class="text-sm text-slate-400"><?= htmlspecialchars($d['date_dispo']) ?></div>
                                <div class="mt-1 flex items-center gap-2">
                                    <span class="px-2 py-1 rounded-lg bg-emerald-500/20 text-emerald-300 text-xs">
                                        <?= htmlspecialchars($d['start_time']) ?>
                                    </span>
                                    <span class="text-slate-400">→</span>
                                    <span class="px-2 py-1 rounded-lg bg-indigo-500/20 text-indigo-300 text-xs">
                                        <?= htmlspecialchars($d['end_time']) ?>
                                    </span>
                                </div>
                            </div>
                            <form method="POST" action="/coach/deleteDisponibilite">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($d['id']) ?>">
                                <button type="submit" class="bg-red-500/20 text-red-300 hover:bg-red-500/30 font-semibold px-4 py-2 rounded-xl transition">
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>