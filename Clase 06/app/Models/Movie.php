<?php

namespace App\Models;

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
}
