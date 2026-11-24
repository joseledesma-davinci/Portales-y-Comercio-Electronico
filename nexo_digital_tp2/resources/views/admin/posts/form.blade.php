<div class="form-grid">
    <div class="form-group">
        <label for="category_id">Categoría</label>
        <select id="category_id" name="category_id">
            <option value="">Seleccioná una categoría</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" @selected((string) old('category_id', $post?->category_id) === (string) $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id')
            <small class="field-error">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="published_at">Fecha de publicación</label>
        <input type="date" id="published_at" name="published_at" value="{{ old('published_at', optional($post?->published_at)->format('Y-m-d')) }}">
        @error('published_at')
            <small class="field-error">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group form-group-full">
        <label for="title">Título</label>
        <input type="text" id="title" name="title" value="{{ old('title', $post?->title) }}">
        @error('title')
            <small class="field-error">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group form-group-full">
        <label for="synopsis">Sinopsis</label>
        <textarea id="synopsis" name="synopsis" rows="3">{{ old('synopsis', $post?->synopsis) }}</textarea>
        @error('synopsis')
            <small class="field-error">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group form-group-full">
        <label for="content">Contenido</label>
        <textarea id="content" name="content" rows="10">{{ old('content', $post?->content) }}</textarea>
        @error('content')
            <small class="field-error">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group form-group-full">
        <label for="image">Imagen (JPG, JPEG, PNG, WEBP — máximo 2MB)</label>
        <input type="file" id="image" name="image" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">
        @error('image')
            <small class="field-error">{{ $message }}</small>
        @enderror

        @if($post && $post->image_url)
            <p style="margin: 0.6rem 0 0.3rem;"><strong>Imagen actual:</strong></p>
            <img src="{{ $post->image_url }}" alt="Vista previa de imagen actual" style="max-width: 260px; border-radius: 10px; border: 1px solid #dbe4ef;">
        @endif
    </div>
</div>
