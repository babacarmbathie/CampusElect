<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription Étudiant | CAMPUS ELECT</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
:root {
    --dark-brown: #3a2a1f;
    --medium-brown: #5d4b36;
    --light-brown: #8b7355;
    --cream: #f5f0e6;
    --white: #ffffff;
    --nav-bg: rgba(58, 42, 31, 0.9);
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

body {
    min-height: 100vh;
    background: linear-gradient(135deg, var(--medium-brown), var(--dark-brown));
    padding-top: 70px; /* Pour compenser la navbar fixe */
}

/* Navigation */
.navbar {
    background-color: var(--nav-bg);
    backdrop-filter: blur(10px);
    box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.navbar-brand {
    font-weight: 600;
    color: var(--cream) !important;
    letter-spacing: 1px;
}

.navbar-brand-text {
    font-size: 1.3rem;
}

.nav-link {
    color: var(--cream) !important;
    font-weight: 500;
    margin: 0 10px;
    padding: 8px 15px !important;
    border-radius: 5px;
    transition: all 0.3s ease;
}

.nav-link:hover, .nav-link.active {
    background-color: rgba(139, 115, 85, 0.3);
    color: var(--white) !important;
}

.navbar-toggler {
    border-color: var(--cream);
}

.navbar-toggler-icon {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(245, 240, 230, 1)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
}

/* Contenu principal */
.page-container {
    display: flex;
    min-height: calc(100vh - 120px); /* Prend en compte le footer */
}

.left-side {
    flex: 5;
    background: var(--cream);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    position: relative;
    padding: 40px;
    background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100" opacity="0.05"><path d="M30,50 Q50,30 70,50 T90,50" fill="none" stroke="%233a2a1f" stroke-width="2"/></svg>');
    background-size: 200px;
}

.login-illustration {
    width: 100%;
    max-width: 400px;
    height: auto;
    animation: float 6s ease-in-out infinite;
}

.welcome-message {
    text-align: center;
    max-width: 500px;
    margin-top: 30px;
    opacity: 0;
    animation: fadeIn 1s forwards 0.5s;
}

.welcome-text {
    color: var(--dark-brown);
    font-size: 2.5em;
    font-weight: 600;
    margin-bottom: 15px;
    letter-spacing: 0.5px;
    line-height: 1.2;
    background: linear-gradient(to right, var(--dark-brown), var(--light-brown));
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
}

.welcome-subtext {
    color: var(--medium-brown);
    font-size: 1.1em;
    line-height: 1.6;
    margin-bottom: 25px;
}

.welcome-divider {
    width: 100px;
    height: 3px;
    background: linear-gradient(to right, var(--light-brown), var(--dark-brown));
    margin: 20px auto;
    border-radius: 3px;
}

.welcome-quote {
    font-style: italic;
    color: var(--medium-brown);
    font-size: 1em;
    line-height: 1.6;
    position: relative;
    padding: 0 30px;
}

.quote-icon {
    color: var(--light-brown);
    opacity: 0.6;
    font-size: 0.8em;
    margin: 0 5px;
}

.right-side {
    flex: 7;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px;
    background: linear-gradient(to right bottom, var(--light-brown), var(--medium-brown));
}

@keyframes float {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-20px);
    }
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.form-container {
    width: 100%;
    max-width: 650px;
}

.form-box {
    background: var(--cream);
    padding: 60px;
    border-radius: 15px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    transform: translateY(20px);
    animation: slideUp 0.8s forwards;
    position: relative;
    overflow: hidden;
    border: 1px solid rgba(58, 42, 31, 0.1);
}

.form-box::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: linear-gradient(to right, var(--light-brown), var(--dark-brown));
}

h2 {
    color: var(--dark-brown);
    text-align: center;
    margin-bottom: 40px;
    font-size: 2.4em;
    font-weight: 400;
    letter-spacing: 0.5px;
}

.input-group {
    position: relative;
    margin-bottom: 30px;
}

.input-group input {
    width: 100%;
    padding: 15px 0;
    font-size: 18px;
    color: var(--dark-brown);
    border: none;
    outline: none;
    background: transparent;
    border-bottom: 2px solid var(--light-brown);
    transition: all 0.3s ease;
}

.input-group input:focus {
    border-bottom-color: var(--dark-brown);
}

label {
    position: absolute;
    left: 0;
    top: 15px;
    color: var(--light-brown);
    pointer-events: none;
    transition: all 0.3s ease;
    font-size: 18px;
}

.input-group input:focus + label,
.input-group input:valid + label {
    top: -15px;
    font-size: 14px;
    color: var(--dark-brown);
}

.submit-btn {
    width: 100%;
    padding: 16px;
    background: linear-gradient(to right, var(--dark-brown), var(--medium-brown));
    color: var(--cream);
    border: none;
    border-radius: 8px;
    font-size: 18px;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-top: 20px;
    letter-spacing: 1px;
    font-weight: 500;
    box-shadow: 0 4px 15px rgba(58, 42, 31, 0.2);
}

.submit-btn:hover {
    background: linear-gradient(to right, var(--medium-brown), var(--dark-brown));
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(58, 42, 31, 0.3);
}

