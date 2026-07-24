<?php

use App\Http\Controllers\Api\ActorController;
use App\Http\Controllers\Api\GenreController;
use App\Http\Controllers\Api\PlatformController;
use App\Http\Controllers\Api\TvSeriesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('actors/search', [ActorController::class, 'search']);

// Homepage
Route::get('tvseries/homepage', [TvSeriesController::class, 'homepage']);

// Serie TV
Route::get('tvseries', [TvSeriesController::class, 'index']);
Route::get('tvseries/{slug}', [TvSeriesController::class, 'show']);

// Platforms
Route::get("/platforms", [PlatformController::class, "index"]);

// Genres
Route::get("/genres", [GenreController::class, "index"]);

// Actor
Route::get('/actors/{slug}', [ActorController::class, 'show']);
