<?php
// $movie->load('genres');
// echo "<pre>";
// print_r($movie->genres->pluck('genre_id')->all());
// echo "</pre>";

// TODO: Mover esto a un método del modelo.
$genreIds = $movie->genres->pluck('genre_id')->all();
?>
<x-layouts.main>
    <x-slot:title>Editar {{ $movie->title }}</x-slot:title>

    <h1>Editar {{ $movie->title }}</h1>

    @if($errors->any())
        <div class="alert alert-danger">Hay errores en los datos enviados. Por favor, revisá los datos que tienen un error y probá de enviar el formulario de nuevo.</div>
    @endif

    <form action="{{ route('movies.update', ['id' => $movie->movie_id]) }}" method="post" enctype="multipart/form-data">
        @csrf
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
            <label for="rating_fk" class="form-label">Clasificación</label>
            <select
                id="rating_fk"
                name="rating_fk"
                @class([
                    'form-control',
                    'is-invalid' => $errors->has('rating_fk'),
                ])
                @error('rating_fk')
                aria-invalid="true"
                aria-errormessage="error-rating_fk"
                @enderror
            >
                @foreach($ratings as $rating)
                <option
                    value="{{ $rating->rating_id }}"
                    @selected($rating->rating_id == old('rating_fk', $movie->rating_fk))
                >
                    {{ $rating->name }} ({{ $rating->abbreviation }})
                </option>
                @endforeach
            </select>
            @error('rating_fk')
                <div class="text-danger" id="error-rating_fk">{{ $message }}</div>
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
            <div class="mb-2">Portada actual</div>
                @if($movie->cover && \Storage::exists($movie->cover))
                    <div class="col-2">
                        <img src="{{ \Storage::url($movie->cover) }}" alt="" class="img-fluid">
                    </div>
                @else
                    Sin portada
                @endif
        </div>
        <div class="mb-3">
            <label for="cover" class="form-label">Portada (opcional)</label>
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
                aria-describedby="help-cover"
            >
            <div class="text-muted" id="help-cover">Solo seleccioná una portada si querés cambiar la actual</div>
            @error('cover')
                <div class="text-danger" id="error-cover">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="cover_description" class="form-label">Descripción de la portada (opcional)</label>
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

        <fieldset class="mb-3">
            <legend>Géneros</legend>

            @foreach($genres as $genre)
            <label class="me-3">
                <input
                    type="checkbox"
                    name="genre_fks[]"
                    value="{{ $genre->genre_id }}"
                    @checked(in_array($genre->genre_id, old('genre_fks', $genreIds)))
                >
                {{ $genre->name }}
            </label>
            @endforeach
        </fieldset>

        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</x-layouts.main>