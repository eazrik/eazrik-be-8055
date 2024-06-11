<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MovieController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('movie-store', [MovieController::class, 'store']);
Route::get('all-movies', [MovieController::class, 'allMovies']);
Route::get('new-movies', [MovieController::class, 'newMovies']);
Route::get('top-movies', [MovieController::class, 'topMovies']);
Route::get('single-movie/{movie}', [MovieController::class, 'singleMovie']);
Route::get('genre', [MovieController::class, 'genre']);
Route::get('timeSlot', [MovieController::class, 'timeSlot']);
Route::get('specificMovieTheatre', [MovieController::class, 'specificMovieTheatre']);
Route::get('performer', [MovieController::class, 'performer']);
Route::post('movie-update/{movie}', [MovieController::class, 'update']);
Route::post('movie-rating/{movie}', [MovieController::class, 'rating']);
Route::delete('movie-delete/{movie}', [MovieController::class, 'delete']);
