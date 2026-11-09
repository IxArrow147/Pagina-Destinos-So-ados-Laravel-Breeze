<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-3">
            <label for="name" class="form-label fw-semibold">Nombre Completo</label>
            <input id="name" type="text" name="name" class="form-control" value="{{ old('name') }}" required autofocus autocomplete="name">
            <x-input-error :messages="$errors->get('name')" class="text-danger mt-1" />
        </div>

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label fw-semibold">Correo Electrónico</label>
            <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required autocomplete="username">
            <x-input-error :messages="$errors->get('email')" class="text-danger mt-1" />
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label fw-semibold">Contraseña</label>
            <input id="password" type="password" name="password" class="form-control" required autocomplete="new-password">
            <x-input-error :messages="$errors->get('password')" class="text-danger mt-1" />
        </div>

        <!-- Confirm Password -->
        <div class="mb-3">
            <label for="password_confirmation" class="form-label fw-semibold">Confirmar Contraseña</label>
            <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" required autocomplete="new-password">
            <x-input-error :messages="$errors->get('password_confirmation')" class="text-danger mt-1" />
        </div>
        <!-- Autorización de tratamiento de datos -->
        <div class="mb-3">
            <div class="p-3 rounded border" style="background-color: var(--color-primary-light); border-color: var(--color-primary) !important;">
                <div class="d-flex align-items-center gap-2 mb-2" style="color: var(--color-primary);">
                    <i class="fa-solid fa-shield-halved"></i>
                    <strong style="font-size: 0.9rem;">Protección de tus datos personales</strong>
                </div>
                <div class="form-check">
                    <input id="privacy" type="checkbox" name="privacy" value="1"
                        class="form-check-input" {{ old('privacy') ? 'checked' : '' }} required>
                    <label for="privacy" class="form-check-label" style="font-size: 0.85rem;">
                        He leído y acepto la
                        <a href="{{ route('politica.privacidad') }}" target="_blank" class="fw-bold" style="color: var(--color-primary); text-decoration: underline;">Política de Tratamiento de Datos Personales</a>.
                        Autorizo a {{ config('privacy.responsable') }} a tratar mi nombre, correo electrónico y contraseña para crear y administrar mi cuenta, permitir mi acceso y enviarme correos de seguridad (como la recuperación de contraseña). Entiendo que mis datos pueden ser procesados por proveedores tecnológicos ubicados fuera de Colombia y que puedo consultar, actualizar o solicitar la eliminación de mis datos cuando lo desee.
                    </label>
                </div>
            </div>
            <x-input-error :messages="$errors->get('privacy')" class="text-danger mt-1" />
        </div>
        <div class="d-flex justify-content-between align-items-center mt-4">
            <a class="text-muted" href="{{ route('login') }}" style="font-size: 0.9rem;">
                ¿Ya tienes cuenta? <strong>Inicia sesión</strong>
            </a>

            <button type="submit" class="btn btn-primary" style="background-color: var(--color-primary);">
                Registrarse
            </button>
        </div>
    </form>
</x-guest-layout>
