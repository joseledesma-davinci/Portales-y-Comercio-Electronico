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
        /*
            # Validación de los datos recibidos
            La clase Request incluye un método (o "macro") "validate()" que nos permite aplicar
            validaciones a los valores recibidos.

            Este método recibe un parámetro obligatorio que es un array asociativo con las reglas de 
            validación para cada campo.
            Las claves del array deben ser los nombres de los parámetros recibidos que queremos validar.
            Y los valores del array deben ser la lista de reglas de validación a aplicar a ese campo.
            Las reglas se pueden pasar como un array secuencial, o como un único string separando las
            reglas con un "|".

            La lista completa de reglas de validación disponibles las pueden ver en la documentación:
            https://laravel.com/framework/docs/validation#available-validation-rules

            El método validate() hace varias cosas:
            - Aplica las validaciones.
                - Si todas las validaciones pasan con éxito, entonces retorna un array con los valores 
                    validados.
                - Si una o más reglas de validación fallan, entonces:
                    - Si la petición no parece provenir de un formulario de HTML (sino que parece hecha por
                        Ajax, o recibida de una petición HTTP manual, etc), entonces imprime en pantalla
                        un JSON con los mensajes de error, y termina la petición.
                    - Si la petición es de un formulario de HTML, entonces:
                            - "Flashea" todos los valores recibidos del form en la sesión. Estos datos
                                se pueden acceder fácilmente con la función old().
                            - "Flashea" todos los mensajes de error de la validación en la sesion.
                            - Redirecciona a la página de la que venimos.


            Adicionalmente, Laravel nos permite pasar un segundo parámetro a validate() donde definamos los
            mensajes de error personalizados para nuestros campos.
        */
        $request->validate([
            // 'title' => ['required', 'min:2'],
            'title' => 'required|min:2',
            'price' => 'required|numeric',
            'release_date' => 'required',
            'synopsis' => 'required',
        ], [
            'title.required' => 'El campo título tiene que tener un valor.',
            'title.min' => 'El campo título tiene que tener al menos :min caracteres.',
            'price.required' => 'El campo precio tiene que tener un valor.',
            'price.numeric' => 'El campo precio tiene que tener un valor numérico.',
            'release_date.required' => 'El campo fecha de estreno tiene que tener un valor.',
            'synopsis.required' => 'El campo sinopsis tiene que tener un valor.',
        ]);

        // dd($request->input());
        // dd($request->only(['title', 'price', 'release_date', 'synopsis'])); // "Whitelist"
        // dd($request->except(['cover', 'cover_description'])); // "Blacklist"

        $data = $request->only(['title', 'price', 'release_date', 'synopsis']);

        /*
            # Alta versión 1: creando el objeto y cargando manualmente los valores
        */
        // $movie = new Movie();
        // $movie->title = $data['title'];
        // $movie->price = $data['price'];
        // $movie->release_date = $data['release_date'];
        // $movie->synopsis = $data['synopsis'];
        // $movie->save();

        /*
            # Alta versión 2: usando el método "create()" del modelo
            Este método acepta un array asociativo de valores, donde las claves deben coincidir con los 
            campos de la tabla que queremos asignarles un valor.
            "create()" depende del uso de lo que llamamos "mass assignment" (asignación masiva) para 
            cargar los datos del array.
            Mass assignment es, en Laravel, el proceso de aceptar el array con las claves para completar los
            valores de los campos del modelo.
            Por razones de seguridad, para permitir hacer el mass assignment en un modelo determinado, 
            necesitamos definir dentro de su clase qué columnas son a las que queremos permitir asignarles
            valores de esta manera.
        */
        $movie = Movie::create($data);

        // Como *siempre* debemos hacer en cualquier petición que sea por POST, terminamos redireccionando a
        // otra página.
        // En Laravel, esto es tarea simple con el helper redirect().
        // return redirect(url('/peliculas/listado'))
        // return redirect(route('movies.index'))
        // return redirect()
        //     ->route('movies.index')
        // to_route() genera un redireccionamiento a una ruta por su nombre.
        return to_route('movies.index')
            // El método "with()" del redirect "flashea" un valor en la sesión.
            // "Flashear", en este contexto, significa que el valor existe solo por el siguiente renderizado.
            // Es muy útil para cosas como mensajes de feedback, pasaje de mensajes de error, etc.
            ->with('feedback.message', 'La película ' . $movie->title . ' se publicó con éxito.');
    }

    public function edit(int $id)
    {
        return view('movies.edit', [
            'movie' => Movie::findOrFail($id),
        ]);
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'title' => 'required|min:2',
            'price' => 'required|numeric',
            'release_date' => 'required',
            'synopsis' => 'required',
        ], [
            'title.required' => 'El campo título tiene que tener un valor.',
            'title.min' => 'El campo título tiene que tener al menos :min caracteres.',
            'price.required' => 'El campo precio tiene que tener un valor.',
            'price.numeric' => 'El campo precio tiene que tener un valor numérico.',
            'release_date.required' => 'El campo fecha de estreno tiene que tener un valor.',
            'synopsis.required' => 'El campo sinopsis tiene que tener un valor.',
        ]);
        
        $movie = Movie::findOrFail($id);

        $data = $request->only(['title', 'price', 'release_date', 'synopsis']);

        $movie->update($data);

        return to_route('movies.index')
            ->with('feedback.message', 'La película ' . $movie->title . ' se actualizó con éxito.');
    }

    public function delete(int $id)
    {
        return view('movies.delete', [
            'movie' => Movie::findOrFail($id),
        ]);
    }

    public function destroy(int $id)
    {
        $movie = Movie::findOrFail($id);

        $movie->delete();

        return to_route('movies.index')
            ->with('feedback.message', 'La película ' . $movie->title . ' se eliminó con éxito.');
    }
}
