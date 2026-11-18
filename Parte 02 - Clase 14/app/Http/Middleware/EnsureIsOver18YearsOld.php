<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/*
    # Middleware
    Para definir un middleware solo necesitamos crear una clase común y corriente. No necesita heredar
    de ninguna otra clase, ni usar ningún trait, ni nada por el estilo.

    El único requisito que tienen es tener un método público "handle".
    Este método debe:
    1. Recibir un primer parámetro que sea el objeto Request.
    2. Recibir un segundo parámetro que sea un Closure.
    3. Retornar el siguiente paso a ejecutar.

    El objeto Request tiene, como sabemos, toda la data sobre la petición que se está realizando. Incluyendo
    los datos del form, del query string, cookies, sesión, la ruta, etc.
    El Closure contiene el siguiente paso que tocaría en el stack de ejecución (por ejemplo, el próximo
    middleware).

    Si queremos permitir que todo siga su camino, es imperativo que hagamos un return de ese Closure y le
    pasemos el objeto Request.

    Los middleware necesitan asociarse a una ruta de alguna manera. Solo por existir no hacen nada.

    Hay varias maneras de asignar middleware:
    - Por ruta
        Llamando al método middleware en la creación de la ruta.
    - Por grupo
    - Global
*/
class EnsureIsOver18YearsOld
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /*
            En este middleware queremos verificar si la película es solo para mayores de 18 años.
            De ser así, vamos a preguntar si el usuario ya confirmó que cumple con esto.
            Si no es así, lo redireccionamos a un formulario de confirmación para que pueda hacerlo.
            Si ya había confirmado la edad, entonces lo dejamos seguir.
        */
        // Buscamos la película. Necesitamos tener el id de la misma, que lo podemos encontrar en el
        // parámetro de ruta "id".
        $movie = $request->route('movie');

        if($movie->rating_fk == 4) {
            if(!session('is_over_18', false)) {
                return to_route('movies.age-verification.form', ['id' => $movie->movie_id]);
            }
        }

        return $next($request);
    }
}
