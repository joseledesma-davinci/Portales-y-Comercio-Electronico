@extends('layouts.app')

@section('title', $service->title)

@section('content')
<section class="section-spacing" aria-labelledby="titulo-servicio">
    <h1 id="titulo-servicio">{{ $service->title }}</h1>

    @if($service->image)
        <img src="{{ asset('img/'.$service->image) }}" alt="Imagen del servicio {{ $service->title }}" class="detail-image" loading="lazy">
    @else
        <div class="image-placeholder image-placeholder-lg" aria-hidden="true">Imagen próximamente</div>
    @endif

    <p class="price">${{ number_format((float)$service->price, 0, ',', '.') }} ARS</p>
    <p>{{ $service->synopsis }}</p>
    <p>{{ $service->description }}</p>
    <p><a href="{{ route('services.index') }}" class="text-link">← Volver a servicios</a></p>
</section>
@endsection
