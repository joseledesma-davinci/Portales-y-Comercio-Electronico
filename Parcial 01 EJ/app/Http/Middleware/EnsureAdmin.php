<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Middleware que exige sesión de administrador para acceder al panel.
 */
class EnsureAdmin
{
    /**
     * Maneja la solicitud entrante y valida que exista admin_id en sesión.
     *
     * @param  Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->session()->has('admin_id')) {
            return redirect()->route('admin.login')->with('error', 'Necesitás iniciar sesión para entrar al panel.');
        }

        return $next($request);
    }
}
