<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Entidades principales con sus llaves foráneas (mismos nombres de
 * constraint que el script SQL original).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Destino_Turistico', function (Blueprint $table) {
            $table->increments('id_destino');
            $table->string('codigo', 20)->unique();
            $table->string('nombre', 150);
            $table->decimal('latitud', 9, 6)->nullable();
            $table->decimal('longitud', 9, 6)->nullable();
            $table->text('descripcion')->nullable();
            $table->tinyInteger('nivel_popularidad')->nullable();
            $table->text('restricciones')->nullable();
            $table->unsignedInteger('id_tipo_destino');
            $table->unsignedInteger('id_pais');
            $table->unsignedInteger('id_region');

            $table->foreign('id_pais', 'fk_destino_pais')->references('id_pais')->on('Pais');
            $table->foreign('id_region', 'fk_destino_region')->references('id_region')->on('Region');
            $table->foreign('id_tipo_destino', 'fk_destino_tipo')->references('id_tipo_destino')->on('Tipo_Destino');
        });

        Schema::create('Actividad_Turistica', function (Blueprint $table) {
            $table->increments('id_actividad');
            $table->string('codigo', 20)->unique();
            $table->string('nombre', 150);
            $table->decimal('duracion_horas', 4, 2)->nullable();
            $table->tinyInteger('dificultad')->nullable();
            $table->text('equipamiento_necesario')->nullable();
            $table->text('restricciones')->nullable();
            $table->decimal('precio_por_persona', 10, 2)->nullable();
            $table->smallInteger('capacidad_maxima')->nullable();
            $table->unsignedInteger('id_destino');
            $table->unsignedInteger('id_tipo_actividad');

            $table->foreign('id_destino', 'fk_actividad_destino')->references('id_destino')->on('Destino_Turistico');
            $table->foreign('id_tipo_actividad', 'fk_actividad_tipo')->references('id_tipo_actividad')->on('Tipo_Actividad');
        });

        Schema::create('Alojamiento', function (Blueprint $table) {
            $table->increments('id_alojamiento');
            $table->string('codigo', 20)->unique();
            $table->string('nombre_comercial', 150);
            $table->string('direccion', 200)->nullable();
            $table->decimal('latitud', 9, 6)->nullable();
            $table->decimal('longitud', 9, 6)->nullable();
            $table->string('contacto', 200)->nullable();
            $table->text('politica_cancelacion')->nullable();
            $table->decimal('comision_acordada', 5, 2)->nullable();
            $table->unsignedInteger('id_tipo_alojamiento');
            $table->unsignedInteger('id_categoria_alojamiento');

            $table->foreign('id_tipo_alojamiento', 'fk_tipo_aloj')->references('id_tipo_alojamiento')->on('Tipo_Alojamiento');
            $table->foreign('id_categoria_alojamiento', 'fk_categoria_aloj')->references('id_categoria_alojamiento')->on('Categoria_Alojamiento');
        });

        Schema::create('Transporte', function (Blueprint $table) {
            $table->increments('id_transporte');
            $table->string('codigo', 20)->unique();
            $table->string('proveedor', 200)->nullable();
            $table->string('ruta', 200)->nullable();
            $table->smallInteger('capacidad')->nullable();
            $table->integer('duracion_minutos')->nullable();
            $table->text('restricciones_equipaje')->nullable();
            $table->decimal('tarifa', 10, 2)->nullable();
            $table->unsignedInteger('id_tipo_transporte');

            $table->foreign('id_tipo_transporte', 'fk_transporte_tipo')->references('id_tipo_transporte')->on('Tipo_Transporte');
        });

        Schema::create('Guia_Turistico', function (Blueprint $table) {
            $table->increments('id_guia');
            $table->string('nombres', 100);
            $table->string('apellidos', 100);
            $table->string('documento_identidad', 30)->unique();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('nacionalidad', 100)->nullable();
            $table->decimal('evaluacion_desempeno', 3, 2)->nullable();
            $table->boolean('disponibilidad')->nullable();
        });

        Schema::create('Cliente', function (Blueprint $table) {
            $table->increments('id_cliente');
            $table->string('codigo', 20)->unique();
            $table->string('nombres_razon_social', 200);
            $table->string('documento', 30)->unique();
            $table->string('nacionalidad', 100)->nullable();
            $table->string('direccion', 200)->nullable();
            $table->string('telefono', 10)->nullable();
            $table->string('correo', 150)->nullable();
            $table->string('programa_fidelizacion', 100)->nullable();
            $table->unsignedInteger('id_tipo_cliente');

            $table->foreign('id_tipo_cliente', 'fk_cliente_tipo')->references('id_tipo_cliente')->on('Tipo_Cliente');
        });

        Schema::create('Paquete_Turistico', function (Blueprint $table) {
            $table->increments('id_paquete');
            $table->string('codigo', 20)->unique();
            $table->string('nombre_comercial', 150);
            $table->tinyInteger('duracion_dias')->nullable();
            $table->tinyInteger('duracion_noches')->nullable();
            $table->decimal('precio_base', 10, 2)->nullable();
            $table->smallInteger('minimo_participantes')->nullable();
            $table->tinyInteger('nivel_dificultad')->nullable();
            $table->unsignedInteger('id_tipo_transporte');
            $table->unsignedInteger('id_categoria_alojamiento');
            $table->unsignedInteger('id_regimen');

            $table->foreign('id_tipo_transporte', 'fk_paquete_transporte')->references('id_tipo_transporte')->on('Tipo_Transporte');
            $table->foreign('id_categoria_alojamiento', 'fk_paquete_categoria')->references('id_categoria_alojamiento')->on('Categoria_Alojamiento');
            $table->foreign('id_regimen', 'fk_paquete_regimen')->references('id_regimen')->on('Regimen_Alimenticio');
        });

        Schema::create('Promocion', function (Blueprint $table) {
            $table->increments('id_promocion');
            $table->string('codigo', 20)->unique();
            $table->string('nombre', 150);
            $table->text('descripcion')->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->decimal('valor_descuento', 10, 2)->nullable();
            $table->text('condiciones_especiales')->nullable();
            $table->text('resultados_obtenidos')->nullable();
            $table->unsignedInteger('id_tipo_descuento');

            $table->foreign('id_tipo_descuento', 'fk_promocion_tipo_desc')->references('id_tipo_descuento')->on('Tipo_Descuento');
        });

        Schema::create('Reserva', function (Blueprint $table) {
            $table->increments('id_reserva');
            $table->string('numero_reserva', 20)->unique();
            $table->dateTime('fecha_creacion')->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->smallInteger('cantidad_adultos')->nullable();
            $table->smallInteger('cantidad_ninos')->nullable();
            $table->text('solicitudes_especiales')->nullable();
            $table->decimal('precio_total', 10, 2)->nullable();
            $table->decimal('abonos_realizados', 10, 2)->nullable();
            $table->decimal('saldo_pendiente', 10, 2)->nullable();
            $table->string('estado', 50)->nullable();
            $table->unsignedInteger('id_cliente');
            $table->unsignedInteger('id_metodo_pago');
            $table->unsignedInteger('id_paquete');
            $table->unsignedInteger('id_guia');

            $table->foreign('id_cliente', 'fk_reserva_cliente')->references('id_cliente')->on('Cliente');
            $table->foreign('id_metodo_pago', 'fk_reserva_metodo_pago')->references('id_metodo_pago')->on('Metodo_Pago');
            $table->foreign('id_paquete', 'fk_reserva_paquete')->references('id_paquete')->on('Paquete_Turistico');
            $table->foreign('id_guia', 'fk_reserva_guia')->references('id_guia')->on('Guia_Turistico');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Reserva');
        Schema::dropIfExists('Promocion');
        Schema::dropIfExists('Paquete_Turistico');
        Schema::dropIfExists('Cliente');
        Schema::dropIfExists('Guia_Turistico');
        Schema::dropIfExists('Transporte');
        Schema::dropIfExists('Alojamiento');
        Schema::dropIfExists('Actividad_Turistica');
        Schema::dropIfExists('Destino_Turistico');
    }
};
