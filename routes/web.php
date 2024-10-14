<?php

use App\Http\Controllers\Admin\DasboardController;
use App\Http\Controllers\Guest\PageController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\PostTypeController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PageController::class, 'index'])->name('home');

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DasboardController::class, 'index'])->name('home');

    Route::resource('posts', PostController::class);
    Route::resource('post-types', PostTypeController::class)->except(['show', 'edit', 'update', 'create']);
    Route::resource('tags', TagController::class)->except(['show', 'edit', 'update', 'create']);
});


Route::middleware('auth')->prefix('profile')->name('profile.')->group(function () {
    Route::get('/', [ProfileController::class, 'edit'])->name('edit');
    Route::patch('/', [ProfileController::class, 'update'])->name('update');
    Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
});

require __DIR__ . '/auth.php';
