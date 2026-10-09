<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel') :: DevHost Estudio</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="alternate icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
<header class="admin-header">
    <div class="admin-container admin-header-content">
        <a class="admin-brand" href="{{ route('admin.dashboard') }}">Panel DevHost</a>
        <nav aria-label="Navegación del panel de administración">
            <ul class="admin-nav-list">
                <li><a href="{{ route('admin.dashboard') }}">Panel</a></li>
                <li><a href="{{ route('admin.posts.index') }}">Publicaciones</a></li>
                <li>
                    <form action="{{ route('auth.logout') }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-ghost">Cerrar sesión</button>
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</header>

<main class="admin-main">
    <div class="admin-container">
        @include('partials.feedback')
        @yield('content')
    </div>
</main>
</body>
</html>
