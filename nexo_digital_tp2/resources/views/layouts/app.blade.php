<!DOCTYPE html>
<html lang="es-AR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'DevHost Estudio')</title>
    <meta name="description" content="Estudio de Desarrollo Web & Hosting con servicios de hosting, desarrollo y mantenimiento.">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="alternate icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<div id="app">
    <header class="site-header">
        <div class="container header-content">
            <a class="brand" href="{{ route('home') }}">DevHost Estudio</a>
            <nav aria-label="Navegación principal del sitio">
                <ul class="nav-list">
                    <li><a href="{{ route('home') }}">Inicio</a></li>
                    <li><a href="{{ route('services.index') }}">Servicios</a></li>
                    <li><a href="{{ route('posts.index') }}">Blog</a></li>

                    @guest
                        <li><a href="{{ route('auth.login.form') }}">Ingresar</a></li>
                        <li><a href="{{ route('auth.register.form') }}" class="nav-admin-link">Crear cuenta</a></li>
                    @else
                        @if(auth()->user()?->isAdmin())
                            <li><a href="{{ route('admin.dashboard') }}" class="nav-admin-link">Panel</a></li>
                        @endif
                        <li><span class="nav-user-name">Hola, {{ auth()->user()->name }}</span></li>
                        <li>
                            <form action="{{ route('auth.logout') }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-link">Salir</button>
                            </form>
                        </li>
                    @endguest
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <div class="container">
            @include('partials.feedback')
            @yield('content')
        </div>
    </main>

    <footer class="site-footer">
        <div class="container footer-content">
            <p>© {{ now()->year }} DevHost Estudio — Tecnología que acompaña tu crecimiento.</p>
            <p><a href="{{ route('auth.login.form') }}" class="text-link">Ingresar</a></p>
        </div>
    </footer>
</div>
</body>
</html>
