<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TourSystem | Acceso</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <!-- TU CSS de la Landing Page -->
    <link rel="stylesheet" href="{{ asset('css/landing_page.css') }}" />
    
    <style>
        body {
            background-color: var(--color-bg-alt);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .auth-card {
            background-color: var(--color-bg);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-lg);
            padding: 3rem;
            width: 100%;
            max-width: 450px;
        }
        .auth-logo {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            font-size: 2rem;
            font-weight: 700;
            color: var(--color-primary);
            margin-bottom: 2rem;
        }
        .auth-logo span {
            color: var(--color-text);
        }
    </style>
</head>
<body>

    <div class="auth-card">
        <!-- Logo -->
        <a href="{{ route('landing_page') }}" class="auth-logo">
            <i class="fa-solid fa-earth-americas"></i>
            <span>TourSystem</span>
        </a>

        <!-- Contenido del formulario (Login o Register) -->
        {{ $slot }}
        
        <!-- Botón para volver al inicio -->
        <div class="text-center mt-4">
            <a href="{{ route('landing_page') }}" class="text-muted" style="font-size: 0.9rem;">
                <i class="fa-solid fa-arrow-left me-1"></i> Volver a la página principal
            </a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
