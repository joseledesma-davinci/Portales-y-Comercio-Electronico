{{-- 
    # Errores de validación
    Automáticamente, Laravel crea en todas las vistas una variable $errors de tipo ViewErrorBag.
    Esta variable va a contener los errores de validación que hayan ocurrido.

    El que exista siempre esa variable (haya habido una validación o no) nos permite evitar tener que
    preguntar todo el tiempo si esite la variable $errors.
--}}
<x-layouts.main>
    <x-slot:title>Publicar una nueva película</x-slot:title>

    <h1>Publicar una nueva película</h1>

    @if($errors->any())
        <div class="alert alert-danger">Hay errores en los datos enviados. Por favor, revisá los datos que tienen un error y probá de enviar el formulario de nuevo.</div>
    @endif

    <form action="{{ route('movies.store') }}" method="post">
        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input
                type="text"
                id="title"
                name="title"
                {{-- class="form-control @error('title') is-invalid @enderror" --}}
                {{-- 
                    @class() permite armar el atributo class según los valores que pasemos en un array.
                    Los valores que solo sean un string, sin un clave asignada, van a agregar siempre.
                    Para clases que tienen que agregarse condicionalmente, tenemos que usar el nombre de
                    la clase como clave, y la condición de aplicación como valor.
                --}}
                @class([
                    'form-control',
                    'is-invalid' => $errors->has('title'),
                ])
                {{-- 
                    # Mensajes de error accesibles
                    Para que los mensajes de error sean accesibles no alcanza con imprimir el mensaje de 
                    error al lado del campo y agregar una clase de CSS.
                    Necesitamos también asociar semánticamente el mensaje de error al campo, así como
                    indicar que hay un error.
                    Estas dos cosas, que son esenciales para usuarios no videntes, los podemos lograr con
                    ayuda de los atributos aria-*.
                    ARIA (Accesible Rich Internet Applications) es un estándar de la WAI (Web Accesibility
                    Initiative). La WAI es una rama de la W3C que está encargada de definir los estándares
                    de accesibilidad y la WCAG (Web Content Accessibility Guidelines).

                    Para los errores, hay 2 atributos aria-* que nos van a ser útiles:
                    1. aria-invalid
                        Permite indicar si el campo tiene un valor inválido.
                        Acepta los valores "true" y "false".
                    2. aria-errormessage
                        Acepta el id del elemento de HTML que tiene el mensaje de error correspondiente al
                        campo.

                    Ambos atributos solo deberían estar presentes si hay un error. Por eso vamos a meter dentro
                    de un condicional.

                    Nota: Para la mejor posible experiencia, deberíamos ir actualizando los valores de los
                    atributos aria-* con JS a medida que el usuario vaya corrigiendo las cosas.
                --}}
                @error('title')
                aria-invalid="true"
                aria-errormessage="error-title"
                @enderror
                value="{{ old('title') }}"
            >
            {{-- 
                # Detección de errores de validación
                Para saber si hay un error de validación en un determinado campo, podemos usar el método
                de $errors->has(campo) con un if.
                Por ejemplo:
                    @if($errors->has('title')) ... @endif
                
                Alternativamente, para una escrita y lectura más cómoda y precisa, podemos usar la directiva
                @error de Blade:
                    @error('title') ... @enderror

                Dentro de la directiva @error(), automáticamente vamos a tener acceso a una variable $message
                que contiene el primer mensaje de error del campo.
            --}}
            @error('title')
                <div class="text-danger" id="error-title">{{ $message }}</div>
            @enderror
            {{-- @if($errors->has('title'))
                <div class="text-danger">{{ $errors->first('title') }}</div>
            @endif --}}
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
                value="{{ old('price') }}"
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
                value="{{ old('release_date') }}"
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
            >{{ old('synopsis') }}</textarea>
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
                value="{{ old('cover_description') }}"
            >
            @error('cover_description')
                <div class="text-danger" id="error-cover_description">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Publicar</button>
    </form>
</x-layouts.main>