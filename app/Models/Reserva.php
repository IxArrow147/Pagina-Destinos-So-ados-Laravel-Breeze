<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $table = 'Reserva';
    protected $primaryKey = 'id_reserva';
    public $timestamps = false;

    protected $fillable = [
        'numero_reserva', 'fecha_creacion', 'fecha_inicio', 'fecha_fin',
        'cantidad_adultos', 'cantidad_ninos', 'solicitudes_especiales',
        'precio_total', 'abonos_realizados', 'saldo_pendiente', 'estado',
        'id_cliente', 'id_metodo_pago', 'id_paquete', 'id_guia'
    ];

    // Relación: Una reserva pertenece a un cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }

    // Relación: Una reserva pertenece a un paquete
    public function paquete()
    {
        return $this->belongsTo(Paquete::class, 'id_paquete', 'id_paquete');
    }
}