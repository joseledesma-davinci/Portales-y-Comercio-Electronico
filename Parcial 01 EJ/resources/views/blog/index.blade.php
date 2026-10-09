@extends('layouts.app')

@section('title', 'Blog | DevHost Estudio')

@section('content')
<section aria-labelledby="titulo-blog" class="section-spacing">
    <h1 id="titulo-blog">Blog de seguridad, rendimiento y novedades tech</h1>
    <p>Notas pensadas para equipos que quieren una web robusta, veloz y lista para escalar.</p>

    <div class="blog-list">
        @forelse($posts as $post)
            <article class="post-item">
                <header>
                    <p class="category">{{ $post->category->name }}</p>
                    <h2><a href="{{ route('site.blog.show', $post) }}">{{ $post->title }}</a></h2>
                </header>
                <p>{{ $post->excerpt }}</p>
                <p class="meta">Publicado {{ optional($post->published_at)->format('d/m/Y') }} · {{ $post->reading_time_minutes }} min de lectura</p>
            </article>
        @empty
            <p>Todavía no hay publicaciones para mostrar.</p>
        @endforelse
    </div>

    <nav aria-label="Paginación del blog" class="pagination-wrap">
        {{ $posts->links() }}
    </nav>
</section>
@endsection
