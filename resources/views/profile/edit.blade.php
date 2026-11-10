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
                    <h5 class="fw-bold text-danger mb-2">
                        <i class="fa-solid fa-triangle-exclamation me-1"></i> Eliminar Cuenta
                    </h5>
                    <p class="text-muted mb-3">
                        Puedes solicitar la eliminación de tus datos personales en cualquier momento, como lo permite la
                        <a href="{{ route('politica.privacidad') }}" target="_blank" style="color: var(--color-primary);">Política de Tratamiento de Datos Personales</a>.
                        Antes de continuar, ten en cuenta lo que ocurrirá:
                    </p>

                    <ul class="list-unstyled mb-4" style="font-size: 0.92rem;">
                        <li class="d-flex gap-2 mb-2"><i class="fa-solid fa-trash text-danger mt-1"></i>
                            <span>Se borrarán de forma <strong>permanente</strong> tu nombre, tu correo electrónico, tu contraseña y la constancia de autorización que diste al registrarte.</span></li>
                        <li class="d-flex gap-2 mb-2"><i class="fa-solid fa-right-from-bracket text-danger mt-1"></i>
                            <span>Se cerrarán todas tus sesiones activas y se invalidarán los enlaces de recuperación de contraseña pendientes.</span></li>
                        <li class="d-flex gap-2 mb-2"><i class="fa-solid fa-ban text-danger mt-1"></i>
                            <span>No podrás recuperar la cuenta ni deshacer la acción. Si quieres volver, tendrás que registrarte de nuevo.</span></li>
                        <li class="d-flex gap-2 mb-2"><i class="fa-solid fa-scale-balanced text-danger mt-1"></i>
                            <span>Tu cuenta no tiene información asociada que la ley obligue a conservar, por eso se elimina por completo.</span></li>
                        @if($user->role === 'admin')
                            <li class="d-flex gap-2 mb-2"><i class="fa-solid fa-user-shield text-danger mt-1"></i>
                                <span>Eres administrador: no podrás eliminar tu cuenta si eres el único que queda.</span></li>
                        @endif
                    </ul>

                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
                        <i class="fa-solid fa-user-xmark me-1"></i> Eliminar mi cuenta
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
                    <h5 class="modal-title" id="confirmDeleteModalLabel">¿Eliminar tu cuenta definitivamente?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger py-2 small">
                        <i class="fa-solid fa-triangle-exclamation me-1"></i>
                        Esta acción es <strong>irreversible</strong>: se borrarán tu nombre, correo y contraseña.
                    </div>

                    <form method="post" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('delete')

                        <div class="form-check mb-3">
                            <input id="confirm_deletion" name="confirm_deletion" type="checkbox" value="1" class="form-check-input" required>
                            <label for="confirm_deletion" class="form-check-label small">
                                Entiendo que mi cuenta y mis datos personales se eliminarán de forma permanente y que no se puede deshacer.
                            </label>
                            @error('confirm_deletion', 'userDeletion') <div class="text-danger mt-1 small">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_delete" class="form-label fw-semibold">Confirma tu contraseña</label>
                            <input id="password_delete" name="password" type="password" class="form-control" placeholder="Tu contraseña" required autocomplete="current-password">
                            @error('password', 'userDeletion') <div class="text-danger mt-1 small">{{ $message }}</div> @enderror
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-danger">Sí, eliminar mi cuenta</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Si hubo un error al eliminar, reabre el modal para que el usuario vea el mensaje --}}
    @if($errors->userDeletion->isNotEmpty())
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                new bootstrap.Modal(document.getElementById('confirmDeleteModal')).show();
            });
        </script>
    @endif
@endsection
