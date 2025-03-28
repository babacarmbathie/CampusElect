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
    /* Bouton voté en vert */
    .btn-voted {
      background-color: #28a745 !important;
      border-color: #28a745 !important;
    }
    /* Limiter la hauteur du texte dans le modal */
    #modalCandidateProgram {
      max-height: 200px;
      overflow-y: auto;
    }
    .progress {
      height: 20px;
      background-color: #f0f0f0;
      border-radius: 15px;
      overflow: hidden;
      box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
      width: calc(100% - 20px); /* Assurez-vous que toutes les barres ont la même largeur et évitent les débordements */
      margin: 0 auto 10px auto; /* Centrer horizontalement et ajouter une marge en bas */
    }
    .progress-bar {
      height: 100%;
      background: linear-gradient(45deg, #5E2C1A, #8B4513);
        color: #ffffff;
      font-weight: 600;
      text-shadow: 1px 1px 1px rgba(0,0,0,0.2);
      transition: width 0.5s ease-in-out;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.9rem;
      position: relative;
      overflow: hidden;
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
      animation: move 2s linear infinite;
      z-index: 1;
    }
    @keyframes move {
      0% {
        background-position: 0 0;
      }
      100% {
        background-position: 50px 50px;
      }
    }
    /* Style pour le conteneur de la carte */
    .candidate-card {
      transition: transform 0.2s ease-in-out;
      border: none;
      border-radius: 15px;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    .candidate-card:hover {
      transform: translateY(-5px);
    }
    /* Style pour le pourcentage */
    .progress-bar span {
      position: relative;
      z-index: 2;
    }
  </style>
</head>
<body>
  <!-- ... votre navbar, section titre, etc ... -->

  <!-- Liste des candidats -->
  <div class="container-fluid py-5" style="background-color: #ffffff;">
    <div class="container">
      <h2 class="text-center mb-4" style="color: #5E2C1A;"><i class="fas fa-users me-2"></i>Liste des Candidats</h2>
      <div class="row" id="candidates-list">
        @foreach($candidates as $candidate)
          @php
            $name = json_encode($candidate->name);
            $program = json_encode(str_replace(["\r", "\n"], ' ', $candidate->program));
            $photo = json_encode($candidate->photo_path);
          @endphp
          <div class="col-md-4 mb-4">
            <div class="card h-100 candidate-card" style="cursor:pointer;" onclick="openCandidateModal({{ $name }}, {{ $program }}, {{ $photo }}, {{ $candidate->id }})">
              <img src="{{ asset('storage/' . $candidate->photo_path) }}" class="card-img-top mx-auto d-block" alt="Photo de {{ $candidate->name }}">
              <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                  <h5 class="card-title mb-1">
                    {{ $candidate->name }}
                    @if($vote && $vote->candidate_id === $candidate->id)
                      <i class="fas fa-check-circle text-success ms-2"></i>
                    @endif
                  </h5>
                  <p class="card-text mb-2">{{ Str::limit($candidate->program, 80) }}</p>
                </div>
              </div>
              @if($vote)
                <!-- Affichage de la progress bar uniquement si l'étudiant a voté -->
                <div class="progress mt-2" style="flex-grow: 1; margin-left: 10px;">
                  <div id="progress-{{ $candidate->id }}" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                    <span>0%</span>
                  </div>
                </div>
              @endif
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
    // Stocker l'ID du candidat en cours dans le modal
    let currentCandidateId = null;
  </script>

  <!-- Scripts JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Initialiser les barres de progression au chargement de la page
    document.addEventListener('DOMContentLoaded', function() {
      if (hasVoted) {
        updateProgressBars();
        // Mettre à jour toutes les 5 secondes
        setInterval(updateProgressBars, 5000);
      }
    });

    // Fonction d'ouverture du modal pour afficher les informations du candidat
    function openCandidateModal(name, program, photo, candidateId) {
      currentCandidateId = candidateId;
      let voteBtn = document.getElementById('voteButton');
      voteBtn.classList.remove('btn-voted');
      voteBtn.innerText = 'Voter';
      voteBtn.disabled = false;
      document.getElementById('voteMessage').classList.add('d-none');

      // Remplissage du modal
      document.getElementById('candidateModalLabel').innerText = name;
      document.getElementById('modalCandidateImage').src = "{{ asset('images') }}/" + photo;
      document.getElementById('modalCandidateProgram').innerText = program;
      
      // Si l'utilisateur a déjà voté, désactiver le bouton sauf si c'est le candidat pour lequel il a voté
      if (hasVoted) {
        if (candidateId === votedCandidateId) {
          voteBtn.classList.add('btn-voted');
          voteBtn.innerText = 'Vous avez voté pour ce candidat';
          voteBtn.disabled = true;
        } else {
          voteBtn.innerText = '->';
          voteBtn.disabled = true;
        }
      }
      
      // Afficher le modal
      let candidateModal = new bootstrap.Modal(document.getElementById('candidateModal'));
      candidateModal.show();
    }

    // Fonction de confirmation du vote
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

          // Mettre à jour immédiatement après le vote
          updateProgressBars();
          // Démarrer les mises à jour régulières
          setInterval(updateProgressBars, 2000);
        } else {
          alert(data.error || "Une erreur est survenue lors de l'enregistrement de votre vote.");
        }
      })
      .catch(error => {
        console.error('Erreur lors de la soumission du vote:', error);
        alert(error.error || "Une erreur est survenue. Veuillez réessayer.");
      });
    }

    // Fonction AJAX pour mettre à jour les progressions avec gestion d'erreur améliorée
    function updateProgressBars() {
        fetch("{{ route('vote.progress') }}")
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erreur réseau');
                }
                return response.json();
            })
            .then(data => {
                if (!Array.isArray(data)) {
                    console.error("Format de données invalide");
                    return;
                }
            data.forEach(item => {
                let progressBar = document.getElementById('progress-' + item.candidate_id);
                if (progressBar) {
                        // Animation fluide de la barre de progression
                        progressBar.style.transition = 'width 0.5s ease-in-out';
                progressBar.style.width = item.vote_percentage + "%";
                progressBar.setAttribute("aria-valuenow", item.vote_percentage);
                        progressBar.querySelector('span').innerText = item.vote_percentage + "%";
                }
            });
            })
            .catch(error => {
            console.error("Erreur lors de la mise à jour des progressions:", error);
            });
}
  </script>
</body>
</html>
