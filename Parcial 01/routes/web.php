<?php

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

// ADMINISTRADOR
Route::get('admin/login', [AuthController::class, 'loginForm'])->name('auth.login.form');
Route::post('admin/login', [AuthController::class, 'loginProcess'])->name('auth.login.process');
Route::post('admin/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::get('/admin', [DashboardController::class, 'index'])
    ->name('admin.dashboard')
    ->middleware('auth');

Route::get('/admin/publicaciones', [PostsController::class, 'adminIndex'])
    ->name('admin.posts.index')
    ->middleware('auth');

Route::get('/admin/publicaciones/crear', [PostsController::class, 'create'])
    ->name('admin.posts.create')
    ->middleware('auth');
Route::post('/admin/publicaciones/crear', [PostsController::class, 'store'])
    ->name('admin.posts.store')
    ->middleware('auth');

Route::get('/admin/publicaciones/{id}/editar', [PostsController::class, 'edit'])
    ->whereNumber('id')
    ->name('admin.posts.edit')
    ->middleware('auth');
Route::post('/admin/publicaciones/{id}/editar', [PostsController::class, 'update'])
    ->whereNumber('id')
    ->name('admin.posts.update')
    ->middleware('auth');

Route::get('/admin/publicaciones/{id}/eliminar', [PostsController::class, 'delete'])
    ->whereNumber('id')
    ->name('admin.posts.delete')
    ->middleware('auth');
Route::post('/admin/publicaciones/{id}/eliminar', [PostsController::class, 'destroy'])
    ->whereNumber('id')
    ->name('admin.posts.destroy')
    ->middleware('auth');

