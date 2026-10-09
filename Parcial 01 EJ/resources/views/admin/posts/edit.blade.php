@extends('layouts.admin')

@section('title', 'Editar publicación')

@section('content')
<section aria-labelledby="edit-post-title">
    <h1 id="edit-post-title">Editar publicación</h1>
    <p>Actualizá el contenido y el estado de esta nota.</p>

    <form action="{{ route('admin.posts.update', $post) }}" method="POST" class="admin-form" novalidate>
        @csrf
        @method('PUT')
        @include('admin.posts.form-fields', ['post' => $post])
        <button type="submit" class="btn btn-primary">Actualizar publicación</button>
    </form>
</section>
@endsection
