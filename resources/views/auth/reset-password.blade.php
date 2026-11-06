<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="mb-3">
            <label for="email" class="form-label fw-semibold">Correo Electrónico</label>
            <input id="email" type="email" name="email" class="form-control" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username">
            <x-input-error :messages="$errors->get('email')" class="text-danger mt-1" />
        </div>

        <div class="mb-3">
            <label for="password" class="form-label fw-semibold">Nueva Contraseña</label>
            <input id="password" type="password" name="password" class="form-control" required autocomplete="new-password">
            <x-input-error :messages="$errors->get('password')" class="text-danger mt-1" />
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="form-label fw-semibold">Confirmar Contraseña</label>
            <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" required autocomplete="new-password">
            <x-input-error :messages="$errors->get('password_confirmation')" class="text-danger mt-1" />
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary" style="background-color: var(--color-primary);">
                Restablecer Contraseña
            </button>
        </div>
    </form>
</x-guest-layout>
