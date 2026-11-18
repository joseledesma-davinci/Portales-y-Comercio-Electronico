<?php

namespace App\Http\Controllers;

use App\Mail\MovieReservationRegistered;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MoviesReservationController extends Controller
{
    public function register(int $id)
    {
        /*
            # Envío de emails
            Para pedir que un email se envíe usamos la façade de Mail.
            Esta fachada tiene el método Mail::to() que acepta una o varias (como un array) direcciones
            de emails a dónde enviar un correo.
            Cada correo puede ser:
            - String.
            - Objeto user con una propiedad "email".
            - Objeto Address.
            - Un array compuesto de los anteriores.

            Una vez definido el to() podemos encadenar el método send() que recibe el objeto Mailable a enviar.
        */
        $movie = Movie::findOrFail($id);
        Mail::to(Auth::user())->send(new MovieReservationRegistered($movie));

        return to_route('movies.index')
            ->with('feedback.message', 'La película ' . $movie->title . ' se reservó con éxito.');
    }
}
