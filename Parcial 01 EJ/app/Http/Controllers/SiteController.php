<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Service;
use Illuminate\Contracts\View\View;

/**
 * Controlador público del sitio institucional.
 */
class SiteController extends Controller
{
    /**
     * Muestra la home con servicios destacados y últimas publicaciones.
     */
    public function index(): View
    {
        $services = Service::query()
            ->where('active', true)
            ->orderByDesc('featured')
            ->orderBy('price')
            ->take(3)
            ->get();

        $posts = Post::query()
            ->with('category')
            ->where('status', 'publicado')
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('home', compact('services', 'posts'));
    }

    /**
     * Muestra el catálogo de servicios ofrecidos.
     */
    public function services(): View
    {
        $services = Service::query()
            ->where('active', true)
            ->orderByDesc('featured')
            ->orderBy('price')
            ->get();

        return view('services', compact('services'));
    }

    /**
     * Lista paginada del blog público.
     */
    public function blog(): View
    {
        $posts = Post::query()
            ->with('category')
            ->where('status', 'publicado')
            ->latest('published_at')
            ->paginate(5)
            ->withQueryString();

        return view('blog.index', compact('posts'));
    }

    /**
     * Muestra el detalle de una publicación del blog.
     */
    public function post(Post $post): View
    {
        abort_unless($post->status === 'publicado', 404);

        return view('blog.show', compact('post'));
    }
}
