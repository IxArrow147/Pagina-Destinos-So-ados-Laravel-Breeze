# 🏝️ TourSystem | Destinos Soñados S.A.

Sistema de gestión turística desarrollado como proyecto de aprendizaje y evaluación. Incluye una Landing Page pública, un sistema de autenticación de usuarios y un panel de administración (CRUD) para gestionar destinos y reservas, conectado a una base de datos relacional robusta mediante **Stored Procedures**.

## 🛠️ Tecnologías y Herramientas Utilizadas

*   **Backend:** Laravel 13.38.0 (PHP 8.4.27)
*   **Autenticación:** Laravel Breeze
*   **Base de Datos:** MySQL (Gestionado en MySQL Workbench)
*   **Frontend (Panel):** Bootstrap 5 y FontAwesome.
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
git clone https://github.com/IxArrow147/Pagina-Destinos-So-ados-Laravel-Breeze
cd example-app
composer install
npm install

### 3. Configurar el Entorno (.env)
Laravel utiliza dos archivos para la configuración: .env (privado) y .env.example (plantilla pública).

### 4. Duplica el archivo de ejemplo ejecutando en la terminal:
cp .env.example .env

### 5. Genera la clave de la aplicación:
php artisan key:generate

### 6. Abre el archivo .env recién creado y configura las credenciales de tu base de datos local:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=Destinos_Soñados_SA
DB_USERNAME=tu_usuario_local
DB_PASSWORD=tu_contraseña_local
(Nota: Debes crear la base de datos vacía llamada Destinos_Soñados_SA en tu MySQL Workbench antes de continuar).

### 7. Crear la Base de Datos (Migraciones y Seeders)
Este proyecto utiliza migraciones y seeders para garantizar que la base de datos sea reproducible en cualquier entorno. NO necesitas ejecutar scripts .sql manualmente.
Simplemente ejecuta el siguiente comando en tu terminal:
php artisan migrate:fresh --seed
Esto creará todas las tablas (incluyendo las de Breeze), los Stored Procedures y cargará los datos iniciales (catálogos y datos de demostración).

### 8. Compilar Assets y Levantar el Servidor
Ejecuta los siguientes comandos:
npm run build
php artisan serve
(Si usas Laravel Herd, simplemente abre el proyecto desde el panel de Herd).
Visita la URL asignada (ej: http://example-app.test o http://localhost:8000) en tu navegador.

### 9.CREDENCIALES DE PRUEBA (Usuario Breeze)
CREDENCIALES DE PRUEBA (Usuario Administrador)
El sistema crea automáticamente un usuario administrador al ejecutar las migraciones y seeders (php artisan migrate:fresh --seed). Las credenciales se configuran desde las variables ADMIN_EMAIL y ADMIN_PASSWORD en el archivo .env. puedes agregar el tuyo en el archivo .env o hacerlo con tu bases de datos mysql con el siguiente comando despues de registrarte en la pagina
UPDATE users SET role = 'admin' WHERE email = 'tu_correo@ejemplo.com';

ESTRUCTURA Y EXPLICACIÓN DEL CÓDIGO

routes/web.php: Define las rutas públicas (Landing Page) y las rutas protegidas (Panel de Administración usando middleware('auth') y middleware('admin')).

resources/views/layouts/: Contiene panel.blade.php, el layout maestro que hereda el diseño de la Landing Page (colores, header, footer) y es usado por todas las vistas del CRUD.

app/Http/Controllers/: La lógica del CRUD. Los controladores (DestinoController y ReservaController) utilizan una arquitectura híbrida: usan Eloquent (Modelos) para consultar datos (listados con relaciones) y llaman directamente a los Stored Procedures (DB::statement('CALL sp_...')) para las inserciones, actualizaciones y eliminaciones.

app/Http/Middleware/AdminMiddleware.php: Middleware que protege las rutas del CRUD, permitiendo el acceso únicamente a usuarios con el rol de 'admin'.

database/migrations/ y database/seeders/: Contienen la estructura de las tablas, la creación de los Stored Procedures y los datos iniciales. Esto garantiza que la base de datos se cree automáticamente con el comando php artisan migrate:fresh --seed.

NOTA SOBRE LA LÓGICA DE NEGOCIO Y BASE DE DATOS
La lógica de negocio pesada (inserciones, cálculos de saldos en reservas, actualizaciones y consultas complejas con JOINS) está centralizada en Stored Procedures dentro de MySQL. Esto garantiza un alto rendimiento, seguridad contra inyecciones SQL y mantiene la integridad relacional del sistema. El controlador en Laravel actúa únicamente como un puente entre la interfaz y la base de datos, manteniendo el código PHP limpio y fácil de mantener.

PRUEBAS AUTOMATIZADAS (TESTING)
El proyecto cuenta con una suite de 9 pruebas automatizadas (Feature Tests) implementadas con PHPUnit. Para ejecutarlas, corre el comando:
php artisan test
Estas pruebas validan:

El middleware de autorización por roles (Admin vs Usuario).

Las validaciones de los formularios de reservas.

La lógica de negocio (rechazo de abonos mayores al precio total).


