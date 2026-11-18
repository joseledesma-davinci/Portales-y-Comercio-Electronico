<x-layouts.main>
    <x-slot:title>{{ $movie->title }}</x-slot:title>

    <h1>{{ $movie->title }}</h1>

    <div class="row mb-4">
        <div class="col-2">
            {{-- @if($movie->cover !== null && \Storage::disk('public')->exists($movie->cover))
                <img src="<?= \Storage::disk('public')->url($movie->cover);?>" alt="{{ $movie->cover_description }}" class="img-fluid"> --}}
            @if($movie->cover !== null && \Storage::exists($movie->cover))
                <img src="<?= \Storage::url($movie->cover);?>" alt="{{ $movie->cover_description }}" class="img-fluid">
            @else
                Sin portada 
                {{-- Acá iría una imagen que diga "sin imagen" o "sin portada". --}}
            @endif
        </div>
        <div class="col-10">
            <dl>
                <dt>Precio</dt>
                <dd>${{ $movie->price }}</dd>
                <dt>Fecha de estreno</dt>
                <dd>{{ $movie->release_date }}</dd>
                <dt>Clasificación</dt>
                <dd>{{ $movie->rating->name }} ({{ $movie->rating->abbreviation }})</dd>
                <dt>Géneros</dt>
                <dd>
                    @forelse($movie->genres as $genre)
                        <span class="badge bg-secondary">{{ $genre->name }}</span>
                    @empty
                        <i>Sin géneros asignados</i>
                    @endforelse
                </dd>
            </dl>
        </div>
    </div>

    <h2>Sinopsis</h2>

    <div>{{ $movie->synopsis }}</div>
</x-layouts.main>