@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<section aria-labelledby="dashboard-title">
    <h1 id="dashboard-title">Dashboard del blog</h1>
    <p>¡Hola, {{ session('admin_name', 'Administrador') }}! Desde acá podés gestionar las entradas del blog.</p>

    <section class="stats-grid" aria-label="Métricas del panel">
        <article class="stat-card">
            <h2>Publicaciones totales</h2>
            <p>{{ $stats['publicaciones'] }}</p>
        </article>
        <article class="stat-card">
            <h2>Publicadas</h2>
            <p>{{ $stats['publicadas'] }}</p>
        </article>
        <article class="stat-card">
            <h2>Servicios activos</h2>
            <p>{{ $stats['servicios_activos'] }}</p>
        </article>
    </section>

    <section aria-labelledby="tabla-posts" class="table-section">
        <div class="table-headline">
            <h2 id="tabla-posts">Listado de publicaciones</h2>
            <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">Nueva publicación</a>
        </div>

        <div class="table-wrapper">
            <table>
                <caption class="sr-only">Tabla de publicaciones del blog</caption>
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Categoría</th>
                        <th>Estado</th>
                        <th>Autor</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($posts as $post)
                        <tr>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->category->name }}</td>
                            <td><span class="badge badge-{{ $post->status }}">{{ ucfirst($post->status) }}</span></td>
                            <td>{{ $post->author->name }}</td>
                            <td class="actions-cell">
                                <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-small">Editar</a>
                                <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" onsubmit="return confirm('¿Seguro que querés eliminar esta publicación?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-small btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No hay publicaciones cargadas todavía.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination-wrap">
            {{ $posts->links() }}
        </div>
    </section>
</section>
@endsection
