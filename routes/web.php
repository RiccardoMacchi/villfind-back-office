<?php

use App\Http\Controllers\Admin\DasboardController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\RatingController;
use App\Http\Controllers\Guest\PageController;
use App\Http\Controllers\Admin\VillainController;
use App\Http\Controllers\Admin\SponsorshipController;
use App\Http\Controllers\Admin\StatisticsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Models\Sponsorship;

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

// Rotte payment
Route::get('/checkout/{sponsorship}', [PaymentController::class, 'showCheckout'])->name('checkout.show');
Route::post('/checkout', [PaymentController::class, 'checkout'])->name('checkout.process');
Route::get('/checkout/success', function () {
    return 'Transazione completata con successo!';
})->name('checkout.success');
Route::get('/checkout/error', function () {
    return 'C\'è stato un errore durante la transazione.';
})->name('checkout.error');


Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DasboardController::class, 'index'])->name('home');
    Route::resource('villains', VillainController::class)->except(['create', 'show']);
    // Route::get('ratings/statistics', [RatingController::class, 'statistics'])->name('ratings.statistics');
    Route::resource('ratings', RatingController::class);
    Route::resource('messages', MessageController::class)->except(['create', 'update']);
    Route::post('/reset-session', [SponsorshipController::class, 'resetSession'])->name('session.reset');
    Route::get('sponsorship/purchase/{sponsorship}', [SponsorshipController::class, 'purchaseSponsorship'])->name('sponsorship.purchase');
    Route::resource('sponsorship', SponsorshipController::class)->except(['create', 'update', 'show', 'destroy']);
    Route::resource('statistic', StatisticsController::class)->except(['create', 'update', 'show', 'destroy']);;
});


Route::middleware('auth')->prefix('profile')->name('profile.')->group(function () {
    Route::get('/', [ProfileController::class, 'edit'])->name('edit');
    Route::patch('/', [ProfileController::class, 'update'])->name('update');
    Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
});

require __DIR__ . '/auth.php';
