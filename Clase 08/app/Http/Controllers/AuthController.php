<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function loginProcess(Request $request)
    {
        // TODO: Validar...

        /*
            # Uso de la autenticación de Laravel
            Para manejar la autenticación Laravel ofrece la clase Auth, que la podemos acceder desde
            la fachada Auth o desde la función auth().

            Esta clase va a tener múltiples métodos para aprovechar. Empezando por el método
            Auth::attempt().
            Este método intenta autenticar a un usuario con las credenciales que le pasemos como argumento.
            Si tiene éxito, autentica al usuario y retorna true. De lo contrario, retorna false.
            Las credenciales se las tenemos que pasar como un array asociativo que tenga, al menos, 2
            valores:
            1. Una clave "password" con el valor del password. *Debe* llamarse la clave "password".
            2. Al menos un campo más con el que buscar al usuario.

            La idea es que todos los campos de las credenciales que pasemos y *no* sean el password
            se van a usar para buscar al usuario en el almacenamiento.
        */
        $credentials = $request->only(['email', 'password']);

        if( !Auth::attempt($credentials) ) {
            return to_route('auth.login.form')
                // withInput() es el método que flashea los valores del formulario en la sesión.
                ->withInput()
                ->with('feedback.message', 'Las credenciales ingresadas no coinciden con nuestros registros.');
        }

        // ¡El usuario está autenticado \o/!
        return to_route('movies.index')
            ->with('feedback.message', 'Sesión iniciada con éxito. ¡Hola de nuevo!');
    }

    public function logout()
    {
        // TODO: Arreglar el precio. Upload de archivos.
        Auth::logout();

        return to_route('auth.login.form')
            ->with('feedback.message', 'Sesión cerrada con éxito. ¡Te esperamos de nuevo!');
    }
}
