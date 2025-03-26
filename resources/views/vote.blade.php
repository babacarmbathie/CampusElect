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
        /* Quelques améliorations CSS pour le bouton voté */
        .btn-voted {
            background-color: #28a745 !important;
            border-color: #28a745 !important;
        }
    
    #modalCandidateProgram {
        max-height: 200px; /* ou la hauteur désirée */
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
                    <a class="nav-link text-white" href="{{ route('welcome') }}">welcome</a>
                </li>
                <li class="nav-item fw-medium">
                    <a class="nav-link text-white" href="{{ route('welcome') }}">welcome Us</a>
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
                    // Supprimer les retours à la ligne dans le programme
                    $program = json_encode(str_replace(["\r", "\n"], ' ', $candidate->program));
                    $photo = json_encode($candidate->photo_path);
                @endphp
                <div class="col-md-4 mb-4">
                    <div class="card h-100 candidate-card" style="cursor:pointer;" onclick="openCandidateModal({{ $name }}, {{ $program }}, {{ $photo }}, {{ $candidate->id }})">
                        <img src="{{ asset('images/' . $candidate->photo_path) }}" class="card-img-top" alt="Photo de {{ $candidate->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $candidate->name }}</h5>
                            <p class="card-text">{{ Str::limit($candidate->program, 80) }}</p>
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
                <button id="voteButton" type="button" class="btn btn-primary" onclick="submitVote()">Voter</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>


<!-- Footer -->
<footer class="footer">
    <div class="custom-shape-divider-top-1713266907">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="shape-fill"></path>
            <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" class="shape-fill"></path>
            <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="shape-fill"></path>
        </svg>
    </div>
    <div class="container-fluid footer-body">
        <div class="row">
            <div class="col-md-6 footer-left pt-xl-4 px-xl-5 d-flex justify-content-center flex-column">
                <div>
                    <img src="{{ asset('images/resc/iVOTE4.png') }}" class="img-fluid ivote-logo" id="footer" alt="iVote Logo">
                    <p>Cette plateforme est un système électoral automatisé conçu pour les élections des représentants étudiants au sein des UFR de l'Université Gaston Berger.</p>
                    <p class="credits-footer" id="credits"><span class="hello-text">© 2024 Université Gaston Berger de Saint-Louis.</span> Tous droits réservés</p>
                    <div class="vertical-line"></div>
                </div>
            </div>
            <div class="col-md-3 footer-middle">
                <div class="row">
                    <p class="credits-footer">Visitez</p>
                    <div class="col-md-3">
                        <a href="https://www.facebook.com/UGBSaintLouis">Université Gaston Berger</a>
                        <a href="https://www.facebook.com/UNSENEGAL">Université du Sénégal</a>
                    </div>
                    <div class="col-md-3">
                        <a href="https://www.facebook.com/MinistreEducationSenegal">Ministère de l'Éducation du Sénégal</a>
                        <a href="https://www.facebook.com/SENEGAL2025">Sénégal 2025</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 footer-right">
                <div>
                    <p class="credits-footer">Contactez-nous</p>
                    <p>Envoyez-nous un email à <a href="mailto:ivote.senegal@gmail.com" class="ivote-email">ivote.senegal@gmail.com</a></p>
                    <p><a href="{{ route('welcome') }}" class="footer-welcome-us">À propos | </a><a href="#" class="footer-welcome-us">Notre histoire</a></p>
                    <a href="https://twitter.com/ivote_senegal"><img src="data:image/png;base64,..."></a>
                    <a href="https://www.facebook.com/ivote_senegal"><img src="data:image/png;base64,..."></a>
                    <a href="https://www.instagram.com/ivote_senegal/"><img src="data:image/png;base64,..."></a>
                </div>
            </div>
        </div>
    </div>
    <div class="social-links text-center py-3">
        <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
        <a href="#" class="social-icon"><i class="fab fa-facebook"></i></a>
        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
    </div>

</footer>

<!-- Scripts JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Variables globales pour stocker l'état du vote
    let hasVoted = false;
    let currentCandidateId = null;
    // Fonction appelée lors du clic sur une carte candidat
    function openCandidateModal(name, program, photo, candidateId) {
    // Réinitialisation de l'état du vote
    currentCandidateId = candidateId;
    document.getElementById('voteButton').classList.remove('btn-voted');
    document.getElementById('voteButton').innerText = 'Voter';
    document.getElementById('voteButton').disabled = false;
    document.getElementById('voteMessage').classList.add('d-none');
    
    // Remplissage du modal
    document.getElementById('candidateModalLabel').innerText = name;
    document.getElementById('modalCandidateImage').src = "{{ asset('images') }}/" + photo;
    document.getElementById('modalCandidateProgram').innerText = program;
    
    // Affichage du modal
    let candidateModal = new bootstrap.Modal(document.getElementById('candidateModal'));
    candidateModal.show();
}

// Variable globale pour l'ID de l'élection (à définir dynamiquement, par exemple depuis votre Blade)
// pour le moment on gere qu'un seule vote
let currentElectionId = {{ $currentElection->id ?? 1 }}; // Remplacez 1 par la valeur par défaut ou assurez-vous que $currentElection est défini

function submitVote() {
    // Empêcher de voter plusieurs fois
    if(hasVoted) return;

    // Préparer les données du vote
    const voteData = {
        candidate_id: currentCandidateId,
        election_id: currentElectionId,
    };

    // Envoyer la requête AJAX via fetch vers la route vote.store
    fetch("{{ route('vote.store') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify(voteData)
    })
    .then(response => {
        // Vérifier si la réponse est en JSON et dans le cas contraire lever une erreur
        if (!response.ok) {
            return response.json().then(err => { throw err; });
        }
        return response.json();
    })
    .then(data => {
        // Si le vote a bien été enregistré côté serveur
        if(data.success){
            hasVoted = true;
            let voteBtn = document.getElementById('voteButton');
            voteBtn.classList.add('btn-voted');
            voteBtn.innerText = 'Voté';
            voteBtn.disabled = true;
            
            let voteMsg = document.getElementById('voteMessage');
            voteMsg.classList.remove('d-none');
            voteMsg.innerText = data.message || "Merci d'avoir voté pour ce candidat !";
        } else {
            // Gérer une éventuelle erreur retournée par le serveur
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
