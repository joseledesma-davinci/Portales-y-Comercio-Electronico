@extends('layouts.admin')

@section('title', 'Crear publicación')

@section('content')
<section aria-labelledby="titulo-crear-post">
    <h1 id="titulo-crear-post">Crear publicación</h1>

    @if($errors->any())
        <div class="flash flash-error" role="alert">Hay errores en los datos enviados. Revisá los campos marcados.</div>
    @endif

    <form action="{{ route('admin.posts.store') }}" method="post" class="admin-form">
        @csrf
        @include('admin.posts.form', ['post' => null])
        <button type="submit" class="btn btn-primary">Guardar publicación</button>
    </form>
</section>
@endsection
