<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Request para validar la edición de publicaciones.
 */
class PostUpdateRequest extends FormRequest
{
    /**
     * Autoriza la operación para usuarios autenticados del panel.
     */
    public function authorize(): bool
    {
        return $this->session()->has('admin_id');
    }

    /**
     * Reglas de validación para actualizar publicaciones.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $postId = (int) $this->route('post')->id;

        return [
            'category_id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'string', 'min:10', 'max:120'],
            'slug' => ['nullable', 'string', 'max:140', Rule::unique('posts', 'slug')->ignore($postId)],
            'excerpt' => ['required', 'string', 'min:20', 'max:240'],
            'content' => ['required', 'string', 'min:120'],
            'status' => ['required', 'in:publicado,borrador'],
            'reading_time_minutes' => ['required', 'integer', 'min:1', 'max:60'],
        ];
    }

    /**
     * Mensajes de error amigables para edición.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'category_id.required' => 'Seleccioná una categoría para el artículo.',
            'category_id.exists' => 'La categoría elegida no existe.',
            'title.required' => 'Escribí un título para la publicación.',
            'title.min' => 'El título debe tener al menos :min caracteres.',
            'slug.unique' => 'Ese slug ya está en uso, elegí otro.',
            'excerpt.required' => 'Agregá una bajada para resumir el contenido.',
            'content.required' => 'El contenido completo es obligatorio.',
            'content.min' => 'El contenido debe tener al menos :min caracteres.',
            'status.required' => 'Elegí el estado de la publicación.',
            'status.in' => 'El estado seleccionado no es válido.',
            'reading_time_minutes.required' => 'Indicá el tiempo estimado de lectura.',
            'reading_time_minutes.integer' => 'El tiempo de lectura debe ser numérico.',
        ];
    }
}
