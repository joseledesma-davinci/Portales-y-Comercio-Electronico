@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<section aria-labelledby="titulo-dashboard">
    <h1 id="titulo-dashboard">Panel de administración</h1>
    <p>Resumen general de contenido y actividad editorial.</p>

    <section class="stats-grid" aria-label="Indicadores del panel">
        <article class="stat-card">
            <h2>Publicaciones totales</h2>
            <p>{{ $stats['posts_total'] }}</p>
        </article>
        <article class="stat-card">
            <h2>Publicadas</h2>
            <p>{{ $stats['posts_published'] }}</p>
        </article>
        <article class="stat-card">
            <h2>Categorías</h2>
            <p>{{ $stats['categories_total'] }}</p>
        </article>
        <article class="stat-card">
            <h2>Servicios activos</h2>
            <p>{{ $stats['services_active'] }}</p>
        </article>
    </section>

    <section class="table-section" aria-labelledby="titulo-ultimas-posts">
        <div class="table-headline">
            <h2 id="titulo-ultimas-posts">Últimas publicaciones</h2>
            <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">Nueva publicación</a>
        </div>

        <div class="table-wrapper">
            <table>
                <caption class="sr-only">Listado de últimas publicaciones</caption>
                <thead>
                <tr>
                    <th>Título</th>
                    <th>Categoría</th>
                    <th>Autor</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @forelse($latestPosts as $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->category->name }}</td>
                        <td>{{ $post->user->name }}</td>
                        <td>
                            @if($post->published_at)
                                <span class="badge badge-publicado">Publicado</span>
                            @else
                                <span class="badge badge-borrador">Borrador</span>
                            @endif
                        </td>
                        <td class="actions-cell">
                            <a class="btn btn-small" href="{{ route('admin.posts.edit', ['id' => $post->id]) }}">Editar</a>
                            <a class="btn btn-small btn-danger" href="{{ route('admin.posts.delete', ['id' => $post->id]) }}">Eliminar</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No hay publicaciones cargadas.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </section>
</section>
@endsection
