<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} :: DV Películas</title>
    {{-- 
        # Manejo de rutas con URLs amigables
        Tradicionalmente, es común que queramos vincular los archivos del HTML (como los CSS o JS o imágenes)
        con rutas relativas.
        Por ejemplo:
            css/bootstrap.min.css
        
        ¿Por qué usábamos rutas relativas?
        Porque esto facilita poder ejecutar el mismo proyecto en distintos entornos con distintos dominios
        sin tener que hacer ajustes en el código.

        Esto, que nos puede haber servido bien muchas veces, tiene un gran problema al querer combinarse con
        URLs amigables.
        La razón es que las URLs amigables suelen tener múltiples niveles de "directorios" para hacerlas,
        justamente, amigables y fáciles de leer para los usuarios.
        Esos directorios "ficticios" nos traen problemas con las URLs relativas, porque nos cambian 
        constantemente la ruta de base para las rutas relativas.

        ¿Cómo se puede solucionar?
        La solución más simple es usar rutas absolutas.
        Por ejemplo:
            http://localhost:8000/css/bootstrap.min.css

        Esto va a solucionar el problema de las rutas, pero nos lleva de nuevo al problema que buscamos evitar
        usando rutas relativas.

        Afortunadamente para nosotros, Laravel nos ofrece una solución simple, que es crear las rutas absolutas
        dinámicamente a través de las funciones "helper" de Laravel.
        Por ejemplo, podemos usar la función url() de la siguiente forma:
            url('css/bootstrap.min.css')

        Eso va a generar la URL absoluta dinámicamente según dónde esté hosteado el proyecto.
    --}}
    <link rel="stylesheet" href="<?= url('css/bootstrap.min.css');?>">
    <link rel="stylesheet" href="<?= url('css/style.css');?>">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?= url('/');?>">DV Películas</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= url('/');?>">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= url('nosotros');?>">Nosotros</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= url('peliculas/listado');?>">Películas</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <main class="container py-3">
            {{-- 
                Como dijimos en [views/movies/index.blade.php], la variable "$slot" va a contener lo que
                sea que se ponga como contenido de la etiqueta del componente.

                Las dobles llaves {{ }} son el mecanismo principal de Blade para imprimir contenido en la
                salida.
                Es decir que escribir:
                    {{ $expression }}

                Es lo mismo que escribir:
                    <?= e($expression);?>

                ¿Qué es esa función e()?
                Es una función de Laravel. Funciona de manera muy similar a la función htmlspecialchars()
                de php.
                Lo que hace es escapar todos los caracteres que tienen un significado especial es HTML y
                los reemplaza por sus entidades HTML equivalentes.
                Esto es muy importante para evitar los ataques de XSS (Cross-Site Scripting).

                Y si necesitamos imprimir un texto sin escaparlo, podemos usar la sintaxis propia de Blade
                para ese fin:
                    {!! $expression !!}

                La cual sí es equivalente 100% a:
                    <?= $expression;?>
            --}}
            {{ $slot }}
        </main>
        <footer class="footer">
            <p>Da Vinci &copy; 2026</p>
        </footer>
    </div>
</body>
</html>