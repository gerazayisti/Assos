<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Association Famille Megué</title>
    <link href="{{ asset('css/bootstrap-5.3.3/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/nav.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>
    <!-- Navigation -->
    
    <!-- Navigation -->
    <nav class="sidebar-nav">
        <div class="container">
            <div class="nav-header">
                <img src="{{ asset('images/default-logo.png') }}" alt="Logo" class="app-logo">
                <h1 class="app-name">Famille Megué</h1>
            </div>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ route('home') }}">
                        <i class="fas fa-home"></i>
                        <span>Accueil</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('membres*') ? 'active' : '' }}" href="{{ route('membres.index') }}">
                        <i class="fas fa-users"></i>
                        <span>Membres</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('epargnes*') ? 'active' : '' }}" href="{{ route('epargnes.index') }}">
                        <i class="fas fa-piggy-bank"></i>
                        <span>Épargnes</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('tontines*') ? 'active' : '' }}" href="{{ route('tontines') }}">
                        <i class="fas fa-handshake"></i>
                        <span>Tontines</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('prets*') ? 'active' : '' }}" href="{{ route('prets') }}">
                        <i class="fas fa-coins"></i>
                        <span>Prêts</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('rapports*') ? 'active' : '' }}" href="{{ route('rapports') }}">
                        <i class="fas fa-chart-bar"></i>
                        <span>Rapports</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('parametres*') ? 'active' : '' }}" href="{{ route('parametres') }}">
                        <i class="fas fa-cog"></i>
                        <span>Paramètres</span>
                    </a>
                </li>
                <li class="nav-item more-menu d-md-none">
                    <a class="nav-link" href="#" id="moreMenuBtn">
                        <i class="fas fa-ellipsis-h"></i>
                        <span>Plus</span>
                    </a>
                    <div class="dropup-menu" id="dropupMenu">
                        <!-- Les éléments après le 4ème seront déplacés ici en JS -->
                    </div>
                </li>
            </ul>
        </div>
    </nav>


    <!-- Main Content -->
    <main class="container mt-5 pt-5">
        @yield('content')
    </main>

    @stack('modals')

    <!-- Footer -->
    <footer class="bg-light mt-5 py-3">
        <div class="container text-center">
            <p class="mb-0">&copy; 2024 Association Famille Megué. Tous droits réservés.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    
    @stack('scripts')
</body>
</html>
