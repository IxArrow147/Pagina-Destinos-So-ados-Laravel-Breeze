<x-guest-layout>
    <p class="text-muted mb-4" style="font-size: 0.95rem;">
        ¡Gracias por registrarte! Antes de comenzar, verifica tu correo electrónico haciendo clic en el enlace que acabamos de enviarte. Si no lo recibiste, con gusto te enviamos otro.
    </p>

    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success py-2" style="font-size: 0.9rem;">
            Se envió un nuevo enlace de verificación al correo que registraste.
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mt-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-primary" style="background-color: var(--color-primary);">
                Reenviar correo de verificación
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-link text-muted p-0" style="font-size: 0.9rem;">
                Cerrar sesión
            </button>
        </form>
    </div>
</x-guest-layout>
