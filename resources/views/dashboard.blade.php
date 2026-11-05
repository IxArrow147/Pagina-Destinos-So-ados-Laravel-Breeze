@extends('layouts.panel')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 mt-2">
        <h2 class="fw-bold" style="color: var(--color-text);">Bienvenido, {{ Auth::user()->name }}</h2>
    </div>

    <div class="card shadow-sm border-0" style="border-radius: var(--radius-lg);">
        <div class="card-body p-4 text-center">
            <i class="fa-solid fa-gauge-high fs-1 mb-3" style="color: var(--color-primary);"></i>
            <h4 class="fw-bold">Panel de Administración TourSystem</h4>
            <p class="text-muted">Selecciona una opción del menú superior para comenzar a gestionar el sistema.</p>
            
            <div class="row mt-4 justify-content-center">
                <div class="col-md-4">
                    <a href="{{ route('destinos.index') }}" class="btn btn-outline-primary w-100 py-3 mb-2" style="color: var(--color-primary); border-color: var(--color-primary);">
                        <i class="fa-solid fa-map-location-dot fs-3 d-block mb-2"></i>
                        Gestionar Destinos
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('reservas.index') }}" class="btn btn-outline-primary w-100 py-3 mb-2" style="color: var(--color-primary); border-color: var(--color-primary);">
                        <i class="fa-solid fa-calendar-check fs-3 d-block mb-2"></i>
                        Gestionar Reservas
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection