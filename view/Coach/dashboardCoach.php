<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>CoachLink – Dashboard Coach</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Sora:wght@500;600;700&display=swap"
        rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ["Inter", "system-ui", "sans-serif"],
                        display: ["Sora", "Inter", "sans-serif"]
                    },
                    colors: {
                        midnight: "#0B1220",
                        carbon: "#0E0E10",
                        lime: "#9AFF00",
                        cyanx: "#4DE1FF"
                    },
                    boxShadow: {
                        soft: "0 18px 40px rgba(0,0,0,.35)"
                    }
                }
            }
        }
    </script>
</head>

<body class="min-h-screen bg-gradient-to-b from-midnight to-carbon text-slate-50">

    <?php
    // ✅ Safety: avoid warnings if controller didn't send arrays
    $reservations = $reservations ?? [];
    $dispos = $dispos ?? [];

    $totalReservations = count($reservations);
    $pendingReservations = count(array_filter($reservations, fn($r) => ($r['status'] ?? '') === 'pending'));
    $acceptedReservations = count(array_filter($reservations, fn($r) => ($r['status'] ?? '') === 'accepted'));
    $freeSlots = count($dispos);
    ?>

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
                    <div class="text-xs text-slate-400">Dashboard Coach</div>
                </div>
            </a>

            <div class="flex items-center gap-2">
                <a href="/logout" class="rounded-xl bg-lime px-4 py-2 text-sm font-semibold text-black hover:brightness-110">
                    Logout
                </a>
            </div>
        </div>
    </header>

    <main class="mx-auto max-w-6xl px-5 py-10">

        <!-- Flash Messages -->
        <?php if (isset($_SESSION['flash_success'])): ?>
            <div class="mb-4 rounded-2xl border border-lime/30 bg-lime/10 p-4 text-lime">
                <?= htmlspecialchars($_SESSION['flash_success']) ?>
                <?php unset($_SESSION['flash_success']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['flash_error'])): ?>
            <div class="mb-4 rounded-2xl border border-red-500/30 bg-red-500/10 p-4 text-red-200">
                <?= htmlspecialchars($_SESSION['flash_error']) ?>
                <?php unset($_SESSION['flash_error']); ?>
            </div>
        <?php endif; ?>

        <!-- header -->
        <div class="flex flex-col gap-2 md:flex-row md:items-end md:justify-between">
            <div>
                <h1 class="font-display text-3xl">
                    Bonjour, <?= htmlspecialchars($_SESSION['user']['full_name'] ?? 'Coach') ?>
                </h1>
                <p class="mt-1 text-slate-400">Gère tes disponibilités et tes réservations.</p>
            </div>
        </div>

        <!-- stats -->
        <section class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-[26px] border border-white/10 bg-white/5 p-5 shadow-soft">
                <div class="text-xs text-slate-400">Réservations (total)</div>
                <div class="mt-2 font-display text-3xl"><?= (int)$totalReservations ?></div>
                <div class="mt-2 text-xs text-slate-500">Toutes demandes</div>
            </div>

            <div class="rounded-[26px] border border-white/10 bg-white/5 p-5 shadow-soft">
                <div class="text-xs text-slate-400">En attente</div>
                <div class="mt-2 font-display text-3xl"><?= (int)$pendingReservations ?></div>
                <div class="mt-2 text-xs text-slate-500">à accepter / refuser</div>
            </div>

            <div class="rounded-[26px] border border-white/10 bg-white/5 p-5 shadow-soft">
                <div class="text-xs text-slate-400">Acceptées</div>
                <div class="mt-2 font-display text-3xl"><?= (int)$acceptedReservations ?></div>
                <div class="mt-2 text-xs text-slate-500">séances validées</div>
            </div>

            <div class="rounded-[26px] border border-white/10 bg-white/5 p-5 shadow-soft">
                <div class="text-xs text-slate-400">Disponibilités libres</div>
                <div class="mt-2 font-display text-3xl"><?= (int)$freeSlots ?></div>
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
                        <p class="mt-1 text-sm text-slate-400">Crée des séances "libres".</p>
                    </div>
                    <span class="rounded-full border border-lime/40 bg-lime/10 px-3 py-1 text-xs text-lime">Dispo</span>
                </div>

                <!-- ✅ CHANGE action to your route -->
                <form action="/coach/addDisponibilite" method="POST" class="mt-5 grid gap-3">
                    <div>
                        <label class="text-xs font-semibold text-slate-300">Date</label>
                        <input name="date_dispo" type="date" required
                            class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm outline-none focus:border-cyanx/40" />
                    </div>

                    <div>
                        <label class="text-xs font-semibold text-slate-300">Heure Début</label>
                        <input name="start_time" type="time" required
                            class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm outline-none focus:border-cyanx/40" />
                    </div>

                    <div>
                        <label class="text-xs font-semibold text-slate-300">Heure Fin</label>
                        <input name="end_time" type="time" required
                            class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm outline-none focus:border-cyanx/40" />
                    </div>

                    <button type="submit"
                        class="mt-2 w-full rounded-2xl bg-lime px-5 py-3 font-semibold text-black hover:brightness-110">
                        Ajouter
                    </button>
                </form>
            </div>

            <!-- Reservations -->
            <div class="lg:col-span-2 rounded-[30px] border border-white/10 bg-white/5 p-6 shadow-soft">
                <div class="flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
                    <div>
                        <h2 class="font-display text-xl">Réservations</h2>
                        <p class="mt-1 text-sm text-slate-400">Accepte / Refuse les demandes.</p>
                    </div>
                </div>

                <div class="mt-5 grid gap-3">
                    <?php if (empty($reservations)): ?>
                        <p class="text-sm text-slate-400">Aucune réservation pour le moment.</p>
                    <?php else: ?>
                        <?php foreach ($reservations as $reservation): ?>
                            <div
                                class="flex flex-col gap-4 rounded-[24px] border border-white/10 bg-white/5 p-5 shadow-soft sm:flex-row sm:items-center sm:justify-between">

                                <!-- Infos -->
                                <div class="space-y-2 flex-1">
                                    <div class="flex flex-wrap items-center gap-2">
                                        <?php if (($reservation['status'] ?? '') === 'pending'): ?>
                                            <span
                                                class="rounded-full border border-yellow-500/40 bg-yellow-500/10 px-3 py-1 text-xs font-semibold text-yellow-300">
                                                En attente
                                            </span>
                                        <?php elseif (($reservation['status'] ?? '') === 'accepted'): ?>
                                            <span
                                                class="rounded-full border border-lime/40 bg-lime/10 px-3 py-1 text-xs font-semibold text-lime">
                                                Acceptée
                                            </span>
                                        <?php elseif (($reservation['status'] ?? '') === 'refused'): ?>
                                            <span
                                                class="rounded-full border border-red-500/40 bg-red-500/10 px-3 py-1 text-xs font-semibold text-red-300">
                                                Refusée
                                            </span>
                                        <?php endif; ?>
                                    </div>

                                    <div class="text-sm font-semibold text-white">
                                        👤 <?= htmlspecialchars($reservation['sportif_name'] ?? '-') ?>
                                    </div>

                                    <div class="text-xs text-slate-400">
                                        📧 <?= htmlspecialchars($reservation['sportif_email'] ?? '-') ?>
                                    </div>

                                    <div class="grid gap-2 sm:grid-cols-3 mt-2">
                                        <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-2">
                                            <p class="text-xs text-slate-400">Date</p>
                                            <p class="mt-1 text-sm font-semibold text-white">
                                                <?= htmlspecialchars($reservation['date_dispo'] ?? '-') ?>
                                            </p>
                                        </div>

                                        <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-2">
                                            <p class="text-xs text-slate-400">Début</p>
                                            <p class="mt-1 text-sm font-semibold text-white">
                                                <?= htmlspecialchars($reservation['start_time'] ?? '-') ?>
                                            </p>
                                        </div>

                                        <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-2">
                                            <p class="text-xs text-slate-400">Fin</p>
                                            <p class="mt-1 text-sm font-semibold text-white">
                                                <?= htmlspecialchars($reservation['end_time'] ?? '-') ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Actions -->
                                <div class="flex gap-2 sm:flex-col sm:items-end">
                                    <?php if (($reservation['status'] ?? '') === 'pending'): ?>

                                        <!-- ✅ CHANGE action to your route -->
                                        <form action="/coach/reservation/accept" method="POST" class="w-full sm:w-auto">
                                            <input type="hidden" name="reservation_id" value="<?= (int)($reservation['id_reservation'] ?? 0) ?>">
                                            <button type="submit"
                                                class="w-full rounded-2xl bg-lime px-5 py-3 text-sm font-semibold text-black transition hover:-translate-y-0.5 hover:brightness-110">
                                                Accepter
                                            </button>
                                        </form>

                                        <!-- ✅ CHANGE action to your route -->
                                        <form action="/coach/reservation/refuse" method="POST" class="w-full sm:w-auto">
                                            <input type="hidden" name="reservation_id" value="<?= (int)($reservation['id_reservation'] ?? 0) ?>">
                                            <button type="submit"
                                                class="w-full rounded-2xl border border-red-500/30 bg-red-500/10 px-5 py-3 text-sm font-semibold text-red-200 transition hover:-translate-y-0.5 hover:bg-red-500/15 hover:border-red-500/50">
                                                Refuser
                                            </button>
                                        </form>

                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

        </section>

        <!-- Disponibilités -->
        <section class="mt-6 rounded-[30px] border border-white/10 bg-white/5 p-6 shadow-soft">
            <div class="flex items-end justify-between">
                <div>
                    <h2 class="font-display text-xl">Mes disponibilités</h2>
                    <p class="mt-1 text-sm text-slate-400">Liste des créneaux libres.</p>
                </div>
                <span class="rounded-full border border-cyanx/30 bg-cyanx/10 px-3 py-1 text-xs text-cyanx">Slots</span>
            </div>

            <div class="mt-5 grid gap-3">
                <?php if (empty($dispos)): ?>
                    <p class="text-sm text-slate-400">Aucune disponibilité ajoutée.</p>
                <?php else: ?>
                    <?php foreach ($dispos as $d): ?>
                        <div class="flex flex-col gap-4 rounded-[24px] border border-white/10 bg-white/5 p-5 shadow-soft sm:flex-row sm:items-center sm:justify-between">
                            <div class="grid gap-2 sm:grid-cols-3 flex-1">
                                <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-2">
                                    <p class="text-xs text-slate-400">Date</p>
                                    <p class="mt-1 text-sm font-semibold text-white"><?= htmlspecialchars($d['date_dispo'] ?? '-') ?></p>
                                </div>

                                <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-2">
                                    <p class="text-xs text-slate-400">Début</p>
                                    <p class="mt-1 text-sm font-semibold text-white"><?= htmlspecialchars($d['start_time'] ?? '-') ?></p>
                                </div>

                                <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-2">
                                    <p class="text-xs text-slate-400">Fin</p>
                                    <p class="mt-1 text-sm font-semibold text-white"><?= htmlspecialchars($d['end_time'] ?? '-') ?></p>
                                </div>
                            </div>

                            <div class="flex gap-2 sm:flex-col sm:items-end">
                                <!-- ✅ CHANGE action to your route -->
                                <form action="/coach/dispo/delete" method="POST" class="w-full sm:w-auto">
                                    <input type="hidden" name="id_dispo" value="<?= (int)($d['id_dispo'] ?? 0) ?>">
                                    <button type="submit"
                                        class="w-full rounded-2xl border border-red-500/30 bg-red-500/10 px-5 py-3 text-sm font-semibold text-red-200 transition hover:-translate-y-0.5 hover:bg-red-500/15 hover:border-red-500/50">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </section>

    </main>

</body>

</html>
