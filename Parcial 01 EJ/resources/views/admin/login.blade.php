@extends('layouts.app')

@section('title', 'Ingreso al panel admin')

@section('content')
<section class="section-spacing" aria-labelledby="admin-login-title">
    <h1 id="admin-login-title">Ingreso al panel administrativo</h1>
    <p>Accedé con tu usuario administrador para gestionar las publicaciones del blog.</p>

    <form action="{{ route('admin.login.attempt') }}" method="POST" class="form-card" novalidate>
        @csrf
        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email">
            @error('email')
                <small class="field-error">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Contraseña</label>
            <input id="password" name="password" type="password" autocomplete="current-password">
            @error('password')
                <small class="field-error">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Ingresar al panel</button>
    </form>
</section>
@endsection
