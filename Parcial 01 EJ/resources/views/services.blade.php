@extends('layouts.app')

@section('title', 'Servicios | DevHost Estudio')

@section('content')
<section aria-labelledby="titulo-servicios" class="section-spacing">
    <h1 id="titulo-servicios">Servicios profesionales para tu presencia digital</h1>
    <p>Planes de hosting, desarrollo web y mantenimiento técnico en un solo equipo.</p>

    <div class="service-grid">
        @forelse($services as $service)
            <article class="service-card">
                <header>
                    <h2>{{ $service->name }}</h2>
                    <p class="category">{{ $service->category }}</p>
                </header>
                <p>{{ $service->description }}</p>
                <p class="price">${{ number_format((float)$service->price, 0, ',', '.') }} ARS / {{ $service->billing_cycle }}</p>
                <h3>Incluye</h3>
                <ul>
                    @foreach(explode("\n", $service->features) as $feature)
                        <li>{{ $feature }}</li>
                    @endforeach
                </ul>
                <p class="support">Soporte {{ $service->included_support ? 'incluido' : 'no incluido' }}.</p>
            </article>
        @empty
            <p>No encontramos servicios activos en este momento.</p>
        @endforelse
    </div>
</section>
@endsection
