<div class="container-fluid px-4 mt-3">
  

    <!-- En-tête de la section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0" style="color: var(--primary-color);"><i class="fas fa-user-graduate me-2"></i>Gestion des Étudiants</h4>
        <button type="button" class="btn btn-primary px-4 py-2" id="showFormBtn" onclick="showForm()" 
                style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--dark-color) 100%); border: none;">
            <i class="fas fa-user-plus me-2"></i> Nouvel Étudiant
        </button>
    </div>
    
    <!-- Formulaire d'ajout (caché par défaut) -->
    <div class="card mb-4 border-0 shadow-lg" id="studentFormContainer" style="border-radius: 15px; display: none;">
        <div class="card-header py-3" style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--dark-color) 100%); border-radius: 15px 15px 0 0;">
            <h5 class="mb-0 text-white"><i class="fas fa-user-plus me-2"></i> Ajouter un nouvel étudiant</h5>
        </div>
        <div class="card-body p-4">
            <form method="POST" action="{{ route('students.store') }}" enctype="multipart/form-data" id="studentForm" class="needs-validation" novalidate>
                @csrf
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold" style="color: var(--primary-color);">
                                <i class="fas fa-user me-2"></i>Nom complet <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control form-control-lg border-0 shadow-sm @error('name') is-invalid @enderror" 
                                   name="name" required placeholder="Entrez le nom complet"
                                   value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold" style="color: var(--primary-color);">
                                <i class="fas fa-envelope me-2"></i>Email <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <input type="email" class="form-control form-control-lg border-0 shadow-sm @error('email') is-invalid @enderror" 
                                       name="email" required placeholder="prenom.nom"
                                       value="{{ old('email') }}">
                                <span class="input-group-text border-0 shadow-sm" style="background: var(--light-color);">
                                    @ugb.edu.sn
                                </span>
                            </div>
                            <small class="text-muted">L'email doit être une adresse UGB valide</small>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold" style="color: var(--primary-color);">
                                <i class="fas fa-id-card me-2"></i>Code étudiant <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control form-control-lg border-0 shadow-sm @error('student_code') is-invalid @enderror" 
                                   name="student_code" required placeholder="P123456"
                                   pattern="^P[0-9]+$" value="{{ old('student_code') }}"
                                   oninvalid="this.setCustomValidity('Le code doit commencer par P suivi de chiffres')"
                                   oninput="this.setCustomValidity('')">
                            <small class="text-muted">Format requis: P suivi de chiffres (ex: P123456)</small>
                            @error('student_code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold" style="color: var(--primary-color);">
                                <i class="fas fa-lock me-2"></i>Mot de passe <span class="text-danger">*</span>
                            </label>
                            <input type="password" class="form-control form-control-lg border-0 shadow-sm @error('password') is-invalid @enderror" 
                                   name="password" required placeholder="Mot de passe" minlength="8">
                            <small class="text-muted">Minimum 8 caractères</small>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold" style="color: var(--primary-color);">
                                <i class="fas fa-lock me-2"></i>Confirmer le mot de passe <span class="text-danger">*</span>
                            </label>
                            <input type="password" class="form-control form-control-lg border-0 shadow-sm" 
                                   name="password_confirmation" required placeholder="Confirmez le mot de passe" minlength="8">
                            <div class="invalid-feedback">Veuillez confirmer le mot de passe</div>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <div class="alert alert-info" role="alert">
                            <i class="fas fa-info-circle me-2"></i>
                            <small>L'étudiant pourra se connecter à l'application avec ces identifiants.</small>
                        </div>
                    </div>
                    
                    <div class="col-12 d-flex justify-content-end gap-3">
                        <button type="button" class="btn btn-light btn-lg px-4" id="cancelFormBtn">
                            <i class="fas fa-times me-2"></i> Annuler
                        </button>
                        <button type="submit" class="btn btn-primary btn-lg px-4" id="submitBtn"
                                style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--dark-color) 100%); border: none;">
                            <span class="spinner-border spinner-border-sm d-none me-2" id="submitSpinner"></span>
                            <i class="fas fa-save me-2" id="submitIcon"></i> Enregistrer
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Liste des étudiants -->
    <div class="card shadow-lg border-0" style="border-radius: 15px;">
        <div class="card-header py-3" style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--dark-color) 100%); border-radius: 15px 15px 0 0;">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0 text-white"><i class="fas fa-list me-2"></i> Liste des étudiants</h4>
                <div class="d-flex align-items-center">
                    <div class="position-relative me-3">
                        <input type="text" class="form-control border-0 shadow-sm" id="searchStudent" 
                               placeholder="Rechercher un étudiant..." style="border-radius: 20px; padding-left: 35px;">
                        <i class="fas fa-search position-absolute" style="left: 12px; top: 50%; transform: translateY(-50%); color: var(--primary-color);"></i>
                    </div>
                    <span class="badge bg-light text-dark rounded-pill px-4 py-2 fs-6">{{ $users->count() }} étudiant(s)</span>
                </div>
            </div>
        </div>
        
        <div class="card-body p-4">
        @if($users->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="py-3 px-4 text-uppercase fw-bold" style="color: var(--primary-color);">Étudiant</th>
                                <th class="py-3 px-4 text-uppercase fw-bold" style="color: var(--primary-color);">Contact</th>
                                <th class="py-3 px-4 text-uppercase fw-bold" style="color: var(--primary-color);">Code Étudiant</th>
                                <th class="py-3 px-4 text-uppercase fw-bold text-end" style="color: var(--primary-color);">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                                <!-- Modal d'édition (caché) -->
                                <div class="modal fade" id="editStudentModal{{ $user->id }}" tabindex="-1" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content border-0 shadow-lg" style="border-radius: 15px;">
                                            <div class="modal-header border-0 py-3" 
                                                 style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--dark-color) 100%); border-radius: 15px 15px 0 0;">
                                                <h5 class="modal-title text-white">
                                                    <i class="fas fa-user-edit me-2"></i>Modifier l'étudiant
                                                </h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body p-4">
                                                <div class="row">
                                                    <!-- Colonne de gauche avec avatar -->
                                                    <div class="col-md-4 text-center mb-4 mb-md-0">
                                                        <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" 
                                                             style="width: 150px; height: 150px; background: linear-gradient(135deg, var(--primary-color) 0%, var(--dark-color) 100%);">
                                                            <span class="text-white" style="font-size: 4rem;">{{ substr($user->name, 0, 1) }}</span>
                                                        </div>
                                                        <h5 class="fw-bold mb-1" style="color: var(--primary-color);">{{ $user->name }}</h5>
                                                        <p class="text-muted mb-3">Étudiant</p>
                                                        <div class="badge px-3 py-2 mb-3" 
                                                             style="background-color: var(--light-color); color: var(--primary-color);">
                                                            <i class="fas fa-id-card me-2"></i>{{ $user->student->student_code }}
                                                        </div>
                                                    </div>

                                                    <!-- Colonne de droite avec le formulaire -->
                                                    <div class="col-md-8">
                                                        <form id="editStudentForm{{ $user->id }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                            
                                                            <div class="mb-3">
                                                                <label class="form-label fw-bold" style="color: var(--primary-color);">
                                                                    <i class="fas fa-user me-2"></i>Nom complet
                                                                </label>
                                                                <input type="text" class="form-control form-control-lg border-0 shadow-sm" 
                                                                       name="name" value="{{ $user->name }}" required
                                                                       style="border-radius: 10px;">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label fw-bold" style="color: var(--primary-color);">
                                                                    <i class="fas fa-envelope me-2"></i>Email
                                                                </label>
                                                                <div class="input-group">
                                                                    <input type="email" class="form-control form-control-lg border-0 shadow-sm" 
                                                                           name="email" value="{{ $user->email }}" required
                                                                           style="border-radius: 10px 0 0 10px;">
                                                                    <span class="input-group-text border-0 shadow-sm" style="background: var(--light-color);">
                                                                        @ugb.edu.sn
                                                                    </span>
                                                                </div>
                                                                <small class="text-muted">L'email doit être une adresse UGB valide</small>
                                                            </div>

                                                            <div class="mb-4">
                                                                <label class="form-label fw-bold" style="color: var(--primary-color);">
                                                                    <i class="fas fa-id-card me-2"></i>Code étudiant
                                                                </label>
                                                                <input type="text" class="form-control form-control-lg border-0 shadow-sm" 
                                                                       name="student_code" value="{{ $user->student->student_code }}" required
                                                                       pattern="^P[0-9]+$" style="border-radius: 10px;"
                                                                       oninvalid="this.setCustomValidity('Le code doit commencer par P suivi de chiffres')"
                                                                       oninput="this.setCustomValidity('')">
                                                                <small class="text-muted">Format requis: P suivi de chiffres (ex: P123456)</small>
                                                            </div>

                                                            <div class="alert alert-info" role="alert">
                                                                <i class="fas fa-info-circle me-2"></i>
                                                                <small>La modification des informations de l'étudiant nécessite une vérification. Assurez-vous que les données sont correctes.</small>
                                                            </div>

                                                            <div class="d-flex justify-content-end gap-2">
                                                                <button type="button" class="btn btn-light btn-lg px-4" onclick="closeFixedModal()">
                                                                    <i class="fas fa-times me-2"></i>Annuler
                                                                </button>
                                                                <button type="submit" class="btn btn-primary btn-lg px-4" 
                                                                        style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--dark-color) 100%); border: none;">
                                                                    <i class="fas fa-save me-2"></i>Enregistrer
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <tr class="align-middle hover-shadow" style="transition: all 0.3s ease;">
                                <td class="px-4">
                                    <div class="d-flex align-items-center">
                                            <div class="rounded-circle d-flex align-items-center justify-content-center shadow-sm me-3" 
                                                 style="width: 45px; height: 45px; background: linear-gradient(135deg, var(--primary-color) 0%, var(--dark-color) 100%);">
                                                <span class="text-white fw-bold">{{ substr($user->name, 0, 1) }}</span>
                                            </div>
                                            <div>
                                                <h6 class="fw-bold mb-1" style="color: var(--primary-color);">{{ $user->name }}</h6>
                                                <small class="text-muted">Étudiant</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4">
                                        <div>
                                            <span class="d-block mb-1"><i class="fas fa-envelope me-2" style="color: var(--primary-color);"></i>{{ $user->email }}</span>
                                    </div>
                                </td>
                                <td class="px-4">
                                        <span class="badge px-3 py-2" 
                                              style="background-color: var(--light-color); color: var(--primary-color); font-size: 0.9em;">
                                            <i class="fas fa-id-card me-2"></i>{{ $user->student->student_code ?? 'N/A' }}
                                    </span>
                                </td>
                                <td class="px-4 text-end">
                                        <button class="btn btn-sm px-3 me-2" 
                                                style="background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%); color: #000; border: none; font-weight: 500;"
                                                onclick="editStudent({{ $user->id }})">
                                            <i class="fas fa-edit me-2"></i>Éditer
                                        </button>
                                        <button class="btn btn-sm btn-danger px-3" 
                                                onclick="confirmDeleteStudent({{ $user->id }})">
                                            <i class="fas fa-trash me-2"></i>Supprimer
                                        </button>
                                    </td>
                                </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
                
                <div class="pagination-container d-flex justify-content-center mt-4">
                    {{ $users->links() }}
            </div>
        @else
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="fas fa-user-slash fa-4x" style="color: var(--secondary-color);"></i>
                    </div>
                    <h5 class="text-muted">Aucun étudiant enregistré</h5>
                    <p class="text-muted">Cliquez sur "Nouvel Étudiant" pour ajouter un étudiant</p>
                </div>
            @endif
            </div>
    </div>
