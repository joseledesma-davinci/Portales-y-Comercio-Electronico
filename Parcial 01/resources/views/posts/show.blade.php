@extends('layouts.app')

@section('title', $post->title)

@section('content')
<article class="post-detail section-spacing" aria-labelledby="titulo-post">
    <header>
        <p class="category">{{ $post->category->name }}</p>
        <h1 id="titulo-post">{{ $post->title }}</h1>
        <p class="meta">Publicado el {{ optional($post->published_at)->format('d/m/Y') }} por {{ $post->user->name }}</p>
    </header>

    @if($post->image)
        <img src="{{ asset('img/'.$post->image) }}" alt="Imagen destacada de {{ $post->title }}" class="detail-image" loading="lazy">
    @else
        <div class="image-placeholder image-placeholder-lg" aria-hidden="true">Sin imagen</div>
    @endif

    <p class="excerpt"><strong>{{ $post->synopsis }}</strong></p>

    @foreach(preg_split('/\n\n+/', trim($post->content)) as $paragraph)
        <p>{{ $paragraph }}</p>
    @endforeach

    <p><a href="{{ route('posts.index') }}" class="text-link">← Volver al blog</a></p>
</article>
@endsection
