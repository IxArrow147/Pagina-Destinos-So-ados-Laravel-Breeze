<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Procedimientos almacenados: paquete.
 */
return new class extends Migration
{
    private array $procedimientos = [
        'sp_paquete_insert',
        'sp_paquete_update',
        'sp_paquete_delete',
        'sp_paquete_get_by_id',
        'sp_paquete_get_all',
    ];

    public function up(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_paquete_insert');
        DB::unprepared(<<<'SQL'
        CREATE PROCEDURE sp_paquete_insert(
            IN p_codigo VARCHAR(20),
            IN p_nombre VARCHAR(150),
            IN p_dias TINYINT,
            IN p_noches TINYINT,
            IN p_precio DECIMAL(10,2),
            IN p_min_participantes SMALLINT,
            IN p_dificultad TINYINT,
            IN p_id_transporte INT,
            IN p_id_categoria INT,
            IN p_id_regimen INT
        )
        BEGIN
            INSERT INTO Paquete_Turistico
            (codigo, nombre_comercial, duracion_dias, duracion_noches, precio_base,
             minimo_participantes, nivel_dificultad, id_tipo_transporte,
             id_categoria_alojamiento, id_regimen)
            VALUES
            (p_codigo, p_nombre, p_dias, p_noches, p_precio,
             p_min_participantes, p_dificultad, p_id_transporte,
             p_id_categoria, p_id_regimen);
            SELECT LAST_INSERT_ID() AS id_generado;
        END
        SQL);

        DB::unprepared('DROP PROCEDURE IF EXISTS sp_paquete_update');
        DB::unprepared(<<<'SQL'
        CREATE PROCEDURE sp_paquete_update(
            IN p_id INT,
            IN p_codigo VARCHAR(20),
            IN p_nombre VARCHAR(150),
            IN p_dias TINYINT,
            IN p_noches TINYINT,
            IN p_precio DECIMAL(10,2),
            IN p_min_participantes SMALLINT,
            IN p_dificultad TINYINT,
            IN p_id_transporte INT,
            IN p_id_categoria INT,
            IN p_id_regimen INT
        )
        BEGIN
            UPDATE Paquete_Turistico
            SET codigo = p_codigo,
                nombre_comercial = p_nombre,
                duracion_dias = p_dias,
                duracion_noches = p_noches,
                precio_base = p_precio,
                minimo_participantes = p_min_participantes,
                nivel_dificultad = p_dificultad,
                id_tipo_transporte = p_id_transporte,
                id_categoria_alojamiento = p_id_categoria,
                id_regimen = p_id_regimen
            WHERE id_paquete = p_id;
            SELECT ROW_COUNT() AS filas_afectadas;
        END
        SQL);

        DB::unprepared('DROP PROCEDURE IF EXISTS sp_paquete_delete');
        DB::unprepared(<<<'SQL'
        CREATE PROCEDURE sp_paquete_delete(
            IN p_id INT
        )
        BEGIN
            DELETE FROM Paquete_Turistico WHERE id_paquete = p_id;
            SELECT ROW_COUNT() AS filas_afectadas;
        END
        SQL);

        DB::unprepared('DROP PROCEDURE IF EXISTS sp_paquete_get_by_id');
        DB::unprepared(<<<'SQL'
        CREATE PROCEDURE sp_paquete_get_by_id(
            IN p_id INT
        )
        BEGIN
            SELECT p.*,
                   tt.nombre AS transporte_nombre,
                   ca.Estrellas AS categoria_estrellas,
                   ra.nombre AS regimen_nombre
            FROM Paquete_Turistico p
            LEFT JOIN Tipo_Transporte tt ON p.id_tipo_transporte = tt.id_tipo_transporte
            LEFT JOIN Categoria_Alojamiento ca ON p.id_categoria_alojamiento = ca.id_categoria_alojamiento
            LEFT JOIN Regimen_Alimenticio ra ON p.id_regimen = ra.id_regimen
            WHERE p.id_paquete = p_id;
        END
        SQL);

        DB::unprepared('DROP PROCEDURE IF EXISTS sp_paquete_get_all');
        DB::unprepared(<<<'SQL'
        CREATE PROCEDURE sp_paquete_get_all()
        BEGIN
            SELECT p.*,
                   tt.nombre AS transporte_nombre,
                   ca.Estrellas AS categoria_estrellas,
                   ra.nombre AS regimen_nombre
            FROM Paquete_Turistico p
            LEFT JOIN Tipo_Transporte tt ON p.id_tipo_transporte = tt.id_tipo_transporte
            LEFT JOIN Categoria_Alojamiento ca ON p.id_categoria_alojamiento = ca.id_categoria_alojamiento
            LEFT JOIN Regimen_Alimenticio ra ON p.id_regimen = ra.id_regimen
            ORDER BY p.id_paquete DESC;
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
