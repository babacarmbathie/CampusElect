<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CampusElect - Université Gaston Berger</title>
  <!-- Favicon -->
  <link rel="icon" href="{{ asset('logo.svg') }}" type="image/svg+xml">
  <!-- Fontawesome Link for Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- AOS Animation -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/accueil.css') }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <!-- Montserrat Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <style>
    :root {
      --marron-fonce: #5D4037;
      --marron-moyen: #8D6E63;
      --marron-clair: #D7CCC8;
      --beige: #EFEBE9;
      --blanc: #FFFFFF;
    }

    body {
      font-family: 'Montserrat', sans-serif;
      overflow-x: hidden;
      background-color: var(--beige);
    }

    /* Navigation */
    #mainNav {
      background: linear-gradient(90deg, var(--marron-fonce), var(--marron-moyen));
      box-shadow: 0 2px 15px rgba(0,0,0,0.1);
      transition: all 0.3s ease;
    }

    .navbar-brand-text {
      color: var(--blanc);
      font-weight: 600;
      letter-spacing: 1px;
    }

    .nav-link {
      color: var(--marron-clair);
      font-weight: 500;
      margin: 0 10px;
      transition: all 0.3s ease;
    }

    .nav-link:hover {
      color: var(--blanc);
      transform: translateY(-2px);
    }

    /* Hero Section */
    .hero-section {
      position: relative;
      height: 100vh;
      min-height: 600px;
      display: flex;
      align-items: center;
      background: url('{{ asset("images/ugb_bg.jpg") }}') no-repeat center/cover;
      color: white;
    }

    .hero-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0,0,0,0.4);
    }

    .hero-content {
      position: relative;
      z-index: 2;
    }

    .hero-title {
      font-size: 3.5rem;
      font-weight: 700;
      text-shadow: 0 2px 10px rgba(0,0,0,0.5);
      margin-bottom: 1.5rem;
    }

    .hero-subtitle {
      font-size: 1.3rem;
      letter-spacing: 2px;
      text-shadow: 0 2px 5px rgba(0,0,0,0.5);
    }

    /* Bouton principal */
    .cta-button {
      background: var(--marron-moyen);
      color: var(--blanc);
      padding: 15px 35px;
      border-radius: 50px;
      font-weight: 600;
      border: none;
      transition: all 0.3s ease;
      box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    .cta-button:hover {
      background: var(--marron-fonce);
      transform: translateY(-3px);
      box-shadow: 0 8px 20px rgba(0,0,0,0.3);
    }

    /* Section Organisations */
    .organizations {
      padding: 80px 0;
      background: var(--blanc);
    }

    .org-card {
      background: var(--blanc);
      border-radius: 15px;
      padding: 30px;
      transition: all 0.4s ease;
      box-shadow: 0 10px 20px rgba(0,0,0,0.08);
      height: 100%;
      border: 1px solid var(--marron-clair);
    }

    .org-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 30px rgba(0,0,0,0.15);
    }

    .org-logo {
      width: 120px;
      height: 120px;
      object-fit: contain;
      margin-bottom: 20px;
      transition: all 0.3s ease;
    }

    .org-card:hover .org-logo {
      transform: scale(1.1);
    }

    /* Footer */
    .footer {
      position: relative;
      background: linear-gradient(135deg, var(--marron-fonce), var(--marron-moyen));
      color: var(--blanc);
      padding-top: 100px;
    }

    .footer-divider {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      overflow: hidden;
      line-height: 0;
    }

    .footer-divider svg {
      position: relative;
      display: block;
      width: calc(100% + 1.3px);
      height: 100px;
    }

    .footer-divider .shape-fill {
      fill: var(--blanc);
    }

    .footer-content {
      position: relative;
      z-index: 1;
    }

    .footer-logo {
      filter: brightness(0) invert(1);
      margin-bottom: 20px;
    }

    .footer-links a {
      color: var(--marron-clair);
      transition: all 0.3s ease;
      display: block;
      margin-bottom: 8px;
    }

    .footer-links a:hover {
      color: var(--blanc);
      transform: translateX(5px);
      text-decoration: none;
    }

    .social-icon {
      width: 35px;
      margin-right: 15px;
      transition: all 0.3s ease;
    }

    .social-icon:hover {
      transform: translateY(-5px);
    }

    /* Responsive */
    @media (max-width: 768px) {
      .hero-title {
        font-size: 2.5rem;
      }
      
      .hero-subtitle {
        font-size: 1rem;
      }
      
      .org-btn img {
        width: 80px;
        height: auto;
        transition: transform 0.3s ease-in-out;
    }

    .org-btn:hover img {
        transform: scale(1.2);
    }

    /* Animation de la bordure */
    .org-btn::before {
        content: "";
        position: absolute;
        top: -2px;
        left: -2px;
        right: -2px;
        bottom: -2px;
        z-index: -1;
        background: linear-gradient(45deg, var(--marron-clair), var(--marron-fonce));
        border-radius: 15px;
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
    }

    .org-btn:hover::before {
        opacity: 1;
    }

    /* Texte */
    .org-btn h4 {
        color: var(--marron-fonce);
        margin-top: 10px;
    }

    .org-btn p {
        margin-bottom: 0;
    }
    }
  </style>
