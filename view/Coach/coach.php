<!doctype html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Profil Coach — CoachLink</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Sora:wght@500;600;700&display=swap" rel="stylesheet">
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: { sans: ["Inter","system-ui"], display: ["Sora","Inter","system-ui"] },
          colors: { midnight:"#0B1220", carbon:"#0E0E10", lime:"#9AFF00", cyan:"#4DE1FF" },
          boxShadow: { soft: "0 18px 50px rgba(0,0,0,.40)" }
        }
      }
    }
  </script>
</head>
<body class="min-h-screen bg-[radial-gradient(1200px_500px_at_15%_0%,rgba(77,225,255,.12),transparent_60%),radial-gradient(1000px_600px_at_85%_10%,rgba(154,255,0,.10),transparent_55%),linear-gradient(180deg,#0B1220,#0E0E10_70%)] text-slate-100">

  <header class="sticky top-0 z-40 border-b border-white/10 bg-carbon/60 backdrop-blur-xl">
    <div class="mx-auto flex max-w-6xl items-center justify-between px-6 py-4">
      <a href="coaches.html" class="rounded-2xl border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold hover:border-white/20">← Coachs</a>
      <a href="index.html" class="font-display">CoachLink</a>
      <a href="dashboard-sportif.html" class="rounded-2xl bg-lime px-4 py-2 text-sm font-semibold text-black hover:brightness-95">Espace Sportif</a>
    </div>
  </header>

  <main class="mx-auto max-w-6xl px-6 py-10">
    <!-- Profile header -->
    <section class="grid gap-6 lg:grid-cols-3">
      <div class="lg:col-span-2 overflow-hidden rounded-[32px] border border-white/10 bg-white/5 shadow-soft">
        <div class="relative">
          <img id="heroImg" class="h-64 w-full object-cover brightness-90" alt="Coach">
          <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
          <div class="absolute bottom-4 left-4 right-4">
            <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
              <div>
                <div id="name" class="font-display text-3xl">—</div>
                <div class="mt-1 text-slate-300"><span id="sport">—</span> • <span id="city">—</span></div>
              </div>
              <div class="flex items-center gap-3">
                <div class="rounded-2xl bg-black/35 px-4 py-2 text-sm">
                  ⭐ <span id="rating" class="font-semibold">—</span>
                </div>
                <div class="rounded-2xl bg-black/35 px-4 py-2 text-sm">
                  <span class="text-lime font-semibold" id="price">—</span> <span class="text-slate-300">MAD / séance</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="p-6">
          <div class="flex flex-wrap gap-2" id="tags"></div>

          <div class="mt-6 grid gap-4 md:grid-cols-2">
            <div class="rounded-3xl border border-white/10 bg-carbon/30 p-5">
              <div class="text-sm text-slate-400">À propos</div>
              <p id="about" class="mt-2 leading-relaxed text-slate-200">
                —
              </p>
            </div>
            <div class="rounded-3xl border border-white/10 bg-carbon/30 p-5">
              <div class="text-sm text-slate-400">Certifications</div>
              <ul class="mt-3 space-y-2 text-slate-200 text-sm" id="certs"></ul>
            </div>
          </div>

          <div class="mt-6 rounded-3xl border border-white/10 bg-carbon/30 p-5">
            <div class="flex items-center justify-between gap-3">
              <div>
                <div class="text-sm text-slate-400">Avis</div>
                <div class="mt-1 font-semibold">Ce que disent les sportifs</div>
              </div>
              <button id="addReviewBtn" class="rounded-2xl border border-white/10 bg-white/5 px-4 py-2 text-sm font-semibold hover:border-white/20">
                Ajouter un avis
              </button>
            </div>
            <div id="reviews" class="mt-4 grid gap-3 md:grid-cols-2"></div>
          </div>
        </div>
      </div>

      <!-- Booking -->
      <aside class="rounded-[32px] border border-white/10 bg-white/5 shadow-soft p-6">
        <div class="flex items-center justify-between">
          <div>
            <div class="text-sm text-slate-400">Réservation</div>
            <div class="font-display text-xl">Choisir un créneau</div>
          </div>
          <span id="availBadge" class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs text-slate-300">
            <span class="h-2 w-2 rounded-full bg-slate-500"></span> —
          </span>
        </div>

        <div class="mt-4">
          <div class="text-sm text-slate-400">Cette semaine</div>
          <div id="slots" class="mt-3 grid gap-2"></div>
        </div>

        <div class="mt-5 rounded-3xl border border-white/10 bg-carbon/30 p-4 text-sm text-slate-300">
          Paiement & confirmation dans le dashboard sportif.
        </div>

        <a href="coaches.html" class="mt-5 inline-flex w-full items-center justify-center rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm font-semibold hover:border-white/20">
          Voir d’autres coachs
        </a>
      </aside>
    </section>
  </main>

  <!-- Booking Modal -->
  <div id="bookModal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/60"></div>
    <div class="relative mx-auto mt-20 w-[min(720px,calc(100%-32px))] rounded-3xl border border-white/10 bg-carbon/80 p-5 backdrop-blur-xl shadow-soft">
      <div class="flex items-start justify-between gap-4">
        <div>
          <div class="text-sm text-slate-400">Confirmer la séance</div>
          <div class="mt-1 font-display text-2xl" id="modalTitle">—</div>
          <div class="mt-1 text-slate-300 text-sm" id="modalMeta">—</div>
        </div>
        <button id="closeModal" class="rounded-2xl border border-white/10 bg-white/5 px-4 py-2 text-sm hover:bg-white/10">Esc</button>
      </div>

      <div class="mt-5 grid gap-3 md:grid-cols-2">
        <label class="rounded-2xl border border-white/10 bg-white/5 p-4">
          <div class="text-xs text-slate-400">Type de séance</div>
          <select id="sessionType" class="mt-2 w-full rounded-xl border border-white/10 bg-carbon/60 px-3 py-2 outline-none focus:border-lime/40">
            <option>Technique</option>
            <option>Cardio</option>
            <option>Préparation physique</option>
            <option>Plan nutrition / récupération</option>
          </select>
        </label>
        <label class="rounded-2xl border border-white/10 bg-white/5 p-4">
          <div class="text-xs text-slate-400">Note au coach (optionnel)</div>
          <input id="note" class="mt-2 w-full rounded-xl border border-white/10 bg-carbon/60 px-3 py-2 outline-none placeholder:text-slate-500 focus:border-lime/40"
                 placeholder="Ex: objectif, niveau, besoin…" />
        </label>
      </div>

      <div class="mt-5 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div class="text-sm text-slate-300">
          Total: <span class="text-lime font-semibold" id="modalPrice">—</span> MAD
        </div>
        <button id="confirmBooking" class="inline-flex items-center justify-center rounded-2xl bg-lime px-5 py-3 text-sm font-semibold text-black hover:brightness-95">
          Confirmer
        </button>
      </div>

      <div id="toast" class="mt-4 hidden rounded-2xl border border-lime/30 bg-lime/10 p-4 text-sm text-lime">
        Réservation enregistrée. Ouvre ton dashboard sportif.
      </div>
    </div>
  </div>

  <!-- Review Modal -->
  <div id="reviewModal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/60"></div>
    <div class="relative mx-auto mt-24 w-[min(680px,calc(100%-32px))] rounded-3xl border border-white/10 bg-carbon/80 p-5 backdrop-blur-xl shadow-soft">
      <div class="flex items-start justify-between gap-4">
        <div>
          <div class="text-sm text-slate-400">Ajouter un avis</div>
          <div class="mt-1 font-display text-2xl">Ton expérience</div>
        </div>
        <button id="closeReview" class="rounded-2xl border border-white/10 bg-white/5 px-4 py-2 text-sm hover:bg-white/10">Esc</button>
      </div>

      <div class="mt-5 grid gap-3 md:grid-cols-2">
        <label class="rounded-2xl border border-white/10 bg-white/5 p-4">
          <div class="text-xs text-slate-400">Nom</div>
          <input id="rName" class="mt-2 w-full rounded-xl border border-white/10 bg-carbon/60 px-3 py-2 outline-none placeholder:text-slate-500 focus:border-lime/40" placeholder="Ex: Amine" />
        </label>
        <label class="rounded-2xl border border-white/10 bg-white/5 p-4">
          <div class="text-xs text-slate-400">Note</div>
          <select id="rRating" class="mt-2 w-full rounded-xl border border-white/10 bg-carbon/60 px-3 py-2 outline-none focus:border-lime/40">
            <option>5</option><option>4</option><option>3</option><option>2</option><option>1</option>
          </select>
        </label>
      </div>

      <label class="mt-3 block rounded-2xl border border-white/10 bg-white/5 p-4">
        <div class="text-xs text-slate-400">Message</div>
        <textarea id="rMsg" rows="4" class="mt-2 w-full resize-none rounded-xl border border-white/10 bg-carbon/60 px-3 py-2 outline-none placeholder:text-slate-500 focus:border-lime/40"
                  placeholder="Ex: Très bon coaching, séance structurée…"></textarea>
      </label>

      <div class="mt-5 flex items-center justify-end gap-2">
        <button id="saveReview" class="rounded-2xl bg-lime px-5 py-3 text-sm font-semibold text-black hover:brightness-95">Enregistrer</button>
      </div>
    </div>
  </div>

  <script>
    const COACHES = [
      {
        id:1,
        name:"Sarah B.",
        sport:"Prépa physique • Athlétisme",
        city:"Rabat",
        price:200,
        rating:4.9,
        available:true,
        img:"https://images.unsplash.com/photo-1517836357463-d25dfeac3438?auto=format&fit=crop&w=1200&q=80",
        tags:["Force","Mobilité","Programme","Récupération"],
        about:"Préparatrice physique (7 ans). Je construis des plans simples et efficaces: force, mobilité, prévention des blessures, progression mesurable.",
        certs:["Diplôme BPJEPS • Prépa physique","Nutrition sportive (formation)","Spécialité prévention blessures"],
        slots:["Lun 18:30","Mar 20:00","Jeu 19:00","Sam 10:30"],
        reviews:[
          {name:"Amine", rating:5, msg:"Séance claire et intense. J’ai senti la progression dès la 2e semaine."},
          {name:"Sara", rating:5, msg:"Très pro, bonne correction de posture, programme adapté."}
        ]
      },
      {
        id:2,
        name:"Yassine K.",
        sport:"Football",
        city:"Casablanca",
        price:150,
        rating:4.7,
        available:true,
        img:"https://images.unsplash.com/photo-1521412644187-c49fa049e84d?auto=format&fit=crop&w=1200&q=80",
        tags:["Tactique","Technique","Cardio","U19"],
        about:"Coach football orienté technique + lecture de jeu. Objectif: meilleur contrôle, placement, intensité, et décisions plus rapides.",
        certs:["Licence CAF C","Expérience club U17/U19","Analyse vidéo (niveau 1)"],
        slots:["Mer 18:00","Jeu 20:00","Dim 09:30"],
        reviews:[
          {name:"Younes", rating:5, msg:"Super conseils tactiques, séance très bien structurée."}
        ]
      }
    ];

    const $ = (id)=>document.getElementById(id);

    function getId(){
      const p = new URLSearchParams(location.search);
      return parseInt(p.get("id") || "1", 10);
    }

    function reviewCard(r){
      return `
        <div class="rounded-3xl border border-white/10 bg-white/5 p-4">
          <div class="flex items-center justify-between">
            <div class="font-semibold">${r.name}</div>
            <div class="text-sm text-slate-400">⭐ <span class="text-slate-200 font-semibold">${r.rating}</span></div>
          </div>
          <p class="mt-2 text-sm text-slate-300 leading-relaxed">${r.msg}</p>
        </div>
      `;
    }

    function slotBtn(label, disabled){
      return `
        <button ${disabled ? "disabled" : ""}
          class="slotBtn rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-left text-sm hover:border-white/20 disabled:opacity-40 disabled:hover:border-white/10"
          data-slot="${label}">
          <div class="flex items-center justify-between">
            <div class="font-semibold">${label}</div>
            <div class="text-lime font-semibold">Choisir</div>
          </div>
        </button>
      `;
    }

    function setBadge(available){
      const badge = $("availBadge");
      badge.innerHTML = available
        ? `<span class="h-2 w-2 rounded-full bg-lime"></span> Disponible`
        : `<span class="h-2 w-2 rounded-full bg-slate-500"></span> Complet`;
      badge.className = available
        ? "inline-flex items-center gap-2 rounded-full border border-lime/30 bg-lime/10 px-3 py-1 text-xs text-lime"
        : "inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs text-slate-300";
    }

    const coach = COACHES.find(c => c.id === getId()) || COACHES[0];

    // Fill UI
    $("heroImg").src = coach.img;
    $("name").textContent = coach.name;
    $("sport").textContent = coach.sport;
    $("city").textContent = coach.city;
    $("price").textContent = coach.price;
    $("rating").textContent = coach.rating.toFixed(1);
    $("about").textContent = coach.about;

    $("tags").innerHTML = coach.tags.map(t => `
      <span class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs text-slate-200">
        <span class="h-2 w-2 rounded-full bg-cyan shadow-[0_0_14px_rgba(77,225,255,.55)]"></span>${t}
      </span>
    `).join("");

    $("certs").innerHTML = coach.certs.map(c => `<li class="flex gap-2"><span class="text-lime">•</span><span>${c}</span></li>`).join("");

    $("reviews").innerHTML = coach.reviews.map(reviewCard).join("");
    setBadge(coach.available);

    // Slots
    const disabledAll = !coach.available;
    $("slots").innerHTML = coach.slots.map(s => slotBtn(s, disabledAll)).join("");

    // Booking modal logic
    const modal = $("bookModal");
    const closeModal = $("closeModal");
    const confirmBooking = $("confirmBooking");
    const toast = $("toast");
    let chosenSlot = null;

    function openModal(slot){
      chosenSlot = slot;
      $("modalTitle").textContent = `${coach.name}`;
      $("modalMeta").textContent = `${slot} • ${coach.city} • ${coach.sport}`;
      $("modalPrice").textContent = coach.price;
      toast.classList.add("hidden");
      modal.classList.remove("hidden");
      setTimeout(()=>closeModal.focus(), 0);
    }
    function hideModal(){ modal.classList.add("hidden"); }

    document.querySelectorAll(".slotBtn").forEach(btn=>{
      btn.addEventListener("click", ()=> openModal(btn.dataset.slot));
    });

    closeModal.addEventListener("click", hideModal);
    window.addEventListener("keydown", (e)=>{
      if(e.key === "Escape"){
        if(!modal.classList.contains("hidden")) hideModal();
        if(!$("reviewModal").classList.contains("hidden")) $("reviewModal").classList.add("hidden");
      }
    });
    modal.addEventListener("click", (e)=>{
      if(e.target === modal.firstElementChild) hideModal();
    });

    confirmBooking.addEventListener("click", ()=>{
      const type = $("sessionType").value;
      const note = $("note").value.trim();

      // Save to localStorage as "pending booking"
      const bookings = JSON.parse(localStorage.getItem("bookings") || "[]");
      bookings.unshift({
        id: Date.now(),
        coachId: coach.id,
        coachName: coach.name,
        sport: coach.sport,
        city: coach.city,
        slot: chosenSlot,
        type,
        note,
        price: coach.price,
        status: "pending",
        createdAt: new Date().toISOString()
      });
      localStorage.setItem("bookings", JSON.stringify(bookings));
      toast.classList.remove("hidden");
    });

    // Review modal
    const reviewModal = $("reviewModal");
    $("addReviewBtn").addEventListener("click", ()=> reviewModal.classList.remove("hidden"));
    $("closeReview").addEventListener("click", ()=> reviewModal.classList.add("hidden"));
    reviewModal.addEventListener("click", (e)=>{
      if(e.target === reviewModal.firstElementChild) reviewModal.classList.add("hidden");
    });

    $("saveReview").addEventListener("click", ()=>{
      const n = $("rName").value.trim() || "Anonyme";
      const r = parseInt($("rRating").value, 10);
      const m = $("rMsg").value.trim();
      if(!m){ alert("Message obligatoire"); return; }

      coach.reviews.unshift({name:n, rating:r, msg:m});
      $("reviews").innerHTML = coach.reviews.map(reviewCard).join("");
      $("rName").value = ""; $("rMsg").value = ""; $("rRating").value = "5";
      reviewModal.classList.add("hidden");
    });
  </script>
</body>
</html>
