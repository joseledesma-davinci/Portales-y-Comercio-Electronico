<x-layouts.main>
    <x-slot:title>Confirmación necesaria para eliminar</x-slot:title>

    <h1>Confirmación necesaria para eliminar {{ $movie->title }}</h1>

    <p>Para eliminar la película <b>{{ $movie->title }}</b> es necesario hacer una confirmación.</p>
    <p>Abajo se muestran los detalles de la película.</p>

    <hr class="mb-4">

    <h2>{{ $movie->title }}</h2>

    <dl>
        <dt>Precio</dt>
        <dd>${{ $movie->price }}</dd>
        <dt>Fecha de estreno</dt>
        <dd>{{ $movie->release_date }}</dd>
    </dl>

    <h2>Sinopsis</h2>

    <div>{{ $movie->synopsis }}</div>

    <hr class="my-4">

    <p>Esta acción es <b>irreversible</b>. ¿Querés continuar?</p>

    <form action="{{ route('movies.destroy', ['id' => $movie->movie_id]) }}" method="post">
        <button type="submit" class="btn btn-danger">Sí, eliminar {{ $movie->title }}</button>
    </form>
</x-layouts.main>