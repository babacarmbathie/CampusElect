<div class="container-fluid px-4 mt-3">
    <!-- Bouton pour ouvrir le formulaire -->
    <div class="mb-3">
        <button class="btn btn-primary" id="showFormBtn" style="background-color: #5E3023; border-color: #5E3023;">
            <i class="fas fa-user-plus me-2"></i> Ajouter un candidat
        </button>
    </div>

    <!-- Formulaire d'ajout (caché par défaut) -->
    <div class="card mb-4 d-none" id="candidateFormContainer">
        <div class="card-header text-white" style="background-color: #5E3023;">
            <h5 class="mb-0"><i class="fas fa-user-plus me-2"></i> Nouveau candidat</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('candidates.store') }}" enctype="multipart/form-data" id="candidateForm">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nom complet <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="election_id" class="form-label">Élection <span class="text-danger">*</span></label>
                            <select class="form-select" id="election_id" name="election_id" required>
                                @foreach($elections as $election)
                                    <option value="{{ $election->id }}">{{ $election->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="photo" class="form-label">Photo <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" id="photo" name="photo" accept="image/*" required>
                            <small class="text-muted">Formats acceptés : JPG, JPEG, PNG (Max 2MB)</small>
                            <div class="mt-3 text-center" id="imagePreview" style="display:none;">
                                <img id="previewImg" src="#" class="img-thumbnail rounded-circle shadow" 
                                     style="width:150px; height:150px; object-fit:cover; border:3px solid #B88B4A;">
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="program" class="form-label">Programme <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="program" name="program" rows="4" required></textarea>
                        </div>
                    </div>
                    
                    <div class="col-12 d-flex justify-content-end gap-3">
                        <button type="button" class="btn btn-secondary" id="cancelFormBtn">
                            <i class="fas fa-times me-1"></i> Annuler
                        </button>
                        <button type="submit" class="btn text-white" style="background-color: #5E3023;">
                            <i class="fas fa-save me-1"></i> Enregistrer
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Liste des candidats -->
    <div class="card shadow-lg border-0" style="border-radius: 10px;">
        <div class="card-header text-white py-3" style="background: linear-gradient(135deg, #5E3023 0%, #7a4a3c 100%);">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="fas fa-users me-2"></i> Liste des candidats</h4>
                <span class="badge bg-light text-dark rounded-pill px-3 py-2">{{ $candidates->count() }}</span>
            </div>
        </div>
        <div class="card-body">
            @if($candidates->isEmpty())
                <div class="text-center py-5 text-muted">
                    <i class="fas fa-user-slash fa-4x mb-3" style="color: #B88B4A;"></i>
                    <p class="h5">Aucun candidat enregistré</p>
                </div>
            @else
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
                    @foreach($candidates as $candidate)
                    <div class="col">
                        <div class="card h-100 border-0 shadow-sm hover-shadow transition-all" 
                             style="border-radius: 10px; cursor: pointer;"
                             data-bs-toggle="modal" data-bs-target="#modalCandidat{{ $candidate->id }}">
                            <div class="card-body text-center p-4">
                                @if($candidate->photo_path)
                                    <img src="{{ asset('storage/'.$candidate->photo_path) }}" 
                                         class="rounded-circle shadow mb-3" 
                                         style="width:100px;height:100px;object-fit:cover; border:3px solid #B88B4A;"
                                         alt="Photo de {{ $candidate->name }}"
                                         onerror="this.src='{{ asset('images/default-user.png') }}'">
                                @else
                                    <div class="rounded-circle d-flex align-items-center justify-content-center mb-3 mx-auto" 
                                         style="width:100px;height:100px; background-color:#F3E9DC; color:#5E3023;">
                                        <i class="fas fa-user fa-2x"></i>
                                    </div>
                                @endif
                                
                                <h5 class="fw-bold mb-2" style="color: #5E3023;">{{ $candidate->name }}</h5>
                                <span class="badge px-3 py-2 mb-3" style="background-color:#F3E9DC; color:#5E3023;">
                                    {{ $candidate->election->title ?? 'N/A' }}
                                </span>
                                <p class="text-muted text-truncate">
                                    <!-- {{ Str::limit($candidate->program, 60) }} -->
                                </p>
                            </div>
                            <div class="card-footer bg-transparent border-0 pt-0 pb-3">
                                <button class="btn btn-sm" 
                                        style="background-color:#5E3023; color:white;"
                                        data-bs-toggle="modal" data-bs-target="#modalCandidat{{ $candidate->id }}">
                                    <i class="fas fa-eye me-1"></i> Voir détails
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Modal pour ce candidat -->
                    <div class="modal fade" id="modalCandidat{{ $candidate->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content border-0 shadow" style="border-radius:15px;">
                                <div class="modal-header py-3" style="background:linear-gradient(135deg, #5E3023 0%, #7a4a3c 100%); border-radius:15px 15px 0 0;">
                                    <h5 class="modal-title text-white">
                                        <i class="fas fa-user-circle me-2"></i> {{ $candidate->name }}
                                    </h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-4">
                                    <div class="row">
                                        <div class="col-md-4 text-center">
                                            @if($candidate->photo_path)
                                                <img src="{{ asset('storage/'.$candidate->photo_path) }}" 
                                                     class="rounded-circle shadow mb-4" 
                                                     style="width:180px;height:180px;object-fit:cover; border:5px solid #B88B4A;"
                                                     alt="Photo de {{ $candidate->name }}">
                                            @else
                                                <div class="rounded-circle d-flex align-items-center justify-content-center shadow mb-4 mx-auto" 
                                                     style="width:180px;height:180px; background-color:#F3E9DC; color:#5E3023;">
                                                    <i class="fas fa-user fa-3x"></i>
                                                </div>
                                            @endif
                                            <h4 class="fw-bold mb-1" style="color:#5E3023;">{{ $candidate->name }}</h4>
                                            <div class="badge px-3 py-2 mb-3" style="background-color:#F3E9DC; color:#5E3023;">
                                                <i class="fas fa-vote-yea me-2"></i> {{ $candidate->election->title ?? 'N/A' }}
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <h5 class="fw-bold mb-3" style="color:#5E3023;">
                                                <i class="fas fa-file-alt me-2"></i> Programme électoral
                                            </h5>
                                            <div class="bg-light p-4 rounded-3" style="min-height:200px; max-height:300px; overflow-y:auto;">
                                                {{ $candidate->program }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer border-0">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        <i class="fas fa-times me-1"></i> Fermer
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

@section('scripts')
<script>
    // Gestion du formulaire d'ajout
    document.addEventListener('DOMContentLoaded', function() {
        const showFormBtn = document.getElementById('showFormBtn');
        const cancelFormBtn = document.getElementById('cancelFormBtn');
        const formContainer = document.getElementById('candidateFormContainer');
        const photoInput = document.getElementById('photo');
        const imagePreview = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');

        // Afficher le formulaire
        showFormBtn.addEventListener('click', function() {
            formContainer.classList.remove('d-none');
            showFormBtn.classList.add('d-none');
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        // Cacher le formulaire
        cancelFormBtn.addEventListener('click', function() {
            formContainer.classList.add('d-none');
            showFormBtn.classList.remove('d-none');
            document.getElementById('candidateForm').reset();
            imagePreview.style.display = 'none';
        });

        // Prévisualisation de la photo
        photoInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    imagePreview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                imagePreview.style.display = 'none';
            }
        });
    });
</script>
@endsection