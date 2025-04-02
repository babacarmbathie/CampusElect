<div class="container-fluid px-4 mt-3">
    

    <!-- Bouton pour ouvrir le formulaire -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0" style="color: var(--primary-color);"><i class="fas fa-user-tie me-2"></i>Gestion des Candidats</h4>
        <button type="button" class="btn btn-primary px-4 py-2" id="showFormBtn" onclick="showForm()" 
                style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--dark-color) 100%); border: none;">
            <i class="fas fa-user-plus me-2"></i> Nouveau Candidat
        </button>
    </div>

    <!-- Formulaire d'ajout (caché par défaut) -->
    <div class="card mb-4 border-0 shadow-lg" id="candidateFormContainer" style="border-radius: 15px; display: none;">
        <div class="card-header py-3" style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--dark-color) 100%); border-radius: 15px 15px 0 0;">
            <h5 class="mb-0 text-white"><i class="fas fa-user-plus me-2"></i> Ajouter un nouveau candidat</h5>
        </div>
        <div class="card-body p-4">
            <form method="POST" action="{{ route('candidates.store') }}" enctype="multipart/form-data" id="candidateForm" class="needs-validation" novalidate>
                @csrf
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold" style="color: var(--primary-color);">
                                Nom complet <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control form-control-lg border-0 shadow-sm @error('name') is-invalid @enderror" 
                                   id="name" name="name" required placeholder="Entrez le nom complet"
                                   value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="election_id" class="form-label fw-bold" style="color: var(--primary-color);">
                                Élection <span class="text-danger">*</span>
                            </label>
                            <select class="form-select form-select-lg border-0 shadow-sm @error('election_id') is-invalid @enderror" 
                                    id="election_id" name="election_id" required>
                                <option value="" selected disabled>Sélectionnez une élection</option>
                                @foreach($elections as $election)
                                    <option value="{{ $election->id }}" {{ old('election_id') == $election->id ? 'selected' : '' }}>
                                        {{ $election->title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('election_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="photo" class="form-label fw-bold" style="color: var(--primary-color);">
                                Photo <span class="text-danger">*</span>
                            </label>
                            <input type="file" class="form-control form-control-lg border-0 shadow-sm @error('photo') is-invalid @enderror" 
                                   id="photo" name="photo" accept="image/jpeg,image/png,image/jpg" required>
                            <small class="text-muted">Formats acceptés : JPG, JPEG, PNG (Max 2MB)</small>
                            @error('photo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="mt-3 text-center" id="imagePreview" style="display:none;">
                                <img id="previewImg" src="#" class="img-thumbnail rounded-circle shadow-lg" 
                                     style="width:180px; height:180px; object-fit:cover; border:5px solid var(--secondary-color);">
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="program" class="form-label fw-bold" style="color: var(--primary-color);">
                                Programme électoral <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control form-control-lg border-0 shadow-sm @error('program') is-invalid @enderror" 
                                      id="program" name="program" rows="4" required 
                                      placeholder="Décrivez le programme électoral du candidat">{{ old('program') }}</textarea>
                            @error('program')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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

    <!-- Liste des candidats -->
    <div class="card shadow-lg border-0" style="border-radius: 15px;">
        <div class="card-header py-3" style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--dark-color) 100%); border-radius: 15px 15px 0 0;">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0 text-white"><i class="fas fa-list me-2"></i> Liste des candidats</h4>
                <span class="badge bg-light text-dark rounded-pill px-4 py-2 fs-6">{{ $candidates->count() }} candidat(s)</span>
            </div>
        </div>
        <div class="card-body p-4">
            @if($candidates->isEmpty())
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="fas fa-user-slash fa-4x" style="color: var(--secondary-color);"></i>
                    </div>
                    <h5 class="text-muted">Aucun candidat enregistré</h5>
                    <p class="text-muted">Cliquez sur "Nouveau Candidat" pour ajouter un candidat</p>
                </div>
            @else
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
                    @foreach($candidates as $candidate)
                    <div class="col">
                        <div class="card h-100 border-0 shadow-sm hover-shadow" 
                             style="border-radius: 15px; cursor: pointer; transition: all 0.3s ease;"
                             onclick="showCandidateDetails({{ $candidate->id }})">
                            <div class="position-relative">
                                <div class="card-body text-center p-4">
                                    @if($candidate->photo_path)
                                        <img src="{{ asset('storage/'.$candidate->photo_path) }}" 
                                             class="rounded-circle shadow-lg mb-3" 
                                             style="width:150px; height:150px; object-fit:cover; border:4px solid var(--secondary-color);"
                                             alt="Photo de {{ $candidate->name }}"
                                             onerror="this.src='{{ asset('images/default-user.png') }}'">
                                    @else
                                        <div class="rounded-circle d-flex align-items-center justify-content-center mb-3 mx-auto shadow-lg" 
                                             style="width:150px; height:150px; background-color:var(--light-color); color:var(--primary-color);">
                                            <i class="fas fa-user fa-3x"></i>
                                        </div>
                                    @endif
                                    
                                    <h5 class="fw-bold mb-2" style="color: var(--primary-color);">{{ $candidate->name }}</h5>
                                    <span class="badge px-3 py-2 mb-3" 
                                          style="background-color:var(--light-color); color:var(--primary-color);">
                                        {{ $candidate->election->title ?? 'N/A' }}
                                    </span>
                                    
                                    <div class="mt-3">
                                        <button class="btn btn-sm px-3" 
                                                style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--dark-color) 100%); color: white;">
                                            <i class="fas fa-eye me-2"></i> Voir détails
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal pour ce candidat -->
                    <div class="card mb-4 d-none border-0 shadow-lg modal-card" id="modalCandidat{{ $candidate->id }}" style="border-radius: 15px; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 90%; max-width: 800px; z-index: 99999;">
                        <div class="card-header py-3" style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--dark-color) 100%); border-radius: 15px 15px 0 0;">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 text-white">
                                    <i class="fas fa-user-circle me-2"></i> Détails du candidat
                                    </h5>
                                <button type="button" class="btn-close btn-close-white" onclick="hideCandidateDetails({{ $candidate->id }})" aria-label="Close"></button>
                            </div>
                                </div>
                        <div class="card-body p-4">
                                    <div class="row">
                                        <div class="col-md-4 text-center">
                                            @if($candidate->photo_path)
                                                <img src="{{ asset('storage/'.$candidate->photo_path) }}" 
                                                     class="rounded-circle shadow-lg mb-4" 
                                                     style="width:200px; height:200px; object-fit:cover; border:5px solid var(--secondary-color);"
                                                     alt="Photo de {{ $candidate->name }}">
                                            @else
                                                <div class="rounded-circle d-flex align-items-center justify-content-center shadow-lg mb-4 mx-auto" 
                                                     style="width:200px; height:200px; background-color:var(--light-color); color:var(--primary-color);">
                                                    <i class="fas fa-user fa-4x"></i>
                                                </div>
                                            @endif
                                            <h4 class="fw-bold mb-2" style="color:var(--primary-color);">{{ $candidate->name }}</h4>
                                            <div class="badge px-3 py-2 mb-3" 
                                                 style="background-color:var(--light-color); color:var(--primary-color);">
                                                <i class="fas fa-vote-yea me-2"></i> {{ $candidate->election->title ?? 'N/A' }}
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <h5 class="fw-bold mb-3" style="color:var(--primary-color);">
                                                <i class="fas fa-file-alt me-2"></i> Programme électoral
                                            </h5>
                                            <div class="bg-light p-4 rounded-3" 
                                                 style="min-height:200px; max-height:300px; overflow-y:auto; background-color:var(--light-color) !important;">
                                                {{ $candidate->program }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <div class="card-footer border-0 bg-white p-3 d-flex justify-content-end gap-2" style="border-radius: 0 0 15px 15px;">
                            <button type="button" class="btn btn-light px-4" onclick="hideCandidateDetails({{ $candidate->id }})">
                                        <i class="fas fa-times me-2"></i> Fermer
                            </button>
                            <button type="button" class="btn btn-warning px-4" onclick="editCandidate({{ $candidate->id }})"
                                    style="background: linear-gradient(135deg, #ffc107, #fd7e14); border: none; color: white;">
                                <i class="fas fa-edit me-2"></i> Modifier
                            </button>
                            <button type="button" class="btn btn-danger px-4" onclick="confirmDeleteCandidate({{ $candidate->id }})"
                                    style="background: linear-gradient(135deg, #dc3545, #c82333); border: none;">
                                <i class="fas fa-trash-alt me-2"></i> Supprimer
                            </button>
                        </div>
                    </div>

                    <!-- Modal d'édition -->
                    <div class="card mb-4 d-none border-0 shadow-lg modal-card" id="editModalCandidat{{ $candidate->id }}" style="border-radius: 15px; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 90%; max-width: 800px; z-index: 99998;">
                        <div class="card-header py-3" style="background: linear-gradient(135deg, #ffc107, #fd7e14); border-radius: 15px 15px 0 0;">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 text-white">
                                    <i class="fas fa-edit me-2"></i> Modifier le candidat
                                </h5>
                                <button type="button" class="btn-close btn-close-white" onclick="hideEditForm({{ $candidate->id }})" aria-label="Close"></button>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <form method="POST" action="{{ route('candidates.update', $candidate->id) }}" enctype="multipart/form-data" id="editCandidateForm{{ $candidate->id }}" class="needs-validation" novalidate>
                                @csrf
                                @method('PUT')
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="edit_name{{ $candidate->id }}" class="form-label fw-bold" style="color: var(--primary-color);">
                                                Nom complet <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control form-control-lg border-0 shadow-sm" 
                                                   id="edit_name{{ $candidate->id }}" name="name" required 
                                                   placeholder="Entrez le nom complet" value="{{ $candidate->name }}">
                                            <div class="invalid-feedback">Veuillez entrer le nom du candidat</div>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="edit_election_id{{ $candidate->id }}" class="form-label fw-bold" style="color: var(--primary-color);">
                                                Élection <span class="text-danger">*</span>
                                            </label>
                                            <select class="form-select form-select-lg border-0 shadow-sm" 
                                                    id="edit_election_id{{ $candidate->id }}" name="election_id" required>
                                                <option value="" disabled>Sélectionnez une élection</option>
                                                @foreach($elections as $election)
                                                    <option value="{{ $election->id }}" {{ $candidate->election_id == $election->id ? 'selected' : '' }}>
                                                        {{ $election->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">Veuillez sélectionner une élection</div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="edit_photo{{ $candidate->id }}" class="form-label fw-bold" style="color: var(--primary-color);">
                                                Photo
                                            </label>
                                            <input type="file" class="form-control form-control-lg border-0 shadow-sm" 
                                                   id="edit_photo{{ $candidate->id }}" name="photo" accept="image/jpeg,image/png,image/jpg">
                                            <small class="text-muted">Formats acceptés : JPG, JPEG, PNG (Max 2MB). Laissez vide pour conserver la photo actuelle.</small>
                                            
                                            <div class="mt-3 text-center">
                                                <div class="mb-2">Photo actuelle :</div>
                                                @if($candidate->photo_path)
                                                    <img src="{{ asset('storage/'.$candidate->photo_path) }}" 
                                                         class="img-thumbnail rounded-circle" 
                                                         style="width:150px; height:150px; object-fit:cover; border:4px solid var(--secondary-color);"
                                                         alt="Photo actuelle">
                                                @else
                                                    <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto" 
                                                         style="width:150px; height:150px; background-color:var(--light-color); color:var(--primary-color);">
                                                        <i class="fas fa-user fa-3x"></i>
                                                    </div>
                                                @endif
                                                
                                                <div class="mt-3" id="editImagePreview{{ $candidate->id }}" style="display:none;">
                                                    <div class="mb-2">Nouvelle photo :</div>
                                                    <img id="editPreviewImg{{ $candidate->id }}" src="#" class="img-thumbnail rounded-circle" 
                                                         style="width:150px; height:150px; object-fit:cover; border:4px solid var(--secondary-color);">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="edit_program{{ $candidate->id }}" class="form-label fw-bold" style="color: var(--primary-color);">
                                                Programme électoral <span class="text-danger">*</span>
                                            </label>
                                            <textarea class="form-control form-control-lg border-0 shadow-sm" 
                                                      id="edit_program{{ $candidate->id }}" name="program" rows="4" required 
                                                      placeholder="Décrivez le programme électoral du candidat">{{ $candidate->program }}</textarea>
                                            <div class="invalid-feedback">Veuillez saisir le programme électoral</div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-12 d-flex justify-content-end gap-3">
                                        <button type="button" class="btn btn-light btn-lg px-4" onclick="hideEditForm({{ $candidate->id }})">
                                            <i class="fas fa-times me-2"></i> Annuler
                                        </button>
                                        <button type="submit" class="btn btn-primary btn-lg px-4" 
                                                style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--dark-color) 100%); border: none;">
                                            <i class="fas fa-save me-2"></i> Enregistrer
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Modal de confirmation de suppression -->
                    <div class="card mb-4 d-none border-0 shadow-lg modal-card" id="deleteModalCandidat{{ $candidate->id }}" style="border-radius: 15px; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 90%; max-width: 500px; z-index: 99998;">
                        <div class="card-header py-3" style="background: linear-gradient(135deg, #dc3545, #c82333); border-radius: 15px 15px 0 0;">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 text-white">
                                    <i class="fas fa-exclamation-triangle me-2"></i> Confirmation de suppression
                                </h5>
                                <button type="button" class="btn-close btn-close-white" onclick="hideDeleteModal({{ $candidate->id }})" aria-label="Close"></button>
                            </div>
                        </div>
                        <div class="card-body p-4 text-center">
                            <div class="mb-4">
                                @if($candidate->photo_path)
                                    <img src="{{ asset('storage/'.$candidate->photo_path) }}" 
                                         class="rounded-circle shadow mb-3" 
                                         style="width:100px; height:100px; object-fit:cover; border:3px solid var(--secondary-color);"
                                         alt="Photo de {{ $candidate->name }}">
                                @else
                                    <div class="rounded-circle d-flex align-items-center justify-content-center mb-3 mx-auto" 
                                         style="width:100px; height:100px; background-color:var(--light-color); color:var(--primary-color);">
                                        <i class="fas fa-user fa-3x"></i>
                                    </div>
                                @endif
                                <h4 class="fw-bold" style="color:var(--primary-color);">{{ $candidate->name }}</h4>
                            </div>
                            
                            <p class="fs-5 mb-4">Êtes-vous sûr de vouloir supprimer ce candidat ?</p>
                            <p class="text-danger mb-4">Cette action est irréversible et supprimera définitivement toutes les données associées à ce candidat.</p>
                            
                            <form method="POST" action="{{ route('candidates.destroy', $candidate->id) }}" id="deleteCandidateForm{{ $candidate->id }}">
                                @csrf
                                @method('DELETE')
                                <div class="d-flex justify-content-center gap-3">
                                    <button type="button" class="btn btn-light btn-lg px-4" onclick="hideDeleteModal({{ $candidate->id }})">
                                        <i class="fas fa-times me-2"></i> Annuler
                                    </button>
                                    <button type="submit" class="btn btn-danger btn-lg px-4">
                                        <i class="fas fa-trash-alt me-2"></i> Supprimer
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Backdrop pour l'édition -->
                    <div class="modal-backdrop d-none" id="editBackdrop{{ $candidate->id }}" style="opacity: 0.7; z-index: 99990;"></div>

                    <!-- Backdrop pour la suppression -->
                    <div class="modal-backdrop d-none" id="deleteBackdrop{{ $candidate->id }}" style="opacity: 0.7; z-index: 99990;"></div>

                    <div class="modal-backdrop d-none" id="backdrop{{ $candidate->id }}" style="opacity: 0.7; z-index: 99990;"></div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Assurez-vous que jQuery et Bootstrap sont chargés -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Script pour la gestion du formulaire -->
<script type="text/javascript">
    // Fonction globale pour afficher le formulaire
    function showForm() {
        console.log("Fonction showForm appelée");
        var formContainer = document.getElementById('candidateFormContainer');
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
        var formContainer = document.getElementById('candidateFormContainer');
        var showFormBtn = document.getElementById('showFormBtn');
        
        if (formContainer && showFormBtn) {
            formContainer.style.display = 'none';
            showFormBtn.style.display = 'block';
            document.getElementById('candidateForm').reset();
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

        // Configuration de la prévisualisation de la photo
        var photoInput = document.getElementById('photo');
        var imagePreview = document.getElementById('imagePreview');
        var previewImg = document.getElementById('previewImg');

        if (photoInput) {
            photoInput.onchange = function() {
                console.log("Changement de photo détecté");
                var file = this.files[0];
            if (file) {
                    if (file.size > 2 * 1024 * 1024) {
                        alert('La taille du fichier ne doit pas dépasser 2MB');
                        this.value = '';
                        if (imagePreview) imagePreview.style.display = 'none';
                        return;
                    }

                    if (!file.type.match('image/jpeg') && !file.type.match('image/png')) {
                        alert('Seuls les fichiers JPG, JPEG et PNG sont acceptés');
                        this.value = '';
                        if (imagePreview) imagePreview.style.display = 'none';
                        return;
                    }

                    var reader = new FileReader();
                reader.onload = function(e) {
                        if (previewImg && imagePreview) {
                    previewImg.src = e.target.result;
                    imagePreview.style.display = 'block';
                }
                    };
                reader.readAsDataURL(file);
                } else if (imagePreview) {
                imagePreview.style.display = 'none';
                }
            };
        }

        // Configuration de la soumission du formulaire
        var form = document.getElementById('candidateForm');
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

    function showCandidateDetails(candidateId) {
        // Sauvegarder la position de défilement et désactiver le défilement
        savedScrollPosition = disableScrolling();
        
        const candidate = document.querySelector(`#modalCandidat${candidateId}`);
        if (!candidate) return;
        
        // Charger le contenu dans le container fixe
        const modalContent = document.getElementById('fixedModalContent');
        const modalBackdrop = document.getElementById('fixedModalBackdrop');
        const modalContainer = document.getElementById('fixedModalContainer');
        
        // Copier le contenu HTML de la carte du candidat dans le modal fixe
        const candidateContent = document.querySelector(`#modalCandidat${candidateId}`).innerHTML;
        modalContent.innerHTML = candidateContent;
        
        // Remplacer les boutons pour utiliser closeFixedModal
        const closeButtons = modalContent.querySelectorAll('[onclick*="hideCandidateDetails"]');
        closeButtons.forEach(button => {
            button.setAttribute('onclick', 'closeFixedModal()');
        });
        
        // Remplacer les fonctions des autres boutons
        const editButtons = modalContent.querySelectorAll('[onclick*="editCandidate"]');
        editButtons.forEach(button => {
            const newOnclick = button.getAttribute('onclick').replace(`editCandidate(${candidateId})`, `editCandidateFromModal(${candidateId})`);
            button.setAttribute('onclick', newOnclick);
        });
        
        const deleteButtons = modalContent.querySelectorAll('[onclick*="confirmDeleteCandidate"]');
        deleteButtons.forEach(button => {
            const newOnclick = button.getAttribute('onclick').replace(`confirmDeleteCandidate(${candidateId})`, `confirmDeleteCandidateFromModal(${candidateId})`);
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

    function editCandidateFromModal(candidateId) {
        closeFixedModal();
        setTimeout(() => {
            editCandidate(candidateId);
        }, 100);
    }

    function confirmDeleteCandidateFromModal(candidateId) {
        closeFixedModal();
        setTimeout(() => {
            confirmDeleteCandidate(candidateId);
        }, 100);
    }

    // Fonctions existantes modifiées pour utiliser le même modal fixe
    function editCandidate(candidateId) {
        savedScrollPosition = disableScrolling();
        
        const editModal = document.querySelector(`#editModalCandidat${candidateId}`);
        if (!editModal) return;
        
        // Charger le contenu dans le container fixe
        const modalContent = document.getElementById('fixedModalContent');
        const modalBackdrop = document.getElementById('fixedModalBackdrop');
        const modalContainer = document.getElementById('fixedModalContainer');
        
        // Copier le contenu HTML du modal d'édition dans le modal fixe
        modalContent.innerHTML = editModal.innerHTML;
        
        // Remplacer les boutons pour utiliser closeFixedModal
        const closeButtons = modalContent.querySelectorAll('[onclick*="hideEditForm"]');
        closeButtons.forEach(button => {
            button.setAttribute('onclick', 'closeFixedModal()');
        });
        
        // Adapter les formulaires et les événements
        const forms = modalContent.querySelectorAll('form');
        forms.forEach(form => {
            const originalId = form.id;
            if (originalId) {
                form.id = 'fixedModal' + originalId;
                setupFormValidation(form);
            }
        });
        
        // Configurer la prévisualisation d'images
        setupEditImagePreviewFixed(candidateId);
        
        // Ajouter un gestionnaire de clic pour le backdrop
        modalBackdrop.onclick = closeFixedModal;
        
        // Afficher le modal
        modalContainer.style.display = 'block';
        
        // Ajouter un gestionnaire pour la touche Échap
        document.addEventListener('keydown', handleEscapeKey);
    }

    function confirmDeleteCandidate(candidateId) {
        savedScrollPosition = disableScrolling();
        
        const deleteModal = document.querySelector(`#deleteModalCandidat${candidateId}`);
        if (!deleteModal) return;
        
        // Charger le contenu dans le container fixe
        const modalContent = document.getElementById('fixedModalContent');
        const modalBackdrop = document.getElementById('fixedModalBackdrop');
        const modalContainer = document.getElementById('fixedModalContainer');
        
        // Copier le contenu HTML du modal de suppression dans le modal fixe
        modalContent.innerHTML = deleteModal.innerHTML;
        
        // Remplacer les boutons pour utiliser closeFixedModal
        const closeButtons = modalContent.querySelectorAll('[onclick*="hideDeleteModal"]');
        closeButtons.forEach(button => {
            button.setAttribute('onclick', 'closeFixedModal()');
        });
        
        // Adapter les formulaires
        const forms = modalContent.querySelectorAll('form');
        forms.forEach(form => {
            const originalId = form.id;
            if (originalId) {
                form.id = 'fixedModal' + originalId;
            }
        });
        
        // Ajouter un gestionnaire de clic pour le backdrop
        modalBackdrop.onclick = closeFixedModal;
        
        // Afficher le modal
        modalContainer.style.display = 'block';
        
        // Ajouter un gestionnaire pour la touche Échap
        document.addEventListener('keydown', handleEscapeKey);
    }

    function setupFormValidation(form) {
        form.addEventListener('submit', function(e) {
            if (!this.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
            }
            this.classList.add('was-validated');
        });
    }

    function setupEditImagePreviewFixed(candidateId) {
        const photoInput = document.querySelector('#fixedModalContent [id*="edit_photo"]');
        const imagePreview = document.querySelector('#fixedModalContent [id*="editImagePreview"]');
        const previewImg = document.querySelector('#fixedModalContent [id*="editPreviewImg"]');
        
        if (photoInput && imagePreview && previewImg) {
            photoInput.onchange = function() {
                const file = this.files[0];
                if (file) {
                    // Vérifier la taille du fichier
                    if (file.size > 2 * 1024 * 1024) {
                        alert('La taille du fichier ne doit pas dépasser 2MB');
                        this.value = '';
                        imagePreview.style.display = 'none';
                        return;
                    }
                    
                    // Vérifier le type de fichier
                    if (!file.type.match('image/jpeg') && !file.type.match('image/png')) {
                        alert('Seuls les fichiers JPG, JPEG et PNG sont acceptés');
                        this.value = '';
                        imagePreview.style.display = 'none';
                        return;
                    }
                    
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImg.src = e.target.result;
                        imagePreview.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                } else {
                    imagePreview.style.display = 'none';
                }
            };
        }
    }

        // Animation des cartes au survol
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.hover-shadow');
        cards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px)';
                this.style.boxShadow = '0 15px 30px rgba(0,0,0,0.1)';
            });
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = '0 5px 15px rgba(0,0,0,0.05)';
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
        #modalCandidat {
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
</style>

<!-- Container modal universel fixé - Ne bouge jamais -->
<div id="fixedModalContainer" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; z-index:9999999; pointer-events:none;">
    <div id="fixedModalBackdrop" style="position:fixed; top:0; left:0; width:100%; height:100%; background-color:rgba(0,0,0,0.7); pointer-events:all;"></div>
    <div id="fixedModalContent" class="card border-0 shadow-lg" style="position:fixed; top:50%; left:50%; transform:translate(-50%, -50%); width:90%; max-width:800px; pointer-events:all; border-radius:15px; overflow:hidden;"></div>
</div>
 