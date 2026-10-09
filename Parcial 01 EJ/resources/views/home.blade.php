@extends('layouts.app')

@section('title', 'Inicio | DevHost Estudio')

@section('content')
<section class="hero" aria-labelledby="hero-title">
    <div>
        <h1 id="hero-title">Estudio de Desarrollo Web & Hosting</h1>
        <p>En DevHost Estudio ayudamos a empresas y profesionales a vender más con plataformas rápidas, seguras y mantenibles.</p>
        <p>Laburamos con una metodología clara: diagnóstico, implementación y soporte continuo para que tu negocio no se frene.</p>
        <a href="{{ route('site.services') }}" class="btn btn-primary">Ver servicios disponibles</a>
    </div>
</section>

<section aria-labelledby="servicios-destacados" class="section-spacing">
    <h2 id="servicios-destacados">Servicios destacados</h2>
    <div class="card-grid">
        @forelse($services as $service)
            <article class="card">
                <h3>{{ $service->name }}</h3>
                <p>{{ $service->short_description }}</p>
                <p class="price">${{ number_format((float)$service->price, 0, ',', '.') }} ARS / {{ $service->billing_cycle }}</p>
            </article>
        @empty
            <p>No hay servicios cargados por ahora.</p>
        @endforelse
    </div>
</section>

<section aria-labelledby="ultimas-novedades" class="section-spacing">
    <h2 id="ultimas-novedades">Últimas novedades del blog</h2>
    <div class="card-grid">
        @forelse($posts as $post)
            <article class="card">
                <p class="category">{{ $post->category->name }}</p>
                <h3>{{ $post->title }}</h3>
                <p>{{ $post->excerpt }}</p>
                <a href="{{ route('site.blog.show', $post) }}" class="text-link" aria-label="Leer {{ $post->title }}">Leer artículo</a>
            </article>
        @empty
            <p>Todavía no hay publicaciones visibles.</p>
        @endforelse
    </div>
</section>
@endsection
