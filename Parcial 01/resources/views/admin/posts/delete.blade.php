@extends('layouts.admin')

@section('title', 'Eliminar publicación')

@section('content')
<section aria-labelledby="titulo-eliminar-post">
    <h1 id="titulo-eliminar-post">Confirmar eliminación</h1>

    <article class="table-section">
        <h2>{{ $post->title }}</h2>
        <p><strong>Categoría:</strong> {{ $post->category->name }}</p>
        <p><strong>Autor:</strong> {{ $post->user->name }}</p>
        <p><strong>Estado:</strong> {{ $post->published_at ? 'Publicado' : 'Borrador' }}</p>
        <p>Esta acción es irreversible. ¿Querés eliminar esta publicación?</p>

        <form action="{{ route('admin.posts.destroy', ['id' => $post->id]) }}" method="post">
            @csrf
            <button type="submit" class="btn btn-danger">Sí, eliminar publicación</button>
            <a href="{{ route('admin.posts.index') }}" class="btn btn-small">Cancelar</a>
        </form>
    </article>
</section>
@endsection
