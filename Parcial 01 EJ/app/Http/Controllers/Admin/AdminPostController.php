<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

/**
 * ABM de publicaciones del blog en el panel administrativo.
 */
class AdminPostController extends Controller
{
    /**
     * Redirige el índice del recurso al dashboard principal.
     */
    public function index(): RedirectResponse
    {
        return redirect()->route('admin.dashboard');
    }

    /**
     * Muestra el formulario de alta de publicaciones.
     */
    public function create(): View
    {
        $categories = Category::query()->orderBy('name')->get();

        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Guarda una nueva publicación con validación server-side.
     */
    public function store(PostStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $slug = Str::slug($data['slug'] ?: $data['title']);

        Post::query()->create([
            'user_id' => (int) session('admin_id'),
            'category_id' => $data['category_id'],
            'title' => $data['title'],
            'slug' => $slug,
            'excerpt' => $data['excerpt'],
            'content' => $data['content'],
            'status' => $data['status'],
            'reading_time_minutes' => $data['reading_time_minutes'],
            'published_at' => $data['status'] === 'publicado' ? now() : null,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Publicación creada correctamente.');
    }

    /**
     * Muestra el formulario de edición de una publicación.
     */
    public function edit(Post $post): View
    {
        $categories = Category::query()->orderBy('name')->get();

        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Actualiza una publicación existente.
     */
    public function update(PostUpdateRequest $request, Post $post): RedirectResponse
    {
        $data = $request->validated();

        $slug = Str::slug($data['slug'] ?: $data['title']);

        $post->update([
            'category_id' => $data['category_id'],
            'title' => $data['title'],
            'slug' => $slug,
            'excerpt' => $data['excerpt'],
            'content' => $data['content'],
            'status' => $data['status'],
            'reading_time_minutes' => $data['reading_time_minutes'],
            'published_at' => $data['status'] === 'publicado' ? ($post->published_at ?? now()) : null,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Publicación actualizada correctamente.');
    }

    /**
     * Elimina una publicación del sistema.
     */
    public function destroy(Request $request, Post $post): RedirectResponse
    {
        if ((int) session('admin_id') === (int) $post->user_id && Post::query()->count() === 1) {
            return back()->with('error', 'No podés borrar la única publicación existente del panel.');
        }

        $post->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Publicación eliminada correctamente.');
    }
}
