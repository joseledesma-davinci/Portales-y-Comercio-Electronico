<x-layouts.main>
    <x-slot:title>Ingresar a mi cuenta</x-slot:title>

    <h1>Iniciar sesión</h1>

    <form action="{{ route('auth.login.process') }}" method="post">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" id="password" name="password" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Ingresar</button>
    </form>
</x-layouts.main>