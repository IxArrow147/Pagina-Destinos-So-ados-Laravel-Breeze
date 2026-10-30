<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Procedimientos almacenados: reserva.
 */
return new class extends Migration
{
    private array $procedimientos = [
        'sp_reserva_insert',
        'sp_reserva_update',
        'sp_reserva_delete',
        'sp_reserva_get_by_id',
        'sp_reserva_get_all',
    ];

    public function up(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_reserva_insert');
        DB::unprepared(<<<'SQL'
        CREATE PROCEDURE sp_reserva_insert(
            IN p_numero VARCHAR(20),
            IN p_fecha_inicio DATE,
            IN p_fecha_fin DATE,
            IN p_adultos SMALLINT,
            IN p_ninos SMALLINT,
            IN p_solicitudes TEXT,
            IN p_precio DECIMAL(10,2),
            IN p_abonos DECIMAL(10,2),
            IN p_estado VARCHAR(50),
            IN p_id_cliente INT,
            IN p_id_metodo INT,
            IN p_id_paquete INT,
            IN p_id_guia INT
        )
        BEGIN
            INSERT INTO Reserva
            (numero_reserva, fecha_creacion, fecha_inicio, fecha_fin,
             cantidad_adultos, cantidad_ninos, solicitudes_especiales,
             precio_total, abonos_realizados, saldo_pendiente, estado,
             id_cliente, id_metodo_pago, id_paquete, id_guia)
            VALUES
            (p_numero, NOW(), p_fecha_inicio, p_fecha_fin,
             p_adultos, p_ninos, p_solicitudes,
             p_precio, p_abonos, (p_precio - p_abonos), p_estado,
             p_id_cliente, p_id_metodo, p_id_paquete, p_id_guia);
            SELECT LAST_INSERT_ID() AS id_generado;
        END
        SQL);

        DB::unprepared('DROP PROCEDURE IF EXISTS sp_reserva_update');
        DB::unprepared(<<<'SQL'
        CREATE PROCEDURE sp_reserva_update(
            IN p_id INT,
            IN p_numero VARCHAR(20),
            IN p_fecha_inicio DATE,
            IN p_fecha_fin DATE,
            IN p_adultos SMALLINT,
            IN p_ninos SMALLINT,
            IN p_solicitudes TEXT,
            IN p_precio DECIMAL(10,2),
            IN p_abonos DECIMAL(10,2),
            IN p_estado VARCHAR(50),
            IN p_id_cliente INT,
            IN p_id_metodo INT,
            IN p_id_paquete INT,
            IN p_id_guia INT
        )
        BEGIN
            UPDATE Reserva
            SET numero_reserva = p_numero,
                fecha_inicio = p_fecha_inicio,
                fecha_fin = p_fecha_fin,
                cantidad_adultos = p_adultos,
                cantidad_ninos = p_ninos,
                solicitudes_especiales = p_solicitudes,
                precio_total = p_precio,
                abonos_realizados = p_abonos,
                saldo_pendiente = (p_precio - p_abonos),
                estado = p_estado,
                id_cliente = p_id_cliente,
                id_metodo_pago = p_id_metodo,
                id_paquete = p_id_paquete,
                id_guia = p_id_guia
            WHERE id_reserva = p_id;
            SELECT ROW_COUNT() AS filas_afectadas;
        END
        SQL);

        DB::unprepared('DROP PROCEDURE IF EXISTS sp_reserva_delete');
        DB::unprepared(<<<'SQL'
        CREATE PROCEDURE sp_reserva_delete(
            IN p_id INT
        )
        BEGIN
            DELETE FROM Reserva WHERE id_reserva = p_id;
            SELECT ROW_COUNT() AS filas_afectadas;
        END
        SQL);

        DB::unprepared('DROP PROCEDURE IF EXISTS sp_reserva_get_by_id');
        DB::unprepared(<<<'SQL'
        CREATE PROCEDURE sp_reserva_get_by_id(
            IN p_id INT
        )
        BEGIN
            SELECT r.*,
                   c.nombres_razon_social AS cliente_nombre,
                   p.nombre_comercial AS paquete_nombre,
                   g.nombres AS guia_nombres, g.apellidos AS guia_apellidos,
                   mp.nombre AS metodo_pago_nombre
            FROM Reserva r
            LEFT JOIN Cliente c ON r.id_cliente = c.id_cliente
            LEFT JOIN Paquete_Turistico p ON r.id_paquete = p.id_paquete
            LEFT JOIN Guia_Turistico g ON r.id_guia = g.id_guia
            LEFT JOIN Metodo_Pago mp ON r.id_metodo_pago = mp.id_metodo_pago
            WHERE r.id_reserva = p_id;
        END
        SQL);

        DB::unprepared('DROP PROCEDURE IF EXISTS sp_reserva_get_all');
        DB::unprepared(<<<'SQL'
        CREATE PROCEDURE sp_reserva_get_all()
        BEGIN
            SELECT r.*,
                   c.nombres_razon_social AS cliente_nombre,
                   p.nombre_comercial AS paquete_nombre,
                   g.nombres AS guia_nombres, g.apellidos AS guia_apellidos,
                   mp.nombre AS metodo_pago_nombre
            FROM Reserva r
            LEFT JOIN Cliente c ON r.id_cliente = c.id_cliente
            LEFT JOIN Paquete_Turistico p ON r.id_paquete = p.id_paquete
            LEFT JOIN Guia_Turistico g ON r.id_guia = g.id_guia
            LEFT JOIN Metodo_Pago mp ON r.id_metodo_pago = mp.id_metodo_pago
            ORDER BY r.id_reserva DESC;
        END
        SQL);
    }

    public function down(): void
    {
        foreach ($this->procedimientos as $nombre) {
            DB::unprepared("DROP PROCEDURE IF EXISTS {$nombre}");
        }
    }
};
