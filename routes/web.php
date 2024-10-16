<?php

use App\Http\Controllers\Admin\DasboardController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Guest\PageController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\VillainController;
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
    Route::resource('villains', VillainController::class);
    Route::resource('skills', SkillController::class);
    Route::resource('messages', MessageController::class)->except(['index', 'destroy','show']);
});


Route::middleware('auth')->prefix('profile')->name('profile.')->group(function () {
    Route::get('/', [ProfileController::class, 'edit'])->name('edit');
    Route::patch('/', [ProfileController::class, 'update'])->name('update');
    Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
});

require __DIR__ . '/auth.php';
