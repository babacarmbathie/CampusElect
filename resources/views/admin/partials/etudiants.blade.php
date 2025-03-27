<div class="card shadow border-0 w-100">
    <div class="card-header bg-primary text-white py-3">
        <h5 class="mb-0 d-flex align-items-center">
            <i class="fas fa-users me-3 fs-4"></i>Gestion des Étudiants
        </h5>
    </div>
    
    <div class="card-body p-0">
        @if($users->count() > 0)
            <div class="table-responsive rounded-3 w-100">
                <table class="table table-hover table-striped mb-0 w-100">
                    <thead class="table-light">
                        <tr>
                            <th class="py-3 px-4 text-uppercase fw-semibold">Nom</th>
                            <th class="py-3 px-4 text-uppercase fw-semibold">Email</th>
                            <th class="py-3 px-4 text-uppercase fw-semibold">Code Étudiant</th>
                            <th class="py-3 px-4 text-uppercase fw-semibold text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr class="align-middle">
                                <td class="px-4">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm me-3">
                                            <div class="avatar-title bg-soft-primary rounded-circle text-primary fw-semibold">
                                                {{ substr($user->name, 0, 1) }}
                                            </div>
                                        </div>
                                        <span>{{ $user->name }}</span>
                                    </div>
                                </td>
                                <td class="px-4">
                                    <span class="text-muted">{{ $user->email }}</span>
                                </td>
                                <td class="px-4">
                                    <span class="badge bg-soft-info text-info fw-semibold">
                                        {{ $user->student->student_code ?? 'N/A' }}
                                    </span>
                                </td>
                                <td class="px-4 text-end">
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-sm btn-outline-warning me-2 d-flex align-items-center">
                                            <i class="fas fa-edit me-1"></i> Éditer
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger d-flex align-items-center">
                                            <i class="fas fa-trash me-1"></i> Supprimer
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <div class="d-flex justify-content-center py-4 bg-light rounded-bottom">
                    {{ $users->links() }}
                </div>
            </div>
        @else
            <div class="alert alert-info mb-0 rounded-3">
                <div class="d-flex align-items-center">
                    <i class="fas fa-info-circle me-3 fs-4"></i>
                    <div>
                        <h5 class="mb-1">Aucun étudiant trouvé</h5>
                        <p class="mb-0">La base de données ne contient actuellement aucun étudiant.</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>