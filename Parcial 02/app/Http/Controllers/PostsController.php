<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

/**
 * Controlador de blog público y ABM administrativo de publicaciones.
 */
class PostsController extends Controller
{
    /**
     * Lista de posts públicos publicados.
     */
    public function index(): View
    {
        $posts = Post::query()
            ->with(['category', 'user'])
            ->whereNotNull('published_at')
            ->whereDate('published_at', '<=', now()->toDateString())
            ->orderByDesc('published_at')
            ->paginate(5)
            ->withQueryString();

        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Muestra el detalle de una publicación pública.
     */
    public function show(int $id): View
    {
        $post = Post::query()->with(['category', 'user'])->findOrFail($id);

        if ($post->published_at === null || $post->published_at->gt(now()->startOfDay())) {
            abort(404);
        }

        return view('posts.show', ['post' => $post]);
    }

    /**
     * Lista administrativa de publicaciones.
     */
    public function adminIndex(): View
    {
        $posts = Post::query()
            ->with(['category', 'user'])
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        return view('admin.posts.index', ['posts' => $posts]);
    }

    /**
     * Formulario de alta de posts.
     */
    public function create(): View
    {
        $categories = Category::query()->orderBy('name')->get();

        return view('admin.posts.create', ['categories' => $categories]);
    }

    /**
     * Guarda una publicación nueva con soporte de upload real de imagen.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|min:10|max:120',
            'synopsis' => 'required|min:20|max:240',
            'content' => 'required|min:120',
            'published_at' => 'nullable|date|after_or_equal:today',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
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
            'published_at.after_or_equal' => 'La fecha de publicación no puede ser anterior a hoy.',
            'image.image' => 'El archivo de imagen debe ser una imagen válida.',
            'image.mimes' => 'La imagen debe estar en formato JPG, JPEG, PNG o WEBP.',
            'image.max' => 'La imagen no puede superar los 2 MB.',
        ]);

        $data = $request->only(['category_id', 'title', 'synopsis', 'content', 'published_at']);
        $data['user_id'] = (int) auth()->id();
        $data['published_at'] = $data['published_at'] ?: null;
        $data['image'] = null;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        Post::query()->create($data);

        return to_route('admin.posts.index')->with('feedback.message', 'Publicación creada correctamente.');
    }

    /**
     * Formulario de edición de un post.
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
     * Actualiza una publicación y reemplaza imagen previa cuando corresponde.
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|min:10|max:120',
            'synopsis' => 'required|min:20|max:240',
            'content' => 'required|min:120',
            'published_at' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
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
            'image.image' => 'El archivo de imagen debe ser una imagen válida.',
            'image.mimes' => 'La imagen debe estar en formato JPG, JPEG, PNG o WEBP.',
            'image.max' => 'La imagen no puede superar los 2 MB.',
        ]);

        $post = Post::query()->findOrFail($id);

        $data = $request->only(['category_id', 'title', 'synopsis', 'content', 'published_at']);
        $data['published_at'] = $data['published_at'] ?: null;

        if ($request->hasFile('image')) {
            if ($post->image && str_starts_with($post->image, 'posts/')) {
                Storage::disk('public')->delete($post->image);
            }

            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($data);

        return to_route('admin.posts.index')->with('feedback.message', 'Publicación actualizada correctamente.');
    }

    /**
     * Vista de confirmación de borrado.
     */
    public function delete(int $id): View
    {
        $post = Post::query()->with(['category', 'user'])->findOrFail($id);

        return view('admin.posts.delete', ['post' => $post]);
    }

    /**
     * Borra una publicación y su archivo subido si aplica.
     */
    public function destroy(Request $request, int $id): RedirectResponse
    {
        $post = Post::query()->findOrFail($id);

        if ($post->image && str_starts_with($post->image, 'posts/')) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return to_route('admin.posts.index')->with('feedback.message', 'Publicación eliminada correctamente.');
    }
}
