<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CampusElect - Université Gaston Berger</title>
  <!-- Favicon -->
  <link rel="icon" href="{{ asset('logo.svg') }}" type="image/svg+xml">
  <!-- Fontawesome Link for Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/accueil.css') }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <!-- Montserrat Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
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
            <a class="nav-link" href="{{ route('welcome') }}">À propos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('student.login') }}">Se connecter</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="parallax">
    <div class="container">
      <div class="row">
        <div class="col text-center text-white">
          <h5 id="index-PUPSRC" class="text-truncate mt-3">
            UNIVERSITÉ GASTON BERGER DE SAINT-LOUIS
          </h5>
          <h1 class="" id="index-AES">Vote Automatique de l'UFR SAT</h1>
          <a href="#organizations" type="button" class="btn btn-primary fw-bold index-button">Sélectionner votre UFR</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Organizations Section -->
  <section id="organizations" class="organizations">
    <form action="includes/classes/landing-page-controller.php" method="post">
      
    <div class="container-fluid">
          <div class="row justify-content-center text-center">
            <div class="col-md-3 mb-4">
              <button type="submit" name="submit_btn" value="vote" class="landing-page-org-card" id="SCO-landing-logo">
                <img src="ugb.jpg" alt="SCO Logo" class="landing-page-logo-size">
                <h5 class="fw-bold pt-2 text-capitalize">SAT</h5>
              </button>
            </div>
          </div>
        </div>

        <div class="container-fluid">
          <div class="row justify-content-center text-center">
            <div class="col-md-3 mb-4" id="index-ACAP">
              <button type="submit" name="submit_btn" value="SAT" class="landing-page-org-card" id="ACAP-landing-logo">
                <img src="images/logos/acap.png" alt="ACAP Logo" class="landing-page-logo-size">
                <h5 class="fw-bold pt-2 text-uppercase">SAT</h5>
              </button>
            </div>

            <div class="col-md-3 mb-4" id="index-AECES">
              <button type="submit" name="submit_btn" value="SAT" class="landing-page-org-card" id="AECES-landing-logo">
                <img src="images/logos/aeces.png" alt="AECES Logo" class="landing-page-logo-size">
                <h5 class="fw-bold pt-2 text-uppercase">SAT</h5>
              </button>
            </div>

            <div class="col-md-3 mb-4" id="index-AECES">
              <button type="submit" name="submit_btn" value="S2ATA" class="landing-page-org-card" id="ELITE-landing-logo">
                <img src="images/logos/elite.png" alt="ELITE Logo" class="landing-page-logo-size">
                <h5 class="fw-bold pt-2 text-uppercase">S2ATA</h5>
              </button>
            </div>
          </div>
        </div>

        <div class="container-fluid">
          <div class="row justify-content-center text-center">
           
            

          </div>
        </div>

       
        </div>
      </div>
    </form>
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

  <!-- Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

  <!-- JavaScript for dynamic text change -->
  <script>
    const indexPUPSRC = document.getElementById('index-PUPSRC');

    function updateText() {
      if (window.innerWidth <= 768) {
        indexPUPSRC.textContent = 'UGB SAINT-LOUIS';
      } else {
        indexPUPSRC.textContent = 'UNIVERSITÉ GASTON BERGER DE SAINT-LOUIS';
      }
    }

    window.addEventListener('load', updateText);
    window.addEventListener('resize', updateText);
  </script>
</body>

</html>