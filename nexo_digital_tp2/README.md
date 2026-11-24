# DevHost Estudio — TP2 (2do Parcial)

Proyecto Laravel 12 para **Portales y Comercio Electrónico** (2do parcial), ampliado sobre la base del TP1 con roles, middleware personalizado de admin, registro público, ABM de posts con subida real de imágenes y módulo administrativo de usuarios.

## Requisitos técnicos
- PHP 8.2+
- Composer
- Laravel 12
- SQLite (entorno local rápido) o MySQL (entrega final)
- Sin Vite / sin npm

## Instalación rápida (local con SQLite)
1. Instalar dependencias:
   ```bash
   composer install
   ```
2. Preparar entorno:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
3. Verificar base local:
   - `DB_CONNECTION=sqlite`
   - `DB_DATABASE=database/database.sqlite`
4. Crear DB y poblar:
   ```bash
   touch database/database.sqlite
   php artisan migrate:fresh --seed
   ```
5. Habilitar archivos públicos de Storage:
   ```bash
   php artisan storage:link
   ```
6. Levantar servidor:
   ```bash
   php artisan serve
   ```

## Instalación para entrega (MySQL/XAMPP)
1. Ajustar `.env` con:
   - `DB_CONNECTION=mysql`
   - `DB_HOST=127.0.0.1`
   - `DB_PORT=3306`
   - `DB_DATABASE=apellido_nombre`
   - `DB_USERNAME=root`
   - `DB_PASSWORD=`
2. Crear base automáticamente:
   ```bash
   php artisan db:create
   ```
3. Migrar y seedear:
   ```bash
   php artisan migrate:fresh --seed
   ```
4. Crear enlace de storage:
   ```bash
   php artisan storage:link
   ```

> Importante de entrega: **`public/storage` no se incluye en el ZIP**. Es un enlace simbólico que se regenera en la máquina evaluadora con `php artisan storage:link`.

## Credenciales de prueba
- **Admin**
  - Email: `admin@estudio.test`
  - Password: `admin123`
- **Usuarios comunes**
  - `maria@estudio.test` / `maria1234`
  - `lucas@estudio.test` / `lucas1234`
  - `sofia@estudio.test` / `sofia1234`

## Estructura de tablas del TP2
- `users`: id, name, email (unique), password, role (`admin|user`), timestamps.
- `categories`: id, name, slug (unique), description nullable, timestamps.
- `services`: id, title, synopsis, description, price, image nullable, is_active, timestamps.
- `posts`: id, user_id (FK cascade), category_id (FK restrict), title, synopsis, content, image nullable, published_at nullable, timestamps.
- `subscriptions`: id, user_id (FK cascade), service_id (FK restrict), status (`activa|vencida|cancelada`), started_at, expires_at nullable, notes nullable, timestamps.

## Rutas principales
### Públicas
- `GET /`
- `GET /servicios`
- `GET /servicios/{id}`
- `GET /blog`
- `GET /blog/{id}`
- `GET /ingresar` / `POST /ingresar`
- `GET /registro` / `POST /registro`
- `POST /salir`

### Admin (protegidas con `auth` + `admin`)
- `GET /admin`
- `GET /admin/usuarios`
- `GET /admin/usuarios/{id}`
- `GET /admin/publicaciones`
- `GET|POST /admin/publicaciones/crear`
- `GET|POST /admin/publicaciones/{id}/editar`
- `GET|POST /admin/publicaciones/{id}/eliminar`

## Requisitos del TP2 y dónde están implementados (archivo / línea aprox.)
| Requisito | Implementación |
|---|---|
| 5 tablas propias + relaciones | `database/migrations/0001_01_01_000000_create_users_table.php`, `2026_10_08_015102_create_categories_table.php`, `2026_10_08_015102_create_services_table.php`, `2026_10_08_015102_create_posts_table.php`, `2026_10_08_120000_create_subscriptions_table.php` |
| Comentarios pedagógicos cascade/restrict | Migraciones de `posts` y `subscriptions` en las FK (`user_id`/`category_id` y `user_id`/`service_id`) |
| Modelos y relaciones TP2 | `app/Models/User.php`, `Category.php`, `Service.php`, `Post.php`, `Subscription.php` |
| Accessor `image_url` (legacy + storage) | `app/Models/Post.php` método `getImageUrlAttribute()` |
| Middleware admin personalizado | `app/Http/Middleware/EnsureUserIsAdmin.php` |
| Alias `admin` y registro middleware | `bootstrap/app.php` (`$middleware->alias([...])`) |
| Registro de usuarios sin scaffolding | `app/Http/Controllers/AuthController.php` (`registerForm`, `registerProcess`) |
| Login con redirect por rol | `AuthController@loginProcess()` |
| Rutas auth en español | `routes/web.php` (`/ingresar`, `/registro`, `/salir`) |
| ABM posts con upload real | `app/Http/Controllers/PostsController.php` (`store`, `update`, `destroy`) |
| Formularios con multipart y preview | `resources/views/admin/posts/create.blade.php`, `edit.blade.php`, `form.blade.php` |
| Listado y detalle de usuarios admin | `app/Http/Controllers/Admin/AdminUserController.php`, vistas `resources/views/admin/users/index.blade.php` y `show.blade.php` |
| Seed de usuarios + suscripciones | `database/seeders/UserSeeder.php`, `SubscriptionSeeder.php`, `DatabaseSeeder.php` |
| Paginación propia en español | `resources/views/pagination/site.blade.php`, `resources/views/pagination/admin.blade.php`, `lang/es/pagination.php` |

## Verificación técnica
La verificación completa (HTTP, auth, middleware, upload y conteos de tablas) está en:
- `verificacion_e2e.md`
