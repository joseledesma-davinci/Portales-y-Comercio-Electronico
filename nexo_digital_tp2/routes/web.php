<?php

use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ServicesController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/servicios', [ServicesController::class, 'index'])->name('services.index');
Route::get('/servicios/{id}', [ServicesController::class, 'show'])
    ->whereNumber('id')
    ->name('services.show');

Route::get('/blog', [PostsController::class, 'index'])->name('posts.index');
Route::get('/blog/{id}', [PostsController::class, 'show'])
    ->whereNumber('id')
    ->name('posts.show');

Route::get('/ingresar', [AuthController::class, 'loginForm'])->name('auth.login.form');
Route::post('/ingresar', [AuthController::class, 'loginProcess'])->name('auth.login.process');
Route::get('/registro', [AuthController::class, 'registerForm'])->name('auth.register.form');
Route::post('/registro', [AuthController::class, 'registerProcess'])->name('auth.register.process');
Route::post('/salir', [AuthController::class, 'logout'])->name('auth.logout');

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function (): void {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/usuarios', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::get('/usuarios/{id}', [AdminUserController::class, 'show'])
        ->whereNumber('id')
        ->name('admin.users.show');

    Route::get('/publicaciones', [PostsController::class, 'adminIndex'])->name('admin.posts.index');
    Route::get('/publicaciones/crear', [PostsController::class, 'create'])->name('admin.posts.create');
    Route::post('/publicaciones/crear', [PostsController::class, 'store'])->name('admin.posts.store');
    Route::get('/publicaciones/{id}/editar', [PostsController::class, 'edit'])
        ->whereNumber('id')
        ->name('admin.posts.edit');
    Route::post('/publicaciones/{id}/editar', [PostsController::class, 'update'])
        ->whereNumber('id')
        ->name('admin.posts.update');
    Route::get('/publicaciones/{id}/eliminar', [PostsController::class, 'delete'])
        ->whereNumber('id')
        ->name('admin.posts.delete');
    Route::post('/publicaciones/{id}/eliminar', [PostsController::class, 'destroy'])
        ->whereNumber('id')
        ->name('admin.posts.destroy');
});
