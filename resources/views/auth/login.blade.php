<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-success" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label fw-semibold">Correo Electrónico</label>
            <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
            <x-input-error :messages="$errors->get('email')" class="text-danger mt-1" />
        </div>

        <div class="mb-3">
            <label for="password" class="form-label fw-semibold">Contraseña</label>
            <input id="password" type="password" name="password" class="form-control" required>
            <x-input-error :messages="$errors->get('password')" class="text-danger mt-1" />
        </div>

        <div class="mb-3 form-check">
            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
            <label for="remember_me" class="form-check-label">Recordarme</label>
        </div>

        <div class="d-flex justify-content-between align-items-center">
            @if (Route::has('password.request'))
                <a class="text-muted" href="{{ route('password.request') }}" style="font-size: 0.9rem;">
                    ¿Olvidaste tu contraseña?
                </a>
            @endif

            <button type="submit" class="btn btn-primary" style="background-color: var(--color-primary);">
                Iniciar Sesión
            </button>
        </div>
        
        <div class="text-center mt-4 pt-3 border-top">
            <p class="mb-0 text-muted">¿No tienes cuenta? 
                <a href="{{ route('register') }}" class="fw-bold" style="color: var(--color-primary);">Regístrate aquí</a>
            </p>
            <div class="text-center mt-3">
                <a href="{{ route('politica.privacidad') }}" class="btn btn-outline-primary btn-sm">
                    <i class="fa-solid fa-shield-halved me-1"></i> Política de privacidad
                </a>
            </div>
        </div>
    </form>
</x-guest-layout>
