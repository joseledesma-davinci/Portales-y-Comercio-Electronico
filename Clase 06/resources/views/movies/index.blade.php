{{-- 
    # Usando componentes
    Cuando tenemos componentes de Blade definidos, podemos fácilmente usarlos en cualquier otro template
    de Blade.
    Solo lo tenemos que hacer con la sintaxis:
        <x-componente></x-componente>

    Donde "componente" lo reemplazamos con la ruta del componente en la carpeta "[views/components]", sin extensión
    y reemplazando las "/" de los subdirectorios con ".".
    Por ejemplo, si tenemos el componente:
        views/components/layouts/main.blade.php

    Lo podemos invocar escribiendo:
        <x-layouts.main></x-layouts.main>

    Es común que a los componentes queramos pasarles algún contenido, como código HTML.
    Para hacerlo, podemos simplemente escribir en el interior de la etiqueta del componente lo que queremos 
    pasarle. Por ejemplo:
        <x-layouts.main>
            <h1>Listado de películas</h1>
        </x-layouts.main>

    Pero esto no alcanza. El componente tiene que esperar poder recibir este HTML y usarlo.
    Laravel le pasa ese contenido directamente en la variable "$slot".

    Si necesitamos poder permitir que se puedan pasar múltiples contenidos a un componente para que sean 
    usados en distintos lugares, Blade soporta el uso de "named slots".
    La sintaxis sería, por ejemplo:
        <x-layouts.main>
            <x-slot:title>Lista de películas</x-slot:title>

            <h1>Listado de películas</h1>
        </x-layouts.main>

    Noten el <x-slot:title>.
    <x-slot> permite definir un slot con nombre. El nombre es lo que ponemos a continuación del ":".
    Es ese nombre con el que la variable en la que Blade va a recibir el valor se llama.
    En este caso, será "$title".
--}}
<x-layouts.main>
    <x-slot:title>Lista de películas</x-slot:title>

    <h1>Listado de películas</h1>

    <div class="mb-3">
        <a href="{{ url('/peliculas/nueva') }}">Publicar una nueva película</a>
    </div>

    {{-- 
        Para listar las películas, con el fin de ahorrar tiempo de cursada, vamos a imprimirlo en una tabla.
        Esto puede ser útil para un panel de administración, pero no es la forma adecuada de presentar la
        data al usuario. Donde algo como cards podría ser una mejor opción.
    --}}
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Título</th>
                <th>Precio</th>
                <th>Fecha de estreno</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($movies as $movie)
            <tr>
                {{-- 
                    En los modelos de Eloquent podemos acceder a los campos de la tabla de cada registro a
                    través de propiedades "públicas" de la clase.
                --}}
                <td>{{ $movie->title }}</td>
                <td>${{ $movie->price }}</td>
                <td>{{ $movie->release_date }}</td>
                <td>
                    <a href="{{ url('peliculas/' . $movie->movie_id) }}">Ver</a>
                </td>
            </tr>
            @endforeach
            
            <?php /*
            foreach($movies as $movie):
            ?>
            <tr>
                <td>{{ $movie->title }}</td>
                <td>${{ $movie->price }}</td>
                <td>{{ $movie->release_date }}</td>
                <td>Coming Soon&trade;</td>
            </tr>
            <?php 
            endforeach;*/
            ?>
        </tbody>
    </table>
</x-layouts.main>