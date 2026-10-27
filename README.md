# 🏝️ TourSystem | Destinos Soñados S.A.

Sistema de gestión turística desarrollado como proyecto de aprendizaje y evaluación. Incluye una Landing Page pública, un sistema de autenticación de usuarios y un panel de administración (CRUD) para gestionar destinos, conectado a una base de datos relacional robusta mediante **Stored Procedures**.

## 🛠️ Tecnologías y Herramientas Utilizadas

*   **Backend:** Laravel 13.38.0 (PHP 8.4.27)
*   **Autenticación:** Laravel Breeze
*   **Base de Datos:** MySQL (Gestionado en MySQL Workbench)
*   **Frontend (Panel):** Tailwind CSS (por defecto en Breeze) y Bootstrap 5 (para el CRUD).
*   **Frontend (Landing):** Bootstrap 5, CSS puro (Metodología BEM) y FontAwesome.
*   **Entorno de Desarrollo:** Laravel Herd
*   **Editor de Código:** Visual Studio Code
*   **Gestor de Paquetes:** Composer (PHP) y NPM (Node).

---

## 🚀 Guía de Instalación Paso a Paso

Sigue estas instrucciones al pie de la letra para levantar el proyecto en un entorno local.

### 1. Requisitos Previos
Asegúrate de tener instalado:
*   [PHP 8.2 o superior](https://www.php.net/)
*   [Composer](https://getcomposer.org/)
*   [Node.js y NPM](https://nodejs.org/)
*   [MySQL](https://dev.mysql.com/downloads/workbench/) (o un gestor compatible como MariaDB).
*   Opcional: [Laravel Herd](https://herd.laravel.com/) (para un entorno de desarrollo rápido).

### 2. Clonar el Repositorio e Instalar Dependencias
Abre tu terminal y ejecuta:
```bash
git clone <(https://github.com/IxArrow147/Pagina-Destinos-So-ados-Laravel-Breeze)>
cd example-app
composer install
npm install

GUÍA DE INSTALACIÓN (PASO A PASO)

Requisitos previos
Tener instalado PHP 8.2+, Composer, Node.js/NPM y MySQL.

Clonar el repositorio e instalar dependencias
Abre la terminal y ejecuta:
git clone <URL_DE_TU_REPOSITORIO>
cd example-app
composer install
npm install

Configurar el entorno (.env)
Laravel usa dos archivos: .env (privado) y .env.example (plantilla pública).
Copia la plantilla con este comando:
cp .env.example .env
Luego genera la clave de la aplicación:
php artisan key:generate
Abre el archivo .env y configura TUS credenciales de MySQL:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=Destinos_Soñados_SA
DB_USERNAME=tu_usuario_local
DB_PASSWORD=tu_contraseña_local

Base de Datos (¡IMPORTANTE! Orden Correcto)
El proyecto usa una base de datos preexistente con Stored Procedures. NO uses 'php artisan migrate' todavía.
Ve a la carpeta 'database_scripts/' en la raíz del proyecto. Abre MySQL Workbench y ejecuta los archivos en este estricto orden:

01_creacion_tablas.sql (Crea la BD y las tablas relacionales)

02_stored_procedures.sql (Crea los SPs para el CRUD)

03_inserts_iniciales.sql (Inserta datos maestros y de prueba)
Nota: El script ya incluye la creación de la base de datos, no la crees manualmente.

Crear las tablas de Autenticación (Breeze)
Ahora sí, ejecuta las migraciones de Laravel para crear las tablas de usuarios y login:
php artisan migrate

Compilar assets y levantar el servidor
Ejecuta:
npm run build
php artisan serve
(Si usas Laravel Herd, abre el proyecto desde su panel).
Visita http://localhost:8000 en tu navegador.

CREDENCIALES DE PRUEBA (Usuario Breeze)
Puedes registrarte en la ruta /register o usar este usuario para probar el panel rápido:
Email: [PON AQUÍ EL CORREO DEL USUARIO QUE CREASTE]
Password: [PON AQUÍ LA CONTRASEÑA]

EXPLICACIÓN TÉCNICA DEL CÓDIGO

Layouts: Usamos 'resources/views/layouts/panel.blade.php' como plantilla maestra (Header, Footer, CSS). Las vistas del CRUD hacen @extends('layouts.panel') para no repetir código.

Rutas: 'routes/web.php' contiene la ruta pública ('/') y las rutas protegidas (middleware 'auth') para el CRUD.

Controladores y SPs: En lugar del ORM de Laravel, el controlador usa 'DB::select('CALL sp_...')' para llamar directamente a los Stored Procedures de MySQL. Esto centraliza la lógica pesada (JOINs, cálculos, inserciones) en la base de datos, ahorrando código en PHP y optimizando el rendimiento.
