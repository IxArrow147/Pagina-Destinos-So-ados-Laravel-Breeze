@extends('layouts.panel')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 mt-2">
        <h2 class="fw-bold" style="color: var(--color-text);">Gestión de Reservas</h2>
        <a href="{{ route('reservas.create') }}" class="btn btn-primary" style="background-color: var(--color-primary); border:none;">
            <i class="fa-solid fa-plus me-1"></i> Nueva Reserva
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa-solid fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0" style="border-radius: var(--radius-lg);">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead style="background-color: var(--color-primary-light);">
                        <tr>
                            <th class="py-3 px-4">N° Reserva</th>
                            <th class="py-3 px-4">Cliente</th>
                            <th class="py-3 px-4">Paquete</th>
                            <th class="py-3 px-4">Fechas</th>
                            <th class="py-3 px-4">Estado</th>
                            <th class="py-3 px-4 text-end">Total / Saldo</th>
                            <th class="py-3 px-4 text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reservas as $reserva)
                        <tr>
                            <td class="py-3 px-4 align-middle fw-bold">{{ $reserva->numero_reserva }}</td>
                            <td class="py-3 px-4 align-middle">
                                {{ $reserva->cliente->nombres_razon_social ?? 'Cliente eliminado' }}
                            </td>
                            <td class="py-3 px-4 align-middle">
                                {{ $reserva->paquete->nombre_comercial ?? 'Paquete eliminado' }}
                            </td>
                            <td class="py-3 px-4 align-middle">
                                <small class="text-muted d-block">Inicio: {{ $reserva->fecha_inicio }}</small>
                                <small class="text-muted d-block">Fin: {{ $reserva->fecha_fin }}</small>
                            </td>
                            <td class="py-3 px-4 align-middle">
                                @if($reserva->estado == 'Confirmada')
                                    <span class="badge bg-success">Confirmada</span>
                                @else
                                    <span class="badge bg-warning text-dark">{{ $reserva->estado }}</span>
                                @endif
                            </td>
                            <td class="py-3 px-4 align-middle text-end">
                                <span class="d-block fw-semibold">${{ number_format($reserva->precio_total, 2) }}</span>
                                <small class="text-danger">Saldo: ${{ number_format($reserva->saldo_pendiente, 2) }}</small>
                            </td>
                            <td class="py-3 px-4 align-middle text-end">
                                <a href="{{ route('reservas.edit', $reserva->id_reserva) }}" class="btn btn-sm btn-warning">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <form action="{{ route('reservas.destroy', $reserva->id_reserva) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar esta reserva?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="fa-solid fa-calendar-xmark fs-1 mb-3 d-block"></i>
                                No hay reservas registradas aún.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection