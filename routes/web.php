<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RSSFeedController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PostController::class, 'index'])->name('posts.index');

Route::get('/feed', [RSSFeedController::class, 'index'])->name('feed.index');

Route::middleware('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/create', [PostController::class, 'store'])->name('posts.store');
    Route::delete('/{id}', [PostController::class, 'destroy'])->name('posts.delete');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');

require __DIR__.'/auth.php';

Route::get('/{slug}', [PostController::class, 'show'])->name('posts.show');
