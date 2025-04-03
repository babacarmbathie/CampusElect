<div class="container-fluid px-4 mt-3">
  

    <!-- En-tête de la section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0" style="color: var(--primary-color);"><i class="fas fa-user-graduate me-2"></i>Gestion des Étudiants</h4>
        <button type="button" class="btn btn-primary px-4 py-2" id="showStudentFormBtn" onclick="StudentManager.showForm()" 
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
                                   name="password" required placeholder="Mot de passe" minlength="8"
                                   autocomplete="new-password">
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
                                   name="password_confirmation" required placeholder="Confirmez le mot de passe" minlength="8"
                                   autocomplete="new-password">
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
                        <button type="button" class="btn btn-light btn-lg px-4" id="cancelStudentFormBtn" onclick="StudentManager.hideForm()">
                            <i class="fas fa-times me-2"></i> Annuler
                        </button>
                        <button type="submit" class="btn btn-primary btn-lg px-4" id="addStudentSubmitBtn"
                                style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--dark-color) 100%); border: none;">
                            <span class="spinner-border spinner-border-sm d-none me-2" id="addStudentSpinner"></span>
                            <i class="fas fa-save me-2" id="addStudentIcon"></i> Enregistrer
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
                                <div class="card mb-4 d-none border-0 shadow-lg modal-card" id="editStudentModal{{ $user->id }}" style="border-radius: 15px; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 90%; max-width: 800px; z-index: 99998;">
                                    <div class="card-header py-3" style="background: linear-gradient(135deg, #ffc107, #fd7e14); border-radius: 15px 15px 0 0;">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h5 class="mb-0 text-white">
                                                <i class="fas fa-edit me-2"></i> Modifier l'étudiant
                                            </h5>
                                            <button type="button" class="btn-close btn-close-white" onclick="StudentManager.closeModal()" aria-label="Close"></button>
                                        </div>
                                    </div>
                                    <div class="card-body p-4">
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
                                                <form id="editStudentForm{{ $user->id }}" method="POST" action="{{ route('students.update', $user->id) }}" class="needs-validation" novalidate>
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                    
                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold" style="color: var(--primary-color);">
                                                            <i class="fas fa-user me-2"></i>Nom complet <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" class="form-control form-control-lg border-0 shadow-sm" 
                                                               name="name" value="{{ $user->name }}" required
                                                               style="border-radius: 10px;">
                                                        <div class="invalid-feedback">Veuillez entrer le nom complet</div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold" style="color: var(--primary-color);">
                                                            <i class="fas fa-envelope me-2"></i>Email <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control form-control-lg border-0 shadow-sm" 
                                                                   name="email" value="{{ str_replace('@ugb.edu.sn', '', $user->email) }}" required
                                                                   style="border-radius: 10px 0 0 10px;">
                                                            <span class="input-group-text border-0 shadow-sm" style="background: var(--light-color);">
                                                                @ugb.edu.sn
                                                            </span>
                                                        </div>
                                                        <div class="invalid-feedback">Veuillez entrer une adresse email valide</div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold" style="color: var(--primary-color);">
                                                            <i class="fas fa-id-card me-2"></i>Code étudiant <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" class="form-control form-control-lg border-0 shadow-sm" 
                                                               name="student_code" value="{{ $user->student->student_code }}" required
                                                               pattern="^P[0-9]+$" style="border-radius: 10px;"
                                                               oninvalid="this.setCustomValidity('Le code doit commencer par P suivi de chiffres')"
                                                               oninput="this.setCustomValidity('')">
                                                        <small class="text-muted">Format requis: P suivi de chiffres (ex: P123456)</small>
                                                        <div class="invalid-feedback">Le code étudiant doit commencer par P suivi de chiffres</div>
                                                    </div>

                                                    <div class="alert alert-info" role="alert">
                                                        <i class="fas fa-info-circle me-2"></i>
                                                        <small>La modification des informations de l'étudiant nécessite une vérification. Assurez-vous que les données sont correctes.</small>
                                                    </div>

                                                    <div class="d-flex justify-content-end gap-2">
                                                        <button type="button" class="btn btn-light btn-lg px-4" onclick="StudentManager.closeModal()">
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
                                                onclick="StudentManager.edit({{ $user->id }})">
                                            <i class="fas fa-edit me-2"></i>Éditer
                                        </button>
                                        <button class="btn btn-sm btn-danger px-3" 
                                                onclick="StudentManager.confirmDelete({{ $user->id }})">
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

