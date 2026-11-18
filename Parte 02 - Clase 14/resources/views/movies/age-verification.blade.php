<x-layouts.main>
    <x-slot:title>Confirmación de edad necesaria</x-slot:title>

    <h1>Confirmación de edad</h1>

    <p>La película <b>{{ $movie->title }}</b> está indicada como solo para mayores de 18 años.</p>
    <p>Para poder ingresar es necesario que confirmes que cumplís con esto.</p>

    <form action="{{ route('movies.age-verification.confirm', ['id' => $movie->movie_id]) }}" method="post">
        @csrf
        <button type="submit" class="btn btn-primary">Sí, soy mayor de 18 años</button>
        <a href="{{ route('movies.index') }}" class="btn btn-danger">No, soy menor de edad. ¡Sacame de acá!</a>
    </form>
</x-layouts.main>