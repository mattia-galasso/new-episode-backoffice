<?php

use App\Http\Controllers\Admin\ActorController;
use App\Http\Controllers\Api\TvSeriesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('actors/search', [ActorController::class, 'search']);

// Homepage
Route::get('tvseries/homepage', [TvSeriesController::class, 'homepage']);

// Lista Serie TV
Route::get('tvseries', [TvSeriesController::class, 'index']);
