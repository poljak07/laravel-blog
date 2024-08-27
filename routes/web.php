<?php

use App\Http\Controllers\{
    AboutController,
    ArticleController,
    CategoryController,
    ContactController,
    HomeController,
    ProfileController,
    TagController
};

use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::get('/dashboard', fn() => view('dashboard'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::prefix('articles')->group(function () {
        Route::get('create', [ArticleController::class, 'create'])->name('articles.create');
        Route::post('create', [ArticleController::class, 'store'])->name('articles.store');
        Route::get('{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
        Route::patch('{article}', [ArticleController::class, 'update'])->name('articles.update');
        Route::delete('{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');
    });

    Route::prefix('tags')->group(function () {
        Route::get('create', [TagController::class, 'create'])->name('tags.create');
        Route::post('create', [TagController::class, 'store'])->name('tags.store');
        Route::get('{tag}/edit', [TagController::class, 'edit'])->name('tags.edit');
        Route::patch('{tag}', [TagController::class, 'update'])->name('tags.update');
        Route::delete('{tag}', [TagController::class, 'destroy'])->name('tags.destroy');
    });

    Route::prefix('categories')->group(function () {
        Route::get('create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('store', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::patch('{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    });
});

Route::resources([
    'articles' => ArticleController::class,
    'tags' => TagController::class,
    'categories' => CategoryController::class,
]);

Route::get('/about', AboutController::class)->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

require __DIR__.'/auth.php';

