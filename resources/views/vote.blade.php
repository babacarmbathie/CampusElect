<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Élection des Représentants Étudiants</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/vote.css') }}">
  <style>
    /* Améliorations pour le bouton voté */
    .btn-voted {
      background-color: #28a745 !important;
      border-color: #28a745 !important;
    }
    /* Limiter la hauteur du texte dans le modal */
    #modalCandidateProgram {
      max-height: 200px;
      overflow-y: auto;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg fixed-top navbar-dark" id="mainNav" style="background: linear-gradient(135deg, #5E2C1A, #8E4B3A);">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center" href="#" style="font-size: 1.8rem; font-weight: bold; color: white;">
        <img src="{{ asset('ugb.jpg') }}" id="ivote-logo-landing-header" alt="iVote Logo" class="img-fluid me-3" style="height: 50px;">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" style="border-color: white;">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item fw-medium">
            <a class="nav-link text-white" href="{{ route('welcome') }}">Welcome</a>
          </li>
          <li class="nav-item fw-medium">
            <a class="nav-link text-white" href="{{ route('welcome') }}">Welcome Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active text-white" href="{{ route('welcome') }}">Register</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Section Titre -->
  <div class="container-fluid text-center py-5 position-relative" style="background-color: #8E4B3A; margin-top: 90px; overflow: hidden;">
    <div class="container position-relative z-1">
      <h1 class="display-4 mb-3" style="color: white; font-weight: bold; text-shadow: 2px 2px 4px rgba(0,0,0,0.1);">
        Élection des Représentants Étudiants
      </h1>
      <p class="lead" style="font-size: 1.25rem; color: #f8f9fa;">
        Choisissez le candidat qui représente vos idées et vos valeurs.
      </p>
    </div>
    <svg class="position-absolute bottom-0 start-0 w-100" viewBox="0 0 1440 100" preserveAspectRatio="none" style="height: 50px; fill: #ffffff;">
      <path d="M0,0V100H1440V0C1200,100 800,100 400,100C200,100 100,100 0,0Z"></path>
    </svg>
  </div>

  <!-- Liste des candidats -->
  <div class="container-fluid py-5" style="background-color: #ffffff;">
    <div class="container">
      <h2 class="text-center mb-4" style="color: #5E2C1A;"><i class="fas fa-users me-2"></i>Liste des Candidats</h2>
      <div class="row" id="candidates-list">
        @foreach($candidates as $candidate)
          @php
            $name = json_encode($candidate->name);
            // Nettoyer les retours à la ligne du programme
            $program = json_encode(str_replace(["\r", "\n"], ' ', $candidate->program));
            $photo = json_encode($candidate->photo_path);
          @endphp
          <div class="col-md-4 mb-4">
            <div class="card h-100 candidate-card" style="cursor:pointer;" onclick="openCandidateModal({{ $name }}, {{ $program }}, {{ $photo }}, {{ $candidate->id }})">
              <img src="{{ asset('images/' . $candidate->photo_path) }}" class="card-img-top" alt="Photo de {{ $candidate->name }}">
              <div class="card-body">
                <h5 class="card-title">{{ $candidate->name }}</h5>
                <p class="card-text">{{ Str::limit($candidate->program, 80) }}</p>
                <!-- Progression des votes -->
                <div class="progress mt-2">
                  <div class="progress-bar" role="progressbar" style="width: {{ $candidate->vote_percentage ?? 0 }}%;" aria-valuenow="{{ $candidate->vote_percentage ?? 0 }}" aria-valuemin="0" aria-valuemax="100">
                    {{ $candidate->vote_percentage ?? 0 }}%
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>

  <!-- Modal de détail candidat -->
  <div class="modal fade" id="candidateModal" tabindex="-1" aria-labelledby="candidateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="candidateModalLabel"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
        </div>
        <div class="modal-body">
          <img id="modalCandidateImage" src="" class="img-fluid mb-3" alt="Photo candidat">
          <p id="modalCandidateProgram"></p>
          <div id="voteMessage" class="alert alert-success d-none" role="alert">
            Merci d'avoir voté !
          </div>
        </div>
        <div class="modal-footer">
          <button id="voteButton" type="button" class="btn btn-primary" onclick="confirmVote()">Voter</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Passage d'information depuis le contrôleur vers JS -->
  <script>
    // Indique si l'utilisateur a déjà voté
    let hasVoted = {{ $vote ? 'true' : 'false' }};
    // ID du candidat pour lequel l'utilisateur a voté (ou null)
    let votedCandidateId = {{ $vote ? $vote->candidate_id : 'null' }};
    // ID de l'élection en cours
    let currentElectionId = {{ $currentElection->id }};
    // Variable pour stocker l'ID du candidat en cours d'affichage dans le modal
    let currentCandidateId = null;
  </script>

  <!-- Scripts JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Fonction d'ouverture du modal pour afficher les informations du candidat
    function openCandidateModal(name, program, photo, candidateId) {
      currentCandidateId = candidateId;
      let voteBtn = document.getElementById('voteButton');
      // Réinitialisation du bouton
      voteBtn.classList.remove('btn-voted');
      voteBtn.innerText = 'Voter';
      voteBtn.disabled = false;
      document.getElementById('voteMessage').classList.add('d-none');

      // Remplissage du modal
      document.getElementById('candidateModalLabel').innerText = name;
      document.getElementById('modalCandidateImage').src = "{{ asset('images') }}/" + photo;
      document.getElementById('modalCandidateProgram').innerText = program;
      
      // Si l'utilisateur a déjà voté
      if (hasVoted) {
        // Seul le candidat pour lequel il a voté affichera "Voté"
        if (candidateId === votedCandidateId) {
          voteBtn.classList.add('btn-voted');
          voteBtn.innerText = 'Voté';
          voteBtn.disabled = true;
        } else {
          // Pour les autres, le bouton reste désactivé sans l'état "voté"
          voteBtn.innerText = '->';
          voteBtn.disabled = true;
        }
      }
      
      // Afficher le modal
      let candidateModal = new bootstrap.Modal(document.getElementById('candidateModal'));
      candidateModal.show();
    }

    // Fonction qui affiche une confirmation avant de voter
    function confirmVote() {
      if (window.confirm("Confirmez-vous votre vote ?")) {
        submitVote();
      }
    }

    // Fonction pour envoyer le vote via AJAX
    function submitVote() {
      if (hasVoted) return;

      const voteData = {
        candidate_id: currentCandidateId,
        election_id: currentElectionId,
      };

      fetch("{{ route('vote.store') }}", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify(voteData)
      })
      .then(response => {
        if (!response.ok) {
          return response.json().then(err => { throw err; });
        }
        return response.json();
      })
      .then(data => {
        if (data.success) {
          hasVoted = true;
          votedCandidateId = currentCandidateId;

          let voteBtn = document.getElementById('voteButton');
          voteBtn.classList.add('btn-voted');
          voteBtn.innerText = 'Voté';
          voteBtn.disabled = true;
          
          let voteMsg = document.getElementById('voteMessage');
          voteMsg.classList.remove('d-none');
          voteMsg.innerText = data.message || "Merci d'avoir voté pour ce candidat !";
        } else {
          alert(data.error || "Une erreur est survenue lors de l'enregistrement de votre vote.");
        }
      })
      .catch(error => {
        console.error('Erreur lors de la soumission du vote:', error);
        alert(error.error || "Une erreur est survenue. Veuillez réessayer.");
      });
    }
  </script>
</body>
</html>