<!-- Container modal pour les étudiants -->
<div id="studentModalContainer" class="modal-system" style="display:none;">
    <div class="modal-backdrop"></div>
    <div class="modal-wrapper">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 15px;">
            <!-- Le contenu sera injecté ici -->
        </div>
    </div>
</div>

<style>
.modal-system {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    z-index: 999999;
}

.modal-system .modal-backdrop {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    z-index: 999999;
}

.modal-system .modal-wrapper {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 90%;
    max-width: 800px;
    z-index: 1000000;
}

.modal-system .modal-content {
    background: white;
    position: relative;
    width: 100%;
    transform: translateZ(0);
    will-change: transform;
}

body.modal-open {
    overflow: hidden;
    position: fixed;
    width: 100%;
    height: 100%;
}

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
#studentModalContainer {
    will-change: transform;
    transform-style: preserve-3d;
    backface-visibility: hidden;
    perspective: 1000px;
    transform: translateZ(0);
    -webkit-font-smoothing: subpixel-antialiased;
}

#studentModalContent {
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
</style>

<script type="text/javascript">
    // Création d'un espace de noms pour les étudiants
    const StudentManager = {
        // Fonction pour afficher le formulaire
        showForm: function() {
            console.log("StudentManager: showForm appelée");
            const formContainer = document.getElementById('studentFormContainer');
            const showFormBtn = document.getElementById('showStudentFormBtn');
            
            if (formContainer && showFormBtn) {
                formContainer.style.display = 'block';
                showFormBtn.style.display = 'none';
                formContainer.scrollIntoView({ behavior: 'smooth' });
            }
        },

        // Fonction pour cacher le formulaire
        hideForm: function() {
            console.log("StudentManager: hideForm appelée");
            const formContainer = document.getElementById('studentFormContainer');
            const showFormBtn = document.getElementById('showStudentFormBtn');
            
            if (formContainer && showFormBtn) {
                formContainer.style.display = 'none';
                showFormBtn.style.display = 'block';
                document.getElementById('studentForm').reset();
            }
        },

        // Fonction pour éditer un étudiant
        edit: function(studentId) {
            console.log("StudentManager: edit appelée pour étudiant", studentId);
            const editModal = document.querySelector(`#editStudentModal${studentId}`);
            if (!editModal) {
                console.error("Modal d'édition non trouvé");
                return;
            }
            
            this.showModal(editModal.innerHTML);
            this.setupEditForm(studentId);
        },

        setupEditForm: function(studentId) {
            const form = document.querySelector('#editStudentForm' + studentId);
            if (form) {
                form.onsubmit = (e) => {
                    e.preventDefault();
                    this.submitEdit(studentId, form);
                };
            }
        },

        closeModal: function() {
            const container = document.getElementById('studentModalContainer');
            container.style.display = 'none';
            container.querySelector('.modal-content').innerHTML = '';
            document.body.classList.remove('modal-open');
        },

        // Fonction pour confirmer la suppression
        confirmDelete: function(studentId) {
            console.log("StudentManager: confirmDelete appelée pour étudiant", studentId);
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
                    this.delete(studentId);
                }
            });
        },

        // Fonction pour soumettre l'édition
        submitEdit: function(studentId, form) {
            console.log("StudentManager: submitEdit appelée pour étudiant", studentId);
            const formData = new FormData(form);
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            
            // Ajout du domaine @ugb.edu.sn à l'email
            const emailInput = formData.get('email');
            if (emailInput && !emailInput.includes('@')) {
                formData.set('email', emailInput + '@ugb.edu.sn');
            }
            
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Traitement...';
            
            $.ajax({
                url: form.action,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                success: (response) => {
                    console.log("Réponse du serveur:", response);
                    if (response.success) {
                        this.closeModal();
                        Swal.fire({
                            title: 'Succès!',
                            text: response.message || 'Les modifications ont été enregistrées avec succès',
                            icon: 'success',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#5E2C1A'
                        }).then(() => {
                            this.reloadPage();
                        });
                    } else {
                        Swal.fire({
                            title: 'Erreur!',
                            text: response.message || 'Une erreur est survenue lors de la mise à jour',
                            icon: 'error',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#5E2C1A'
                        });
                    }
                },
                error: (xhr) => {
                    console.error("Erreur lors de la soumission:", xhr);
                    let errorMessage = 'Une erreur est survenue';
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        errorMessage = Object.values(errors).flat().join('\n');
                    }
                    Swal.fire({
                        title: 'Erreur!',
                        text: errorMessage,
                        icon: 'error',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#5E2C1A'
                    });
                },
                complete: () => {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalText;
                }
            });
        },

        // Fonction pour supprimer un étudiant
        delete: function(studentId) {
            console.log("StudentManager: delete appelée pour étudiant", studentId);
            $.ajax({
                url: `/admin/students/${studentId}`,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: () => {
                    Swal.fire({
                        title: 'Suppression en cours...',
                        text: 'Veuillez patienter',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showConfirmButton: false,
                        willOpen: () => {
                            Swal.showLoading();
                        }
                    });
                },
                success: (response) => {
                    if (response.success) {
                        Swal.fire({
                            title: 'Supprimé!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#5E2C1A'
                        }).then(() => this.reloadPage());
                    }
                },
                error: () => {
                    Swal.fire({
                        title: 'Erreur!',
                        text: 'Une erreur est survenue lors de la suppression.',
                        icon: 'error',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#5E2C1A'
                    });
                }
            });
        },

        // Fonction pour recharger la page proprement
        reloadPage: function() {
            // Supprimer les intervalles et timeouts existants
            const highestTimeoutId = setTimeout(";");
            for (let i = 0; i < highestTimeoutId; i++) {
                clearTimeout(i);
            }
            
            // Supprimer les intervalles
            const highestIntervalId = setInterval(";");
            for (let i = 0; i < highestIntervalId; i++) {
                clearInterval(i);
            }
            
            // Recharger la page
            window.location.href = window.location.pathname;
        },

        // Amélioration de la gestion des modals
        showModal: function(content) {
            const container = document.getElementById('studentModalContainer');
            const modalContent = container.querySelector('.modal-content');
            
            modalContent.innerHTML = content;
            document.body.classList.add('modal-open');
            container.style.display = 'block';
            
            // Gestionnaire pour fermer avec Echap
            const handleEscape = (e) => {
                if (e.key === 'Escape') this.closeModal();
            };
            document.addEventListener('keydown', handleEscape);
            
            // Gestionnaire pour le backdrop
            container.querySelector('.modal-backdrop').onclick = () => this.closeModal();
        },

        // Amélioration de l'initialisation
        init: function() {
            document.addEventListener('DOMContentLoaded', () => {
                // Configuration du bouton d'ajout
                const showFormBtn = document.getElementById('showStudentFormBtn');
                if (showFormBtn) {
                    showFormBtn.onclick = () => this.showForm();
                }

                // Configuration du bouton d'annulation
                const cancelFormBtn = document.getElementById('cancelStudentFormBtn');
                if (cancelFormBtn) {
                    cancelFormBtn.onclick = () => this.hideForm();
                }

                // Configuration du formulaire
                this.setupForm();

                // Configuration des animations des cartes
                document.querySelectorAll('.hover-shadow').forEach(card => {
                    card.addEventListener('mouseenter', function() {
                        this.style.transform = 'translateY(-5px)';
                        this.style.boxShadow = '0 10px 20px rgba(0,0,0,0.1)';
                    });
                    card.addEventListener('mouseleave', function() {
                        this.style.transform = 'translateY(0)';
                        this.style.boxShadow = 'none';
                    });
                });
            });
        }
    };

    // Initialisation
    document.addEventListener('DOMContentLoaded', () => {
        StudentManager.init();
    });
</script>