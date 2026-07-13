<?php

use App\Http\Controllers\Admin\ActorController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\TvSeriesCastController;
use App\Http\Controllers\Admin\TvSeriesController;
use App\Http\Controllers\Admin\TvSeriesPlatformController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/* TV Series Resource Controller */
Route::resource('tvseries', TvSeriesController::class)
    ->middleware(['auth', 'verified']);

/* TV Series Cast Controller */
Route::middleware('auth')->group(function () {
    /* Route Edit */
    Route::get('tvseries/{tvseries}/cast', [TvSeriesCastController::class, 'edit'])->name('tvseries.cast.edit');

    /* Route addActor */
    Route::put('tvseries/{tvseries}/cast/add', [TvSeriesCastController::class, 'addActor'])->name('tvseries.cast.add');

    /* Route removeActor */
    Route::delete('tvseries/{tvseries}/cast/{actor}/remove', [TvSeriesCastController::class, 'removeActor'])->name('tvseries.cast.remove');
});

/* TV Series Platforms Controller */
Route::middleware('auth')->group(function () {
    /* Route Edit */
    Route::get(
        'tvseries/{tvseries}/platforms',
        [TvSeriesPlatformController::class, 'edit']
    )->name('tvseries.platforms.edit');

    /* Route addPlatform */
    Route::put(
        'tvseries/{tvseries}/platforms',
        [TvSeriesPlatformController::class, 'addPlatform']
    )->name('tvseries.platforms.add');

    /* Route removePlatform */
    Route::delete(
        'tvseries/{tvseries}/platforms/{platform}',
        [TvSeriesPlatformController::class, 'removePlatform']
    )->name('tvseries.platforms.remove');
});


/* Genres Resource Controller */
Route::resource('genres', GenreController::class)
    ->middleware(['auth', 'verified']);

/* Actors Resource Controller */
Route::resource('actors', ActorController::class)
    ->middleware(['auth', 'verified']);



require __DIR__ . '/auth.php';