.login-link {
    margin-top: 30px;
    text-align: center;
    color: var(--medium-brown);
    font-size: 16px;
}

.login-link a {
    color: var(--dark-brown);
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    border-bottom: 1px dashed var(--dark-brown);
    padding-bottom: 2px;
}

.login-link a:hover {
    color: var(--medium-brown);
    border-bottom-style: solid;
}

/* Styles pour les alertes */
.alert {
    margin-bottom: 30px;
    border-radius: 8px;
}

/* Styles pour la validation */
.valid-icon, .invalid-icon {
    position: absolute;
    right: 0;
    top: 50%;
    transform: translateY(-50%);
    transition: all 0.3s;
    font-size: 18px;
}

.valid-icon {
    color: #28a745;
    opacity: 0;
}

.invalid-icon {
    color: #dc3545;
    opacity: 0;
}

.help-text {
    font-size: 0.8em;
    color: var(--medium-brown);
    margin-top: 5px;
    display: none;
}

/* Animation */
@keyframes slideUp {
    to {
        transform: translateY(0);
        opacity: 1;
    }
    from {
        transform: translateY(20px);
        opacity: 0;
    }
}

/* Footer */
.footer {
    position: relative;
    background: var(--cream);
    color: var(--dark-brown);
    padding-top: 80px;
    margin-top: auto;
}

.custom-shape-divider-top-1713266907 {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    overflow: hidden;
    line-height: 0;
}

.custom-shape-divider-top-1713266907 svg {
    position: relative;
    display: block;
    width: calc(100% + 1.3px);
    height: 80px;
}

.custom-shape-divider-top-1713266907 .shape-fill {
    fill: var(--medium-brown);
}

.footer-body {
    padding: 40px 0;
}

.footer-left, .footer-middle, .footer-right {
    padding: 20px;
}

.footer p {
    margin-bottom: 15px;
    line-height: 1.6;
}

.footer a {
    color: var(--dark-brown);
    text-decoration: none;
    transition: all 0.3s ease;
    display: block;
    margin-bottom: 10px;
}

.footer a:hover {
    color: var(--light-brown);
    text-decoration: underline;
}

.credits-footer {
    font-weight: 500;
    margin-bottom: 20px !important;
}

.connect-with-us-footer {
    width: 30px;
    margin-right: 15px;
    transition: all 0.3s ease;
}

.connect-with-us-footer:hover {
    transform: translateY(-3px);
}

.vertical-line {
    display: none;
}

/* Responsive */
@media (max-width: 1200px) {
    .page-container {
        flex-direction: column;
    }
    
    .left-side, .right-side {
        flex: 1;
        width: 100%;
        padding: 40px 20px;
    }
    
    .left-side {
        min-height: 40vh;
    }
    
    .right-side {
        min-height: 60vh;
    }
    
    .form-box {
        padding: 40px;
    }
    
    .login-illustration {
        max-width: 300px;
    }
}

@media (max-width: 992px) {
    .footer-left, .footer-middle, .footer-right {
        text-align: center;
        margin-bottom: 30px;
    }
    
    .vertical-line {
        display: block;
        height: 1px;
        background-color: rgba(58, 42, 31, 0.2);
        margin: 30px 0;
    }
}

@media (max-width: 768px) {
    .form-box {
        padding: 30px;
    }
    
    h2 {
        font-size: 2em;
    }
    
    .welcome-text {
        font-size: 2.2em;
    }
    
    input, label {
        font-size: 16px;
    }
    
    .submit-btn {
        padding: 14px;
        font-size: 16px;
    }
    
    .navbar-brand-text {
        font-size: 1.1rem;
    }
}

