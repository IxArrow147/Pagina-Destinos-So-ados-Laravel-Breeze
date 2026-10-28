<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;
use App\Models\Cliente;
use App\Models\Paquete;
use Illuminate\Support\Facades\DB; // Para usar tus SPs

class ReservaController extends Controller
{
    // 1. Listar todas las reservas
    public function index()
    {
        // Usamos Eloquent y la relación que creamos para traer todo de una vez
        $reservas = Reserva::with(['cliente', 'paquete'])->orderBy('id_reserva', 'desc')->get();
        return view('reservas.index', compact('reservas'));
    }

    // 2. Mostrar formulario de creación
    public function create()
    {
        // Traemos los clientes y paquetes usando Eloquent para los <select>
        $clientes = Cliente::all();
        $paquetes = Paquete::all();
        return view('reservas.create', compact('clientes', 'paquetes'));
    }

    // 3. Guardar la reserva (¡AQUÍ ESTÁ LA LÓGICA DE NEGOCIO!)
    public function store(Request $request)
    {
        // Validación (10 puntos de la rúbrica)
        $request->validate([
            'numero_reserva' => 'required|unique:Reserva,numero_reserva',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'id_cliente' => 'required|exists:Cliente,id_cliente',
            'id_paquete' => 'required|exists:Paquete_Turistico,id_paquete',
            'precio_total' => 'required|numeric|min:0',
            'abonos_realizados' => 'required|numeric|min:0'
        ]);

        // LÓGICA DE NEGOCIO EN PHP: Calcular el saldo pendiente
        $saldo_pendiente = $request->precio_total - $request->abonos_realizados;

        // LÓGICA DE NEGOCIO EN PHP: Validar que el abono no sea mayor al precio
        if ($saldo_pendiente < 0) {
            return back()->withErrors(['abonos_realizados' => 'El abono no puede ser mayor al precio total.'])->withInput();
        }

        // Usamos tu Stored Procedure para insertar (Recuerda que tiene 13 parámetros)
        DB::statement('CALL sp_reserva_insert(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
            $request->numero_reserva,
            $request->fecha_inicio,
            $request->fecha_fin,
            $request->cantidad_adultos ?? 1,
            $request->cantidad_ninos ?? 0,
            $request->solicitudes_especiales ?? null,
            $request->precio_total,
            $request->abonos_realizados,
            'Confirmada', // Estado por defecto
            $request->id_cliente,
            1, // id_metodo_pago (puedes hacerlo dinámico después)
            $request->id_paquete,
            1  // id_guia (puedes hacerlo dinámico después)
        ]);

        return redirect()->route('reservas.index')->with('success', 'Reserva creada exitosamente.');
    }
    
    // 4. Mostrar formulario de edición
    public function edit($id)
    {
        // Buscamos la reserva usando Eloquent
        $reserva = Reserva::findOrFail($id);
        $clientes = Cliente::all();
        $paquetes = Paquete::all();
        
        return view('reservas.edit', compact('reserva', 'clientes', 'paquetes'));
    }

    // 5. Actualizar la reserva
    public function update(Request $request, $id)
    {
        // Validación
        $request->validate([
            'numero_reserva' => 'required|unique:Reserva,numero_reserva,'.$id.',id_reserva',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'id_cliente' => 'required|exists:Cliente,id_cliente',
            'id_paquete' => 'required|exists:Paquete_Turistico,id_paquete',
            'precio_total' => 'required|numeric|min:0',
            'abonos_realizados' => 'required|numeric|min:0'
        ]);

        // Lógica de negocio: Recalcular el saldo
        $saldo_pendiente = $request->precio_total - $request->abonos_realizados;

        if ($saldo_pendiente < 0) {
            return back()->withErrors(['abonos_realizados' => 'El abono no puede ser mayor al precio total.'])->withInput();
        }

        // Llamamos a tu Stored Procedure de actualización (tiene 14 parámetros)
        DB::statement('CALL sp_reserva_update(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
            $id, // Primer parámetro: el ID
            $request->numero_reserva,
            $request->fecha_inicio,
            $request->fecha_fin,
            $request->cantidad_adultos ?? 1,
            $request->cantidad_ninos ?? 0,
            $request->solicitudes_especiales ?? null,
            $request->precio_total,
            $request->abonos_realizados,
            'Confirmada', 
            $request->id_cliente,
            1, // id_metodo_pago
            $request->id_paquete,
            1  // id_guia
        ]);

        return redirect()->route('reservas.index')->with('success', 'Reserva actualizada exitosamente.');
    }

    // 6. Eliminar reserva
    public function destroy($id)
    {
        // Llamamos a tu Stored Procedure de eliminación
        DB::statement('CALL sp_reserva_delete(?)', [$id]);
        
        return redirect()->route('reservas.index')->with('success', 'Reserva eliminada exitosamente.');
    }
}