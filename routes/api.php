<?php

use App\Http\Controllers\Admin\ActorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/actors/search', [ActorController::class, 'search']);
