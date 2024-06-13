<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ArticleController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/blogs', function () {
//     return Inertia::render('Blog');
// })->middleware(['auth', 'verified'])->name('blogs');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('articles', ArticleController::class)->withTrashed();
Route::post('/{article}/comment', [CommentController::class, 'store'])->name('comment.post');
Route::delete('/{comment}/comment', [CommentController::class, 'destroy'])->name('comment.delete');

Route::get('admin/dashboard', [ArticleController::class, 'class'])->
    middleware(['auth', 'admin']);

require __DIR__.'/auth.php';
