<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Controlador de blog público y ABM de publicaciones en admin.
 */
class PostsController extends Controller
{
    /**
     * Listado público de posts publicados.
     */
    public function index(): View
    {
        $posts = Post::query()
            ->with(['category', 'user'])
            ->whereNotNull('published_at')
            ->whereDate('published_at', '<=', now()->toDateString())
            ->orderByDesc('published_at')
            ->get();

        return view('posts.index', [
            'posts' => $posts,
        ]);
    }

    /**
     * Muestra un post publicado por id.
     */
    public function show(int $id): View
    {
        $post = Post::query()->with(['category', 'user'])->findOrFail($id);

        if ($post->published_at === null || $post->published_at->gt(now()->startOfDay())) {
            abort(404);
        }

        return view('posts.show', [
            'post' => $post,
        ]);
    }

    /**
     * Listado de publicaciones para administración.
     */
    public function adminIndex(): View
    {
        $posts = Post::query()
            ->with(['category', 'user'])
            ->orderByDesc('created_at')
            ->get();

        return view('admin.posts.index', [
            'posts' => $posts,
        ]);
    }

    /**
     * Formulario de alta de publicaciones.
     */
    public function create(): View
    {
        $categories = Category::query()->orderBy('name')->get();
        $post = new Post();
        $post->published_at = Carbon::now()->format('Y-m-d');

        return view('admin.posts.create', [
            'categories' => $categories,
            'post' => $post,
        ]);
    }

    /**
     * Persiste una nueva publicación.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|min:10|max:120',
            'synopsis' => 'required|min:20|max:240',
            'content' => 'required|min:120',
            'published_at' => 'nullable|date',
            'image' => 'nullable|string|max:100',
        ], [
            'category_id.required' => 'Seleccioná una categoría.',
            'category_id.exists' => 'La categoría elegida no existe.',
            'title.required' => 'El título es obligatorio.',
            'title.min' => 'El título debe tener al menos :min caracteres.',
            'title.max' => 'El título no puede superar :max caracteres.',
            'synopsis.required' => 'La sinopsis es obligatoria.',
            'synopsis.min' => 'La sinopsis debe tener al menos :min caracteres.',
            'synopsis.max' => 'La sinopsis no puede superar :max caracteres.',
            'content.required' => 'El contenido es obligatorio.',
            'content.min' => 'El contenido debe tener al menos :min caracteres.',
            'published_at.date' => 'La fecha de publicación no es válida.',
            'image.max' => 'El nombre de imagen no puede superar :max caracteres.',
        ]);

        $data = $request->only(['category_id', 'title', 'synopsis', 'content', 'published_at', 'image']);

        $data['user_id'] = (int) auth()->id();
        $data['published_at'] = $data['published_at'] ?: null;
        $data['image'] = $data['image'] ?: null;

        Post::query()->create($data);

        return to_route('admin.posts.index')
            ->with('feedback.message', 'Publicación creada correctamente.');
    }

    /**
     * Formulario de edición de una publicación.
     */
    public function edit(int $id): View
    {
        $post = Post::query()->findOrFail($id);
        $categories = Category::query()->orderBy('name')->get();

        return view('admin.posts.edit', [
            'post' => $post,
            'categories' => $categories,
        ]);
    }

    /**
     * Actualiza una publicación existente.
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|min:10|max:120',
            'synopsis' => 'required|min:20|max:240',
            'content' => 'required|min:120',
            'published_at' => 'nullable|date',
            'image' => 'nullable|string|max:100',
        ], [
            'category_id.required' => 'Seleccioná una categoría.',
            'category_id.exists' => 'La categoría elegida no existe.',
            'title.required' => 'El título es obligatorio.',
            'title.min' => 'El título debe tener al menos :min caracteres.',
            'title.max' => 'El título no puede superar :max caracteres.',
            'synopsis.required' => 'La sinopsis es obligatoria.',
            'synopsis.min' => 'La sinopsis debe tener al menos :min caracteres.',
            'synopsis.max' => 'La sinopsis no puede superar :max caracteres.',
            'content.required' => 'El contenido es obligatorio.',
            'content.min' => 'El contenido debe tener al menos :min caracteres.',
            'published_at.date' => 'La fecha de publicación no es válida.',
            'image.max' => 'El nombre de imagen no puede superar :max caracteres.',
        ]);

        $post = Post::query()->findOrFail($id);

        $data = $request->only(['category_id', 'title', 'synopsis', 'content', 'published_at', 'image']);
        $data['published_at'] = $data['published_at'] ?: null;
        $data['image'] = $data['image'] ?: null;

        $post->update($data);

        return to_route('admin.posts.index')
            ->with('feedback.message', 'Publicación actualizada correctamente.');
    }

    /**
     * Pantalla de confirmación para eliminar.
     */
    public function delete(int $id): View
    {
        $post = Post::query()->with(['category', 'user'])->findOrFail($id);

        return view('admin.posts.delete', [
            'post' => $post,
        ]);
    }

    /**
     * Elimina una publicación de forma definitiva.
     */
    public function destroy(Request $request, int $id): RedirectResponse
    {
        $post = Post::query()->findOrFail($id);
        $post->delete();

        return to_route('admin.posts.index')
            ->with('feedback.message', 'Publicación eliminada correctamente.');
    }
}
