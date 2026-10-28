@extends('layouts.panel')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 mt-2">
        <h2 class="fw-bold" style="color: var(--color-text);">Nueva Reserva</h2>
        <a href="{{ route('reservas.index') }}" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i> Volver al listado
        </a>
    </div>

    <!-- Mostrar errores de validación -->
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
            <form action="{{ route('reservas.store') }}" method="POST" id="formReserva">
                @csrf
                
                <h5 class="mb-3 text-primary border-bottom pb-2">Información Básica</h5>
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Número de Reserva</label>
                        <input type="text" name="numero_reserva" class="form-control" value="{{ old('numero_reserva', 'RES-' . rand(1000, 9999)) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Fecha de Inicio</label>
                        <input type="date" name="fecha_inicio" class="form-control" value="{{ old('fecha_inicio') }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Fecha de Fin</label>
                        <input type="date" name="fecha_fin" class="form-control" value="{{ old('fecha_fin') }}" required>
                    </div>
                </div>

                <h5 class="mb-3 text-primary border-bottom pb-2">Detalles del Viaje</h5>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Cliente</label>
                        <select name="id_cliente" class="form-select" required>
                            <option value="">Seleccione un cliente...</option>
                            @foreach($clientes as $cliente)
                                <option value="{{ $cliente->id_cliente }}" {{ old('id_cliente') == $cliente->id_cliente ? 'selected' : '' }}>
                                    {{ $cliente->nombres_razon_social }} ({{ $cliente->documento }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Paquete Turístico</label>
                        <select name="id_paquete" class="form-select" required>
                            <option value="">Seleccione un paquete...</option>
                            @foreach($paquetes as $paquete)
                                <option value="{{ $paquete->id_paquete }}" {{ old('id_paquete') == $paquete->id_paquete ? 'selected' : '' }}>
                                    {{ $paquete->nombre_comercial }} - ${{ number_format($paquete->precio_base, 2) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Cant. Adultos</label>
                        <input type="number" name="cantidad_adultos" class="form-control" value="{{ old('cantidad_adultos', 1) }}" min="1" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Cant. Niños</label>
                        <input type="number" name="cantidad_ninos" class="form-control" value="{{ old('cantidad_ninos', 0) }}" min="0" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Solicitudes Especiales (Opcional)</label>
                        <input type="text" name="solicitudes_especiales" class="form-control" value="{{ old('solicitudes_especiales') }}" placeholder="Ej: Habitación familiar">
                    </div>
                </div>

                <h5 class="mb-3 text-primary border-bottom pb-2">Información Financiera</h5>
                <div class="row mb-4 bg-light p-3 rounded mx-1">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Precio Total ($)</label>
                        <input type="number" step="0.01" name="precio_total" id="precio_total" class="form-control" value="{{ old('precio_total') }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Abonos Realizados ($)</label>
                        <input type="number" step="0.01" name="abonos_realizados" id="abonos_realizados" class="form-control" value="{{ old('abonos_realizados', 0) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Saldo Pendiente ($)</label>
                        <!-- Este campo es solo visual, el controlador lo calcula de nuevo por seguridad -->
                        <input type="text" id="saldo_pendiente_visual" class="form-control bg-secondary text-white fw-bold" readonly value="0.00">
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('reservas.index') }}" class="btn btn-light border">Cancelar</a>
                    <button type="submit" class="btn btn-primary" style="background-color: var(--color-primary);">
                        <i class="fa-solid fa-save me-1"></i> Guardar Reserva
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script para calcular el saldo en tiempo real -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const precioInput = document.getElementById('precio_total');
            const abonoInput = document.getElementById('abonos_realizados');
            const saldoInput = document.getElementById('saldo_pendiente_visual');

            function calcularSaldo() {
                const precio = parseFloat(precioInput.value) || 0;
                const abono = parseFloat(abonoInput.value) || 0;
                const saldo = precio - abono;
                
                saldoInput.value = saldo.toFixed(2);
                
                // Si el saldo es negativo, ponemos el texto en rojo
                if (saldo < 0) {
                    saldoInput.classList.remove('bg-secondary');
                    saldoInput.classList.add('bg-danger');
                } else {
                    saldoInput.classList.remove('bg-danger');
                    saldoInput.classList.add('bg-secondary');
                }
            }

            precioInput.addEventListener('input', calcularSaldo);
            abonoInput.addEventListener('input', calcularSaldo);
        });
    </script>
@endsection