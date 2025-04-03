<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Élection des Représentants Étudiants | CAMPUS ELECT</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="{{ asset('css/nav-footer.css') }}">
  <link rel="stylesheet" href="{{ asset('css/vote.css') }}">
</head>
<body>
  <!-- Navigation -->
  @include('components.nav')

  <!-- En-tête -->
  <header class="page-header">
    <div class="container text-center">
      <h1><i class="fas fa-vote-yea me-2"></i>Élection des Représentants Étudiants</h1>
      <p class="lead mb-0">Faites entendre votre voix pour façonner l'avenir de votre université</p>
    </div>
  </header>

  <!-- Contenu principal -->
  <main class="container my-5">
    @if(isset($noElection) && $noElection)
      <div class="row">
        <div class="col-lg-8 mx-auto text-center" data-aos="fade-up">
          <div class="alert alert-warning">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <h4>Aucune élection en cours</h4>
            <p>Il n'y a actuellement aucune élection active. Veuillez revenir plus tard.</p>
          </div>
        </div>
      </div>
    @else
      <!-- Information sur l'élection -->
      <div class="row">
        <div class="col-lg-8 mx-auto text-center" data-aos="fade-up">
          <h1 class="mb-2">Élections UFR {{ $currentElection->ufr }}</h1>
          <div class="election-status">
            @if($electionStatus == 1)
              <span class="status-badge status-open">Élection ouverte</span>
            @elseif($electionStatus == -1)
              <span class="status-badge status-closed">Élection terminée</span>
            @else
              <span class="status-badge status-pending">Élection en attente</span>
            @endif
          </div>
        </div>
      </div>

      <div class="row mt-4">
        <div class="col-12">
          <div class="election-info" data-aos="fade-up">
            <div class="info-item">
              <i class="fas fa-calendar-alt"></i>
              <span>Date limite : {{ \Carbon\Carbon::parse($currentElection->end_date)->format('d F Y') }}</span>
            </div>
            <div class="info-item">
              <i class="fas fa-users"></i>
              <span>Votants : {{ \App\Models\Vote::where('election_id', $currentElection->id)->count() }} étudiants</span>
            </div>
            <div class="info-item">
              <i class="fas fa-user-graduate"></i>
              <span>Inscrits : {{ \App\Models\Student::where('ufr', $currentElection->ufr)->count() }} étudiants</span>
            </div>
            <div class="info-item">
              <i class="fas fa-clock"></i>
              <span id="countdown">Temps restant : {{ \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($currentElection->end_date), false) }} jours</span>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <div class="row mt-5">
            <div class="col-12 text-center mb-4">
              <h2 class="section-title"><i class="fas fa-user-tie me-2"></i>Candidats</h2>
              @if($electionStatus == -1)
                <p class="section-subtitle">Cette élection est terminée. Voici les résultats.</p>
              @elseif($vote)
                <p class="section-subtitle">Vous avez déjà voté pour un candidat</p>
              @else
                <p class="section-subtitle">Sélectionnez votre candidat pour voter</p>
              @endif
            </div>
          </div>
          
          <div class="row" id="candidates-list">
            @if(count($candidates) > 0)
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
                    @if($vote || $electionStatus == -1)
                      <div class="progress-container">
                        <div class="progress">
                          <div id="progress-{{ $candidate->id }}" class="progress-bar" role="progressbar" style="width: {{ $candidate->vote_percentage }}%;" aria-valuenow="{{ $candidate->vote_percentage }}" aria-valuemin="0" aria-valuemax="100">
                            <span>{{ $candidate->vote_percentage }}%</span>
                          </div>
                        </div>
                      </div>
                    @endif
                  </div>
                </div>
              @endforeach
            @else
              <div class="col-12 text-center">
                <div class="alert alert-info">
                  <i class="fas fa-info-circle me-2"></i>
                  Aucun candidat n'a été enregistré pour cette élection.
                </div>
              </div>
            @endif
          </div>
        </div>
      </div>
    @endif
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
  @include('components.footer')

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Configuration globale de l'élection
    window.electionConfig = {
      hasVoted: {{ $vote ? 'true' : 'false' }},
      votedCandidateId: {{ $vote ? $vote->candidate_id : 'null' }},
      currentElectionId: {{ $currentElection ? $currentElection->id : 'null' }},
      electionStatus: {{ $electionStatus ?? 0 }},
      csrfToken: '{{ csrf_token() }}',
      voteEndpoint: '{{ route("vote.store") }}',
      isElectionOpen: {{ ($electionStatus ?? 0) == 1 ? 'true' : 'false' }},
      isElectionClosed: {{ ($electionStatus ?? 0) == -1 ? 'true' : 'false' }},
      hasNoElection: {{ ($electionStatus ?? 0) == 0 ? 'true' : 'false' }},
      endDate: '{{ $currentElection ? $currentElection->end_date : '' }}'
    };

    // Messages d'interface
    window.uiMessages = {
      voteSuccess: 'Votre vote a été enregistré avec succès !',
      voteError: 'Une erreur est survenue lors de l\'enregistrement de votre vote.',
      alreadyVoted: 'Vous avez déjà voté pour cette élection.',
      electionClosed: 'Cette élection est terminée.',
      noElection: 'Aucune élection n\'est en cours.',
      confirmVote: 'Êtes-vous sûr de vouloir voter pour ce candidat ?'
    };

    // Fonction de mise à jour du compte à rebours
    function updateCountdown() {
      const endDate = new Date(window.electionConfig.endDate).getTime();
      const now = new Date().getTime();
      const distance = endDate - now;

      const days = Math.floor(distance / (1000 * 60 * 60 * 24));
      const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      const seconds = Math.floor((distance % (1000 * 60)) / 1000);

      const countdownElement = document.getElementById('countdown');
      if (countdownElement) {
        if (distance < 0) {
          countdownElement.innerHTML = '<span class="text-danger">Élection terminée</span>';
          if (window.electionConfig.isElectionOpen) {
            window.location.reload(); // Recharger si l'élection vient de se terminer
          }
        } else {
          countdownElement.innerHTML = `Temps restant : ${days}j ${hours}h ${minutes}m ${seconds}s`;
        }
      }
    }

    // Mettre à jour le compte à rebours toutes les secondes
    if (window.electionConfig.isElectionOpen) {
      updateCountdown();
      setInterval(updateCountdown, 1000);
    }
  </script>
  <script src="{{ asset('js/vote.js') }}"></script>
</body>
</html>