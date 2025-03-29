<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Élection des Représentants Étudiants | CAMPUS ELECT</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <style>
    :root {
      --dark-brown: #3a2a1f;
      --medium-brown: #5d4b36;
      --light-brown: #8b7355;
      --cream: #f5f0e6;
      --white: #ffffff;
      --nav-bg: rgba(58, 42, 31, 0.9);
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: var(--cream);
      padding-top: 70px;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    /* Navigation */
    .navbar {
      background-color: var(--nav-bg);
      backdrop-filter: blur(10px);
      box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
    }

    .navbar-brand {
      font-weight: 600;
      color: var(--cream) !important;
      letter-spacing: 1px;
    }

    .nav-link {
      color: var(--cream) !important;
      font-weight: 500;
      margin: 0 10px;
      padding: 8px 15px !important;
      border-radius: 5px;
      transition: all 0.3s ease;
    }

    .nav-link:hover, .nav-link.active {
      background-color: rgba(139, 115, 85, 0.3);
      color: var(--white) !important;
    }

    /* Contenu principal */
    .page-header {
      background: linear-gradient(to right, var(--medium-brown), var(--dark-brown));
      color: white;
      padding: 3rem 0;
      margin-bottom: 2rem;
    }

    /* Cartes candidats */
    .candidate-card {
      transition: all 0.3s ease;
      border: none;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
      margin-bottom: 1.5rem;
      cursor: pointer;
      height: 100%;
      display: flex;
      flex-direction: column;
    }

    .candidate-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    }

    .candidate-img-container {
      height: 250px;
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #f8f9fa;
    }

    .candidate-img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.3s ease;
    }

    .candidate-card:hover .candidate-img {
      transform: scale(1.05);
    }

    .card-body {
      background-color: var(--white);
      flex: 1;
      display: flex;
      flex-direction: column;
    }

    /* Barre de progression stylisée */
    .progress-container {
      padding: 0 15px 15px;
      background-color: var(--white);
    }

    .progress {
      height: 25px;
      background-color: #f0f0f0;
      border-radius: 15px;
      overflow: hidden;
      box-shadow: inset 0 1px 3px rgba(0,0,0,0.1);
    }

    .progress-bar {
      background: linear-gradient(45deg, var(--light-brown), var(--dark-brown));
      color: white;
      font-weight: 600;
      font-size: 0.85rem;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
      overflow: hidden;
      transition: width 0.5s ease-in-out;
    }

    .progress-bar::after {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: linear-gradient(
        45deg,
        rgba(255,255,255,0.2) 25%,
        transparent 25%,
        transparent 50%,
        rgba(255,255,255,0.2) 50%,
        rgba(255,255,255,0.2) 75%,
        transparent 75%
      );
      background-size: 25px 25px;
      animation: progressAnimation 2s linear infinite;
    }

    @keyframes progressAnimation {
      0% { background-position: 0 0; }
      100% { background-position: 50px 50px; }
    }

    /* Modal */
    .modal-content {
      border-radius: 15px;
      overflow: hidden;
      border: none;
    }

    .modal-header {
      background: linear-gradient(to right, var(--medium-brown), var(--dark-brown));
      color: white;
      border-bottom: none;
    }

    .modal-body img {
      max-height: 300px;
      width: 100%;
      object-fit: cover;
      border-radius: 8px;
      margin-bottom: 1rem;
      box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    }

    /* Boutons */
    .btn-vote {
      background: linear-gradient(to right, var(--dark-brown), var(--medium-brown));
      border: none;
      padding: 10px 25px;
      font-weight: 600;
      letter-spacing: 0.5px;
    }

    .btn-vote:hover {
      background: linear-gradient(to right, var(--medium-brown), var(--dark-brown));
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .btn-voted {
      background: #28a745 !important;
      cursor: not-allowed;
    }

    /* Footer */
    .footer {
      background: linear-gradient(to right, var(--dark-brown), var(--medium-brown));
      color: var(--cream);
      padding: 40px 0 20px;
      margin-top: auto;
    }

    .footer a {
      color: var(--cream);
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .footer a:hover {
      color: white;
      text-decoration: underline;
    }

    .footer-logo {
      width: 120px;
      margin-bottom: 15px;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .candidate-img-container {
        height: 200px;
      }
      
      .modal-body img {
        max-height: 200px;
      }
    }
  </style>
</head>
<body>
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg fixed-top" id="mainNav">
    <div class="container-fluid">
      <a class="navbar-brand d-flex align-items-center" href="#">
        <x-logo class="navbar-logo me-2" style="width: 50px; height: auto;" />
        <span class="navbar-brand-text">CAMPUS ELECT</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarText">
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route('welcome') }}">Accueil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('welcome') }}">À propos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('student.login') }}">Se connecter</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- En-tête -->
  <header class="page-header">
    <div class="container text-center">
      <h1><i class="fas fa-vote-yea me-2"></i>Élection des Représentants Étudiants</h1>
      <p class="lead mb-0">Faites entendre votre voix pour façonner l'avenir de votre université</p>
    </div>
  </header>

  <!-- Contenu principal -->
  <main class="container my-5">
    <div class="row">
      <div class="col-12">
        <h2 class="text-center mb-4" style="color: var(--dark-brown);">
          <i class="fas fa-users me-2"></i>Liste des Candidats
        </h2>
        
        <div class="row" id="candidates-list">
          @foreach($candidates as $candidate)
            @php
              $name = json_encode($candidate->name);
              $program = json_encode(str_replace(["\r", "\n"], ' ', $candidate->program));
              $photo = json_encode($candidate->photo_path);
            @endphp
            <div class="col-lg-4 col-md-6 mb-4">
              <div class="card h-100 candidate-card" onclick="openCandidateModal({{ $name }}, {{ $program }}, {{ $photo }}, {{ $candidate->id }})">
                <div class="candidate-img-container">
                  <img src="{{ asset('storage/' . $candidate->photo_path) }}" class="candidate-img" alt="{{ $candidate->name }}">
                </div>
                <div class="card-body">
                  <h5 class="card-title">
                    {{ $candidate->name }}
                    @if($vote && $vote->candidate_id === $candidate->id)
                      <i class="fas fa-check-circle text-success ms-2"></i>
                    @endif
                  </h5>
                  <p class="card-text">{{ Str::limit($candidate->program, 80) }}</p>
                </div>
                @if($vote)
                  <div class="progress-container">
                    <div class="progress">
                      <div id="progress-{{ $candidate->id }}" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                        <span>0%</span>
                      </div>
                    </div>
                  </div>
                @endif
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </main>

  <!-- Modal Candidat -->
  <div class="modal fade" id="candidateModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="candidateModalLabel"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-5 mb-3 mb-md-0">
              <img id="modalCandidateImage" src="" class="img-fluid rounded shadow" alt="Photo candidat">
            </div>
            <div class="col-md-7">
              <h4 class="mb-3" style="color: var(--dark-brown);">Programme électoral</h4>
              <div id="modalCandidateProgram" class="mb-3" style="white-space: pre-line;"></div>
              <div id="voteMessage" class="alert alert-success d-none mb-0"></div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button id="voteButton" type="button" class="btn btn-vote" onclick="confirmVote()">Voter</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
          <div class="d-flex align-items-center mb-3">
            <div style="width: 50px; height: 50px; background-color: var(--cream); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 15px;">
              <i class="fas fa-vote-yea" style="font-size: 1.5rem; color: var(--dark-brown);"></i>
            </div>
            <h5 class="mb-0">CAMPUS ELECT</h5>
          </div>
          <p>Plateforme de vote électronique pour les élections universitaires.</p>
        </div>
        <div class="col-lg-2 col-md-3 mb-4 mb-md-0">
          <h5 class="mb-3">Liens utiles</h5>
          <ul class="list-unstyled">
            <li class="mb-2"><a href="#"><i class="fas fa-chevron-right me-2"></i>Résultats</a></li>
            <li class="mb-2"><a href="#"><i class="fas fa-chevron-right me-2"></i>Règlement</a></li>
            <li><a href="#"><i class="fas fa-chevron-right me-2"></i>FAQ</a></li>
          </ul>
        </div>
        <div class="col-lg-3 col-md-3 mb-4 mb-md-0">
          <h5 class="mb-3">Contact</h5>
          <ul class="list-unstyled">
            <li class="mb-2"><a href="mailto:contact@campuselect.edu"><i class="fas fa-envelope me-2"></i>contact@campuselect.edu</a></li>
            <li><a href="tel:+221331234567"><i class="fas fa-phone me-2"></i>+221 33 123 45 67</a></li>
          </ul>
        </div>
        <div class="col-lg-3 col-md-12">
          <h5 class="mb-3">Réseaux sociaux</h5>
          <div class="d-flex">
            <a href="#" class="me-3" style="font-size: 1.5rem;"><i class="fab fa-facebook"></i></a>
            <a href="#" class="me-3" style="font-size: 1.5rem;"><i class="fab fa-twitter"></i></a>
            <a href="#" style="font-size: 1.5rem;"><i class="fab fa-instagram"></i></a>
          </div>
        </div>
      </div>
      <hr class="my-4" style="border-color: rgba(255,255,255,0.1);">
      <div class="text-center">
        <p class="mb-0">© 2023 CAMPUS ELECT. Tous droits réservés.</p>
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Variables globales
    let hasVoted = {{ $vote ? 'true' : 'false' }};
    let votedCandidateId = {{ $vote ? $vote->candidate_id : 'null' }};
    let currentElectionId = {{ $currentElection->id }};
    let currentCandidateId = null;
    let progressUpdateInterval = null;

    // Initialisation des barres de progression
    document.addEventListener('DOMContentLoaded', function() {
      if (hasVoted) {
        updateProgressBars();
        progressUpdateInterval = setInterval(updateProgressBars, 5000);
      }
    });

    // Fonction pour ouvrir le modal du candidat
    function openCandidateModal(name, program, photo, candidateId) {
      currentCandidateId = candidateId;
      const voteBtn = document.getElementById('voteButton');
      voteBtn.classList.remove('btn-voted');
      voteBtn.innerHTML = '<i class="fas fa-vote-yea me-2"></i>Voter';
      voteBtn.disabled = false;
      
      const voteMsg = document.getElementById('voteMessage');
      voteMsg.classList.add('d-none');
      voteMsg.textContent = '';

      // Remplir le modal
      document.getElementById('candidateModalLabel').textContent = name;
      document.getElementById('modalCandidateImage').src = "{{ asset('storage/') }}/" + photo;
      document.getElementById('modalCandidateProgram').textContent = program.replace(/\\n/g, '\n');
      
      // Adapter le bouton si déjà voté
      if (hasVoted) {
        if (candidateId === votedCandidateId) {
          voteBtn.classList.add('btn-voted');
          voteBtn.innerHTML = '<i class="fas fa-check-circle me-2"></i>Vous avez voté';
          voteBtn.disabled = true;
          voteMsg.textContent = "Merci d'avoir voté pour ce candidat !";
          voteMsg.classList.remove('d-none');
        } else {
          voteBtn.innerHTML = '<i class="fas fa-times-circle me-2"></i>Déjà voté';
          voteBtn.disabled = true;
        }
      }
      
      // Afficher le modal
      const modal = new bootstrap.Modal(document.getElementById('candidateModal'));
      modal.show();
    }

    // Confirmation du vote
    function confirmVote() {
      if (!currentCandidateId) return;
      
      if (confirm("Confirmez-vous votre vote pour ce candidat ?\nCette action est irréversible.")) {
        submitVote();
      }
    }

    // Soumission du vote avec gestion CSRF et erreurs
    function submitVote() {
      if (hasVoted || !currentCandidateId) return;

      const voteBtn = document.getElementById('voteButton');
      voteBtn.disabled = true;
      voteBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Enregistrement...';

      fetch("{{ route('vote.store') }}", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": "{{ csrf_token() }}",
          "Accept": "application/json"
        },
        body: JSON.stringify({
          candidate_id: currentCandidateId,
          election_id: currentElectionId
        })
      })
      .then(async response => {
        const data = await response.json();
        
        if (!response.ok) {
          throw new Error(data.message || "Erreur lors de l'enregistrement du vote");
        }
        return data;
      })
      .then(data => {
        if (data.success) {
          hasVoted = true;
          votedCandidateId = currentCandidateId;

          const voteBtn = document.getElementById('voteButton');
          voteBtn.classList.add('btn-voted');
          voteBtn.innerHTML = '<i class="fas fa-check-circle me-2"></i>Voté';
          voteBtn.disabled = true;
          
          const voteMsg = document.getElementById('voteMessage');
          voteMsg.textContent = data.message || "Merci pour votre vote !";
          voteMsg.classList.remove('d-none');

          // Mettre à jour les barres de progression
          updateProgressBars();
          
          // Démarrer les mises à jour régulières
          if (progressUpdateInterval) {
            clearInterval(progressUpdateInterval);
          }
          progressUpdateInterval = setInterval(updateProgressBars, 2000);
        }
      })
      .catch(error => {
        console.error('Erreur:', error);
        
        const voteBtn = document.getElementById('voteButton');
        voteBtn.disabled = false;
        voteBtn.innerHTML = '<i class="fas fa-vote-yea me-2"></i>Voter';
        
        alert(error.message || "Une erreur est survenue. Veuillez réessayer.");
      });
    }

    // Mise à jour des barres de progression avec gestion des erreurs
    function updateProgressBars() {
      fetch("{{ route('vote.progress') }}", {
        headers: {
          "Accept": "application/json"
        }
      })
      .then(async response => {
        if (!response.ok) {
          throw new Error("Erreur lors de la récupération des résultats");
        }
        return response.json();
      })
      .then(data => {
        if (Array.isArray(data)) {
          data.forEach(item => {
            const progressBar = document.getElementById('progress-' + item.candidate_id);
            if (progressBar) {
              progressBar.style.width = item.vote_percentage + "%";
              progressBar.setAttribute('aria-valuenow', item.vote_percentage);
              progressBar.querySelector('span').textContent = item.vote_percentage + "%";
            }
          });
        }
      })
      .catch(error => {
        console.error("Erreur mise à jour progression:", error);
      });
    }
  </script>
</body>
</html>