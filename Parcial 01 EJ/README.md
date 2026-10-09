# DevHost Estudio - Parcial Portales y Comercio Electrónico

Proyecto Laravel 12.x para el parcial de **Portales y Comercio Electrónico**.
Temática: **Estudio de Desarrollo Web & Hosting**.

## Qué incluye

- Sitio público:
  - `/` Inicio institucional
  - `/servicios` Catálogo de servicios y precios
  - `/blog` Blog paginado
  - `/blog/{slug}` Detalle de artículo
- Panel admin con autenticación propia (sin scaffolding de auth Laravel):
  - `/admin/login`
  - `/admin` dashboard con ABM completo de publicaciones
- Base de datos por migrations + seeders:
  - `users`, `categories`, `posts`, `services`

## Requisitos

- PHP 8.2 o superior
- Composer
- MySQL (para entrega) o SQLite (para prueba local rápida)

## Configuración local (modo prueba con SQLite)

1. Copiá variables de entorno:
   ```bash
   cp .env.example .env
   ```
2. Ajustá `.env` a SQLite (ya viene preparado en este repo de prueba):
   - `DB_CONNECTION=sqlite`
   - `DB_DATABASE=database/database.sqlite`
3. Creá el archivo SQLite (si no existe):
   ```bash
   touch database/database.sqlite
   ```
4. Ejecutá migraciones y seeders:
   ```bash
   php artisan migrate:fresh --seed
   ```
5. Levantá servidor local:
   ```bash
   php artisan serve --port=8000
   ```

## Configuración para entrega (MySQL)

En `.env.example` se deja por defecto:

- `DB_CONNECTION=mysql`
- `DB_DATABASE=apellido_nombre`
- `DB_USERNAME=root`
- `DB_PASSWORD=`

> Reemplazá `apellido_nombre` por tu apellido y nombre reales según la consigna.

## Credenciales admin del seeder

- Email: `admin@estudio.test`
- Contraseña: `admin123`

## Notas de implementación

- Validaciones server-side con `FormRequest`.
- Middleware propio `ensure.admin` para proteger rutas de panel.
- Login manual con `Hash::check` y sesión (`admin_id`) sin usar controladores de auth de Laravel.
- Contenido y mensajes en español rioplatense.


## Si usás XAMPP (Windows / Linux) — opción típica

1. Instalá XAMPP (incluye PHP + MySQL + phpMyAdmin) y [Composer](https://getcomposer.org/download/).
2. Andá a http://localhost/phpmyadmin y creá una base nueva con el nombre de la consigna: `apellido_nombre` (individual) o `apellido1_apellido2` (grupal).
3. Copiá el archivo `.env.example` a `.env`:
   ```bash
   cp .env.example .env
   ```
4. Dejá estos valores en `.env`:
   ```
   DB_CONNECTION=mysql
   DB_DATABASE=apellido_nombre
   DB_USERNAME=root
   DB_PASSWORD=
   ```
5. Instalá las dependencias y prepará la app:
   ```bash
   composer install
   php artisan key:generate
   ```
6. Creá las tablas y cargá los datos iniciales:
   ```bash
   php artisan migrate --seed
   ```
7. Levantá el sitio:
   ```bash
   php artisan serve
   ```
   Y abrí **http://127.0.0.1:8000** en el navegador.

## Para la entrega

- Renombra la carpeta o el zip con el formato: `apellido-nombre.zip` (individual) o `apellido-nombre_apellido2-nombre2.zip` (grupal).
- Completá el archivo `datos.txt` con tus datos (carrera, cuatrimestre, turno, comisión, apellido y nombre, etc.) y subilo junto con el proyecto.
- Para probar la versión entregable con MySQL: seguí la sección XAMPP de arriba. Para probar rápido sin MySQL, usá la sección SQLite.
