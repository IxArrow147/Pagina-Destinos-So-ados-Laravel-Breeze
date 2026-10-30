<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Catálogos base que la aplicación necesita siempre (tipos, países, regiones, etc.).
 * Es seguro ejecutarlo varias veces: una tabla que ya tiene filas no se vuelve a poblar.
 * Las llaves foráneas dependen del orden de las tablas, no lo alteres.
 */
class CatalogosSeeder extends Seeder
{
    public function run(): void
    {
        $datos = [
            'Tipo_Destino' => [
                ['nombre' => 'Playa'],
                ['nombre' => 'Montaña'],
                ['nombre' => 'Ciudad Histórica'],
                ['nombre' => 'Aventura'],
                ['nombre' => 'Ecológico'],
                ['nombre' => 'Cultural'],
            ],
            'Tipo_Alojamiento' => [
                ['nombre' => 'Hotel'],
                ['nombre' => 'Hostal'],
                ['nombre' => 'Resort'],
                ['nombre' => 'Apartamento'],
                ['nombre' => 'Cabaña'],
                ['nombre' => 'Eco-Lodge'],
            ],
            'Categoria_Alojamiento' => [
                ['Estrellas' => 1],
                ['Estrellas' => 2],
                ['Estrellas' => 3],
                ['Estrellas' => 4],
                ['Estrellas' => 5],
            ],
            'Tipo_Transporte' => [
                ['nombre' => 'Avión'],
                ['nombre' => 'Bus'],
                ['nombre' => 'Tren'],
                ['nombre' => 'Barco'],
                ['nombre' => 'Vehículo Privado'],
            ],
            'Regimen_Alimenticio' => [
                ['nombre' => 'Solo alojamiento'],
                ['nombre' => 'Desayuno incluido'],
                ['nombre' => 'Media pensión'],
                ['nombre' => 'Pensión completa'],
                ['nombre' => 'Todo incluido'],
            ],
            'Tipo_Actividad' => [
                ['nombre' => 'Aventura'],
                ['nombre' => 'Cultural'],
                ['nombre' => 'Relajación'],
                ['nombre' => 'Gastronómica'],
                ['nombre' => 'Deportiva'],
                ['nombre' => 'Naturaleza'],
            ],
            'Tipo_Descuento' => [
                ['nombre' => 'Porcentaje'],
                ['nombre' => 'Monto fijo'],
                ['nombre' => 'Promoción especial'],
                ['nombre' => 'Temporada baja'],
                ['nombre' => 'Cliente frecuente'],
            ],
            'Metodo_Pago' => [
                ['nombre' => 'Tarjeta de crédito'],
                ['nombre' => 'Tarjeta de débito'],
                ['nombre' => 'Transferencia bancaria'],
                ['nombre' => 'Efectivo'],
                ['nombre' => 'Pago en línea'],
            ],
            'Tipo_Cliente' => [
                ['nombre' => 'Individual'],
                ['nombre' => 'Pareja'],
                ['nombre' => 'Familiar'],
                ['nombre' => 'Empresarial'],
                ['nombre' => 'Grupo turístico'],
            ],
            'Idioma' => [
                ['nombre' => 'Español'],
                ['nombre' => 'Inglés'],
                ['nombre' => 'Francés'],
                ['nombre' => 'Alemán'],
                ['nombre' => 'Italiano'],
                ['nombre' => 'Portugués'],
                ['nombre' => 'Japonés'],
                ['nombre' => 'Chino'],
            ],
            'Especialidad' => [
                ['nombre' => 'Historia'],
                ['nombre' => 'Ecoturismo'],
                ['nombre' => 'Aventura'],
                ['nombre' => 'Gastronomía'],
                ['nombre' => 'Fotografía'],
                ['nombre' => 'Cultura local'],
            ],
            'Certificacion' => [
                ['nombre' => 'Guía certificado internacional'],
                ['nombre' => 'Primeros auxilios'],
                ['nombre' => 'Turismo sostenible'],
                ['nombre' => 'Guía de montaña'],
                ['nombre' => 'Idiomas avanzados'],
            ],
            'Temporada' => [
                ['nombre' => 'Media'],
                ['nombre' => 'Baja'],
                ['nombre' => 'Festiva'],
                ['nombre' => 'Verano'],
                ['nombre' => 'Invierno'],
                ['nombre' => 'Alta'],
            ],
            'Servicio_Alojamiento' => [
                ['nombre' => 'WiFi'],
                ['nombre' => 'Piscina'],
                ['nombre' => 'Gimnasio'],
                ['nombre' => 'Spa'],
                ['nombre' => 'Restaurante'],
                ['nombre' => 'Bar'],
                ['nombre' => 'Transporte al aeropuerto'],
                ['nombre' => 'Desayuno incluido'],
            ],
            'Pais' => [
                ['nombre' => 'Colombia'],
                ['nombre' => 'México'],
                ['nombre' => 'Estados Unidos'],
                ['nombre' => 'España'],
                ['nombre' => 'Francia'],
                ['nombre' => 'Italia'],
                ['nombre' => 'Alemania'],
                ['nombre' => 'Brasil'],
                ['nombre' => 'Argentina'],
                ['nombre' => 'Chile'],
                ['nombre' => 'Perú'],
                ['nombre' => 'Japón'],
                ['nombre' => 'China'],
                ['nombre' => 'Canadá'],
                ['nombre' => 'Australia'],
                ['nombre' => 'Reino Unido'],
                ['nombre' => 'Portugal'],
                ['nombre' => 'Grecia'],
                ['nombre' => 'Turquía'],
                ['nombre' => 'Egipto'],
            ],
            'Region' => [
                ['nombre' => 'Antioquia', 'id_pais' => 1],
                ['nombre' => 'Cundinamarca', 'id_pais' => 1],
                ['nombre' => 'Quintana Roo', 'id_pais' => 2],
                ['nombre' => 'California', 'id_pais' => 3],
                ['nombre' => 'Cataluña', 'id_pais' => 4],
                ['nombre' => 'Île-de-France', 'id_pais' => 5],
                ['nombre' => 'Lombardía', 'id_pais' => 6],
                ['nombre' => 'Baviera', 'id_pais' => 7],
                ['nombre' => 'São Paulo', 'id_pais' => 8],
                ['nombre' => 'Buenos Aires', 'id_pais' => 9],
                ['nombre' => 'Santiago', 'id_pais' => 10],
                ['nombre' => 'Cusco', 'id_pais' => 11],
                ['nombre' => 'Tokio', 'id_pais' => 12],
                ['nombre' => 'Beijing', 'id_pais' => 13],
                ['nombre' => 'Ontario', 'id_pais' => 14],
                ['nombre' => 'Nueva Gales del Sur', 'id_pais' => 15],
                ['nombre' => 'Inglaterra', 'id_pais' => 16],
                ['nombre' => 'Lisboa', 'id_pais' => 17],
                ['nombre' => 'Ática', 'id_pais' => 18],
                ['nombre' => 'El Cairo', 'id_pais' => 20],
            ],
        ];

        foreach ($datos as $tabla => $filas) {
            if (DB::table($tabla)->doesntExist()) {
                DB::table($tabla)->insert($filas);
            }
        }
    }
}
