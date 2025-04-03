// Variables globales
let hasVoted = window.electionConfig?.hasVoted || false;
let votedCandidateId = window.electionConfig?.votedCandidateId || null;
let currentElectionId = window.electionConfig?.currentElectionId || null;
let currentCandidateId = null;
let progressUpdateInterval = null;
let csrfToken = window.electionConfig?.csrfToken || '';
let voteEndpoint = window.electionConfig?.voteEndpoint || '/vote';

// Vérification des variables requises
if (currentElectionId === null) {
  console.error("Erreur: ID de l'élection non défini");
}

// Initialisation des barres de progression
document.addEventListener('DOMContentLoaded', function() {
  console.log("Configuration de l'élection:", window.electionConfig);
  if (hasVoted) {
    updateProgressBars();
    progressUpdateInterval = setInterval(updateProgressBars, 5000);
  }
});

// Fonction pour ouvrir le modal du candidat
function openCandidateModal(name, program, photo, candidateId) {
  if (!name || !program || !photo || !candidateId) {
    console.error("Données du candidat manquantes");
    return;
  }

  currentCandidateId = candidateId;
  const voteBtn = document.getElementById('voteButton');
  const voteMsg = document.getElementById('voteMessage');
  
  if (!voteBtn || !voteMsg) {
    console.error("Éléments du DOM manquants");
    return;
  }

  // Réinitialisation du bouton
  voteBtn.classList.remove('btn-voted');
  voteBtn.innerHTML = '<i class="fas fa-vote-yea me-2"></i>Voter';
  voteBtn.disabled = false;
  
  // Réinitialisation du message
  voteMsg.classList.add('d-none');
  voteMsg.textContent = '';

  // Remplir le modal
  const modalLabel = document.getElementById('candidateModalLabel');
  const modalImage = document.getElementById('modalCandidateImage');
  const modalProgram = document.getElementById('modalCandidateProgram');

  if (!modalLabel || !modalImage || !modalProgram) {
    console.error("Éléments du modal manquants");
    return;
  }

  modalLabel.textContent = name;
  modalImage.src = "/storage/" + photo;
  modalProgram.textContent = program.replace(/\\n/g, '\n');
  
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
  const modalElement = document.getElementById('candidateModal');
  if (!modalElement) {
    console.error("Modal non trouvé");
    return;
  }
  const modal = new bootstrap.Modal(modalElement);
  modal.show();
}

// Confirmation du vote
function confirmVote() {
  if (!currentCandidateId) {
    console.error("Aucun candidat sélectionné");
    return;
  }
  
  if (window.electionConfig?.isElectionClosed) {
    alert(window.uiMessages?.electionClosed || "Cette élection est terminée.");
    return;
  }
  
  if (window.electionConfig?.hasNoElection) {
    alert(window.uiMessages?.noElection || "Aucune élection n'est en cours.");
    return;
  }
  
  if (confirm(window.uiMessages?.confirmVote || "Confirmez-vous votre vote pour ce candidat ?\nCette action est irréversible.")) {
    submitVote();
  }
}

// Soumission du vote avec gestion CSRF et erreurs
function submitVote() {
  if (hasVoted || !currentCandidateId || !currentElectionId) {
    console.error("Vote impossible : déjà voté ou données manquantes", {
      hasVoted,
      currentCandidateId,
      currentElectionId
    });
    return;
  }

  const voteBtn = document.getElementById('voteButton');
  if (!voteBtn) {
    console.error("Bouton de vote non trouvé");
    return;
  }

  voteBtn.disabled = true;
  voteBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Enregistrement...';

  console.log("Envoi du vote:", {
    candidate_id: currentCandidateId,
    election_id: currentElectionId,
    endpoint: voteEndpoint
  });

  fetch(voteEndpoint, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "X-CSRF-TOKEN": csrfToken,
      "Accept": "application/json"
    },
    body: JSON.stringify({
      candidate_id: currentCandidateId,
      election_id: currentElectionId
    })
  })
  .then(async response => {
    const data = await response.json();
    console.log("Réponse du serveur:", data);
    
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
      const voteMsg = document.getElementById('voteMessage');

      if (!voteBtn || !voteMsg) {
        console.error("Éléments du DOM manquants");
        return;
      }

      voteBtn.classList.add('btn-voted');
      voteBtn.innerHTML = '<i class="fas fa-check-circle me-2"></i>Voté';
      voteBtn.disabled = true;
      
      voteMsg.textContent = data.message || "Merci pour votre vote !";
      voteMsg.classList.remove('d-none');

      // Mettre à jour immédiatement les barres de progression
      updateProgressBars();
      
      // Démarrer les mises à jour régulières
      if (progressUpdateInterval) {
        clearInterval(progressUpdateInterval);
      }
      progressUpdateInterval = setInterval(updateProgressBars, 2000);
      
      // Recharger la page après 2 secondes pour afficher tous les changements
      setTimeout(() => {
        window.location.reload();
      }, 2000);
    }
  })
  .catch(error => {
    console.error('Erreur:', error);
    
    const voteBtn = document.getElementById('voteButton');
    if (voteBtn) {
      voteBtn.disabled = false;
      voteBtn.innerHTML = '<i class="fas fa-vote-yea me-2"></i>Voter';
    }
    
    alert(error.message || "Une erreur est survenue. Veuillez réessayer.");
  });
}

// Mise à jour des barres de progression avec gestion des erreurs
function updateProgressBars() {
  fetch("/vote/progress", {
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
        if (!item.candidate_id) {
          console.error("ID du candidat manquant dans les données");
          return;
        }

        const progressBar = document.getElementById('progress-' + item.candidate_id);
        if (progressBar) {
          const percentage = item.vote_percentage || 0;
          progressBar.style.width = percentage + "%";
          progressBar.setAttribute('aria-valuenow', percentage);
          
          const span = progressBar.querySelector('span');
          if (span) {
            span.textContent = percentage + "%";
          }
        }
      });
    }
  })
  .catch(error => {
    console.error("Erreur mise à jour progression:", error);
    // Arrêter les mises à jour en cas d'erreur répétée
    if (progressUpdateInterval) {
      clearInterval(progressUpdateInterval);
      progressUpdateInterval = null;
    }
  });
} 