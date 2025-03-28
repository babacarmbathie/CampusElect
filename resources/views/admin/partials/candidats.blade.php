<div class="container-fluid px-4 mt-3">
    

    <!-- Bouton pour ouvrir le formulaire -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0" style="color: var(--primary-color);"><i class="fas fa-user-tie me-2"></i>Gestion des Candidats</h4>
        <button class="btn btn-primary px-4 py-2" id="showFormBtn" 
                style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--dark-color) 100%); border: none;">
            <i class="fas fa-user-plus me-2"></i> Nouveau Candidat
        </button>
    </div>

    <!-- Formulaire d'ajout (caché par défaut) -->
    <div class="card mb-4 d-none border-0 shadow-lg" id="candidateFormContainer" style="border-radius: 15px;">
        <div class="card-header py-3" style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--dark-color) 100%); border-radius: 15px 15px 0 0;">
            <h5 class="mb-0 text-white"><i class="fas fa-user-plus me-2"></i> Ajouter un nouveau candidat</h5>
        </div>
        <div class="card-body p-4">
            <form method="POST" action="{{ route('candidates.store') }}" enctype="multipart/form-data" id="candidateForm">
                @csrf
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold" style="color: var(--primary-color);">
                                Nom complet <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control form-control-lg border-0 shadow-sm" 
                                   id="name" name="name" required placeholder="Entrez le nom complet">
                        </div>
                        
                        <div class="mb-3">
                            <label for="election_id" class="form-label fw-bold" style="color: var(--primary-color);">
                                Élection <span class="text-danger">*</span>
                            </label>
                            <select class="form-select form-select-lg border-0 shadow-sm" id="election_id" name="election_id" required>
                                <option value="" selected disabled>Sélectionnez une élection</option>
                                @foreach($elections as $election)
                                    <option value="{{ $election->id }}">{{ $election->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="photo" class="form-label fw-bold" style="color: var(--primary-color);">
                                Photo <span class="text-danger">*</span>
                            </label>
                            <input type="file" class="form-control form-control-lg border-0 shadow-sm" 
                                   id="photo" name="photo" accept="image/*" required>
                            <small class="text-muted">Formats acceptés : JPG, JPEG, PNG (Max 2MB)</small>
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
                            <textarea class="form-control form-control-lg border-0 shadow-sm" 
                                      id="program" name="program" rows="4" required 
                                      placeholder="Décrivez le programme électoral du candidat"></textarea>
                        </div>
                    </div>
                    
                    <div class="col-12 d-flex justify-content-end gap-3">
                        <button type="button" class="btn btn-light btn-lg px-4" id="cancelFormBtn">
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
                             data-bs-toggle="modal" data-bs-target="#modalCandidat{{ $candidate->id }}">
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
                    <div class="modal fade" id="modalCandidat{{ $candidate->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content border-0 shadow-lg" style="border-radius:15px;">
                                <div class="modal-header py-3" 
                                     style="background:linear-gradient(135deg, var(--primary-color) 0%, var(--dark-color) 100%); border-radius:15px 15px 0 0;">
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
                                <div class="modal-footer border-0">
                                    <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">
                                        <i class="fas fa-times me-2"></i> Fermer
                                    </button>
                                    <button type="button" class="btn btn-primary px-4" 
                                            style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--dark-color) 100%); border: none;">
                                        <i class="fas fa-edit me-2"></i> Modifier
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
    document.addEventListener('DOMContentLoaded', function() {
        const showFormBtn = document.getElementById('showFormBtn');
        const cancelFormBtn = document.getElementById('cancelFormBtn');
        const formContainer = document.getElementById('candidateFormContainer');
        const photoInput = document.getElementById('photo');
        const imagePreview = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');

        showFormBtn.addEventListener('click', function() {
            formContainer.classList.remove('d-none');
            showFormBtn.classList.add('d-none');
            formContainer.scrollIntoView({ behavior: 'smooth' });
        });

        cancelFormBtn.addEventListener('click', function() {
            formContainer.classList.add('d-none');
            showFormBtn.classList.remove('d-none');
            document.getElementById('candidateForm').reset();
            imagePreview.style.display = 'none';
        });

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

        // Animation des cartes au survol
        const candidateCards = document.querySelectorAll('.hover-shadow');
        candidateCards.forEach(card => {
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
@endsection