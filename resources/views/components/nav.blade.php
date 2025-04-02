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
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle me-1"></i>{{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('vote.index') }}">
                                    <i class="fas fa-vote-yea me-1"></i>Voter
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('student.logout') }}" 
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt me-1"></i>Se déconnecter
                                </a>
                                <form id="logout-form" action="{{ route('student.logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
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
                @endauth
            </ul>
        </div>
    </div>
</nav> 