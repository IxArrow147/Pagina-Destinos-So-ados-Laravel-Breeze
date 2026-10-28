<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Resumen del Sistema (Eloquent)</h3>
                
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-blue-100 p-4 rounded">
                        <p class="text-gray-600">Total Clientes:</p>
                        <p class="text-3xl font-bold">{{ $totalClientes }}</p>
                    </div>
                    <div class="bg-green-100 p-4 rounded">
                        <p class="text-gray-600">Total Reservas:</p>
                        <p class="text-3xl font-bold">{{ $totalReservas }}</p>
                    </div>
                </div>

                <h4 class="text-md font-bold mt-6 mb-2">Últimas 5 Reservas (Relación Eloquent)</h4>
                <ul class="list-disc pl-5">
                    @foreach($ultimasReservas as $reserva)
                        <li>
                            Reserva {{ $reserva->numero_reserva }} - 
                            Cliente: <strong>{{ $reserva->cliente->nombres_razon_social ?? 'Sin cliente' }}</strong>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>