</div>

<!-- Container modal universel fixé - Ne bouge jamais -->
<div id="fixedModalContainer" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; z-index:9999999; pointer-events:none;">
    <div id="fixedModalBackdrop" style="position:fixed; top:0; left:0; width:100%; height:100%; background-color:rgba(0,0,0,0.7); pointer-events:all;"></div>
    <div id="fixedModalContent" class="card border-0 shadow-lg" style="position:fixed; top:50%; left:50%; transform:translate(-50%, -50%); width:90%; max-width:800px; pointer-events:all; border-radius:15px; overflow:hidden;"></div>
</div>

<!-- Scripts et Styles supplémentaires -->
<script type="text/javascript">
    // Fonction globale pour afficher le formulaire
    function showForm() {
        console.log("Fonction showForm appelée");
        var formContainer = document.getElementById('studentFormContainer');
        var showFormBtn = document.getElementById('showFormBtn');
        
        if (formContainer && showFormBtn) {
            console.log("Éléments trouvés, affichage du formulaire");
            formContainer.style.display = 'block';
            showFormBtn.style.display = 'none';
            formContainer.scrollIntoView({ behavior: 'smooth' });
        } else {
            console.log("Éléments non trouvés:", {
                formContainer: !!formContainer,
                showFormBtn: !!showFormBtn
            });
        }
    }

    // Fonction pour cacher le formulaire
    function hideForm() {
        console.log("Fonction hideForm appelée");
        var formContainer = document.getElementById('studentFormContainer');
        var showFormBtn = document.getElementById('showFormBtn');
        
        if (formContainer && showFormBtn) {
            formContainer.style.display = 'none';
            showFormBtn.style.display = 'block';
            document.getElementById('studentForm').reset();
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        console.log("DOM chargé - Configuration des événements");

        // Configuration du bouton d'annulation
        var cancelFormBtn = document.getElementById('cancelFormBtn');
        if (cancelFormBtn) {
            cancelFormBtn.onclick = function() {
                console.log("Bouton annuler cliqué");
                hideForm();
            };
        }

        // Configuration de la soumission du formulaire
        var form = document.getElementById('studentForm');
        if (form) {
            form.onsubmit = function(e) {
                console.log("Soumission du formulaire");
                if (!this.checkValidity()) {
                    e.preventDefault();
                    e.stopPropagation();
                }
                this.classList.add('was-validated');
            };
        }
    });

    let activeModal = null;
    let scrollPosition = 0;

    // Fonction pour arrêter tous les événements de souris sur le document
    function stopMouseEvents(e) {
        if (!e.target.closest('.modal-card')) {
            e.preventDefault();
            e.stopPropagation();
            return false;
        }
    }

    function disableScrolling() {
        const scrollY = window.scrollY;
        document.body.style.position = 'fixed';
        document.body.style.width = '100%';
        document.body.style.height = '100%';
        document.body.style.top = `-${scrollY}px`;
        document.body.style.overflow = 'hidden';
        
        return scrollY;
    }

    function enableScrolling(scrollY) {
        document.body.style.position = '';
        document.body.style.width = '';
        document.body.style.height = '';
        document.body.style.top = '';
        document.body.style.overflow = '';
        window.scrollTo(0, scrollY);
    }

    let savedScrollPosition = 0;

    function showStudentDetails(studentId) {
        // Sauvegarder la position de défilement et désactiver le défilement
        savedScrollPosition = disableScrolling();
        
        const student = document.querySelector(`#modalStudent${studentId}`);
        if (!student) return;
        
        // Charger le contenu dans le container fixe
        const modalContent = document.getElementById('fixedModalContent');
        const modalBackdrop = document.getElementById('fixedModalBackdrop');
        const modalContainer = document.getElementById('fixedModalContainer');
        
        // Copier le contenu HTML de la carte de l'étudiant dans le modal fixe
        const studentContent = document.querySelector(`#modalStudent${studentId}`).innerHTML;
        modalContent.innerHTML = studentContent;
        
        // Remplacer les boutons pour utiliser closeFixedModal
        const closeButtons = modalContent.querySelectorAll('[onclick*="hideStudentDetails"]');
        closeButtons.forEach(button => {
            button.setAttribute('onclick', 'closeFixedModal()');
        });
        
        // Remplacer les fonctions des autres boutons
        const editButtons = modalContent.querySelectorAll('[onclick*="editStudent"]');
        editButtons.forEach(button => {
            const newOnclick = button.getAttribute('onclick').replace(`editStudent(${studentId})`, `editStudentFromModal(${studentId})`);
            button.setAttribute('onclick', newOnclick);
        });
        
        const deleteButtons = modalContent.querySelectorAll('[onclick*="confirmDeleteStudent"]');
        deleteButtons.forEach(button => {
            const newOnclick = button.getAttribute('onclick').replace(`confirmDeleteStudent(${studentId})`, `confirmDeleteStudentFromModal(${studentId})`);
            button.setAttribute('onclick', newOnclick);
        });
        
        // Ajouter un gestionnaire de clic pour le backdrop
        modalBackdrop.onclick = closeFixedModal;
        
        // Afficher le modal
        modalContainer.style.display = 'block';
        
        // Ajouter un gestionnaire pour la touche Échap
        document.addEventListener('keydown', handleEscapeKey);
    }

    function closeFixedModal() {
        const modalContainer = document.getElementById('fixedModalContainer');
        modalContainer.style.display = 'none';
        
        // Vider le contenu
        document.getElementById('fixedModalContent').innerHTML = '';
        
        // Réactiver le défilement
        enableScrolling(savedScrollPosition);
        
        // Supprimer le gestionnaire de la touche Échap
        document.removeEventListener('keydown', handleEscapeKey);
    }

    function handleEscapeKey(e) {
        if (e.key === 'Escape') {
            closeFixedModal();
        }
    }

    function editStudentFromModal(studentId) {
        closeFixedModal();
        setTimeout(() => {
            editStudent(studentId);
        }, 100);
    }

    function confirmDeleteStudentFromModal(studentId) {
        closeFixedModal();
        setTimeout(() => {
            confirmDeleteStudent(studentId);
        }, 100);
    }

    // Fonction pour éditer un étudiant
    function editStudent(studentId) {
        // Sauvegarder la position de défilement et désactiver le défilement
        savedScrollPosition = disableScrolling();
        
        // Afficher le modal d'édition en utilisant Bootstrap
        const modal = new bootstrap.Modal(document.getElementById(`editStudentModal${studentId}`));
        modal.show();
        
        // Configuration de la soumission du formulaire d'édition
        $(`#editStudentForm${studentId}`).on('submit', function(e) {
            e.preventDefault();
            
            // Récupérer les données du formulaire
            const formData = new FormData(this);
            
            // Envoyer la requête AJAX pour mettre à jour l'étudiant
            $.ajax({
                url: `/admin/etudiants/${studentId}`,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'X-HTTP-Method-Override': 'PUT'
                },
                beforeSend: function() {
                    // Afficher l'indicateur de chargement
                    $(e.target).find('button[type="submit"]').prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i>Traitement...');
                },
                success: function(response) {
                    if (response.success) {
                        // Fermer le modal
                        modal.hide();
                        
                        // Afficher un message de succès
                        Swal.fire({
                            title: 'Succès!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#5E2C1A'
                        }).then(() => {
                            // Recharger la page pour afficher les modifications
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: 'Erreur!',
                            text: response.message || 'Une erreur est survenue lors de la mise à jour de l\'étudiant.',
                            icon: 'error',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#5E2C1A'
                        });
                    }
                },
                error: function(xhr) {
                    // Gérer les erreurs de validation
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        let errorMessage = 'Veuillez corriger les erreurs suivantes:<br>';
                        
                        for (const field in errors) {
                            errorMessage += `- ${errors[field][0]}<br>`;
                        }
                        
                        Swal.fire({
                            title: 'Validation échouée!',
                            html: errorMessage,
                            icon: 'error',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#5E2C1A'
                        });
                    } else {
                        Swal.fire({
                            title: 'Erreur!',
                            text: 'Une erreur est survenue lors de la mise à jour de l\'étudiant.',
                            icon: 'error',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#5E2C1A'
                        });
                    }
                },
                complete: function() {
                    // Réactiver le bouton de soumission
                    $(e.target).find('button[type="submit"]').prop('disabled', false).html('<i class="fas fa-save me-2"></i>Enregistrer');
                    
                    // Réactiver le défilement
                    enableScrolling(savedScrollPosition);
                }
            });
        });
    }

    // Fonction pour confirmer la suppression d'un étudiant
    function confirmDeleteStudent(studentId) {
        Swal.fire({
            title: 'Êtes-vous sûr?',
            text: "Cette action est irréversible, l'étudiant et toutes ses données seront supprimés!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Oui, supprimer!',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                deleteStudent(studentId);
            }
        });
    }

    // Fonction pour supprimer un étudiant
    function deleteStudent(studentId) {
        $.ajax({
            url: `/admin/etudiants/${studentId}`,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        title: 'Supprimé!',
                        text: response.message,
                        icon: 'success',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#5E2C1A'
                    }).then(() => {
                        // Recharger la page pour mettre à jour la liste
                        window.location.reload();
                    });
                } else {
                    Swal.fire({
                        title: 'Erreur!',
                        text: response.message || 'Une erreur est survenue lors de la suppression de l\'étudiant.',
                        icon: 'error',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#5E2C1A'
                    });
                }
            },
            error: function() {
                Swal.fire({
                    title: 'Erreur!',
                    text: 'Une erreur est survenue lors de la suppression de l\'étudiant.',
                    icon: 'error',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#5E2C1A'
                });
            }
        });
    }

    // Assurez-vous que les boutons d'édition et de suppression dans le modal utilisent nos fonctions
    document.addEventListener('DOMContentLoaded', function() {
        // Configuration des modaux Bootstrap pour qu'ils apparaissent correctement
        document.querySelectorAll('.modal').forEach(modal => {
            modal.style.zIndex = '99999';
            modal.addEventListener('show.bs.modal', function() {
                setTimeout(() => {
                    document.querySelectorAll('.modal-backdrop').forEach(backdrop => {
                        backdrop.style.zIndex = '99990';
                    });
                }, 0);
            });
        });
    });
