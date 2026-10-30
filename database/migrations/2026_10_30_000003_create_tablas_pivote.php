<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tablas pivote / relaciones muchos-a-muchos.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Destino_Fotografia', function (Blueprint $table) {
            $table->increments('id_foto');
            $table->unsignedInteger('id_destino');
            $table->string('url', 255)->nullable();

            $table->foreign('id_destino', 'fk_foto_destino')->references('id_destino')->on('Destino_Turistico');
        });

        Schema::create('Destino_Temporada', function (Blueprint $table) {
            $table->increments('id_destino_temporada');
            $table->unsignedInteger('id_destino');
            $table->unsignedInteger('id_temporada');

            $table->foreign('id_destino', 'fk_dt_destino')->references('id_destino')->on('Destino_Turistico');
            $table->foreign('id_temporada', 'fk_dt_temporada')->references('id_temporada')->on('Temporada');
        });

        Schema::create('Paquete_Destino', function (Blueprint $table) {
            $table->increments('id_paquete_destino');
            $table->unsignedInteger('id_paquete');
            $table->unsignedInteger('id_destino');

            $table->foreign('id_paquete', 'fk_pd_paquete')->references('id_paquete')->on('Paquete_Turistico');
            $table->foreign('id_destino', 'fk_pd_destino')->references('id_destino')->on('Destino_Turistico');
        });

        Schema::create('Paquete_Actividad_Incluida', function (Blueprint $table) {
            $table->increments('id_paquete_act_inc');
            $table->unsignedInteger('id_paquete');
            $table->unsignedInteger('id_actividad');

            $table->foreign('id_paquete', 'fk_pai_paquete')->references('id_paquete')->on('Paquete_Turistico');
            $table->foreign('id_actividad', 'fk_pai_actividad')->references('id_actividad')->on('Actividad_Turistica');
        });

        Schema::create('Paquete_Actividad_Opcional', function (Blueprint $table) {
            $table->increments('id_paquete_act_opc');
            $table->unsignedInteger('id_paquete');
            $table->unsignedInteger('id_actividad');

            $table->foreign('id_paquete', 'fk_pao_paquete')->references('id_paquete')->on('Paquete_Turistico');
            $table->foreign('id_actividad', 'fk_pao_actividad')->references('id_actividad')->on('Actividad_Turistica');
        });

        Schema::create('Alojamiento_Servicio', function (Blueprint $table) {
            $table->increments('id_aloj_servicio');
            $table->unsignedInteger('id_alojamiento');
            $table->unsignedInteger('id_servicio');

            $table->foreign('id_alojamiento', 'fk_as_aloj')->references('id_alojamiento')->on('Alojamiento');
            $table->foreign('id_servicio', 'fk_as_servicio')->references('id_servicio')->on('Servicio_Alojamiento');
        });

        Schema::create('Guia_Idioma', function (Blueprint $table) {
            $table->increments('id_guia_idioma');
            $table->unsignedInteger('id_guia');
            $table->unsignedInteger('id_idioma');

            $table->foreign('id_guia', 'fk_gi_guia')->references('id_guia')->on('Guia_Turistico');
            $table->foreign('id_idioma', 'fk_gi_idioma')->references('id_idioma')->on('Idioma');
        });

        Schema::create('Guia_Especialidad', function (Blueprint $table) {
            $table->increments('id_guia_especialidad');
            $table->unsignedInteger('id_guia');
            $table->unsignedInteger('id_especialidad');

            $table->foreign('id_guia', 'fk_ge_guia')->references('id_guia')->on('Guia_Turistico');
            $table->foreign('id_especialidad', 'fk_ge_especialidad')->references('id_especialidad')->on('Especialidad');
        });

        Schema::create('Guia_Destino', function (Blueprint $table) {
            $table->increments('id_guia_destino');
            $table->unsignedInteger('id_guia');
            $table->unsignedInteger('id_destino');

            $table->foreign('id_guia', 'fk_gd_guia')->references('id_guia')->on('Guia_Turistico');
            $table->foreign('id_destino', 'fk_gd_destino')->references('id_destino')->on('Destino_Turistico');
        });

        Schema::create('Guia_Certificacion', function (Blueprint $table) {
            $table->increments('id_guia_certificacion');
            $table->unsignedInteger('id_guia');
            $table->unsignedInteger('id_certificacion');

            $table->foreign('id_guia', 'fk_gc_guia')->references('id_guia')->on('Guia_Turistico');
            $table->foreign('id_certificacion', 'fk_gc_cert')->references('id_certificacion')->on('Certificacion');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Guia_Certificacion');
        Schema::dropIfExists('Guia_Destino');
        Schema::dropIfExists('Guia_Especialidad');
        Schema::dropIfExists('Guia_Idioma');
        Schema::dropIfExists('Alojamiento_Servicio');
        Schema::dropIfExists('Paquete_Actividad_Opcional');
        Schema::dropIfExists('Paquete_Actividad_Incluida');
        Schema::dropIfExists('Paquete_Destino');
        Schema::dropIfExists('Destino_Temporada');
        Schema::dropIfExists('Destino_Fotografia');
    }
};
