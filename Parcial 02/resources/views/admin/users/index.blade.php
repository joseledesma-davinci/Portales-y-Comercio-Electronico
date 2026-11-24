@extends('layouts.admin')

@section('title', 'Usuarios')

@section('content')
<section aria-labelledby="titulo-admin-users">
    <div class="table-headline">
        <h1 id="titulo-admin-users">Usuarios registrados</h1>
    </div>

    <form method="get" action="{{ route('admin.users.index') }}" class="admin-form" aria-label="Buscador de usuarios">
        <div class="form-grid">
            <div class="form-group form-group-full">
                <label for="q">Buscar por nombre o email</label>
                <input type="text" id="q" name="q" value="{{ $search }}" placeholder="Ej: maria o maria@mail.com">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>

    <div class="table-section" style="margin-top: 1rem;">
        <div class="table-wrapper">
            <table>
                <caption class="sr-only">Listado de usuarios con cantidad de suscripciones</caption>
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Email</th>
                    <th scope="col">Rol</th>
                    <th scope="col">Suscripciones</th>
                    <th scope="col">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role === 'admin' ? 'Administrador' : 'Usuario' }}</td>
                        <td>{{ $user->subscriptions_count }}</td>
                        <td>
                            <a class="btn btn-small" href="{{ route('admin.users.show', ['id' => $user->id]) }}">Ver detalle</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">No se encontraron usuarios con ese criterio.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination-wrap" aria-label="Paginación de usuarios">
            {{ $users->links('pagination.admin') }}
        </div>
    </div>
</section>
@endsection
