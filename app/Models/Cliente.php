<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'Cliente';
    protected $primaryKey = 'id_cliente';
    public $timestamps = false;

    protected $fillable = [
        'codigo', 'nombres_razon_social', 'documento', 'nacionalidad', 
        'direccion', 'telefono', 'correo', 'programa_fidelizacion', 'id_tipo_cliente'
    ];

    // Relación: Un cliente tiene muchas reservas
    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'id_cliente', 'id_cliente');
    }
}