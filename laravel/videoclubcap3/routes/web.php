<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatalogController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::get('/catalog', [CatalogController::class, 'getIndex'])
    ->middleware(['auth', 'verified'])
    ->name('catalog');

// Route::get('/catalog/create', [CatalogController::class, 'getCreate'])
//     ->middleware(['auth', 'verified'])
//     ->name('create');

Route::get('/catalog/show/{id}', [CatalogController::class, 'getShow'])
    ->middleware(['auth', 'verified'])
    ->name('show');

// Route::get('/catalog/edit/{id}', [CatalogController::class, 'getEdit'])
//     ->middleware(['auth', 'verified'])
//     ->name('edit');

Route::post('/catalog/create', [CatalogController::class, 'postCreate'])
    ->middleware(['auth', 'verified'])
    ->name('create');

Route::put('/catalog/edit/{id}', [CatalogController::class, 'putEdit'])
    ->middleware(['auth', 'verified'])
    ->name('edit');

require __DIR__ . '/settings.php';
