<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

/**
 * Controlador de autenticación y registro sin scaffolding.
 */
class AuthController extends Controller
{
    /**
     * Muestra el formulario de inicio de sesión.
     */
    public function loginForm(): View|RedirectResponse
    {
        if (Auth::check()) {
            return Auth::user()?->isAdmin()
                ? to_route('admin.dashboard')
                : to_route('home');
        }

        return view('auth.login');
    }

    /**
     * Procesa el login y redirige según rol.
     */
    public function loginProcess(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'Necesitás ingresar un email.',
            'email.email' => 'El formato del email no es válido.',
            'password.required' => 'Necesitás ingresar una contraseña.',
            'password.min' => 'La contraseña debe tener al menos :min caracteres.',
        ]);

        if (! Auth::attempt($request->only(['email', 'password']))) {
            return back()
                ->withInput($request->except('password'))
                ->with('feedback.message', 'Credenciales incorrectas. Revisá tus datos e intentá nuevamente.');
        }

        $request->session()->regenerate();

        if (Auth::user()?->isAdmin()) {
            return redirect()->intended(route('admin.dashboard'))
                ->with('feedback.message', '¡Bienvenido al panel!');
        }

        return to_route('home')->with('feedback.message', '¡Bienvenido a DevHost Estudio!');
    }

    /**
     * Muestra el formulario de registro público.
     */
    public function registerForm(): View|RedirectResponse
    {
        if (Auth::check()) {
            return to_route('home');
        }

        return view('auth.register');
    }

    /**
     * Crea una nueva cuenta de usuario común y abre sesión.
     */
    public function registerProcess(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.min' => 'El nombre debe tener al menos :min caracteres.',
            'email.required' => 'El email es obligatorio.',
            'email.email' => 'El formato del email no es válido.',
            'email.unique' => 'Ese email ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos :min caracteres.',
            'password.confirmed' => 'La confirmación de contraseña no coincide.',
        ]);

        $user = User::query()->create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make((string) $request->input('password')),
            'role' => 'user',
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return to_route('home')->with('feedback.message', '¡Cuenta creada con éxito! Bienvenido/a a DevHost Estudio.');
    }

    /**
     * Cierra la sesión actual.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('home')->with('feedback.message', 'Sesión cerrada con éxito.');
    }
}
