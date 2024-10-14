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

Route::get('/all-posts', [PageController::class, 'getAllPosts']);
Route::get('/posts-by-tag-slug/{slug}', [PageController::class, 'getPostsByTagSlug']);
Route::get('/posts-by-type-slug/{slug}', [PageController::class, 'getPostsByTypeSlug']);
Route::get('/all-tags', [PageController::class, 'getAllTags']);
Route::get('/all-types', [PageController::class, 'getAllTypes']);
Route::get('/post-by-slug/{slug}', [PageController::class, 'getPostBySlug']);
