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
            <form action="{{ route('destinos.update', $destino->id_destino) }}" method="POST">
                @csrf
                @method('PUT') <!-- Importante para que Laravel sepa que es una actualización -->
                
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Código</label>
                        <input type="text" name="codigo" class="form-control" value="{{ $destino->codigo }}" required>
                    </div>
                    <div class="col-md-8">
                        <label class="form-label fw-semibold">Nombre del Destino</label>
                        <input type="text" name="nombre" class="form-control" value="{{ $destino->nombre }}" required>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Tipo de Destino</label>
                        <select name="id_tipo" class="form-select" required>
                            @foreach($tipos as $tipo)
                                <option value="{{ $tipo->id }}" {{ $destino->id_tipo_destino == $tipo->id ? 'selected' : '' }}>
                                    {{ $tipo->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">País</label>
                        <select name="id_pais" class="form-select" required>
                            @foreach($paises as $pais)
                                <option value="{{ $pais->id }}" {{ $destino->id_pais == $pais->id ? 'selected' : '' }}>
                                    {{ $pais->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Región</label>
                        <select name="id_region" class="form-select" required>
                            @foreach($regiones as $region)
                                <option value="{{ $region->id }}" {{ $destino->id_region == $region->id ? 'selected' : '' }}>
                                    {{ $region->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Latitud (Opcional)</label>
                        <input type="number" step="0.000001" name="latitud" class="form-control" value="{{ $destino->latitud }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Longitud (Opcional)</label>
                        <input type="number" step="0.000001" name="longitud" class="form-control" value="{{ $destino->longitud }}">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Descripción</label>
                    <textarea name="descripcion" class="form-control" rows="3">{{ $destino->descripcion }}</textarea>
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