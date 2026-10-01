<?php

use Illuminate\Support\Facades\Route;

/*
# Manejo de las rutas en Laravel
Por defecto, todas las rutas que van a existir en nuestra aplicación tienen que estar
definidas en este archivo.
Es decir, Laravel no utiliza un sistema de rutas por archivos.

Como no corresponden las rutas a archivos reales, ¿cómo hace Laravel para saber qué ruta
tiene que levantar en cada caso?
Siempre que el usuario haga alguna petición a Laravel de un archivo que no existe, 
automáticamente esa petición es redireccionada al archivo [public/index.php].

Ese archivo arranca la aplicación de Laravel, y carga y analiza el routeo.
Si encuentra una ruta que corresponda a lo que el usuario pide, la ejecuta.
De lo contrario, automáticamente muestra una página 404.

¿A qué llamamos exactamente una "ruta" (route) en términos de Laravel?
Una ruta es una combinación de 3 cosas que define una pantalla que existe en nuestra 
aplicación.
Esas 3 cosas son:
1. URL a partir de la raíz del sitio (carpeta [public/]).
2. Método HTTP que queremos que la petición reconozca (ej: get, post).
3. La acción a ejecutar para la ruta.

Para definir todo lo relacionado al routeo tenemos la clase de Laravel "Route".
Esta clase tiene un montón de métodos para definir rutas. Por ejemplo, tiene un método
por cada uno de los métodos / verbos de HTTP que Laravel soporta:
    get()
    post()
    put()
    patch()
    delete()
    options()

Todos esos métodos que listamos aceptan 2 parámetros obligatorios:
1. String. URL a partir de la raíz del sitio (carpeta [public/]).
2. Closure|String|Array. La acción a ejecutar para la ruta.

Por ejemplo, Laravel empieza con una ruta de ejemplo que es:
    Route::get('/', function () {
        return view('welcome');
    });

Ahí lo que hacemos es definir una ruta por GET a la raíz del sitio, que cuando se acceda
debe ejecutar ese Closure (función anónima) que representa la acción.
Las acciones, por su lado, generalmente van a retornar siempre una respuesta. Para crear
respuestas de una manera más ágil, Laravel ofrece varias funciones "helper", como view().
Esta función genera una respuesta a partir del contenido de una "vista" (template de HTML)
que exista en la carpeta de [resources/views/].


## Usando controllers como acciones
Si bien podemos usar Closures para las acciones, en general no suele ser una buena idea.
Los Closures pueden contener múltiples instrucciones y, dependiendo de la ruta a la que
pertenecen, pueden tener una gran variedad de responsabilidades. 
Esto eventualmente hace que el archivo de rutas se vuelvan gigante e inmantible.

La forma preferida de asignar acciones, en su lugar, es asignando métodos de "controllers"
a las rutas.

En Laravel, los controllers por defecto están en la carpeta [app/Http/Controllers].

Para usar un método de un controller como acción de una ruta, podemos pasar como parámetro
un array secuencial de 2 posiciones:
1. String. El FQN de la clase del controller.
2. String. El nombre del método.

Por ejemplo:
    [\App\Http\Controllers\HomeController::class, 'index']
*/

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);

Route::get('/nosotros', [\App\Http\Controllers\HomeController::class, 'about']);

Route::get('/peliculas/listado', [\App\Http\Controllers\MoviesController::class, 'index']);

/*
    # Parámetros de ruta en Laravel
    Con frecuencia nos encontramos con casos en una web donde tenemos una URL que necesita que uno o más
    de sus segmentos sean dinámicos.
    Por ejemplo, una pantalla que muestre los detalles de las películas podría usar una URL del tipo:
        /peliculas/1
        /peliculas/2
        /peliculas/3

    O sea, una ruta de "/peliculas/<aca-un-segmento-dinamico>".

    El router de Laravel nos permite representar este tipo de rutas con ayuda de los "parámetros de ruta"
    (route parameters).
    Estos parámetros nos permite definir segmentos de la URL que van a ser dinámicos y que se tienen que 
    poder capturar en variables para su posterior uso.

    La sintaxis para hacerlo es escribir un nombre del parámetro entre {} en el lugar del segmento.
    Por ejemplo:
        "/peliculas/{id}"

    Los valores de los parámetros de la ruta se van a pasar a las acciones asociadas como argumentos.
    Para recibirlos, la acción debe definir parámetros que se llamen igual que el parámetro de ruta 
    correspondiente.

    ## Acotando los valores aceptados por los parámetros
    Para asegurarnos de que un parámetro de ruta no trate de matchear valores no deseados podemos usar
    el método "where()" para indicar los posibles valores esperados.
    Este método recibe 2 parámetros:
        1. El nombre del parámetro de ruta, sin las {}.
        2. La expresión regular (regular expression o "regex") que define el formato.

    También podemos usar alguno de los métodos variantes de where que cubren los casos más comunes,
    como whereNumber()
*/
Route::get('/peliculas/{id}', [\App\Http\Controllers\MoviesController::class, 'show'])
    ->whereNumber('id');

Route::get('/peliculas/nueva', [\App\Http\Controllers\MoviesController::class, 'create']);
Route::post('/peliculas/nueva', [\App\Http\Controllers\MoviesController::class, 'store']);