</head>

<body id="index-body">
  <!-- Navigation Bar -->
  <nav class="navbar navbar-expand-lg fixed-top" id="mainNav">
    <div class="container-fluid">
      <a class="navbar-brand d-flex align-items-center" href="#">
        <x-logo class="navbar-logo me-2" style="width: 50px; height: auto;" />
        <span class="navbar-brand-text">CAMPUS ELECT</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarText">
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route('welcome') }}">Accueil</a>
          </li>
          <li class="nav-item">
          <a class="nav-link" href="{{ route('about') }}">À propos</a>          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('student.login') }}">Se connecter</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="hero-section">
    <div class=""></div>
    <div class="container hero-content">
      <div class="row">
        <div class="col-lg-8 mx-auto text-center" data-aos="fade-up">
          <h5 class="hero-subtitle mb-3">
            UNIVERSITÉ GASTON BERGER DE SAINT-LOUIS
          </h5>
          <h1 class="hero-title mb-4">
            Vote Électronique de l'UFR <span style="color: var(--marron-clair)">SAT</span>
          </h1>
          <a href="#organizations" class="btn cta-button">
            Sélectionner votre UFR <i class="fas fa-arrow-right ms-2"></i>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- Organizations Section -->
  <section id="organizations" class="organizations">
  <div class="container">
    <!-- Première carte centrée -->
    <div class="row justify-content-center mb-4">
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
            <button class="org-btn">
                <img src="{{ asset('images/sat.png') }}" alt="SAT Logo">
                <h4>UFR SAT</h4>
                <p>Sciences Appliquées et Technologies</p>
            </button>
        </div>
    </div>

    <!-- Trois cartes alignées en bas -->
    <div class="row justify-content-center">
        <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
            <button class="org-btn">
                <img src="{{ asset('images/sat.png') }}" alt="SAT Logo">
                <h4>UFR SAT</h4>
                <p>Sciences Appliquées et Technologies</p>
            </button>
        </div>

        <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
            <button class="org-btn">
                <img src="{{ asset('images/sat.png') }}" alt="SAT Logo">
                <h4>UFR SAT</h4>
                <p>Sciences Appliquées et Technologies</p>
            </button>
        </div>

        <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
            <button class="org-btn">
                <img src="{{ asset('images/sat.png') }}" alt="SAT Logo">
                <h4>UFR SAT</h4>
                <p>Sciences Appliquées et Technologies</p>
            </button>
        </div>
    </div>
</div>

  </section>

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
            <x-logo class="img-fluid" style="width: 120px; height: auto;" />
            <p>Plateforme de vote électronique pour les élections universitaires.</p>
            <p class="credits-footer" id="credits"><span class="hello-text">© 2024 CampusElect.</span> Tous droits réservés.</p>
            <div class="vertical-line"></div>
          </div>
        </div>
        <div class="col-md-3 footer-middle">
          <div class="row">
            <p class="credits-footer">Visitez</p>
            <div class="col-md-3">
              <a href="https://www.cena.sn/">CENA</a>
              <a href="https://www.interieur.gouv.sn/">Ministère de l'Intérieur</a>
              <a href="https://www.dge.sn/">DGE</a>
            </div>
            <div class="col-md-3">
              <a href="https://www.assemblee.sn/">Assemblée Nationale</a>
              <a href="https://www.presidence.sn/">Présidence</a>
              <a href="https://www.seneweb.com/">Seneweb</a>
            </div>
          </div>
        </div>
        <div class="col-md-3 footer-right">
          <div>
            <p class="credits-footer">Contactez-nous</p>
            <p>Envoyez-nous un email à <a href="mailto:contact@vote-senegal.sn" class="ivote-email">contact@vote-senegal.sn</a></p>
            <p><a href="about-us.php" class="footer-about-us">À propos | </a><a href="#" class="footer-about-us">Notre Histoire</a></p>
            <a href="https://twitter.com/SenegalVote"><img src="images/twitter-icon.png" class="connect-with-us-footer"></a>
            <a href="https://www.facebook.com/SenegalVote"><img src="images/facebook-icon.png" class="connect-with-us-footer"></a>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  
  
  
  <script>
    // Initialisation AOS
    AOS.init({
      duration: 800,
      easing: 'ease-in-out-quad',
      once: true
    });
    
    // Effet de rétrécissement de la navbar au scroll
    window.addEventListener('scroll', function() {
      const navbar = document.getElementById('mainNav');
      if (window.scrollY > 50) {
        navbar.style.padding = '10px 0';
        navbar.style.boxShadow = '0 2px 10px rgba(0,0,0,0.2)';
      } else {
        navbar.style.padding = '15px 0';
        navbar.style.boxShadow = 'none';
      }
    });
  </script>
</body>
</html>