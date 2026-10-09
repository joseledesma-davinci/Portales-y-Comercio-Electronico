<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

/**
 * Controlador de autenticación manual para el panel admin.
 */
class AdminAuthController extends Controller
{
    /**
     * Muestra el formulario de ingreso al panel.
     */
    public function showLoginForm(): View|RedirectResponse
    {
        if (session()->has('admin_id')) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    /**
     * Procesa el login manual verificando credenciales con Hash::check.
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->validated();

        $user = User::query()->where('email', $credentials['email'])->first();

        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            return back()
                ->withErrors(['email' => 'No se pudo iniciar sesión. Verificá tus credenciales.'])
                ->withInput($request->except('password'));
        }

        $request->session()->regenerate();
        Session::put('admin_id', $user->id);
        Session::put('admin_name', $user->name);

        return redirect()->route('admin.dashboard')->with('success', '¡Bienvenido al panel, che!');
    }

    /**
     * Cierra la sesión de administrador actual.
     */
    public function logout(): RedirectResponse
    {
        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'Sesión cerrada correctamente.');
    }
}
