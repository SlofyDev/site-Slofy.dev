<nav class="navbar navbar-expand-lg navbar-light shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold text-decoration-none d-flex align-items-center" href="{{ route('home') }}">
            <img src="{{ asset('img/logo.png') }}" alt="Slofy.Dev" height="40" class="d-inline-block align-top">
            <span class="ms-2">Slofy.dev</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('freelancers.index') }}">Freelancers</a>
                </li>

                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">Meu Perfil</a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="nav-link border-0 bg-transparent" style="cursor: pointer;">
                                <i class="fas fa-sign-out-alt me-1"></i>Sair
                            </button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Entrar</a>
                    </li>

                    <!-- Dropdown de Registro -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="registerDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            Registrar
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="registerDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('register.freelancer') }}">
                                    Freelancer
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('register.empresa') }}">
                                    Empresa
                                </a>
                            </li>
                        </ul>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>