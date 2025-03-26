
<!-- Login Page -->
<!DOCTYPE html>
<html lang="fr">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Connexion Étudiant</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
   
</head>


<!-- Ajouter ce JavaScript -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
$(document).ready(function() {
    $('#login').on('input', function() {
        const value = $(this).val();
        const emailRegex =/^[^\s@]+@ugb\.edu\.sn$/;
        const codeRegex = /^P[0-9]{4,}$/;
        
        let isValid = false;
        if(value.includes('@')) {
            isValid = emailRegex.test(value);
        } else {
            isValid = codeRegex.test(value.toUpperCase());
        }
        
        if(isValid) {
            $(this).removeClass('invalid-border').addClass('valid-border');
            $(this).siblings('.valid-icon').css('opacity', '1');
            $(this).siblings('.invalid-icon').css('opacity', '0');
        } else {
            $(this).removeClass('valid-border').addClass('invalid-border');
            $(this).siblings('.invalid-icon').css('opacity', '1');
            $(this).siblings('.valid-icon').css('opacity', '0');
        }
    });

        // Animation au focus
$('input').on('focus', function() {
    $(this).parent().css('transform', 'scale(1.02)');
}).on('blur', function() {
    $(this).parent().css('transform', 'scale(1)');
});
});
</script>
<body class="d-flex align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="auth-card card shadow-lg">
                    <div class="card-header bg-white border-0 pt-4">
                        <h2 class="text-center text-primary mb-0">
                            <i class="bi bi-person-circle me-2 icol "> Connexion Étudiant</i>
                        </h2>
                    </div>
                    
                    <div class="card-body px-4 px-md-5 py-4">
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        @endif

                        @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show">
                            <ul class="list-unstyled mb-0">
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        @endif

                        <form action="{{ route('student.login') }}" method="POST">
                            @csrf
                           <!-- Remplacer le champ email par -->
                           <div class="mb-3">
                                <label for="login" class="form-label">Email ou Code Étudiant</label>
                                <input type="text" class="form-control form-control-lg" 
                                    id="login" name="login" required>
                                <i class="fas fa-check valid-icon"></i>
                                <i class="fas fa-times invalid-icon"></i>
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control form-control-lg" 
                                       id="password" name="password" required>
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg w-100 mb-3">
                                Se connecter
                            </button>

                            <div class="text-center mt-3">
                                <p class="mb-0">Pas encore inscrit ? 
                                    <a href="{{ route('student.register.form') }}" 
                                       class="text-decoration-none fw-bold text-primary">
                                        Créer un compte
                                    </a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>