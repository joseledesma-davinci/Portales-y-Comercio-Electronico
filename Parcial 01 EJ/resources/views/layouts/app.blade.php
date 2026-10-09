<!DOCTYPE html>
<html lang="es-AR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'DevHost Estudio')</title>
    <meta name="description" content="Estudio de Desarrollo Web & Hosting con servicios de hosting, desarrollo y mantenimiento.">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<header class="site-header">
    <div class="container header-content">
        <a href="{{ route('site.home') }}" class="brand" aria-label="Ir al inicio de DevHost Estudio">DevHost Estudio</a>
        <nav aria-label="Navegación principal">
            <ul class="nav-list">
                <li><a href="{{ route('site.home') }}">Inicio</a></li>
                <li><a href="{{ route('site.services') }}">Servicios</a></li>
                <li><a href="{{ route('site.blog') }}">Blog</a></li>
                <li><a href="{{ route('admin.login') }}">Admin</a></li>
            </ul>
        </nav>
    </div>
</header>

<main>
    <div class="container">
        @include('partials.flash')
        @yield('content')
    </div>
</main>

<footer class="site-footer">
    <div class="container footer-content">
        <p>© {{ now()->year }} DevHost Estudio. Soluciones web y hosting para negocios que quieren crecer en serio.</p>
    </div>
</footer>
</body>
</html>
