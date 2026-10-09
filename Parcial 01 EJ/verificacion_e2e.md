# Verificación E2E - DevHost Estudio

## Versiones de entorno
- Laravel Framework 12.69.3
- PHP 8.2.34 (cli) (built: Oct  4 2026 14:03:09) (NTS)

## Migraciones y seeders
- Comando ejecutado: `php artisan migrate:fresh --seed`
- Resultado: **OK, sin errores**.

## Verificación HTTP de rutas públicas y admin
- GET / => **200**
- GET /servicios => **200**
- GET /blog => **200**
- GET /blog/checklist-blindar-wordpress-2026 => **200**
- GET /admin/login => **200**
- GET /admin sin sesión => **302** (Location: http://127.0.0.1:8000/admin/login)

## Flujo de login real (sesión + CSRF)
- Token `_token` extraído desde formulario de login: **sí**
- Cookie `XSRF-TOKEN` presente: **sí**
- POST /admin/login con credencial incorrecta => **302**
- GET /admin/login posterior al intento incorrecto => **200**
- Mensaje de error visible en la vista: **sí**
- POST /admin/login con credenciales válidas => **302** (Location: http://127.0.0.1:8000/admin)
- GET /admin con cookie de sesión => **200**

## Verificación ABM de publicaciones por HTTP
- GET /admin/posts/crear => **200**
- POST /admin/posts (crear, con CSRF) => **302**
- Comprobación en DB del slug creado => **1 registro**
- GET /admin/posts/{id}/editar => **200**
- POST /admin/posts/{id} + _method=PUT => **302**
- Comprobación en DB del slug actualizado => **1 registro**
- POST /admin/posts/{id} + _method=DELETE => **302**
- Comprobación en DB luego de eliminar => **0 registro**

## Esquema final de tablas (SQLite)
## users
- id (INTEGER)
- name (varchar)
- email (varchar)
- email_verified_at (datetime)
- password (varchar)
- remember_token (varchar)
- created_at (datetime)
- updated_at (datetime)

## categories
- id (INTEGER)
- name (varchar)
- slug (varchar)
- description (TEXT)
- created_at (datetime)
- updated_at (datetime)

## posts
- id (INTEGER)
- user_id (INTEGER)
- category_id (INTEGER)
- title (varchar)
- slug (varchar)
- excerpt (varchar)
- content (TEXT)
- status (varchar)
- reading_time_minutes (INTEGER)
- published_at (datetime)
- created_at (datetime)
- updated_at (datetime)

## services
- id (INTEGER)
- name (varchar)
- slug (varchar)
- category (varchar)
- short_description (varchar)
- description (TEXT)
- price (numeric)
- billing_cycle (varchar)
- features (TEXT)
- included_support (tinyint(1))
- featured (tinyint(1))
- active (tinyint(1))
- created_at (datetime)
- updated_at (datetime)
