<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MoviesController extends Controller
{
    public function index()
    {
        /*
            # Traer las películas de la tabla `movies`
            Vamos a ver dos maneras de poder traer los datos de la tabla `movies`: Query Builder y Eloquent.

            ## Versión 1: Con el Query Builder
            Entre sus métodos, vimos que el Query Builder tiene "table()" que nos permite aclarar sobre
            qué tabla queremos armar un query.
            Una vez aclarado eso, podemos configurar qué consulta queremos realizar con qué características.
            Por ejemplo, si queremos realizar un SELECT, llamamos al método get().
            Importante: El método get() ejecuta la consulta como un SELECT, y retorna el resultado. Cualquier
            configuración (ej: filtros u ordenamientos) debe estar antes.

            El método get() retorna una "Collection" que contiene los datos de todos los registros que el
            SELECT obtiene transformados en objetos genéricos de php.

            Las "Collections" son clases de Laravel que funcionan como "wrappers" de arrays, y ofrecen múltiples
            métodos para poder manipular el array de manera conveniente.
        */
        // $movies = DB::table('movies')->get();

        /*
            ## Versión 2: Con Eloquent
            Si queremos traer todos los registros que tenemos en una tabla podemos usar el método all()
            de Eloquent.
            Esto nos retorna una Collection de instancias de la clase del modelo que corresponden a cada uno
            de los registros.
        */
        $movies = Movie::all();

        // dd => dump and die.
        // dd($movies);
    
        /*
            # Pasaje de datos a las vistas
            Por defecto, las vistas no tienen casi ninguna variable definida.
            Desde ya que las variables que definimos en el controller no están disponibles automáticamente
            en la vista, porque podría generar problemas.

            Si queremos que una vista reciba uno o más valores para renderizar tenemos que expresamente
            pasárselos en el segundo parámetro de la función "view()".
            Este parámetro debe ser un array asociativo donde las claves van a ser los nombres de las variables
            que queremos crear en la vista.
        */
        // return view('movies/index');
        return view('movies.index', [
            'movies' => $movies,
        ]);
    }

    public function show(int $id)
    {
        /*
            Para buscar y traer un registro por su PK con Eloquent podemos usar el método "find()".
            Este método retorna una instancia con los datos del registro que tenga como PK el argumento que
            le pasemos al método, o null si no se encuentra.
        */
        // $movie = Movie::find($id);

        /*
            Alternativamente, podemos usar el método findOrFail().
            Este método es idéntico a find(), pero si el registro no existe en vez de retornar null, 
            automáticamente lanza un 404.
        */
        $movie = Movie::findOrFail($id);

        return view('movies.show', [
            'movie' => $movie,
        ]);
    }

    public function create()
    {
        return view('movies.create');
    }

    /*
        # Cómo obtener los datos de la petición con Laravel
        Para todo lo referente a la petición (datos del query string, datos del body, cookies, sesiones, etc)
        Laravel ofrece su clase Request.
        Para poder obtener el objeto de esa clase con toda la data, simplemente tenemos que pedirle a Laravel
        que nos "inyecte" el objeto en la clase.
        Laravel cuenta con un "inyector de dependencias". Este es un patrón de diseño que nos permite en los
        métodos de ciertas clases puedan pedir que se le pasen datos directamente por sus parámetros.
        Para poder hacer la "inyección" solo tenemos que tipar el parámetro con la clase deseada.

        ¿Por qué usar Request y no $_POST?
        Hay varias razones:
            - $_POST es una súperglobal. O sea, es una variable global. Las variables globales apestan.
            - El uso de variables globales hace que sea comparativamente difícil el testing automatizado.
            - La clase Request es mucho más flexible. $_POST solo reconoce datos que lleguen enviados por
                un formulario. Request reconoce, además, datos que lleguen con formato JSON.
    */
    public function store(Request $request)
    {
        // dd($request->input());
        // dd($request->only(['title', 'price', 'release_date', 'synopsis'])); // "Whitelist"
        // dd($request->except(['cover', 'cover_description'])); // "Blacklist"

        $data = $request->only(['title', 'price', 'release_date', 'synopsis']);

        /*
            # Alta versión 1: creando el objeto y cargando manualmente los valores
        */
        $movie = new Movie();
        $movie->title = $data['title'];
        $movie->price = $data['price'];
        $movie->release_date = $data['release_date'];
        $movie->synopsis = $data['synopsis'];
        $movie->save();

        // Como *siempre* debemos hacer en cualquier petición que sea por POST, terminamos redireccionando a
        // otra página.
        // En Laravel, esto es tarea simple con el helper redirect().
        return redirect(url('/peliculas/listado'));

        // TODO: Mensajes de feedback. Presentar consigna TP1. Versión 2 del alta. Validación del form.
    }
}
