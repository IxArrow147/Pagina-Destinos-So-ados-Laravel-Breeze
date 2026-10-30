@extends('layouts.panel')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 mt-2">
        <h2 class="fw-bold" style="color: var(--color-text);">Crear Nuevo Destino</h2>
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
            <form action="{{ route('destinos.store') }}" method="POST">
                @csrf
                
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Código</label>
                        <input type="text" name="codigo" class="form-control" value="{{ old('codigo') }}" required>
                    </div>
                    <div class="col-md-8">
                        <label class="form-label fw-semibold">Nombre del Destino</label>
                        <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Tipo de Destino</label>
                        <select name="id_tipo" class="form-select" required>
                            <option value="">Seleccione...</option>
                            @foreach($tipos as $tipo)
                                <option value="{{ $tipo->id }}" {{ old('id_tipo') == $tipo->id ? 'selected' : '' }}>
                                    {{ $tipo->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">País</label>
                        <select name="id_pais" class="form-select" required>
                            <option value="">Seleccione...</option>
                            @foreach($paises as $pais)
                                <option value="{{ $pais->id }}" {{ old('id_pais') == $pais->id ? 'selected' : '' }}>
                                    {{ $pais->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Región</label>
                        <select name="id_region" class="form-select" required>
                            <option value="">Seleccione...</option>
                            @foreach($regiones as $region)
                                <option value="{{ $region->id }}" {{ old('id_region') == $region->id ? 'selected' : '' }}>
                                    {{ $region->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Latitud (Opcional)</label>
                        <input type="number" step="0.000001" name="latitud" class="form-control" value="{{ old('latitud') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Longitud (Opcional)</label>
                        <input type="number" step="0.000001" name="longitud" class="form-control" value="{{ old('longitud') }}">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Descripción</label>
                    <textarea name="descripcion" class="form-control" rows="3">{{ old('descripcion') }}</textarea>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('destinos.index') }}" class="btn btn-light border">Cancelar</a>
                    <button type="submit" class="btn btn-primary" style="background-color: var(--color-primary);">
                        <i class="fa-solid fa-save me-1"></i> Guardar Destino
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection