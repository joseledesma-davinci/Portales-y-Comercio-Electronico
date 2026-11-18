<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
        // $movies = Movie::all();

        /*
            ## Versión 3: Cargando activamente las relaciones
            Cuando usamos relaciones con Eloquent, Laravel no carga de una todas las relaciones que un
            modelo tiene. Por razones obvias. Teniendo en cuenta que la mayoría de las tablas terminan
            estando relacionadas entre sí directa o indirectamente, se volvería un consumo de recursos
            enorme. Y todo por datos que es posible que no se tengan que usar.

            Por eso, Eloquent usa un approach de "lazy loading" (carga perezosa) para la carga de los 
            modelos. Es decir, los modelos de las relaciones no se buscan (no se hacen las consultas
            para traerlos) hasta que directamente pidamos usar la relación.

            Esto significa que si traemos muchos registros de un modelo (por ejemplo, muchas películas)
            que luego recorremos (por ejemplo, con un bucle) y en ese recorrido pedimos acceder a una
            relación (por ejemplo, clasificaciones) va a terminar haciendo una consulta por cada registro
            que hayamos traído.
            Laravel llama a este problema "N+1 queries".

            Durante desarrollo, esto puede pasar desapercibido. Habitualmente tenemos pocos registros
            en la base de datos, solo accedemos al sitio nosotros y es posible que nuestra PC sea 
            bastante más potente que el servidor.
            Pero se puede volver inmensamente notorio y problemático en el sitio en producción.
            Por lo que hay que estar muy atentos a esto.

            Por suerte, es de fácil solución.
            La solución es pedirle a Eloquet que haga un "eager loading" (carga anticipada) de los registros
            relacionados con ayuda del método with().
            Este método recibe como parámetro la(s) relación(es) que queremos que se carguen desde el
            comienzo.

            Nota: Luego de llamar a with() no podemos usar el all(). Por lo que para traer la info tenemos
            que en su lugar usar el método get().
        */
        // $movies = Movie::with(['rating', 'genres'])->get();
        
        /*
            # Paginación con Laravel y el Query Builder a través de Eloquent
            Una paginación es una tarea tediosa de realizar.
            Requiere hacer dos consultas (una para los datos, otra para el total de registros que hay)
            que tengo que mantener sincronizadas con los mismos requisitos de búsqueda.
            Requiere algunos cálculos simples para definir cuántas páginas hay que mostrar.
            Y requiere varioas condicionales y bucles para el armado del paginador en sí.

            El Query Builder (que usa Eloquent de base) incluye herramientas para generar fácilmente un
            paginador.
            Lo único que necesitamos hacer es reemplazar el método get() por el método paginate() y pasarle
            cuántos registros por página queremos.

            Ese método no solo pagina los resultados, trayendo por defecto los de la primera página, sino
            que nos ofrece un método para generar un paginador de HTML: links()

            Por defecto, el paginador utiliza Tailwind para la estilización.
            Trae soporte también para Bootstrap.
            Si preferimos esa alternativa, podemos simplemente definirlo en el [AppServiceProvider].
        */
        $movies = Movie::with(['rating', 'genres'])->paginate(2);

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

    public function show(Movie $movie)
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
        // $movie = Movie::findOrFail($id);

        return view('movies.show', [
            'movie' => $movie,
        ]);
    }

    public function create()
    {
        return view('movies.create', [
            'ratings' => Rating::all(),
            'genres' => Genre::orderBy('name')->get(),
        ]);
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

        $data = $request->only(['title', 'price', 'release_date', 'synopsis', 'cover_description', 'rating_fk']);

        /*
            # Upload de la portada con Laravel y su API Storage
            Para los archivos, los obtenemos con el objeto Request. Igual que cualquier otro dato.
            Pero en vez de usar el método input() vamos a usar el método file(). Esto nos va a dar
            un objeto UploadedFile. El cual tiene métodos útiles para guardar o manipular el archivo.

            Como en nuestro caso la portada (el archivo a guardar) es opcional, primero vamos a 
            preguntar si el usuario envió un archivo.

            Para guardar un archivo desde el UploadedFile con la API de Storage tenemos el método
            store() y el método storeAs().

            store() recibe 2 parámetros:
            1. La ruta donde queremos guardar el archivo (sin nombre de archivo, solo directorio).
            2. Opcional. El "disk" que queremos utilizar para guardar el archivo.

            store() genera un nombre único para el archivo automáticamente, y nos retorna la ruta
            que le corresponde al archivo en el almacenamiento.

            storeAs() es similar, pero acepta un segundo parámetro con el nombre del archivo que
            queremos usar.
        */
        if($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        }

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

        /*
            # Grabando datos en una tabla pivot de una relación muchos-a-muchos
            Como sabemos, para marcar las relaciones entre dos tablas que tienen una relación muchos-a-muchos
            necesitamos insertar lo que son los registros con los respectivos ids en la tabla pivot.

            Una solución sería, claro, hacer manualmente el insert.
            Pero también podemos aprovechar las ventajas que Eloquent nos ofrece.

            A través de uno de los modelos de la relación muchos-a-muchos (por ejemplo, Movie) nosotros
            podemos pedirle a Eloquent que haga los inserts de la tabla pivot de una relación de ese tipo.
            Para esto usamos el método "attach()" de la relación belongsToMany().
            Por ejemplo:
                $modelo->relacion()->attach();

            Nota: Noten que la relación tiene los paréntesis. No es la propiedad dinámica, sino el método
                real de la reación.

            Este método recibe uno o más ids (en formato de array) de la tabla relacionada y hace 
            automáticamente los inserts en la tabla pivot.
        */
        $movie->genres()->attach($request->input('genre_fks', []));

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
            'ratings' => Rating::all(),
            'genres' => Genre::orderBy('name')->get(),
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
        $oldCover = $movie->cover;

        $data = $request->only(['title', 'price', 'release_date', 'synopsis', 'cover_description', 'rating_fk']);
        
        if($request->hasFile('cover')) {
            // $data['cover'] = $request->file('cover')->store('covers', 'public');
            $data['cover'] = $request->file('cover')->store('covers');
        }

        $movie->update($data);

        /*
            # Edición de registros de la tabla pivot de una relación muchos-a-muchos
            En un editar, lo que normalmente vamos a recibir son los ids de los géneros (o cualquier otro
            modelo relacionado) que el usuario quiere que queden.

            Esto significa que según los ids que recibimos tenemos que tomar distintas acciones según los
            ids que existan como registros en la tabla pivot.
            Es decir:
                - Si alguno de los ids que recibimos no está ya presente en la tabla pivot (relacionado con
                    este modelo), entonces lo tenemos que insertar.
                - Si algunos de los ids que recibimos está presente en la tabla pivot, entonces ese queda
                    como está.
                - Si quedan registros en la tabla pivot que no figuren en el array que recibimos, esos los
                    tenemos que eliminar.

            Para poder fácilmente "sincronizar" los registros de la tabla pivot con los ids que recibimos, 
            la relación belongsToMany ofrece el método "sync()".

            El método sync() recibe uno o más ids (en forma de array) con los que queremos que queden.
        */
        $movie->genres()->sync($request->input('genre_fks', []));

        // Si cambiaron la imagen, y existe una vieja, la eliminamos.
        if(
            $request->hasFile('cover') &&
            $oldCover !== null &&
            Storage::exists($oldCover)
        ) {
            Storage::delete($oldCover);
        }

        return to_route('movies.index')
            ->with('feedback.message', 'La película ' . $movie->title . ' se actualizó con éxito.');
    }

    /*
        # Route Model Binding
        Esta es una herramienta que Laravel nos ofrece para poder automáticamente crear por nosotros los
        modelos que corresponden al id (u otro identificador) que recibimos en la ruta.

        Como sabemos, es muy común que en algunas rutas recibamos un identificador de un registro que
        corresponde a algún modelo de Eloquent.
        Este identificador, por ejemplo el id, lo recibimos y con él buscamos el registro usando el método
        find() o findOrFail() del modelo.

        Route Model Binding nos permite simplificar eso en un solo paso.

        Lo único que hacer es que tipar el parámetro que recibe el valor de la ruta con la clase del modelo.
    */
    public function delete(Movie $movie)
    {
        return view('movies.delete', [
            // 'movie' => Movie::findOrFail($id),
            'movie' => $movie,
        ]);
    }

    public function destroy(int $id)
    {
        $movie = Movie::findOrFail($id);

        /*
            # Eliminando los registros de las relaciones de muchos-a-muchos
            Así como tenemos un método "attach" que nos permite insertar registros en la tabla pivot de
            una relación muchos-a-muchos, también tenemos un método "detach" que nos permite hacer lo
            opuesto: eliminar los registros de la relación en la tabla pivot.
            
            El método detach() recibe uno o más ids (en forma de array) de la tabla relacionada que queremos
            eliminar de la relación con la tabla de este modelo.
            Si no pasamos ningún id, se eliminan todos.

            # Implementación de transacciones con el Query Builder
            Se pueden usar de dos maneras:
            1. Llamando a los métodos específicos de cada consulta de la transacción.
            2. Usando el método QueryBuilder::transaction().

            Este método QueryBuilder::transaction() recibe un callback con el código que queremos ejecutar.
            Se supone que al menos 2 consultas de escritura van a ser ejecutadas en ese callback.
            El método empieza primero iniciando una transacción.
            Luego ejecuta el callback.

            Si el callback se completa sin ningún error, el método transaction() ejecuta automáticamente un 
            commit.
            Si algún error ocurre, hace un rollback y arroja un nuevo error.

            ## Notas sobre el ámbito de variables en php
            php, como todos los lenguajes, con reglas para manejar los distintos "ámbitos" (scopes) de
            variables.
            php funciona mayormente con el concepto de "function scope" para las variables.
            Esto significa que las variables se definen dentro de la función donde se asignan (salvo las
            variables globales, pero esas no nos importan).
            Asimismo, las variables al leerse solo se buscan en el ámbito de la función donde estoy.
            Esto es una diferencia importante con JS.
            En JS hay una búsqueda de variables automáticamente dentro del "scope chain".

            En php, esto no aplica por defecto. Solo puedo ver las variables de mi ámbito.
            Pero php nos da una herramienta que nos permite pasar a un closure (función anónima) una o
            más variables del ámbito contenedor: use ()
        */
        try {
            DB::transaction(function() use ($movie) {
                $movie->genres()->detach();
                // throw new \Exception('Error al borrar la película.'); // Simulamos un error.
                $movie->delete();
            });

            if( $movie->cover !== null && Storage::exists($movie->cover) ) {
                Storage::delete($movie->cover);
            }

            return to_route('movies.index')
                ->with('feedback.message', 'La película ' . $movie->title . ' se eliminó con éxito.');
        } catch (\Throwable $th) {
            //throw $th;
            return to_route('movies.index')
                ->with('feedback.message', 'Ocurrió un error y la película no pudo ser eliminada.')
                ->with('feedback.status', 'danger');
        }
    }
}
