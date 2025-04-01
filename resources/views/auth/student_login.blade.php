<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Étudiant | CAMPUS ELECT</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/nav-footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
    @include('components.nav')

    <!-- Contenu principal -->
    <div class="page-container">
    <div class="left-side">
    <svg class="login-illustration" viewBox="0 0 500 500">
        <defs>
            <linearGradient id="grad1" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" style="stop-color:#3a2a1f;stop-opacity:1" />
                <stop offset="100%" style="stop-color:#5d4b36;stop-opacity:1" />
            </linearGradient>
        </defs>
        <circle cx="250" cy="250" r="150" fill="url(#grad1)" opacity="0.1"/>
        <!-- Icône de vote -->
        <path d="M250,180 L280,230 L340,240 L300,280 L310,340 L250,310 L190,340 L200,280 L160,240 L220,230 Z" 
              fill="#8b7355" opacity="0.6" stroke="#3a2a1f" stroke-width="2"/>
        <!-- Icône d'étudiant -->
        <circle cx="250" cy="150" r="30" fill="#5d4b36" opacity="0.6"/>
        <path d="M250,180 Q270,200 250,220 Q230,200 250,180" fill="#3a2a1f" opacity="0.6"/>
    </svg>
    
    <div class="welcome-message">
        <h1 class="welcome-text">Votre voix compte !</h1>
        <p class="welcome-subtext">
            Connectez-vous pour participer aux élections universitaires<br>
            et contribuer à façonner l'avenir de votre campus.
        </p>
        <div class="welcome-divider"></div>
        <p class="welcome-quote">
            <i class="fas fa-quote-left quote-icon"></i>
            Chaque vote est une pierre à l'édifice de la démocratie étudiante
            <i class="fas fa-quote-right quote-icon"></i>
        </p>
    </div>
</div>
        <div class="right-side">
            <div class="form-container">
                <div class="form-box">
                    <h2 class="auth-title">
                        <i class="fas fa-sign-in-alt me-2"></i>
                        Connexion Étudiant
                        <div class="title-underline"></div>
                    </h2>
                    
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
                        <div class="input-group">
                            <input type="text" id="login" name="login" required>
                            <label for="login">Email ou Code Étudiant</label>
                            <i class="fas fa-check valid-icon"></i>
                            <i class="fas fa-times invalid-icon"></i>
                        </div>
                        <div class="input-group">
                            <input type="password" id="password" name="password" required>
                            <label for="password">Mot de passe</label>
                        </div>
                        <button type="submit" class="submit-btn">Se connecter</button>
                        <p class="signup-link">
                            Pas encore inscrit ? 
                            <a href="{{ route('student.register.form') }}">Créer un compte</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('components.footer')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/auth/auth-validation.js') }}"></script>
    <script src="{{ asset('js/auth/auth-ui.js') }}"></script>
    <script src="{{ asset('js/auth/auth.js') }}"></script>
</body>
</html>