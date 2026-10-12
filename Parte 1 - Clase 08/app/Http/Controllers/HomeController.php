<?php
namespace App\Http\Controllers;

/*
En Laravel es común que los controllers hereden de la clase base "Controller".
Esto es porque no es raro que con el avanzar del proyecto varios controllers necesiten
cierta funcionalidad en común. Que ya hereden de la clase Controller permite que podamos
fácilmente agregar esa funcionalidad en dicha clase.
*/
class HomeController extends Controller
{
    public function index()
    {
        // La función recibe el nombre de la vista en la carpeta [resources/views/], pero sin
        // la extensión (ni ".blade.php" ni ".php").
        return view('welcome');
    }

    public function about()
    {
        return view('about');
    }
}