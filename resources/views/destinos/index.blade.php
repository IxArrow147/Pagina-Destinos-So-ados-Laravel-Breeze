@extends('layouts.panel')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 mt-2">
        <h2 class="fw-bold" style="color: var(--color-text);">Listado de Destinos Turísticos</h2>
        <a href="{{ route('destinos.create') }}" class="btn btn-primary" style="background-color: var(--color-primary); border:none;">
            <i class="fa-solid fa-plus me-1"></i> Crear Destino
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0" style="border-radius: var(--radius-lg);">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead style="background-color: var(--color-primary-light);">
                        <tr>
                            <th class="py-3 px-4">ID</th>
                            <th class="py-3 px-4">Foto</th>
                            <th class="py-3 px-4">Código</th>
                            <th class="py-3 px-4">Nombre</th>
                            <th class="py-3 px-4">Tipo</th>
                            <th class="py-3 px-4">País</th>
                            <th class="py-3 px-4">Región</th>
                            <th class="py-3 px-4">Popularidad</th>
                            <th class="py-3 px-4">Restricciones</th>
                            <th class="py-3 px-4 text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($destinos as $destino)
                        <tr>
                            <td class="py-3 px-4 align-middle">{{ $destino->id_destino }}</td>
                            <td class="py-3 px-4 align-middle">
                                @if(!empty($destino->imagen))
                                    <img src="{{ Storage::disk('s3')->temporaryUrl($destino->imagen, now()->addMinutes(30)) }}"
                                         alt="{{ $destino->nombre }}"
                                         class="rounded"
                                         style="width: 56px; height: 56px; object-fit: cover;">
                                @else
                                    <div class="rounded bg-light d-flex align-items-center justify-content-center text-muted"
                                         style="width: 56px; height: 56px;">
                                        <i class="fa-regular fa-image"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="py-3 px-4 align-middle"><span class="badge bg-secondary">{{ $destino->codigo }}</span></td>
                            <td class="py-3 px-4 align-middle fw-semibold">{{ $destino->nombre }}</td>
                            <td class="py-3 px-4 align-middle">{{ $destino->tipo_nombre }}</td>
                            <td class="py-3 px-4 align-middle">{{ $destino->pais_nombre }}</td>
                            <td class="py-3 px-4 align-middle">{{ $destino->region_nombre }}</td>
                            <td class="py-3 px-4 align-middle">
                                @if(!is_null($destino->nivel_popularidad))
                                    <span class="badge bg-info text-dark">{{ $destino->nivel_popularidad }}/10</span>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td class="py-3 px-4 align-middle">
                                @if(!empty($destino->restricciones))
                                    <span title="{{ $destino->restricciones }}">
                                        {{ \Illuminate\Support\Str::limit($destino->restricciones, 40) }}
                                    </span>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td class="py-3 px-4 align-middle text-end">
                                <a href="{{ route('destinos.edit', $destino->id_destino) }}" class="btn btn-sm btn-warning">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <form action="{{ route('destinos.destroy', $destino->id_destino) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar este destino?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center py-5 text-muted">
                                <i class="fa-solid fa-map-location-dot fs-1 mb-3 d-block"></i>
                                No hay destinos registrados aún.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection