<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Procedimientos almacenados: combos.
 */
return new class extends Migration
{
    private array $procedimientos = [
        'sp_combo_tipos_destino',
        'sp_combo_paises',
        'sp_combo_regiones',
        'sp_combo_tipos_cliente',
        'sp_combo_metodos_pago',
        'sp_combo_guias',
        'sp_combo_paquetes',
        'sp_combo_clientes',
        'sp_combo_tipos_transporte',
        'sp_combo_categorias_alojamiento',
        'sp_combo_regimenes',
    ];

    public function up(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_combo_tipos_destino');
        DB::unprepared(<<<'SQL'
        CREATE PROCEDURE sp_combo_tipos_destino()
        BEGIN
            SELECT id_tipo_destino AS id, nombre FROM Tipo_Destino ORDER BY nombre;
        END
        SQL);

        DB::unprepared('DROP PROCEDURE IF EXISTS sp_combo_paises');
        DB::unprepared(<<<'SQL'
        CREATE PROCEDURE sp_combo_paises()
        BEGIN
            SELECT id_pais AS id, nombre FROM Pais ORDER BY nombre;
        END
        SQL);

        DB::unprepared('DROP PROCEDURE IF EXISTS sp_combo_regiones');
        DB::unprepared(<<<'SQL'
        CREATE PROCEDURE sp_combo_regiones()
        BEGIN
            SELECT id_region AS id, nombre FROM Region ORDER BY nombre;
        END
        SQL);

        DB::unprepared('DROP PROCEDURE IF EXISTS sp_combo_tipos_cliente');
        DB::unprepared(<<<'SQL'
        CREATE PROCEDURE sp_combo_tipos_cliente()
        BEGIN
            SELECT id_tipo_cliente AS id, nombre FROM Tipo_Cliente ORDER BY nombre;
        END
        SQL);

        DB::unprepared('DROP PROCEDURE IF EXISTS sp_combo_metodos_pago');
        DB::unprepared(<<<'SQL'
        CREATE PROCEDURE sp_combo_metodos_pago()
        BEGIN
            SELECT id_metodo_pago AS id, nombre FROM Metodo_Pago ORDER BY nombre;
        END
        SQL);

        DB::unprepared('DROP PROCEDURE IF EXISTS sp_combo_guias');
        DB::unprepared(<<<'SQL'
        CREATE PROCEDURE sp_combo_guias()
        BEGIN
            SELECT id_guia AS id, CONCAT(nombres, ' ', apellidos) AS nombre
            FROM Guia_Turistico ORDER BY nombres;
        END
        SQL);

        DB::unprepared('DROP PROCEDURE IF EXISTS sp_combo_paquetes');
        DB::unprepared(<<<'SQL'
        CREATE PROCEDURE sp_combo_paquetes()
        BEGIN
            SELECT id_paquete AS id, nombre_comercial AS nombre
            FROM Paquete_Turistico ORDER BY nombre_comercial;
        END
        SQL);

        DB::unprepared('DROP PROCEDURE IF EXISTS sp_combo_clientes');
        DB::unprepared(<<<'SQL'
        CREATE PROCEDURE sp_combo_clientes()
        BEGIN
            SELECT id_cliente AS id, nombres_razon_social AS nombre
            FROM Cliente ORDER BY nombres_razon_social;
        END
        SQL);

        DB::unprepared('DROP PROCEDURE IF EXISTS sp_combo_tipos_transporte');
        DB::unprepared(<<<'SQL'
        CREATE PROCEDURE sp_combo_tipos_transporte()
        BEGIN
            SELECT id_tipo_transporte AS id, nombre FROM Tipo_Transporte ORDER BY nombre;
        END
        SQL);

        DB::unprepared('DROP PROCEDURE IF EXISTS sp_combo_categorias_alojamiento');
        DB::unprepared(<<<'SQL'
        CREATE PROCEDURE sp_combo_categorias_alojamiento()
        BEGIN
            SELECT id_categoria_alojamiento AS id,
                   CONCAT(Estrellas, ' estrellas') AS nombre
            FROM Categoria_Alojamiento ORDER BY Estrellas;
        END
        SQL);

        DB::unprepared('DROP PROCEDURE IF EXISTS sp_combo_regimenes');
        DB::unprepared(<<<'SQL'
        CREATE PROCEDURE sp_combo_regimenes()
        BEGIN
            SELECT id_regimen AS id, nombre FROM Regimen_Alimenticio ORDER BY nombre;
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
