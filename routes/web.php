<?php

use App\Http\Controllers\Admin\ActorController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\PlatformController;
use App\Http\Controllers\Admin\ProductionCompanyController;
use App\Http\Controllers\Admin\TvSeriesCastController;
use App\Http\Controllers\Admin\TvSeriesController;
use App\Http\Controllers\Admin\TvSeriesPlatformController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Models\Actor;
use App\Models\Genre;
use App\Models\Platform;
use App\Models\ProductionCompany;
use App\Models\TvSeries;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

//
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/* TV Series Resource Controller */
Route::resource('tvseries', TvSeriesController::class)
    ->middleware('auth')
    ->middlewareFor(['index'], 'can:viewAny,' . TvSeries::class)
    ->middlewareFor(['show'], 'can:view,tvseries')
    ->middlewareFor(['create', 'store'], 'can:create,' . TvSeries::class)
    ->middlewareFor(['edit', 'update'], 'can:update,tvseries')
    ->middlewareFor(['destroy'], 'can:delete,tvseries');

/* TV Series Cast Controller */
Route::middleware(['auth', 'can:update,tvseries'])->group(function () {
    /* Route Edit */
    Route::get('tvseries/{tvseries}/cast', [TvSeriesCastController::class, 'edit'])->name('tvseries.cast.edit');

    /* Route addActor */
    Route::put('tvseries/{tvseries}/cast/add', [TvSeriesCastController::class, 'addActor'])->name('tvseries.cast.add');

    /* Route removeActor */
    Route::delete('tvseries/{tvseries}/cast/{actor}/remove', [TvSeriesCastController::class, 'removeActor'])->name('tvseries.cast.remove');
});

/* TV Series Platforms Controller */
Route::middleware(['auth', 'can:update,tvseries'])->group(function () {
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
    ->middleware('auth')
    ->middlewareFor(['index'], 'can:viewAny,' . Genre::class)
    ->middlewareFor(['show'], 'can:view,genre')
    ->middlewareFor(['create', 'store'], 'can:create,' . Genre::class)
    ->middlewareFor(['edit', 'update'], 'can:update,genre')
    ->middlewareFor(['destroy'], 'can:delete,genre');

/* Actors Resource Controller */
Route::resource('actors', ActorController::class)
    ->middleware('auth')
    ->middlewareFor(['index'], 'can:viewAny,' . Actor::class)
    ->middlewareFor(['show'], 'can:view,actor')
    ->middlewareFor(['create', 'store'], 'can:create,' . Actor::class)
    ->middlewareFor(['edit', 'update'], 'can:update,actor')
    ->middlewareFor(['destroy'], 'can:delete,actor');

/* Platforms Resource Controller */
Route::resource('platforms', PlatformController::class)
    ->middleware('auth')
    ->middlewareFor(['index'], 'can:viewAny,' . Platform::class)
    ->middlewareFor(['show'], 'can:view,platform')
    ->middlewareFor(['create', 'store'], 'can:create,' . Platform::class)
    ->middlewareFor(['edit', 'update'], 'can:update,platform')
    ->middlewareFor(['destroy'], 'can:delete,platform');

/* Production Companies Resource Controller */
Route::resource('production-companies', ProductionCompanyController::class)
    ->middleware('auth')
    ->middlewareFor(['index'], 'can:viewAny,' . ProductionCompany::class)
    ->middlewareFor(['show'], 'can:view,production_company')
    ->middlewareFor(['create', 'store'], 'can:create,' . ProductionCompany::class)
    ->middlewareFor(['edit', 'update'], 'can:update,production_company')
    ->middlewareFor(['destroy'], 'can:delete,production_company');

/* Users Resource Controller */
Route::resource('users', UserController::class)
    ->only(['index', 'edit', 'update'])
    ->middleware('auth')
    ->middlewareFor(['index'], 'can:viewAny,' . User::class)
    ->middlewareFor(['edit', 'update'], 'can:update,user');


require __DIR__ . '/auth.php';
