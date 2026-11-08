<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('Destino_Turistico', function (Blueprint $table) {
            $table->string('imagen', 255)->nullable()->after('restricciones');
        });

        DB::unprepared('DROP PROCEDURE IF EXISTS sp_destino_set_imagen');
        DB::unprepared(<<<'SQL'
        CREATE PROCEDURE sp_destino_set_imagen(
            IN p_id INT,
            IN p_imagen VARCHAR(255)
        )
        BEGIN
            UPDATE Destino_Turistico SET imagen = p_imagen WHERE id_destino = p_id;
            SELECT ROW_COUNT() AS filas_afectadas;
        END
        SQL);
    }

    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_destino_set_imagen');

        Schema::table('Destino_Turistico', function (Blueprint $table) {
            $table->dropColumn('imagen');
        });
    }
};