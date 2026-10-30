<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Procedimientos almacenados: cliente.
 */
return new class extends Migration
{
    private array $procedimientos = [
        'sp_cliente_insert',
        'sp_cliente_update',
        'sp_cliente_delete',
        'sp_cliente_get_by_id',
        'sp_cliente_get_all',
    ];

    public function up(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_cliente_insert');
        DB::unprepared(<<<'SQL'
        CREATE PROCEDURE sp_cliente_insert(
            IN p_codigo VARCHAR(20),
            IN p_nombres VARCHAR(200),
            IN p_documento VARCHAR(30),
            IN p_nacionalidad VARCHAR(100),
            IN p_direccion VARCHAR(200),
            IN p_telefono VARCHAR(10),
            IN p_correo VARCHAR(150),
            IN p_fidelizacion VARCHAR(100),
            IN p_id_tipo_cliente INT
        )
        BEGIN
            INSERT INTO Cliente
            (codigo, nombres_razon_social, documento, nacionalidad, direccion,
             telefono, correo, programa_fidelizacion, id_tipo_cliente)
            VALUES
            (p_codigo, p_nombres, p_documento, p_nacionalidad, p_direccion,
             p_telefono, p_correo, p_fidelizacion, p_id_tipo_cliente);
            SELECT LAST_INSERT_ID() AS id_generado;
        END
        SQL);

        DB::unprepared('DROP PROCEDURE IF EXISTS sp_cliente_update');
        DB::unprepared(<<<'SQL'
        CREATE PROCEDURE sp_cliente_update(
            IN p_id INT,
            IN p_codigo VARCHAR(20),
            IN p_nombres VARCHAR(200),
            IN p_documento VARCHAR(30),
            IN p_nacionalidad VARCHAR(100),
            IN p_direccion VARCHAR(200),
            IN p_telefono VARCHAR(10),
            IN p_correo VARCHAR(150),
            IN p_fidelizacion VARCHAR(100),
            IN p_id_tipo_cliente INT
        )
        BEGIN
            UPDATE Cliente
            SET codigo = p_codigo,
                nombres_razon_social = p_nombres,
                documento = p_documento,
                nacionalidad = p_nacionalidad,
                direccion = p_direccion,
                telefono = p_telefono,
                correo = p_correo,
                programa_fidelizacion = p_fidelizacion,
                id_tipo_cliente = p_id_tipo_cliente
            WHERE id_cliente = p_id;
            SELECT ROW_COUNT() AS filas_afectadas;
        END
        SQL);

        DB::unprepared('DROP PROCEDURE IF EXISTS sp_cliente_delete');
        DB::unprepared(<<<'SQL'
        CREATE PROCEDURE sp_cliente_delete(
            IN p_id INT
        )
        BEGIN
            DELETE FROM Cliente WHERE id_cliente = p_id;
            SELECT ROW_COUNT() AS filas_afectadas;
        END
        SQL);

        DB::unprepared('DROP PROCEDURE IF EXISTS sp_cliente_get_by_id');
        DB::unprepared(<<<'SQL'
        CREATE PROCEDURE sp_cliente_get_by_id(
            IN p_id INT
        )
        BEGIN
            SELECT c.*, tc.nombre AS tipo_cliente_nombre
            FROM Cliente c
            LEFT JOIN Tipo_Cliente tc ON c.id_tipo_cliente = tc.id_tipo_cliente
            WHERE c.id_cliente = p_id;
        END
        SQL);

        DB::unprepared('DROP PROCEDURE IF EXISTS sp_cliente_get_all');
        DB::unprepared(<<<'SQL'
        CREATE PROCEDURE sp_cliente_get_all()
        BEGIN
            SELECT c.*, tc.nombre AS tipo_cliente_nombre
            FROM Cliente c
            LEFT JOIN Tipo_Cliente tc ON c.id_tipo_cliente = tc.id_tipo_cliente
            ORDER BY c.id_cliente DESC;
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
