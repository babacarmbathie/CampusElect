<!-- Register Page -->
<!DOCTYPE html>
<html lang="fr">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inscription Étudiant</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<!-- Ajouter ce JavaScript -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<!-- Ajoutez ce script -->
<script>
$(document).ready(function() {
    // Validation email en temps réel
    $('#email').on('input', function() {
        const email = $(this).val();
        const emailRegex =/^[^\s@]+@ugb\.edu\.sn$/;
        
        if(emailRegex.test(email)) {
            $(this).removeClass('invalid-border').addClass('valid-border');
            $(this).siblings('.valid-icon').css('opacity', '1');
            $(this).siblings('.invalid-icon').css('opacity', '0');
        } else {
            $(this).removeClass('valid-border').addClass('invalid-border');
            $(this).siblings('.invalid-icon').css('opacity', '1');
            $(this).siblings('.valid-icon').css('opacity', '0');
        }
    });


 
// Messages d'aide contextuels
$('#email').on('focus', function() {
    $('#emailHelp').fadeIn();
}).on('blur', function() {
    $('#emailHelp').fadeOut();
});

$('#student_code').on('focus', function() {
    $('#codeHelp').fadeIn();
}).on('blur', function() {
    $('#codeHelp').fadeOut();
});

    // Validation code étudiant dynamique
    $('#student_code').on('input', function() {
        const code = $(this).val();
        const codeRegex = /^P[0-9]{4,}$/;
        
        if(codeRegex.test(code)) {
            $(this).removeClass('invalid-border').addClass('valid-border');
        } else {
            $(this).removeClass('valid-border').addClass('invalid-border');
        }
    });

    // Animation au focus
$('input').on('focus', function() {
    $(this).parent().css('transform', 'scale(1.02)');
}).on('blur', function() {
    $(this).parent().css('transform', 'scale(1)');
});

    // Validation mot de passe
    $('#password, #password_confirmation').on('input', function() {
        const password = $('#password').val();
        const confirm = $('#password_confirmation').val();
        
        if(password.length >= 6) {
            $('#password').removeClass('invalid-border').addClass('valid-border');
        } else {
            $('#password').removeClass('valid-border').addClass('invalid-border');
        }
        
        if(password === confirm && confirm !== '') {
            $('#password_confirmation').removeClass('invalid-border').addClass('valid-border');
        } else {
            $('#password_confirmation').removeClass('valid-border').addClass('invalid-border');
        }
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
                            <i class="bi bi-person-plus-fill me-2 icol"> Inscription Étudiant</i>
                        </h2>
                    </div>
                    
                    <div class="card-body px-4 px-md-5 py-4">
                        <!-- Messages d'alerte identiques à la page login -->

                        <form action="{{ route('student.register') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nom complet</label>
                                <input type="text" class="form-control form-control-lg" 
                                       id="name" name="name" value="{{ old('name') }}" required>
                            </div>

                            <div class="mb-3 input-group">
                                <label for="email" class="form-label">Adresse Email</label>
                                <input type="email" class="form-control form-control-lg" 
                                    id="email" name="email" required>
                                <div class="icon-container">
                                    <i class="fas fa-check valid-icon"></i>
                                    <i class="fas fa-times invalid-icon"></i>
                                </div>
                            </div>


                            <div class="mb-3">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control form-control-lg" 
                                       id="password" name="password" required>
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">
                                    Confirmer le mot de passe
                                </label>
                                <input type="password" class="form-control form-control-lg" 
                                       id="password_confirmation" name="password_confirmation" required>
                            </div>

                            <!-- Modifier le champ student_code -->
                            <div class="mb-4">
                                <label for="student_code" class="form-label">Code Étudiant</label>
                                <input type="text" class="form-control form-control-lg" 
                                    id="student_code" name="student_code" 
                                    value="P" required>
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg w-100 mb-3">
                                S'inscrire
                            </button>

                            <div class="text-center mt-3">
                                <p class="mb-0">Déjà inscrit ? 
                                    <a href="{{ route('student.login.form') }}" 
                                       class="text-decoration-none fw-bold text-primary">
                                        Se connecter
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