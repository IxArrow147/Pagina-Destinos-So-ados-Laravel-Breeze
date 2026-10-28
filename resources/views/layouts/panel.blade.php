<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TourSystem | Panel de Administración</title>

    <!-- Bootstrap CSS (para tablas y formularios) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <!-- TU CSS de la Landing Page -->
    <link rel="stylesheet" href="{{ asset('css/landing_page.css') }}" />
    
    <!-- Un pequeño extra para el panel -->
    <style>
        .panel-content {
            min-height: 80vh;
            padding: 2rem 0;
            background-color: var(--color-bg-alt);
        }
        /* Adaptamos el header de la landing para el panel */
        .header__cta--logout {
            background-color: var(--color-border);
            color: var(--color-text);
        }
        .header__cta--logout:hover {
            background-color: #d1d5db;
        }
    </style>
</head>
<body>

    <!-- ===================== HEADER DEL PANEL ===================== -->
    <header class="header">
        <div class="header__container">
            
            <a href="{{ route('dashboard') }}" class="header__logo">
                <i class="fa-solid fa-earth-americas header__logo-icon"></i>
                <span class="header__logo-text">TourSystem <small class="text-muted fs-6">| Panel</small></span>
            </a>

            <nav class="header__nav">
                <ul class="header__nav-list">
                    <li class="header__nav-item">
                        <a href="{{ route('dashboard') }}" class="header__nav-link {{ request()->routeIs('dashboard') ? 'header__nav-link--active' : '' }}">
                            <i class="fa-solid fa-gauge header__nav-icon"></i> Dashboard
                        </a>
                    </li>
                    <li class="header__nav-item">
                        <a href="{{ route('destinos.index') }}" class="header__nav-link {{ request()->routeIs('destinos.*') ? 'header__nav-link--active' : '' }}">
                            <i class="fa-solid fa-map-location-dot header__nav-icon"></i> Destinos
                        </a>
                    </li>
                    <li class="header__nav-item">
                        <a href="{{ route('reservas.index') }}" class="header__nav-link {{ request()->routeIs('reservas.*') ? 'header__nav-link--active' : '' }}">
                            <i class="fa-solid fa-suitcase-rolling header__nav-icon"></i> Reservas
                        </a>
                    </li>
                    <!-- Aquí irás agregando Clientes, Reservas, etc. luego -->
                </ul>
            </nav>

            <!-- Botón para volver a la Landing Page -->
            <a href="{{ route('landing_page') }}" class="header__cta me-3" style="background-color: var(--color-primary); color: white;">
                <i class="fa-solid fa-house me-1"></i> Ir a la Web
            </a>

            <!-- Menú de Usuario (Logout) -->
            <div class="dropdown">
                <button class="header__cta header__cta--logout dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="fa-solid fa-user me-1"></i> {{ Auth::user()->name ?? 'Invitado' }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Mi Perfil</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">Cerrar Sesión</button>
                        </form>
                    </li>
                </ul>
            </div>

        </div>
    </header>

    <!-- ===================== CONTENIDO DINÁMICO ===================== -->
    <main class="panel-content">
        <div class="container"> <!-- Contenedor de Bootstrap para que las tablas no queden pegadas a los bordes -->
            @yield('content')
        </div>
    </main>

    <!-- ===================== FOOTER DEL PANEL ===================== -->
    <footer class="footer py-3 text-center" style="padding: 1rem 0 !important;">
        <p class="footer__copyright m-0">&copy; 2026 Destinos Soñados S.A. — TourSystem Panel.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>