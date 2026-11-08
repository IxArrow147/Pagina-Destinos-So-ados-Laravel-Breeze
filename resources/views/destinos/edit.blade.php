@extends('layouts.panel')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 mt-2">
        <h2 class="fw-bold" style="color: var(--color-text);">Editar Destino: {{ $destino->nombre }}</h2>
        <a href="{{ route('destinos.index') }}" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i> Volver al listado
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>¡Ups! Hay algunos errores:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0" style="border-radius: var(--radius-lg);">
        <div class="card-body p-4">
            <form action="{{ route('destinos.update', $destino->id_destino) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row mb-4">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Código</label>
                        <input type="text" name="codigo" class="form-control" value="{{ old('codigo', $destino->codigo) }}" required>
                    </div>
                    <div class="col-md-8">
                        <label class="form-label fw-semibold">Nombre del Destino</label>
                        <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $destino->nombre) }}" required>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Tipo de Destino</label>
                        <select name="id_tipo" class="form-select" required>
                            @foreach($tipos as $tipo)
                                <option value="{{ $tipo->id }}" {{ old('id_tipo', $destino->id_tipo_destino) == $tipo->id ? 'selected' : '' }}>
                                    {{ $tipo->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">País</label>
                        <select name="id_pais" class="form-select" required>
                            @foreach($paises as $pais)
                                <option value="{{ $pais->id }}" {{ old('id_pais', $destino->id_pais) == $pais->id ? 'selected' : '' }}>
                                    {{ $pais->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Región</label>
                        <select name="id_region" class="form-select" required>
                            @foreach($regiones as $region)
                                <option value="{{ $region->id }}" {{ old('id_region', $destino->id_region) == $region->id ? 'selected' : '' }}>
                                    {{ $region->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Latitud (Opcional)</label>
                        <input type="number" step="0.000001" name="latitud" class="form-control" value="{{ old('latitud', $destino->latitud) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Longitud (Opcional)</label>
                        <input type="number" step="0.000001" name="longitud" class="form-control" value="{{ old('longitud', $destino->longitud) }}">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Descripción</label>
                    <textarea name="descripcion" class="form-control" rows="3">{{ old('descripcion', $destino->descripcion) }}</textarea>
                </div>

                {{-- Nuevos campos: Popularidad y Restricciones --}}
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Popularidad (1-10, Opcional)</label>
                        <input type="number" min="1" max="10" name="popularidad" class="form-control"
                               value="{{ old('popularidad', $destino->nivel_popularidad) }}">
                    </div>
                    <div class="col-md-8">
                        <label class="form-label fw-semibold">Restricciones (Opcional)</label>
                        <textarea name="restricciones" class="form-control" rows="2">{{ old('restricciones', $destino->restricciones) }}</textarea>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Foto del destino</label>

                    @if(!empty($destino->imagen))
                        <div class="mb-2">
                            <img src="{{ Storage::disk('s3')->temporaryUrl($destino->imagen, now()->addMinutes(30)) }}"
                                 alt="{{ $destino->nombre }}"
                                 class="img-fluid rounded border"
                                 style="max-height: 200px;">
                        </div>
                        <div class="form-text mb-2">Si subes una foto nueva, reemplazará a la actual.</div>
                    @endif

                    <input type="file" name="imagen" class="form-control" accept="image/jpeg,image/png,image/webp">
                    <div class="form-text">Formatos JPG, PNG o WEBP. Máximo 2 MB.</div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('destinos.index') }}" class="btn btn-light border">Cancelar</a>
                    <button type="submit" class="btn btn-primary" style="background-color: var(--color-primary);">
                        <i class="fa-solid fa-save me-1"></i> Actualizar Destino
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection