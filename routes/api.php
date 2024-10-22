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
Route::get('/villain/{slug}', [PageController::class, 'villainBySlug']);
Route::get('/list-by-skill/{id}', [PageController::class, 'listBySkill']);
Route::get('/list-by-filters', [PageController::class, 'listByFilters']);
Route::get('/list-by-service/{id}', [PageController::class, 'listByService']);
Route::get('/list-by-universe/{id}', [PageController::class, 'listByUniverse']);
