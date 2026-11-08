<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Importante para los SP
use Illuminate\Support\Facades\Storage;

class DestinoController extends Controller
{
    // 1. Listar todos los destinos
    public function index()
    {
        // Llamamos a tu SP que ya hace el JOIN con Pais, Region y Tipo
        $destinos = DB::select('CALL sp_destino_get_all()');
        return view('destinos.index', compact('destinos'));
    }

    // 2. Mostrar formulario de creación
    public function create()
    {
        // Llamamos a tus SP de combos para llenar los selects
        $tipos = DB::select('CALL sp_combo_tipos_destino()');
        $paises = DB::select('CALL sp_combo_paises()');
        $regiones = DB::select('CALL sp_combo_regiones()');

        return view('destinos.create', compact('tipos', 'paises', 'regiones'));
    }

    // 3. Guardar en BD (Usando tu SP de inserción)
    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|unique:Destino_Turistico,codigo',
            'nombre' => 'required',
            'id_tipo' => 'required',
            'id_pais' => 'required',
            'id_region' => 'required',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'popularidad' => 'nullable|integer|between:1,10',
        ]);

        $resultado = DB::select('CALL sp_destino_insert(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
            $request->codigo,
            $request->nombre,
            $request->latitud ?? null,
            $request->longitud ?? null,
            $request->descripcion ?? null,
            $request->popularidad ?? null,
            $request->restricciones ?? null,
            $request->id_tipo,
            $request->id_pais,
            $request->id_region
        ]);

        if ($request->hasFile('imagen')) {
            $ruta = $request->file('imagen')->store('destinos', 's3');
            DB::statement('CALL sp_destino_set_imagen(?, ?)', [$resultado[0]->id_generado, $ruta]);
        }

        return redirect()->route('destinos.index')->with('success', 'Destino creado exitosamente.');
    }

    // 4. Mostrar formulario de edición
    public function edit($id)
    {
        // Usamos el SP de get_by_id
        $destinoArray = DB::select('CALL sp_destino_get_by_id(?)', [$id]);

        // Si no existe, error 404
        if (empty($destinoArray)) {
            abort(404);
        }

        $destino = $destinoArray[0]; // El SP devuelve un array, tomamos el primero

        // Cargamos los combos de nuevo
        $tipos = DB::select('CALL sp_combo_tipos_destino()');
        $paises = DB::select('CALL sp_combo_paises()');
        $regiones = DB::select('CALL sp_combo_regiones()');

        return view('destinos.edit', compact('destino', 'tipos', 'paises', 'regiones'));
    }

    // 5. Actualizar (Usando tu SP de update)
    public function update(Request $request, $id)
    {
        $request->validate([
            'codigo' => 'required',
            'nombre' => 'required',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'popularidad' => 'nullable|integer|between:1,10',
        ]);

        DB::statement('CALL sp_destino_update(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
            $id, // El primer parámetro es el ID
            $request->codigo,
            $request->nombre,
            $request->latitud ?? null,
            $request->longitud ?? null,
            $request->descripcion ?? null,
            $request->popularidad ?? null,
            $request->restricciones ?? null,
            $request->id_tipo,
            $request->id_pais,
            $request->id_region
        ]);

        if ($request->hasFile('imagen')) {
            // Guardamos la ruta de la foto anterior para borrarla del bucket
            $anterior = (DB::select('CALL sp_destino_get_by_id(?)', [$id])[0] ?? null)?->imagen;

            $ruta = $request->file('imagen')->store('destinos', 's3');
            DB::statement('CALL sp_destino_set_imagen(?, ?)', [$id, $ruta]);

            if ($anterior) {
                Storage::disk('s3')->delete($anterior);
            }
        }

        return redirect()->route('destinos.index')->with('success', 'Destino actualizado.');
    }

    // 6. Eliminar (Usando tu SP de delete)
    public function destroy($id)
    {
        $destino = DB::select('CALL sp_destino_get_by_id(?)', [$id])[0] ?? null;

        DB::statement('CALL sp_destino_delete(?)', [$id]);

        // Se borra la foto después del DELETE: si este falla por una llave
        // foránea, la imagen no se pierde.
        if ($destino && !empty($destino->imagen)) {
            Storage::disk('s3')->delete($destino->imagen);
        }

        return redirect()->route('destinos.index')->with('success', 'Destino eliminado.');
    }
}