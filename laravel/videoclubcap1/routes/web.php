<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::get('/catalog', function () {
    return view('catalog.index');
})
    ->middleware(['auth', 'verified'])
    ->name('catalog');

Route::get('/catalog/create', function () {
    return view('catalog.create');
})
    ->middleware(['auth', 'verified'])
    ->name('create');

Route::get('/catalog/show/{id}', function ($id) {
    return view('catalog.show', compact('id'));
})
    ->middleware(['auth', 'verified'])
    ->name('show');

Route::get('/catalog/edit/{id}', function ($id) {
    return view('catalog.edit', compact('id'));
})
    ->middleware(['auth', 'verified'])
    ->name('edit');

require __DIR__ . '/settings.php';
