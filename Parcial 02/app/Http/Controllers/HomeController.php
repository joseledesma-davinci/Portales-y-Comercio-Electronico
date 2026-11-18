<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Service;
use Illuminate\Contracts\View\View;

/**
 * Controlador de la portada pública del estudio.
 */
class HomeController extends Controller
{
    /**
     * Muestra el home con servicios destacados y últimas publicaciones.
     */
    public function index(): View
    {
        $services = Service::query()
            ->where('is_active', true)
            ->orderBy('price')
            ->take(3)
            ->get();

        $posts = Post::query()
            ->with('category')
            ->whereNotNull('published_at')
            ->whereDate('published_at', '<=', now()->toDateString())
            ->orderByDesc('published_at')
            ->take(3)
            ->get();

        return view('home', [
            'services' => $services,
            'posts' => $posts,
        ]);
    }
}
