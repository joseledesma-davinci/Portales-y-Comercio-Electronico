<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

/*
    Todos los modelos de Eloquent heredan de la clase Model de Eloquent.
    Dependiendo cómo lo implementemos, si estamos siguiendo todas las convenciones de la base de datos de
    Laravel, solo con la creación de la clase que herede de Model alcanza para hacer un ABM (CRUD) completo,
    y sin escribir una línea de SQL.

    Esto es debido a las convenciones de Laravel que le permiten saber o inferir los detalles de la tabla
    asociada.
    
    ## Nombre de la tabla asociada
    Por defecto, Eloquent supone que la tabla correspondiente al modelo se llama igual que el modelo, pero
    en plural (del inglés) y en snake_case.
    Por ejemplo:
        Movie           => movies
        Subscription    => subscriptions
        Child           => children
        MovieGenre      => movie_genres

    Si por la razón que fuere la tabla no sigue esta convención, tenemos que expresamente aclararlo a través
    de la propiedad $table.

    ## Nombre de la PK
    Por defecto, como hablamos durante las migrations, Laravel supone que la PK de todas las tablas es un
    INT (o de la familia) AUTO_INCREMENT de nombre "id".
    Si alguna de estas cosas no se cumple, puede ser necesario indicárselo para que algunas cosas funcionen.

    Para definir el nombre de la PK en la tabla podemos usar la propiedad $primaryKey.
*/
class Movie extends Model
{
    // protected $table = 'movies';
    protected $primaryKey = 'movie_id';

    // Definimos qué columnas se pueden cargar con "mass assignment".
    protected $fillable = ['title', 'price', 'release_date', 'synopsis', 'cover', 'cover_description', 'rating_fk'];

    /*
        # Accessors y mutators
        Se llaman así a los métodos que nos permiten modificar el valor de un campo del modelo cuando
        es leído o escrito, respectivamente.

        Para crearlos solo necesitamos definir un método que se llame como el campo en cuestión (por
        ejemplo, "price") y que tenga el type-hint en el retorno de la clase:
            Illuminate\Database\Eloquent\Casts\Attribute
    */
    public function price(): Attribute
    {
        /*
            Attribute::make() permite definir el accessor y el mutator.
            Recibe 2 argumentos:
            1. get. Callable. Función que dice cómo modificar el valor en la lectura.
            2. set. Callable. Función que dice cómo modificar el valor en la escritura.

            Ambos callables van a recibir como parámetro el valor actual. Y deben retornar el valor
            modificado.
        */
        // return Attribute::make(
        //     function($value) {
        //         return $value / 100;
        //     },
        //     function($value) {
        //         return $value * 100;
        //     }
        // );

        /*
            # Arrow functions en php
            php tiene soporte para definir funciones con una sintaxis de "arrow function".
            Sintaxis:
                fn (<params>) => <returnExpression>

            Dónde:
            - <params>
                Es la lista de parámetros de la función.
            - <returnExpression>
                Es la expresión de retorno.

            Las arrow function tiene 2 particularidades con respecto a las funciones normales de php.
            1. No pueden tener un cuerpo. Solo pueden tener una expresión de retorno.
            2. Tienen acceso a las variables del scope contenedor.
        */
        // return Attribute::make(
        //     fn ($value) => $value / 100,
        //     fn ($value) => $value * 100
        // );

        /*
            # Named arguments
            En php los argumentos, por defecto, siempre se pasan por posición.
            Esto significa que siempre:
                - Primero argumento => primer parámetro
                - Segundo argumento => segundo parámetro
                ...
            
            Para la mayoría de los casos esto funciona bien.
            Pero pueden ser un problema en algunos casos. Por ejemplo:
            1. Funciones que aceptan múltiples parámetros opcionales.
            2. Casos de funciones donde lo que los argumentos representan no son inmediatamente obvios.

            Por ejemplo, tomemos de ejemplo la función setcookie().
            Esta función nativa de php recibe hasta 7 parámetros:
                function setcookie(
                    string $name,
                    string $value = "",
                    int $expires_or_options = 0,
                    string $path = "",
                    string $domain = "",
                    bool $secure = false,
                    bool $httponly = false
                )

            De los cuales solo el primero es obligatorio, y el resto opcionales.

            ¿Qué pasa si queremos setear una cookie especificando solo el nombre (1er parámetro), el valor
            (2do parámetro) y que sea http-only (7mo valor)?
            Usando argumentos posicionales, no tenemos más remedio que escribir los 7, poniendo para los 
            argumentos restantes los valores defaults de manera manual.
            Por ejemplo:
                setcookie('mi-cookie', 'Un valor', 0, "", "", false, true);

            Ese código funciona, pero no es ni el más cómodo de escribir ni, mucho menos, el más cómodo de
            leer.
            No se vuelve inmediatamente obvio qué valor es un default y qué valor es el que estamos asignando.
            Tampoco es necesariamente claro qué representa cada valor.

            Para estos casos, php permite usar también los argumentos por su nombre ("named arguments").
            Esto significa que no pasamos los argumentos de manera que coincidan con el orden (no importa
            el orden que usemos), sino que vamos a especificar a cada uno a qué parámetro corresponde.
            Esto se hace escribiendo el nombre del parámetro (sin $) y un ":" (sin comillas).

            Por ejemplo, el setcookie anterior se puede rescribir:
                setcookie(
                    name: 'mi-cookie', 
                    value: 'Un valor', 
                    httponly: true
                );
        */
        return Attribute::make(
            get: fn ($value) => $value / 100,
            set: fn ($value) => $value * 100,
        );
    }

