<!DOCTYPE html>
<html lang="es-AR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel Admin') - DevHost Estudio</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
<header class="admin-header">
    <div class="admin-container admin-header-content">
        <a href="{{ route('admin.dashboard') }}" class="admin-brand">Panel DevHost Estudio</a>
        <nav aria-label="Navegación del panel">
            <ul class="admin-nav-list">
                <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('admin.posts.create') }}">Nueva publicación</a></li>
                <li>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-ghost">Salir</button>
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</header>

<main class="admin-main">
    <div class="admin-container">
        @include('partials.flash')
        @yield('content')
    </div>
</main>
</body>
</html>
