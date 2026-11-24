# Verificación E2E — TP2 DevHost Estudio

## Entorno validado
- Laravel Framework 12.69.3
- PHP 8.2.35 (cli) (built: Oct 21 2026 06:29:51) (NTS)
- Base de pruebas local: SQLite (`database/database.sqlite`)

## 1) Lint de PHP (archivos nuevos/modificados)
Se ejecutó `php -l` sobre modelos, controladores, middleware, migraciones, seeders, rutas y bootstrap.

Resultado: **sin errores de sintaxis**.

## 2) Migraciones + seeders
Comando ejecutado:
```bash
php artisan migrate:fresh --seed
```

Resultado: OK.

Conteos de tablas tras seed:

users=4
categories=4
services=6
posts=8
subscriptions=3

## 3) Pruebas HTTP públicas
- GET `/` => **200**
- GET `/servicios` => **200**
- GET `/blog` => **200**
- GET `/blog?page=2` => **200**
- GET `/registro` => **200**

## 4) Registro de usuario
### Registro válido
- POST `/registro` => **302**
- Redirect Location => `http://127.0.0.1:8002`
- GET `/` con misma cookie (sesión iniciada) => **200**
- Rol guardado en DB para usuario nuevo => **user**

### Registro inválido (email duplicado + password corta)
- POST `/registro` => **302**
- GET `/registro` posterior (misma sesión) => **200**
- Mensaje "Ese email ya está registrado" visible => **1**
- Mensaje de password mínima visible => **1**

## 5) Login por rol + middleware admin
### Usuario común
- POST `/ingresar` (maria@estudio.test) => **302**
- Redirect Location => `http://127.0.0.1:8002`
- GET `/admin/usuarios` con cookie de usuario => **302**
- Redirect Location => `http://127.0.0.1:8002`
- Feedback "No tenés permisos para acceder al panel de administración." visible en home => **1**

### Administrador
- POST `/ingresar` (admin@estudio.test) => **302**
- Redirect Location => `http://127.0.0.1:8002/admin`
- GET `/admin` => **200**
- GET `/admin/usuarios` => **200**
- Título "Usuarios registrados" visible => **1**
- GET `/admin/usuarios/{id}` (usuario sembrado) => **200**
- Servicio contratado visible en detalle => **1**

## 6) Upload real de imagen en posts
- POST multipart `/admin/publicaciones/crear` con PNG de prueba => **302**
- Ruta guardada en DB (`posts/...`) => `posts/DoQTlvbASjvvOERkfkuNzupblP1TZ2oFGhVFOnOs.png`
- Archivo existente en `storage/app/public/posts` => **1**

## 7) Regla de borradores
- Verificación de título borrador en `/blog` (esperado: no mostrar)
- Coincidencias encontradas => **0**

## 8) Limpieza
- El servidor de pruebas se detuvo al finalizar la verificación.
