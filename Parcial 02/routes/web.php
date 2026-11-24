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
Route::get('/servicios/{id}', [ServicesController::class, 'show'])->name('services.show');

Route::get('/blog', [PostsController::class, 'index'])->name('posts.index');
Route::get('/blog/{id}', [PostsController::class, 'show'])->name('posts.show');

Route::get('/ingresar', [AuthController::class, 'loginForm'])->name('auth.login.form');
Route::post('/ingresar', [AuthController::class, 'loginProcess'])->name('auth.login.process');
Route::get('/registro', [AuthController::class, 'registerForm'])->name('auth.register.form');
Route::post('/registro', [AuthController::class, 'registerProcess'])->name('auth.register.process');
Route::post('/salir', [AuthController::class, 'logout'])->name('auth.logout');


Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');

Route::get('/admin/usuarios', [AdminUserController::class, 'index'])->name('admin.users.index');
Route::get('/admin/usuarios/{id}', [AdminUserController::class, 'show'])->name('admin.users.show');

    Route::get('/admin/publicaciones', [PostsController::class, 'adminIndex'])->name('admin.posts.index');
    Route::get('/admin/publicaciones/crear', [PostsController::class, 'create'])->name('admin.posts.create');
    Route::post('/admin/publicaciones/crear', [PostsController::class, 'store'])->name('admin.posts.store');
    Route::get('/admin/publicaciones/{id}/editar', [PostsController::class, 'edit'])->name('admin.posts.edit');
    Route::post('/admin/publicaciones/{id}/editar', [PostsController::class, 'update'])->name('admin.posts.update');
    Route::get('/admin/publicaciones/{id}/eliminar', [PostsController::class, 'delete'])->name('admin.posts.delete');
    Route::post('/admin/publicaciones/{id}/eliminar', [PostsController::class, 'destroy'])->name('admin.posts.destroy');
