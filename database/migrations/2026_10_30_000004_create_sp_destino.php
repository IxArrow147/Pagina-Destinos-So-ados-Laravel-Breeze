<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Procedimientos almacenados: destino.
 */
return new class extends Migration
{
    private array $procedimientos = [
        'sp_destino_insert',
        'sp_destino_update',
        'sp_destino_delete',
        'sp_destino_get_by_id',
        'sp_destino_get_all',
    ];

    public function up(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_destino_insert');
        DB::unprepared(<<<'SQL'
        CREATE PROCEDURE sp_destino_insert(
            IN p_codigo VARCHAR(20),
            IN p_nombre VARCHAR(150),
            IN p_latitud DECIMAL(9,6),
            IN p_longitud DECIMAL(9,6),
            IN p_descripcion TEXT,
            IN p_popularidad TINYINT,
            IN p_restricciones TEXT,
            IN p_id_tipo INT,
            IN p_id_pais INT,
            IN p_id_region INT
        )
        BEGIN
            INSERT INTO Destino_Turistico
            (codigo, nombre, latitud, longitud, descripcion, nivel_popularidad,
             restricciones, id_tipo_destino, id_pais, id_region)
            VALUES
            (p_codigo, p_nombre, p_latitud, p_longitud, p_descripcion, p_popularidad,
             p_restricciones, p_id_tipo, p_id_pais, p_id_region);
            SELECT LAST_INSERT_ID() AS id_generado;
        END
        SQL);

        DB::unprepared('DROP PROCEDURE IF EXISTS sp_destino_update');
        DB::unprepared(<<<'SQL'
        CREATE PROCEDURE sp_destino_update(
            IN p_id INT,
            IN p_codigo VARCHAR(20),
            IN p_nombre VARCHAR(150),
            IN p_latitud DECIMAL(9,6),
            IN p_longitud DECIMAL(9,6),
            IN p_descripcion TEXT,
            IN p_popularidad TINYINT,
            IN p_restricciones TEXT,
            IN p_id_tipo INT,
            IN p_id_pais INT,
            IN p_id_region INT
        )
        BEGIN
            UPDATE Destino_Turistico
            SET codigo = p_codigo,
                nombre = p_nombre,
                latitud = p_latitud,
                longitud = p_longitud,
                descripcion = p_descripcion,
                nivel_popularidad = p_popularidad,
                restricciones = p_restricciones,
                id_tipo_destino = p_id_tipo,
                id_pais = p_id_pais,
                id_region = p_id_region
            WHERE id_destino = p_id;
            SELECT ROW_COUNT() AS filas_afectadas;
        END
        SQL);

        DB::unprepared('DROP PROCEDURE IF EXISTS sp_destino_delete');
        DB::unprepared(<<<'SQL'
        CREATE PROCEDURE sp_destino_delete(
            IN p_id INT
        )
        BEGIN
            DELETE FROM Destino_Turistico WHERE id_destino = p_id;
            SELECT ROW_COUNT() AS filas_afectadas;
        END
        SQL);

        DB::unprepared('DROP PROCEDURE IF EXISTS sp_destino_get_by_id');
        DB::unprepared(<<<'SQL'
        CREATE PROCEDURE sp_destino_get_by_id(
            IN p_id INT
        )
        BEGIN
            SELECT d.*, 
                   td.nombre AS tipo_nombre,
                   p.nombre AS pais_nombre,
                   r.nombre AS region_nombre
            FROM Destino_Turistico d
            LEFT JOIN Tipo_Destino td ON d.id_tipo_destino = td.id_tipo_destino
            LEFT JOIN Pais p ON d.id_pais = p.id_pais
            LEFT JOIN Region r ON d.id_region = r.id_region
            WHERE d.id_destino = p_id;
        END
        SQL);

        DB::unprepared('DROP PROCEDURE IF EXISTS sp_destino_get_all');
        DB::unprepared(<<<'SQL'
        CREATE PROCEDURE sp_destino_get_all()
        BEGIN
            SELECT d.*, 
                   td.nombre AS tipo_nombre,
                   p.nombre AS pais_nombre,
                   r.nombre AS region_nombre
            FROM Destino_Turistico d
            LEFT JOIN Tipo_Destino td ON d.id_tipo_destino = td.id_tipo_destino
            LEFT JOIN Pais p ON d.id_pais = p.id_pais
            LEFT JOIN Region r ON d.id_region = r.id_region
            ORDER BY d.id_destino DESC;
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
