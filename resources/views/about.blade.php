<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>À propos - CampusElect</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('logo.svg') }}" type="image/svg+xml">
    <!-- Fontawesome Link for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Montserrat Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/nav-footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/confetti/2.7.2/confetti.min.js"></script>
    <script src="https://unpkg.com/swup@4"></script>
</head>

<body>
    <!-- Navigation Bar -->
    @include('components.nav')

    <!-- Main Content -->
    <main class="about-section">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center" data-aos="fade-up">
                    <h1 class="mb-4 section-title">À propos de CampusElect</h1>
                    <p class="lead mb-4">
                        CampusElect est la plateforme de vote électronique officielle de l'Université Gaston Berger de Saint-Louis.
                        Notre mission est de faciliter et de sécuriser le processus électoral au sein de notre communauté universitaire.
                    </p>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-card">
                        <i class="fas fa-shield-alt"></i>
                        <h3>Sécurisé</h3>
                        <p>Système de vote hautement sécurisé avec authentification à deux facteurs et cryptage des données.</p>
                    </div>
                </div>

                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-card">
                        <i class="fas fa-user-check"></i>
                        <h3>Transparent</h3>
                        <p>Processus de vote transparent avec des résultats vérifiables et une traçabilité complète.</p>
                    </div>
                </div>

                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-card">
                        <i class="fas fa-mobile-alt"></i>
                        <h3>Accessible</h3>
                        <p>Interface conviviale accessible depuis n'importe quel appareil connecté à Internet.</p>
                    </div>
                </div>
            </div>

            <!-- Section Notre Équipe -->
            <div class="row mt-5">
                <div class="col-12 text-center mb-5" data-aos="fade-up">
                    <h2 class="section-title">Notre Équipe</h2>
                    <p class="section-subtitle">Les créateurs derrière CampusElect</p>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="team-card">
                        <div class="team-img-container">
                            <img src="{{ asset('images/baba.jpg') }}" alt="Babacar MBathie" class="team-img">
                            <div class="team-overlay"></div>
                        </div>
                        <h3>Babacar MBathie</h3>
                        <p class="team-role">Étudiant Entrepreneur</p>
                        <p class="team-desc">Ingénieur informatique et en agriculture</p>
                        <div class="team-contact">
                            <i class="fas fa-phone me-2"></i>761917181
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="team-card">
                        <div class="team-img-container">
                            <img src="{{ asset('images/paco.jpg') }}" alt="Pape Doukoum TINE" class="team-img">
                            <div class="team-overlay"></div>
                        </div>
                        <h3>Pape Doukoum TINE</h3>
                        <p class="team-role">Étudiant/Informaticien</p>
                        <p class="team-desc">Développeur, Entrepreneur</p>
                        <div class="team-contact">
                            <i class="fas fa-phone me-2"></i>777286959
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="team-card">
                        <div class="team-img-container">
                            <img src=" " alt="Harouna DIAW" class="team-img">
                            <div class="team-overlay"></div>
                        </div>
                        <h3>Harouna DIAW</h3>
                        <p class="team-role">Etudiant Développeur</p>
                        <p class="team-desc">Spécialiste en sécurité des applications</p>
                        <div class="team-contact">
                            <i class="fas fa-phone me-2"></i>771234567
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section Contact -->
            <div class="row mt-5">
                <div class="col-lg-8 mx-auto" data-aos="fade-up">
                    <div class="contact-section">
                        <h2 class="section-title text-center">Contactez-nous</h2>
                        <p class="text-center mb-4">Pour toute question concernant la plateforme, n'hésitez pas à nous contacter.</p>
                        <div class="contact-info">
                            <p><i class="fas fa-phone me-2"></i>Téléphone: 777286959</p>
                            <p><i class="fas fa-envelope me-2"></i>Email: <a href="mailto:contact@campuselect.com">contact@campuselect.com</a></p>
                            <p><i class="fas fa-map-marker-alt me-2"></i>Adresse: Université Gaston Berger, Saint-Louis, Sénégal</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    @include('components.footer')

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true
            });
        });
    </script>
</body>

</html>