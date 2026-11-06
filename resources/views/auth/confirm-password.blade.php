<x-guest-layout>
    <p class="text-muted mb-4" style="font-size: 0.95rem;">
        Esta es una zona segura de la aplicación. Confirma tu contraseña antes de continuar.
    </p>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="mb-4">
            <label for="password" class="form-label fw-semibold">Contraseña</label>
            <input id="password" type="password" name="password" class="form-control" required autocomplete="current-password">
            <x-input-error :messages="$errors->get('password')" class="text-danger mt-1" />
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary" style="background-color: var(--color-primary);">
                Confirmar
            </button>
        </div>
    </form>
</x-guest-layout>
