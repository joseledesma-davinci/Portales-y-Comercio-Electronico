@extends('layouts.admin')

@section('title', 'Nueva publicación')

@section('content')
<section aria-labelledby="create-post-title">
    <h1 id="create-post-title">Crear publicación</h1>
    <p>Completá los datos para sumar una nueva nota al blog.</p>

    <form action="{{ route('admin.posts.store') }}" method="POST" class="admin-form" novalidate>
        @csrf
        @include('admin.posts.form-fields', ['post' => null])
        <button type="submit" class="btn btn-primary">Guardar publicación</button>
    </form>
</section>
@endsection
