<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Étudiant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root { --marron-clair: #8E4B3A; }
        .card-header { background-color: var(--marron-clair); color: white; }
        .btn-primary { background-color: var(--marron-clair); border: none; }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Modifier l'étudiant</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('etudiants.update', $user->id) }}">
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-3">
                                <label class="form-label">Nom complet</label>
                                <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Code étudiant</label>
                                <input type="text" class="form-control" name="student_code" 
                                       value="{{ $user->student->student_code }}" required>
                                <small class="text-muted">Format: P123456</small>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                            <a href="{{ route('etudiants.index') }}" class="btn btn-secondary">Annuler</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>