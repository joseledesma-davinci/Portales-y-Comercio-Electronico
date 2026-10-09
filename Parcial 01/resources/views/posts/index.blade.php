@extends('layouts.app')

@section('title', 'Blog')

@section('content')
<section class="section-spacing" aria-labelledby="titulo-blog">
    <h1 id="titulo-blog">Blog sobre seguridad, optimización y novedades tech</h1>
    <p>Recursos prácticos para mejorar rendimiento, proteger tus activos y tomar mejores decisiones técnicas.</p>

    <div class="blog-list">
        @forelse($posts as $post)
            <article class="post-item">
                @if($post->image)
                    <img src="{{ asset('img/'.$post->image) }}" alt="Imagen de la publicación {{ $post->title }}" class="card-thumb" loading="lazy">
                @else
                    <div class="image-placeholder" aria-hidden="true">Sin imagen</div>
                @endif
                <p class="category">{{ $post->category->name }}</p>
                <h2><a class="post-item-link" href="{{ route('posts.show', ['id' => $post->id]) }}">{{ $post->title }}</a></h2>
                <p>{{ $post->synopsis }}</p>
                <p class="meta">Publicado el {{ optional($post->published_at)->format('d/m/Y') }}</p>
            </article>
        @empty
            <p>No hay publicaciones disponibles por ahora.</p>
        @endforelse
    </div>

    
</section>
@endsection
