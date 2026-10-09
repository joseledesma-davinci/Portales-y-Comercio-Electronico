@extends('layouts.admin')

@section('title', 'Editar publicación')

@section('content')
<section aria-labelledby="titulo-editar-post">
    <h1 id="titulo-editar-post">Editar publicación</h1>

    @if($errors->any())
        <div class="flash flash-error" role="alert">Hay errores en los datos enviados. Revisá los campos marcados.</div>
    @endif

    <form action="{{ route('admin.posts.update', ['id' => $post->id]) }}" method="post" class="admin-form">
        @csrf
        @include('admin.posts.form', ['post' => $post])
        <button type="submit" class="btn btn-primary">Actualizar publicación</button>
    </form>
</section>
@endsection
