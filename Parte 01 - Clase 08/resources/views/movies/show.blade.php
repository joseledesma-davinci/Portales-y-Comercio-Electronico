<x-layouts.main>
    <x-slot:title>{{ $movie->title }}</x-slot:title>

    <h1>{{ $movie->title }}</h1>

    <dl>
        <dt>Precio</dt>
        <dd>${{ $movie->price }}</dd>
        <dt>Fecha de estreno</dt>
        <dd>{{ $movie->release_date }}</dd>
    </dl>

    <h2>Sinopsis</h2>

    <div>{{ $movie->synopsis }}</div>
</x-layouts.main>