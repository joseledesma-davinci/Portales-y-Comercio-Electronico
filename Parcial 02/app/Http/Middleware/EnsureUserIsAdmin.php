<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Middleware de autorización administrativa.
 *
 * Se centraliza acá para no repetir validaciones de rol en cada controlador
 * y para mantener una política de acceso consistente en todo el panel.
 */
class EnsureUserIsAdmin
{
    /**
     * Verifica autenticación y rol admin antes de continuar.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        if (! $request->user()) {
            return to_route('auth.login.form');
        }

        if (! $request->user()->isAdmin()) {
            return to_route('home')->with('feedback.error', 'No tenés permisos para acceder al panel de administración.');
        }

        return $next($request);
    }
}
