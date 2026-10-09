<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * Controlador de autenticación para el panel /admin.
 */
class AuthController extends Controller
{
    /**
     * Renderiza el formulario de acceso al panel.
     */
    public function loginForm(): View|RedirectResponse
    {
        if (Auth::check()) {
            return to_route('admin.dashboard');
        }

        return view('auth.login');
    }

    /**
     * Procesa el intento de login con Auth::attempt.
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

        return redirect()->intended(route('admin.dashboard'))
            ->with('feedback.message', '¡Bienvenido al panel!');
    }

    /**
     * Cierra la sesión actual y vuelve al login.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('auth.login.form')
            ->with('feedback.message', 'Sesión cerrada con éxito.');
    }
}
