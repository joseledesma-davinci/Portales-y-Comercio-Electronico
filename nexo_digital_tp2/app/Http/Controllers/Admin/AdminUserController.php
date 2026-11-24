<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Controlador para gestionar usuarios desde el panel admin.
 */
class AdminUserController extends Controller
{
    /**
     * Lista usuarios paginados con conteo de suscripciones y buscador opcional.
     */
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('q', ''));

        $users = User::query()
            ->withCount('subscriptions')
            ->when($search !== '', function ($query) use ($search): void {
                $query->where(function ($subquery) use ($search): void {
                    $subquery->where('name', 'like', '%'.$search.'%')
                        ->orWhere('email', 'like', '%'.$search.'%');
                });
            })
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('admin.users.index', [
            'users' => $users,
            'search' => $search,
        ]);
    }

    /**
     * Muestra detalle de un usuario y sus servicios contratados.
     */
    public function show(int $id): View
    {
        $user = User::query()
            ->with(['subscriptions.service'])
            ->findOrFail($id);

        return view('admin.users.show', [
            'user' => $user,
        ]);
    }
}