@media (max-width: 576px) {
    .form-box {
        padding: 25px 20px;
    }
    
    h2 {
        font-size: 1.8em;
        margin-bottom: 30px;
    }
    
    .welcome-text {
        font-size: 1.8em;
    }
    
    .login-link {
        font-size: 14px;
    }
    
    body {
        padding-top: 60px;
    }
}
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top" id="mainNav">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <!-- Remplacez par votre logo -->
                <div class="navbar-logo me-2" style="width: 50px; height: auto; background-color: var(--cream); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-people-fill" style="font-size: 1.5rem; color: var(--dark-brown);"></i>
                </div>
                <span class="navbar-brand-text">CAMPUS ELECT</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarText">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('welcome') }}">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('welcome') }}">À propos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('student.register.form') }}">S'inscrire</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('student.login') }}">Se connecter</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

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
                <!-- Icône d'inscription -->
                <path d="M250,180 L280,230 L340,240 L300,280 L310,340 L250,310 L190,340 L200,280 L160,240 L220,230 Z" 
                      fill="#8b7355" opacity="0.6" stroke="#3a2a1f" stroke-width="2"/>
                <!-- Icône d'étudiant -->
                <circle cx="250" cy="150" r="30" fill="#5d4b36" opacity="0.6"/>
                <path d="M250,180 Q270,200 250,220 Q230,200 250,180" fill="#3a2a1f" opacity="0.6"/>
            </svg>
            
            <div class="welcome-message">
                <h1 class="welcome-text">Rejoignez la communauté !</h1>
                <p class="welcome-subtext">
                    Créez votre compte pour participer aux élections universitaires<br>
                    et faire entendre votre voix.
                </p>
                <div class="welcome-divider"></div>
                <p class="welcome-quote">
                    <i class="fas fa-quote-left quote-icon"></i>
                    Votre inscription est la première étape pour contribuer à la démocratie étudiante
                    <i class="fas fa-quote-right quote-icon"></i>
                </p>
            </div>
        </div>
        <div class="right-side">
            <div class="form-container">
                <div class="form-box">
                    <h2>Inscription Étudiant</h2>
                    
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

                    <form action="{{ route('student.register') }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                            <label for="name">Nom complet</label>
                        </div>

                        <div class="input-group">
                            <input type="email" id="email" name="email" required>
                            <label for="email">Adresse Email</label>
                            <i class="fas fa-check valid-icon"></i>
                            <i class="fas fa-times invalid-icon"></i>
                            <div class="help-text" id="emailHelp">Votre email doit se terminer par @ugb.edu.sn</div>
                        </div>

                        <div class="input-group">
                            <input type="password" id="password" name="password" required>
                            <label for="password">Mot de passe</label>
                            <div class="help-text">Minimum 6 caractères</div>
                        </div>

                        <div class="input-group">
                            <input type="password" id="password_confirmation" name="password_confirmation" required>
                            <label for="password_confirmation">Confirmer le mot de passe</label>
                        </div>

                        <div class="input-group">
                            <input type="text" id="student_code" name="student_code" value="P" required>
                            <label for="student_code">Code Étudiant</label>
                            <div class="help-text" id="codeHelp">Commence par P suivi de votre numéro étudiant</div>
                        </div>

                        <button type="submit" class="submit-btn">S'inscrire</button>
                        <p class="login-link">
                            Déjà inscrit ? 
                            <a href="{{ route('student.login.form') }}">Se connecter</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="custom-shape-divider-top-1713266907">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="shape-fill"></path>
                <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" class="shape-fill"></path>
                <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="shape-fill"></path>
            </svg>
        </div>
        <div class="container-fluid footer-body">
            <div class="row">
                <div class="col-md-6 footer-left pt-xl-4 px-xl-5 d-flex justify-content-center flex-column">
                    <div>
                        <!-- Remplacez par votre logo -->
                        <div class="img-fluid" style="width: 120px; height: auto; background-color: var(--dark-brown); border-radius: 50%; display: flex; align-items: center; justify-content: center; padding: 15px; margin-bottom: 20px;">
                            <i class="bi bi-people-fill" style="font-size: 3rem; color: var(--cream);"></i>
                        </div>
                        <p>Plateforme de vote électronique pour les élections universitaires.</p>
                        <p class="credits-footer" id="credits"><span class="hello-text">© 2024 CampusElect.</span> Tous droits réservés.</p>
                        <div class="vertical-line"></div>
                    </div>
                </div>
                <div class="col-md-3 footer-middle">
                    <div class="row">
                        <p class="credits-footer">Visitez</p>
                        <div class="col-md-6">
                            <a href="https://www.cena.sn/">CENA</a>
                            <a href="https://www.interieur.gouv.sn/">Ministère de l'Intérieur</a>
                            <a href="https://www.dge.sn/">DGE</a>
                        </div>
                        <div class="col-md-6">
                            <a href="https://www.assemblee.sn/">Assemblée Nationale</a>
                            <a href="https://www.presidence.sn/">Présidence</a>
                            <a href="https://www.seneweb.com/">Seneweb</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 footer-right">
                    <div>
                        <p class="credits-footer">Contactez-nous</p>
                        <p>Envoyez-nous un email à <a href="mailto:contact@vote-senegal.sn" class="ivote-email">contact@campus-elect.sn</a></p>
                        <p><a href="about-us.php" class="footer-about-us">À propos | </a><a href="#" class="footer-about-us">Notre Histoire</a></p>
                        <div class="mt-3">
                            <a href="#" class="d-inline-block me-3"><i class="bi bi-twitter" style="font-size: 1.5rem; color: var(--dark-brown);"></i></a>
                            <a href="#" class="d-inline-block"><i class="bi bi-facebook" style="font-size: 1.5rem; color: var(--dark-brown);"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
    $(document).ready(function() {
        // Validation email en temps réel
        $('#email').on('input', function() {
            const email = $(this).val();
            const emailRegex = /^[^\s@]+@ugb\.edu\.sn$/;
            
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

        // Changement de la navbar au scroll
        $(window).scroll(function() {
            if ($(this).scrollTop() > 50) {
                $('.navbar').css('background-color', 'rgba(58, 42, 31, 0.95)');
                $('.navbar').css('box-shadow', '0 4px 20px rgba(0, 0, 0, 0.15)');
            } else {
                $('.navbar').css('background-color', 'rgba(58, 42, 31, 0.9)');
                $('.navbar').css('box-shadow', '0 2px 15px rgba(0, 0, 0, 0.1)');
            }
        });
    });
    </script>
</body>
</html>