</script>

<style>
    .modal {
        padding-right: 0 !important;
    }
    
    .modal-open {
        overflow: hidden;
        padding-right: 0 !important;
    }
    
    .modal-dialog {
        margin: 1.75rem auto !important;
        transform: none !important;
    }
    
    .modal.fade .modal-dialog {
        transition: none !important;
        transform: none !important;
    }
    
    .modal.show .modal-dialog {
        transform: none !important;
    }
    
    .modal-backdrop {
        opacity: 0.5;
    }
    
    .modal-content {
        box-shadow: 0 5px 15px rgba(0,0,0,.5);
        border: none;
    }
    
    body.modal-open {
        position: fixed;
        width: 100%;
    }

    .modal-backdrop {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: #000;
        z-index: 1040;
    }

    @media (max-width: 768px) {
        #modalStudent {
            width: 95%;
            margin: 10px;
        }
    }

    /* Styles pour les modals */
    .modal-card {
        -webkit-transform: translate(-50%, -50%) !important;
        transform: translate(-50%, -50%) !important;
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
        perspective: 1000px;
        position: fixed !important;
        top: 50% !important;
        left: 50% !important;
        will-change: transform;
        user-select: none;
        pointer-events: auto;
        touch-action: none;
        z-index: 999999 !important;
        box-shadow: 0 10px 50px rgba(0,0,0,0.5) !important;
        transform-origin: center center !important;
        transition: none !important;
        animation: none !important;
    }
    
    .modal-backdrop {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        width: 100vw;
        height: 100vh;
        background-color: rgba(0, 0, 0, 0.7);
        z-index: 999990 !important;
        pointer-events: all;
        touch-action: none;
        user-select: none;
    }
    
    body.has-modal {
        overflow: hidden !important;
        position: fixed;
        width: 100%;
        height: 100%;
        touch-action: none;
        pointer-events: auto;
    }

    body.has-modal * {
        pointer-events: none;
    }

    body.has-modal .modal-card, 
    body.has-modal .modal-card *,
    body.has-modal .modal-backdrop {
        pointer-events: auto;
    }

    /* Styles supplémentaires pour éviter les problèmes */
    #fixedModalContainer {
        will-change: transform;
        transform-style: preserve-3d;
        backface-visibility: hidden;
        perspective: 1000px;
        transform: translateZ(0);
        -webkit-font-smoothing: subpixel-antialiased;
    }

    #fixedModalContent {
        box-shadow: 0 10px 50px rgba(0,0,0,0.5) !important;
        will-change: transform;
        transform-style: preserve-3d;
        backface-visibility: hidden;
        perspective: 1000px;
        transform: translate(-50%, -50%) translateZ(0);
        -webkit-font-smoothing: subpixel-antialiased;
    }

    /* Empêcher les tremblements sur les éléments avec position: fixed */
    body {
        -webkit-transform: translate3d(0, 0, 0);
        transform: translate3d(0, 0, 0);
    }
    
    /* Styles pour s'assurer que les modaux Bootstrap sont bien affichés */
    .modal {
        z-index: 99999 !important;
    }
    
    .modal-backdrop {
        z-index: 99990 !important;
    }
    
    .modal-content {
        border-radius: 15px !important;
        border: none !important;
        box-shadow: 0 10px 50px rgba(0,0,0,0.5) !important;
    }
    
    .modal-header {
        border-radius: 15px 15px 0 0 !important;
    }
</style>