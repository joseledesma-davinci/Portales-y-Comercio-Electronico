@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
<section class="hero" aria-labelledby="titulo-home">
    <div class="hero-grid">
        <article>
            <h1 id="titulo-home">Estudio de Desarrollo Web & Hosting</h1>
            <p>Ayudamos a negocios a construir, optimizar y sostener su presencia digital con foco en resultados y continuidad operativa.</p>
            <p>Combinamos infraestructura, desarrollo a medida y soporte técnico para que puedas crecer con una base sólida.</p>
        </article>
        <article class="hero-media">
            <img src="{{ asset('img/hero-estudio.jpg') }}" alt="Equipo profesional trabajando en infraestructura y desarrollo web" loading="lazy">
        </article>
    </div>
</section>

<section class="section-spacing" aria-labelledby="servicios-destacados">
    <h2 id="servicios-destacados">Servicios destacados</h2>
    <div class="card-grid">
        @foreach($services as $service)
            <article class="card">
                @if($service->image)
                    <img src="{{ asset('img/'.$service->image) }}" alt="Imagen del servicio {{ $service->title }}" class="card-thumb" loading="lazy">
                @else
                    <div class="image-placeholder" aria-hidden="true">Imagen próximamente</div>
                @endif
                <h3>{{ $service->title }}</h3>
                <p>{{ $service->synopsis }}</p>
                <p class="price">${{ number_format((float)$service->price, 0, ',', '.') }} ARS</p>
                <a href="{{ route('services.show', ['id' => $service->id]) }}" class="text-link">Ver detalle</a>
            </article>
        @endforeach
    </div>
</section>

<section class="section-spacing" aria-labelledby="ultimas-publicaciones">
    <h2 id="ultimas-publicaciones">Últimas publicaciones del blog</h2>
    <div class="card-grid">
        @foreach($posts as $post)
            <article class="card">
                @if($post->image)
                    <img src="{{ asset('img/'.$post->image) }}" alt="Imagen de portada: {{ $post->title }}" class="card-thumb" loading="lazy">
                @else
                    <div class="image-placeholder" aria-hidden="true">Sin imagen</div>
                @endif
                <p class="category">{{ $post->category->name }}</p>
                <h3>{{ $post->title }}</h3>
                <p>{{ $post->synopsis }}</p>
                <a href="{{ route('posts.show', ['id' => $post->id]) }}" class="text-link">Leer nota</a>
            </article>
        @endforeach
    </div>
</section>
@endsection
