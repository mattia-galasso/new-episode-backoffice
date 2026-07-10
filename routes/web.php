<?php

use App\Http\Controllers\Admin\TvSeriesCastController;
use App\Http\Controllers\Admin\TvSeriesController;
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

/* Tv Series Resource Controller */
Route::resource('tvseries', TvSeriesController::class)
    ->middleware(['auth', 'verified']);

/* Tv Series Cast Resource Controller */
Route::middleware('auth')->group(function () {
    /* Route Edit */
    Route::get('tvseries/{tvseries}/cast', [TvSeriesCastController::class, 'edit'])->name('tvseries.cast.edit');

    /* Route addActor */
    Route::put('tvseries/{tvseries}/cast/add', [TvSeriesCastController::class, 'addActor'])->name('tvseries.cast.add');

    /* Route removeActor */
    Route::delete('tvseries/{tvseries}/cast/{actor}/remove', [TvSeriesCastController::class, 'removeActor'])->name('tvseries.cast.remove');
});

require __DIR__ . '/auth.php';
