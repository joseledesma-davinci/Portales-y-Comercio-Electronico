@extends('layouts.app')

@section('title', 'Crear cuenta')

@section('content')
<section class="section-spacing" aria-labelledby="titulo-registro">
    <h1 id="titulo-registro">Crear cuenta</h1>
    <p>Completá tus datos para registrarte como usuario común.</p>

    @if($errors->any())
        <div class="flash flash-error" role="alert">Hay errores en los datos enviados. Revisá el formulario e intentá nuevamente.</div>
    @endif

    <form action="{{ route('auth.register.process') }}" method="post" class="form-card">
        @csrf
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}">
            @error('name')
                <small class="field-error">{{ $message }}</small>
            @enderror
        </div>

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

        <div class="form-group">
            <label for="password_confirmation">Confirmar contraseña</label>
            <input type="password" id="password_confirmation" name="password_confirmation">
        </div>

        <button type="submit" class="btn btn-primary">Crear cuenta</button>
    </form>
</section>
@endsection