    /*
        # Definiendo las relaciones de SQL con Eloquent
        Para poder definir una relación entre dos tablas de SQL con Eloquent necesitamos como requisito
        tener modelos de ambas tablas.

        Teniendo de ambas clases, podemos definir la relación en cualquiera de las clases, o ambas.
        Dónde definimos va a depender de desde los modelos de qué clase es desde donde vamos a querer
        obtener los datos relacionados.
        Por ejemplo, nosotros vamos a relacionar movies y ratings.
        Para el uso que le estamos dando en nuestra aplicación, vamos a querer poder traer de cada película
        su clasificación. O sea, vamos a querer leer la clasificación desde la película. Por lo que vamos a
        tener que definir la relación en el modelo de Movie.

        Si quisiéramos, por otro lado, poder hacer una sección por clasificación en nuestra página. Por
        ejemplo, poder listar todas las películas que sean Aptas para todo público, o todas las que sean
        Mayores de 13 años, etc, ahí sí nos sería conveniente definir la relación en Rating. Así trayendo
        una clasificación podemos obtener todas las películas directamente.

        Y ahora sí, hablemos de cómo se definen.
        Para las definir las relaciones tenemos que definir un método por cada una que queramos poder usar.
        El nombre de este método va a definir el "nombre de la relación" dentro de Laravel. Este nombre va 
        a tener importancia en varios lugares.

        Este método solo necesita retornar una llamada al método de Eloquent que representa la relación.
        Por ejemplo, existen: hasOne, hasMany, belongsTo, belongsToMany, etc.

        En este caso, donde queremos definir la relación en la tabla referenciante de la relación 1-a-muchos
        entre ratings y movies tenemos que usar el método belongsTo().
        Este método recibe algunos parámetros:
        1. String. El FQN del modelo de la tabla relacionada.
        2. Opcional. String. El nombre del campo de la FK.
        3. Opcional. String. El nombre del campo de la PK referenciada.

        ## ¿Cómo se usa la relación?
        Una vez definida, para poder obtener los datos de los registros relacionados a un determinado modelo
        podemos usar la propiedad "dinámica" que Eloquent genera para este fin.
        Esa propiedad es una que se llama igual que el "nombre de la relación".
        Esto significa que si nosotros tenemos un objeto de Movie que contiene el registro con movie_id 1:
            $movie = Movie::findOrFail(1);

        Podemos obtener el objeto de Rating con los datos del registro relacionado con:
            $movie->rating            
    */
    public function rating()
    {
        return $this->belongsTo(Rating::class, 'rating_fk', 'rating_id');
    }

    /*
        # Relaciones de muchos-a-muchos con Eloquent
        Este tipo de relaciones se genera igual que cualquier otra, con la obvia distinción del método que
        usamos, que va a tener que retornar un llamado al método belongsToMany().
        Este método puede recibir varios parámetros:
            $related
                String. El FQN del modelo que representa la tabla relacionada.
            $table
                Opcional. String. El nombre de la tabla pivot.
            $foreignPivotKey
                Opcional. String. El nombre de la FK en la tabla pivot que referencia a la PK de la tabla
                    de *este* modelo.
            $relatedPivotKey
                Opcional. String. El nombre de la FK en la tabla pivot que referencia a la PK de la tabla
                    del *otro* modelo.
            $parentKey
                Opcional. String. El nombre de la PK de la tabla de *este* modelo.
            $relatedKey
                Opcional. String. El nombre de la PK de la tabla del *otro* modelo.

        ## ¿Cómo se usa esta relación?
        Igual que cualquier otra. Accediendo a la propiedad dinámica que se genera con el mismo nombre del
        método (que es el "nombre de la relación").
        En este caso, como es un "Many", en vez de un modelo con los datos del registro relacionado, vamos
        a tener una Collection de dichos modelos.
    */
    public function genres()
    {
        return $this->belongsToMany(
            Genre::class,
            'movies_have_genres',
            'movie_fk',
            'genre_fk',
            'movie_id',
            'genre_id',
        );
    }
}
