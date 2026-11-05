@extends('layouts.panel')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 mt-2">
        <h2 class="fw-bold" style="color: var(--color-text);">Mi Perfil</h2>
    </div>

    <div class="row">
        <!-- Columna Izquierda: Actualizar Información -->
        <div class="col-md-7 mb-4">
            <div class="card shadow-sm border-0 h-100" style="border-radius: var(--radius-lg);">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3 border-bottom pb-2">Información Personal</h5>
                    <p class="text-muted mb-4">Actualiza tu nombre y correo electrónico.</p>

                    <form method="post" action="{{ route('profile.update') }}">
                        @csrf
                        @method('patch')

                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Nombre</label>
                            <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                            @error('name') <div class="text-danger mt-1 small">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Correo Electrónico</label>
                            <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}" required autocomplete="username">
                            @error('email') <div class="text-danger mt-1 small">{{ $message }}</div> @enderror
                        </div>

                        <div class="d-flex align-items-center gap-3 mt-4">
                            <button type="submit" class="btn btn-primary" style="background-color: var(--color-primary);">
                                Guardar Cambios
                            </button>
                            
                            @if (session('status') === 'profile-updated')
                                <span class="text-success small"><i class="fa-solid fa-check"></i> Guardado.</span>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Columna Derecha: Cambiar Contraseña -->
        <div class="col-md-5 mb-4">
            <div class="card shadow-sm border-0 h-100" style="border-radius: var(--radius-lg);">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3 border-bottom pb-2">Seguridad</h5>
                    <p class="text-muted mb-4">Asegúrate de usar una contraseña larga y aleatoria.</p>

                    <form method="post" action="{{ route('password.update') }}">
                        @csrf
                        @method('put')

                        <div class="mb-3">
                            <label for="current_password" class="form-label fw-semibold">Contraseña Actual</label>
                            <input id="current_password" name="current_password" type="password" class="form-control" autocomplete="current-password">
                            @error('current_password', 'updatePassword') <div class="text-danger mt-1 small">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">Nueva Contraseña</label>
                            <input id="password" name="password" type="password" class="form-control" autocomplete="new-password">
                            @error('password', 'updatePassword') <div class="text-danger mt-1 small">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label fw-semibold">Confirmar Contraseña</label>
                            <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password">
                            @error('password_confirmation', 'updatePassword') <div class="text-danger mt-1 small">{{ $message }}</div> @enderror
                        </div>

                        <div class="d-flex align-items-center gap-3 mt-4">
                            <button type="submit" class="btn btn-primary" style="background-color: var(--color-primary);">
                                Actualizar Contraseña
                            </button>

                            @if (session('status') === 'password-updated')
                                <span class="text-success small"><i class="fa-solid fa-check"></i> Actualizada.</span>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección para Eliminar Cuenta (Peligrosa) -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm border-danger mt-2" style="border-radius: var(--radius-lg);">
                <div class="card-body p-4">
                    <h5 class="fw-bold text-danger mb-3">Eliminar Cuenta</h5>
                    <p class="text-muted mb-4">Una vez que tu cuenta sea eliminada, todos sus recursos y datos se borrarán permanentemente.</p>

                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
                        Eliminar Cuenta
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para confirmar eliminación (Bootstrap) -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">¿Estás seguro de que quieres eliminar tu cuenta?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-muted">Esta acción es irreversible. Ingresa tu contraseña para confirmar.</p>
                    <form method="post" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('delete')
                        <div class="mb-3">
                            <label for="password_delete" class="form-label fw-semibold">Contraseña</label>
                            <input id="password_delete" name="password" type="password" class="form-control" placeholder="Tu contraseña">
                            @error('password', 'userDeletion') <div class="text-danger mt-1 small">{{ $message }}</div> @enderror
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-danger">Eliminar Cuenta</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
