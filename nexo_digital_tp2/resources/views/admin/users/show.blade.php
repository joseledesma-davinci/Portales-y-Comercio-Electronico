@extends('layouts.admin')

@section('title', 'Detalle de usuario')

@section('content')
<section aria-labelledby="titulo-user-detail">
    <h1 id="titulo-user-detail">Detalle de usuario</h1>

    <article class="table-section" aria-label="Datos del usuario">
        <p><strong>ID:</strong> {{ $user->id }}</p>
        <p><strong>Nombre:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Rol:</strong> {{ $user->role === 'admin' ? 'Administrador' : 'Usuario' }}</p>
    </article>

    <section class="table-section" aria-labelledby="titulo-servicios" style="margin-top: 1rem;">
        <h2 id="titulo-servicios">Servicios contratados</h2>

        @if($user->subscriptions->isEmpty())
            <p>Este usuario todavía no tiene servicios contratados.</p>
        @else
            <div class="table-wrapper">
                <table>
                    <caption class="sr-only">Tabla de suscripciones del usuario</caption>
                    <thead>
                    <tr>
                        <th scope="col">Servicio</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Inicio</th>
                        <th scope="col">Vencimiento</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($user->subscriptions as $subscription)
                        <tr>
                            <td>{{ $subscription->service->title }}</td>
                            <td>${{ number_format((float)$subscription->service->price, 0, ',', '.') }} ARS</td>
                            <td>{{ $subscription->status_label }}</td>
                            <td>{{ $subscription->started_at?->format('d/m/Y') }}</td>
                            <td>{{ $subscription->expires_at?->format('d/m/Y') ?? 'Sin vencimiento' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <p style="margin-top: 1rem;"><a href="{{ route('admin.users.index') }}" class="text-link">← Volver al listado de usuarios</a></p>
    </section>
</section>
@endsection
