<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destino extends Model
{
    protected $table = 'Destino_Turistico';
    protected $primaryKey = 'id_destino';
    public $timestamps = false;

    protected $fillable = [
        'codigo', 'nombre', 'latitud', 'longitud', 'descripcion',
        'nivel_popularidad', 'restricciones', 'id_tipo_destino', 
        'id_pais', 'id_region'
    ];
}