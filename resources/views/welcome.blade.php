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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <!-- AOS Animation -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <!-- Montserrat Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
  <link rel="stylesheet" href="{{ asset('css/nav-footer.css') }}">
</head>

<body id="index-body">
  <!-- Navigation Bar -->
  @include('components.nav')

  <!-- Hero Section -->
  <section class="hero-section">
    <div class="hero-overlay"></div>
    <div class="container hero-content">
      <div class="row">
        <div class="col-lg-8 mx-auto text-center" data-aos="fade-up">
          <h5 class="hero-subtitle mb-3">
            UNIVERSITÉ GASTON BERGER DE SAINT-LOUIS
          </h5>
          <h1 class="hero-title mb-4">
            Vote Électronique de l'UFR <span class="highlight">SAT</span>
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
            <a href="{{ route('student.register', ['ufr' => $ufrs['SAT']['code']]) }}" class="org-btn">
                <img src="{{ asset('images/' . $ufrs['SAT']['logo']) }}" alt="{{ $ufrs['SAT']['code'] }} Logo">
                <h4>UFR {{ $ufrs['SAT']['code'] }}</h4>
                <p>{{ $ufrs['SAT']['nom'] }}</p>
            </a>
        </div>
    </div>

    <!-- Cartes des UFRs -->
    <div class="row justify-content-center">
        @php
            $ufrKeys = array_keys($ufrs);
            $ufrCount = count($ufrKeys);
            $rows = ceil(($ufrCount - 1) / 3); // -1 car la première UFR est déjà affichée
        @endphp

        @for ($i = 1; $i < $ufrCount; $i++)
            @if (($i - 1) % 3 == 0 && $i > 1)
                </div><div class="row justify-content-center">
            @endif
            
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="{{ 100 + ($i * 100) }}">
                <a href="{{ route('student.register', ['ufr' => $ufrs[$ufrKeys[$i]]['code']]) }}" class="org-btn">
                    <img src="{{ asset('images/' . $ufrs[$ufrKeys[$i]]['logo']) }}" alt="{{ $ufrs[$ufrKeys[$i]]['code'] }} Logo">
                    <h4>UFR {{ $ufrs[$ufrKeys[$i]]['code'] }}</h4>
                    <p>{{ $ufrs[$ufrKeys[$i]]['nom'] }}</p>
                </a>
            </div>
        @endfor
    </div>
</div>
  </section>

   <!-- Footer -->
  @include('components.footer')

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="{{ asset('js/welcome.js') }}"></script>
</body>
</html>