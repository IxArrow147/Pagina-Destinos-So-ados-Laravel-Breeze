<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tablas de catálogos (tipos, clasificaciones, métodos, etc.).
 * Los nombres de tabla conservan la capitalización original porque los
 * procedimientos almacenados y los modelos los referencian así
 * (en Linux, MySQL distingue mayúsculas en nombres de tabla).
 */
return new class extends Migration
{
    /** [tabla, llave primaria, longitud de "nombre", nombre obligatorio] */
    private array $catalogosSimples = [
        ['Tipo_Destino',          'id_tipo_destino',      50,  false],
        ['Tipo_Alojamiento',      'id_tipo_alojamiento',  50,  false],
        ['Tipo_Transporte',       'id_tipo_transporte',   50,  false],
        ['Regimen_Alimenticio',   'id_regimen',           50,  false],
        ['Tipo_Actividad',        'id_tipo_actividad',    50,  false],
        ['Tipo_Descuento',        'id_tipo_descuento',    50,  false],
        ['Metodo_Pago',           'id_metodo_pago',       50,  false],
        ['Tipo_Cliente',          'id_tipo_cliente',      50,  false],
        ['Pais',                  'id_pais',              50,  false],
        ['Idioma',                'id_idioma',            50,  true],
        ['Especialidad',          'id_especialidad',      100, true],
        ['Certificacion',         'id_certificacion',     150, true],
        ['Temporada',             'id_temporada',         50,  true],
        ['Servicio_Alojamiento',  'id_servicio',          100, true],
    ];

    public function up(): void
    {
        foreach ($this->catalogosSimples as [$tabla, $pk, $largo, $obligatorio]) {
            Schema::create($tabla, function (Blueprint $table) use ($pk, $largo, $obligatorio) {
                $table->increments($pk);
                $col = $table->string('nombre', $largo);
                if (! $obligatorio) {
                    $col->nullable();
                }
            });
        }

        Schema::create('Categoria_Alojamiento', function (Blueprint $table) {
            $table->increments('id_categoria_alojamiento');
            $table->tinyInteger('Estrellas');
        });

        // Region depende de Pais (ya creada arriba)
        Schema::create('Region', function (Blueprint $table) {
            $table->increments('id_region');
            $table->string('nombre', 50)->nullable();
            $table->unsignedInteger('id_pais');

            $table->foreign('id_pais', 'fk_Region_Pais')
                ->references('id_pais')->on('Pais');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Region');
        Schema::dropIfExists('Categoria_Alojamiento');

        foreach (array_reverse($this->catalogosSimples) as [$tabla]) {
            Schema::dropIfExists($tabla);
        }
    }
};
