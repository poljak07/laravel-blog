<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('home');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/articles',
    [ArticleController::class, 'index'])->name('articles.index');

Route::get('/articles/create', [ArticleController::class, 'create'])
    ->middleware('auth')->name('articles.create');
Route::post('/articles/create', [ArticleController::class, 'store'])
    ->middleware('auth')->name('articles.store');

Route::get('/articles/{article}', [ArticleController::class, 'show'])
    ->name('articles.show');

Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])
    ->name('articles.edit');

Route::patch('/articles/{article}', [ArticleController::class, 'update'])
    ->name('articles.update');

Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])
    ->middleware('auth')
    ->name('articles.destroy');

Route::get('/tags',
        [TagController::class, 'index'])
    ->name('tags.index');

Route::get('/tags/create', [TagController::class, 'create'])
    ->middleware('auth')->name('tags.create');
Route::post('/tags/create', [TagController::class, 'store'])
    ->middleware('auth')->name('tags.store');

Route::get('/tags/{tag}/edit', [TagController::class, 'edit'])
    ->name('tags.edit');

Route::patch('/tags/{tag}', [TagController::class, 'update'])
    ->name('tags.update');

Route::delete('/tags/{tag}', [TagController::class, 'destroy'])
    ->middleware('auth')
    ->name('tags.destroy');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact',
    [ContactController::class, 'index'])
    ->name('contact');

Route::post('/contact',
    [ContactController::class, 'submit'])
    ->name('contact.submit');

require __DIR__.'/auth.php';

