@extends('layouts.app')

@section('title', 'Servicios')

@section('content')
<section class="section-spacing" aria-labelledby="titulo-servicios">
    <h1 id="titulo-servicios">Servicios de hosting, desarrollo y mantenimiento</h1>
    <p>Elegí la opción que mejor se adapta a tu etapa actual y escalá cuando lo necesites.</p>

    <div class="service-grid">
        @forelse($services as $service)
            <article class="service-card">
                @if($service->image)
                    <img src="{{ asset('img/'.$service->image) }}" alt="Imagen del servicio {{ $service->title }}" class="card-thumb" loading="lazy">
                @else
                    <div class="image-placeholder" aria-hidden="true">Imagen próximamente</div>
                @endif
                <h2>{{ $service->title }}</h2>
                <p>{{ $service->synopsis }}</p>
                <p class="price">${{ number_format((float)$service->price, 0, ',', '.') }} ARS</p>
                <a href="{{ route('services.show', ['id' => $service->id]) }}" class="text-link">Conocer más</a>
            </article>
        @empty
            <p>No hay servicios activos por el momento.</p>
        @endforelse
    </div>
</section>
@endsection
