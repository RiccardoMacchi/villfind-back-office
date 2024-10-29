<?php

use App\Http\Controllers\api\PageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/villains', [PageController::class, 'index']);

Route::get('/skills', [PageController::class, 'allSkills']);
Route::get('/services', [PageController::class, 'allServices']);
Route::get('/universes', [PageController::class, 'allUniverses']);
Route::get('/max-reviews', [PageController::class, 'maxPossibleReviews']);
Route::get('/max-rating', [PageController::class, 'maxRatingValue']);
Route::post('/sent-message', [PageController::class, 'storeMessage']);
Route::post('/sent-rating', [PageController::class, 'storeRating']);
Route::get('/villain/{slug}', [PageController::class, 'villainBySlug']);
Route::get('/list-by-skill/{id}', [PageController::class, 'listBySkill']);
Route::get('/list-by-filters', [PageController::class, 'listByFilters']);
Route::get('/villains-rating', [PageController::class, 'villainsRating']);
Route::get('/active-sponsorship', [PageController::class, 'villainsSponsored']);

Route::post('/receive-client-ip', [PageController::class, 'receiveClientIp']);
