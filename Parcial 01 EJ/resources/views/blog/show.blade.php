@extends('layouts.app')

@section('title', $post->title . ' | Blog DevHost Estudio')

@section('content')
<article class="post-detail" aria-labelledby="post-title">
    <header>
        <p class="category">{{ $post->category->name }}</p>
        <h1 id="post-title">{{ $post->title }}</h1>
        <p class="meta">Publicado {{ optional($post->published_at)->format('d/m/Y') }} · {{ $post->reading_time_minutes }} min de lectura</p>
    </header>

    <p class="excerpt">{{ $post->excerpt }}</p>

    @foreach(preg_split('/\n\n+/', trim($post->content)) as $paragraph)
        <p>{{ $paragraph }}</p>
    @endforeach

    <p><a href="{{ route('site.blog') }}" class="text-link">← Volver al listado del blog</a></p>
</article>
@endsection
