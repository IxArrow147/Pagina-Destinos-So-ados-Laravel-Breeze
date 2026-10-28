<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paquete extends Model
{
    protected $table = 'Paquete_Turistico';
    protected $primaryKey = 'id_paquete';
    public $timestamps = false;

    protected $fillable = [
        'codigo', 'nombre_comercial', 'duracion_dias', 'duracion_noches',
        'precio_base', 'minimo_participantes', 'nivel_dificultad',
        'id_tipo_transporte', 'id_categoria_alojamiento', 'id_regimen'
    ];

    // Relación: Un paquete tiene muchas reservas
    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'id_paquete', 'id_paquete');
    }
}