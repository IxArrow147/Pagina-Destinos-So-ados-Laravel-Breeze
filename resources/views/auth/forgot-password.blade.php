<x-guest-layout>
    <p class="text-muted mb-4" style="font-size: 0.95rem;">
        ¿Olvidaste tu contraseña? No hay problema. Escribe tu correo electrónico y te enviaremos un enlace para que elijas una nueva.
    </p>

    <!-- Session Status -->
    <x-auth-session-status class="mb-3 text-success" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label fw-semibold">Correo Electrónico</label>
            <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
            <x-input-error :messages="$errors->get('email')" class="text-danger mt-1" />
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary" style="background-color: var(--color-primary);">
                Enviar enlace de recuperación
            </button>
        </div>

        <div class="text-center mt-4 pt-3 border-top">
            <a href="{{ route('login') }}" class="text-muted" style="font-size: 0.9rem;">
                <i class="fa-solid fa-arrow-left me-1"></i> Volver a iniciar sesión
            </a>
        </div>
    </form>
</x-guest-layout>