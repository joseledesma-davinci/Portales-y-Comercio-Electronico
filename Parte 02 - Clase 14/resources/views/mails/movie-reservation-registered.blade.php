<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva de película registrada</title>
</head>
<body style="font-family: sans-serif;">
    <h1 style="text-decoration: underline;">Película reservada correctamente</h1>

    <p>La reserva de la película <b>{{ $movie->title }}</b> se registró con éxito.</p>
    <p>Datos de la película:</p>

    <dl>
        <dt>Precio</dt>
        <dd>${{ $movie->price }}</dd>
        <dt>Fecha de estreno</dt>
        <dd>{{ $movie->release_date }}</dd>
        <dt>Clasificación</dt>
        <dd>{{ $movie->rating->name }} ({{ $movie->rating->abbreviation }})</dd>
        <dt>Géneros</dt>
        <dd>
            @forelse($movie->genres as $genre)
                <span>{{ $genre->name }}</span>
            @empty
                <i>Sin géneros asignados</i>
            @endforelse
        </dd>
    </dl>

    <p>Guardá este email como comprobante.</p>

    <p>Atentamente,<br>
    tus amigos de DV Películas.</p>
</body>
</html>