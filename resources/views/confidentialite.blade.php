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

 
<style>
.privacy-section {
    padding: 120px 0 80px;
    background-color: var(--blanc);
    position: relative;
}

.privacy-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 100%;
    background: linear-gradient(45deg, rgba(var(--marron-fonce-rgb), 0.05) 0%, transparent 75%);
    pointer-events: none;
}

.privacy-card {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 15px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: var(--card-shadow);
    border: 1px solid rgba(var(--marron-fonce-rgb), 0.1);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.privacy-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: var(--accent-gradient);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.privacy-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--card-shadow-hover);
}

.privacy-card:hover::before {
    opacity: 1;
}

.privacy-card h2 {
    color: var(--marron-fonce);
    font-size: 1.5rem;
    margin-bottom: 1.2rem;
    font-weight: 600;
    position: relative;
    padding-bottom: 0.5rem;
}

.privacy-card h2::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 50px;
    height: 2px;
    background: var(--accent-gradient);
    transition: width 0.3s ease;
}

.privacy-card:hover h2::after {
    width: 100px;
}

.privacy-card p {
    color: var(--marron-moyen);
    line-height: 1.8;
    margin-bottom: 1.2rem;
}

.privacy-card ul {
    list-style: none;
    padding-left: 1.5rem;
}

.privacy-card ul li {
    color: var(--marron-moyen);
    margin-bottom: 0.8rem;
    position: relative;
}

.privacy-card ul li::before {
    content: '•';
    color: var(--accent-color);
    position: absolute;
    left: -1.5rem;
    font-size: 1.2rem;
}

.contact-info {
    margin-top: 1.5rem;
}

.contact-info p {
    display: flex;
    align-items: center;
    margin-bottom: 1rem;
}

.contact-info i {
    color: var(--accent-color);
    margin-right: 1rem;
    font-size: 1.2rem;
    width: 24px;
}

@media (max-width: 768px) {
    .privacy-section {
        padding: 100px 0 60px;
    }

    .privacy-card {
        padding: 1.5rem;
    }

    .privacy-card h2 {
        font-size: 1.3rem;
    }
}
</style>
<div class="privacy-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h1 class="section-title text-center mb-5">Politique de Confidentialité</h1>
                
                <div class="privacy-card">
                    <h2>Introduction</h2>
                    <p>CampusElect, la plateforme de vote électronique officielle de l'Université Gaston Berger de Saint-Louis, s'engage à protéger la confidentialité de vos données personnelles. Cette politique de confidentialité explique comment nous collectons, utilisons et protégeons vos informations.</p>
                </div>

                <div class="privacy-card">
                    <h2>Collecte des Données</h2>
                    <p>Nous collectons les informations suivantes :</p>
                    <ul>
                        <li>Nom et prénom</li>
                        <li>Numéro d'étudiant</li>
                        <li>Adresse email universitaire</li>
                        <li>UFR et filière</li>
                        <li>Niveau d'études</li>
                    </ul>
                </div>

                <div class="privacy-card">
                    <h2>Utilisation des Données</h2>
                    <p>Vos données sont utilisées pour :</p>
                    <ul>
                        <li>Vérifier votre éligibilité au vote</li>
                        <li>Assurer l'unicité de votre vote</li>
                        <li>Vous informer des élections à venir</li>
                        <li>Générer des statistiques anonymes</li>
                    </ul>
                </div>

                <div class="privacy-card">
                    <h2>Protection des Données</h2>
                    <p>Nous mettons en œuvre les mesures suivantes :</p>
                    <ul>
                        <li>Chiffrement de bout en bout des votes</li>
                        <li>Anonymisation des données de vote</li>
                        <li>Stockage sécurisé sur des serveurs protégés</li>
                        <li>Accès restreint aux administrateurs autorisés</li>
                    </ul>
                </div>

                <div class="privacy-card">
                    <h2>Vos Droits</h2>
                    <p>Conformément à la loi sur la protection des données, vous disposez des droits suivants :</p>
                    <ul>
                        <li>Droit d'accès à vos données</li>
                        <li>Droit de rectification</li>
                        <li>Droit à l'effacement</li>
                        <li>Droit à la portabilité des données</li>
                    </ul>
                </div>

                <div class="privacy-card">
                    <h2>Contact</h2>
                    <p>Pour toute question concernant notre politique de confidentialité, contactez-nous :</p>
                    <div class="contact-info">
                        <p><i class="fas fa-envelope"></i> privacy@campuselect.ugb.sn</p>
                        <p><i class="fas fa-phone"></i> +221 77 123 45 67</p>
                        <p><i class="fas fa-map-marker-alt"></i> Université Gaston Berger, Saint-Louis, Sénégal</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>