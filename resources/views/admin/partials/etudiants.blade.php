<div class="container-fluid px-4 mt-3">
  

    <!-- En-tête de la section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0" style="color: var(--primary-color);"><i class="fas fa-user-graduate me-2"></i>Gestion des Étudiants</h4>
        <button class="btn btn-primary px-4 py-2" id="showFormBtn" 
                style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--dark-color) 100%); border: none;">
            <i class="fas fa-user-plus me-2"></i> Nouvel Étudiant
        </button>
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
                                                data-bs-toggle="modal" data-bs-target="#editStudentModal{{ $user->id }}">
                                            <i class="fas fa-edit me-2"></i>Éditer
                                        </button>
                                        <button class="btn btn-sm btn-danger px-3" 
                                                onclick="confirmDelete({{ $user->id }})">
                                            <i class="fas fa-trash me-2"></i>Supprimer
                                        </button>
                                    </td>
                                </tr>

                                <!-- Modal d'édition -->
                                <div class="modal fade" id="editStudentModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
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
                                                        <form action="{{ route('admin.etudiants.update', $user->id) }}" method="POST" id="editStudentForm{{ $user->id }}">
                                                            @csrf
                                                            @method('PUT')
                                                            
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
                                                                <button type="button" class="btn btn-light btn-lg px-4" data-bs-dismiss="modal">
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
                        @endforeach
                    </tbody>
                </table>
                </div>
                
                <div class="d-flex justify-content-center mt-4">
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

@section('scripts')
<script>
    // Recherche d'étudiants en temps réel
    document.getElementById('searchStudent').addEventListener('input', function(e) {
        const searchText = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('tbody tr');
        
        rows.forEach(row => {
            const name = row.querySelector('h6').textContent.toLowerCase();
            const email = row.querySelector('.text-muted').textContent.toLowerCase();
            const code = row.querySelector('.badge').textContent.toLowerCase();
            
            if(name.includes(searchText) || email.includes(searchText) || code.includes(searchText)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    // Animation des lignes au survol
    const tableRows = document.querySelectorAll('tbody tr');
    tableRows.forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.transform = 'translateX(10px)';
            this.style.boxShadow = '0 5px 15px rgba(0,0,0,0.1)';
        });
        row.addEventListener('mouseleave', function() {
            this.style.transform = 'translateX(0)';
            this.style.boxShadow = 'none';
        });
    });

    // Confirmation de suppression
    function confirmDelete(userId) {
        if(confirm('Êtes-vous sûr de vouloir supprimer cet étudiant ?')) {
            // Créer et soumettre un formulaire de suppression
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/admin/etudiants/${userId}`;
            form.innerHTML = `
                @csrf
                @method('DELETE')
            `;
            document.body.appendChild(form);
            form.submit();
        }
    }
</script>
@endsection