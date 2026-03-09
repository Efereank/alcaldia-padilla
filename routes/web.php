<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Public\ArticleController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BannerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// RUTAS PÚBLICAS - Las que ve todo el mundo
Route::get('/', [ArticleController::class, 'index'])->name('home');
Route::get('/noticia/{slug}', [ArticleController::class, 'show'])->name('article.show');
Route::get('/categoria/{category:slug}', [ArticleController::class, 'byCategory'])->name('category.articles'); // ← NUEVA RUTA

// RUTAS DE AUTENTICACIÓN (las que vienen con Breeze)
require __DIR__.'/auth.php';

// RUTAS DE ADMINISTRACIÓN - Solo para usuarios logueados
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Gestión de artículos
    Route::resource('articles', AdminArticleController::class);
    // Gestión de categorías
    Route::resource('categories', CategoryController::class);
    Route::resource('banners', BannerController::class); // Nueva ruta
});

// RUTAS DE PERFIL (ya vienen con Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});