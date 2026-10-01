<x-layouts.main>
    <x-slot:title>Publicar una nueva película</x-slot:title>

    <h1>Publicar una nueva película</h1>

    <form action="{{ url('/peliculas/nueva') }}" method="post">
        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input
                type="text"
                id="title"
                name="title"
                class="form-control"
            >
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Precio</label>
            <input
                type="text"
                id="price"
                name="price"
                class="form-control"
            >
        </div>
        <div class="mb-3">
            <label for="release_date" class="form-label">Fecha de estreno</label>
            <input
                type="date"
                id="release_date"
                name="release_date"
                class="form-control"
            >
        </div>
        <div class="mb-3">
            <label for="synopsis" class="form-label">Sinopsis</label>
            <textarea
                id="synopsis"
                name="synopsis"
                class="form-control"
            ></textarea>
        </div>
        <div class="mb-3">
            <label for="cover" class="form-label">Portada (coming soon&trade;)</label>
            <input
                type="file"
                id="cover"
                name="cover"
                class="form-control"
            >
        </div>
        <div class="mb-3">
            <label for="cover_description" class="form-label">Descripción de la portada (coming soon&trade;)</label>
            <input
                type="text"
                id="cover_description"
                name="cover_description"
                class="form-control"
            >
        </div>
        <button type="submit" class="btn btn-primary">Publicar</button>
    </form>
</x-layouts.main>