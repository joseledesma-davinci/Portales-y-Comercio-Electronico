@extends('layouts.app')

@section('title', 'Ingreso al panel')

@section('content')
<section class="section-spacing" aria-labelledby="titulo-login">
    <h1 id="titulo-login">Ingreso al panel de administración</h1>
    <p>Usá tu cuenta de administrador para gestionar publicaciones del blog.</p>

    @if($errors->any())
        <div class="flash flash-error" role="alert">
            Hay errores en los datos enviados. Revisá el formulario e intentá de nuevo.
        </div>
    @endif

    <form action="{{ route('auth.login.process') }}" method="post" class="form-card">
        @csrf
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}">
            @error('email')
                <small class="field-error">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password">
            @error('password')
                <small class="field-error">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Ingresar</button>
    </form>
</section>
@endsection
