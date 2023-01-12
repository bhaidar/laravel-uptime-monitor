<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EndpointDestroyController;
use App\Http\Controllers\EndpointStoreController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiteStoreController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard/{site?}', DashboardController::class)
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])
    ->prefix('/sites')
    ->group(function () {
        Route::post('/', SiteStoreController::class)
            ->name('sites.store');

        Route::post('/', SiteStoreController::class)
            ->name('sites.store');

        // An endpoint is created on a site => nested route
        Route::post('/{site}/endpoints', EndpointStoreController::class)
            ->name('site.endpoints.store');
    });

Route::delete('/endpoints/{endpoint}', EndpointDestroyController::class)
    ->middleware(['auth'])
    ->name('endpoints.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
