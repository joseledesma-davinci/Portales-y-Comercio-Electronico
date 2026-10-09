@php
    /** @var \App\Models\Post|null $post */
@endphp

<div class="form-grid">
    <div class="form-group">
        <label for="title">Título</label>
        <input id="title" name="title" type="text" value="{{ old('title', $post?->title) }}">
        @error('title')
            <small class="field-error">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="slug">Slug (opcional)</label>
        <input id="slug" name="slug" type="text" value="{{ old('slug', $post?->slug) }}">
        @error('slug')
            <small class="field-error">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="category_id">Categoría</label>
        <select id="category_id" name="category_id">
            <option value="">Elegí una categoría</option>
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
        <label for="status">Estado</label>
        <select id="status" name="status">
            <option value="publicado" @selected(old('status', $post?->status) === 'publicado')>Publicado</option>
            <option value="borrador" @selected(old('status', $post?->status) === 'borrador')>Borrador</option>
        </select>
        @error('status')
            <small class="field-error">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="reading_time_minutes">Tiempo de lectura (minutos)</label>
        <input id="reading_time_minutes" name="reading_time_minutes" type="number" value="{{ old('reading_time_minutes', $post?->reading_time_minutes ?? 5) }}">
        @error('reading_time_minutes')
            <small class="field-error">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group form-group-full">
        <label for="excerpt">Bajada</label>
        <textarea id="excerpt" name="excerpt" rows="3">{{ old('excerpt', $post?->excerpt) }}</textarea>
        @error('excerpt')
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
</div>
