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
        <label for="image">Nombre de imagen (opcional)</label>
        <input type="text" id="image" name="image" placeholder="ej: blog-seguridad.jpg" value="{{ old('image', $post?->image) }}">
        @error('image')
            <small class="field-error">{{ $message }}</small>
        @enderror
    </div>
</div>
