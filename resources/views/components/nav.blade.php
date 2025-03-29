<!-- Navigation -->
<nav class="navbar navbar-expand-lg fixed-top" id="mainNav">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('welcome') }}">
            @include('components.logo')
            <span class="navbar-brand-text text-white">CAMPUS ELECT</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarText">
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('welcome') ? 'active' : '' }}" href="{{ route('welcome') }}">
                        <i class="fas fa-home me-1"></i>Accueil
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">
                        <i class="fas fa-info-circle me-1"></i>À propos
                    </a>
                </li>
                @if(request()->routeIs('student.login.form'))
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('student.register.form') ? 'active' : '' }}" href="{{ route('student.register.form') }}">
                            <i class="fas fa-user-plus me-1"></i>S'inscrire
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('student.login.form') ? 'active' : '' }}" href="{{ route('student.login.form') }}">
                            <i class="fas fa-sign-in-alt me-1"></i>Se connecter
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav> 