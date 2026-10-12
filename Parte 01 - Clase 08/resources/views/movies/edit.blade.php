<x-layouts.main>
    <x-slot:title>Editar {{ $movie->title }}</x-slot:title>

    <h1>Editar {{ $movie->title }}</h1>

    @if($errors->any())
        <div class="alert alert-danger">Hay errores en los datos enviados. Por favor, revisá los datos que tienen un error y probá de enviar el formulario de nuevo.</div>
    @endif

    <form action="{{ route('movies.update', ['id' => $movie->movie_id]) }}" method="post">
        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input
                type="text"
                id="title"
                name="title"
                @class([
                    'form-control',
                    'is-invalid' => $errors->has('title'),
                ])
                @error('title')
                aria-invalid="true"
                aria-errormessage="error-title"
                @enderror
                value="{{ old('title', $movie->title) }}"
            >
            @error('title')
                <div class="text-danger" id="error-title">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Precio</label>
            <input
                type="text"
                id="price"
                name="price"
                @class([
                    'form-control',
                    'is-invalid' => $errors->has('price'),
                ])
                @error('price')
                aria-invalid="true"
                aria-errormessage="error-price"
                @enderror
                value="{{ old('price', $movie->price) }}"
            >
            @error('price')
                <div class="text-danger" id="error-price">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="release_date" class="form-label">Fecha de estreno</label>
            <input
                type="date"
                id="release_date"
                name="release_date"
                @class([
                    'form-control',
                    'is-invalid' => $errors->has('release_date'),
                ])
                @error('release_date')
                aria-invalid="true"
                aria-errormessage="error-release_date"
                @enderror
                value="{{ old('release_date', $movie->release_date) }}"
            >
            @error('release_date')
                <div class="text-danger" id="error-release_date">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="synopsis" class="form-label">Sinopsis</label>
            <textarea
                id="synopsis"
                name="synopsis"
                @class([
                    'form-control',
                    'is-invalid' => $errors->has('synopsis'),
                ])
                @error('synopsis')
                aria-invalid="true"
                aria-errormessage="error-synopsis"
                @enderror
            >{{ old('synopsis', $movie->synopsis) }}</textarea>
            @error('synopsis')
                <div class="text-danger" id="error-synopsis">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="cover" class="form-label">Portada (coming soon&trade;)</label>
            <input
                type="file"
                id="cover"
                name="cover"
                @class([
                    'form-control',
                    'is-invalid' => $errors->has('cover'),
                ])
                @error('cover')
                aria-invalid="true"
                aria-errormessage="error-cover"
                @enderror
            >
            @error('cover')
                <div class="text-danger" id="error-cover">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="cover_description" class="form-label">Descripción de la portada (coming soon&trade;)</label>
            <input
                type="text"
                id="cover_description"
                name="cover_description"
                @class([
                    'form-control',
                    'is-invalid' => $errors->has('cover_description'),
                ])
                @error('cover_description')
                aria-invalid="true"
                aria-errormessage="error-cover_description"
                @enderror
                value="{{ old('cover_description', $movie->cover_description) }}"
            >
            @error('cover_description')
                <div class="text-danger" id="error-cover_description">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</x-layouts.main>