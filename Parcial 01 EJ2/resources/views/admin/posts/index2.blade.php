@extends('layouts.admin')

@section('title', 'Publicaciones')

@section('content')
<section aria-labelledby="titulo-admin-posts">
    <div class="table-headline">
        <h1 id="titulo-admin-posts">Administrar publicaciones</h1>
        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">Nueva publicación</a>
    </div>

    <div class="table-section">
        <div class="table-wrapper">
            <table>
                <caption class="sr-only">Tabla completa de publicaciones</caption>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Categoría</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @forelse($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->category->name }}</td>
                        <td>{{ optional($post->published_at)->format('d/m/Y') ?? '—' }}</td>
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
                        <td colspan="6">No hay publicaciones registradas.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination-wrap" aria-label="Paginación de publicaciones">
            {{ $posts->links() }}
        </div>
    </div>
</section>
@endsection
