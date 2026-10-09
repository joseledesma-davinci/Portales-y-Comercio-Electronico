<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Service;
use Illuminate\Contracts\View\View;

/**
 * Controlador del dashboard administrativo.
 */
class DashboardController extends Controller
{
    /**
     * Muestra métricas simples y listado de publicaciones.
     */
    public function index(): View
    {
        $posts = Post::query()
            ->with(['category', 'author'])
            ->latest()
            ->paginate(8)
            ->withQueryString();

        $stats = [
            'publicaciones' => Post::query()->count(),
            'publicadas' => Post::query()->where('status', 'publicado')->count(),
            'servicios_activos' => Service::query()->where('active', true)->count(),
        ];

        return view('admin.dashboard', compact('posts', 'stats'));
    }
}
