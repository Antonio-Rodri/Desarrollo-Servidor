<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('user/nota', [UserController::class, 'nota'])->middleware('auth')->name('user.nota');
Route::post('user/nota', [UserController::class, 'putNota'])->middleware('auth')->name('user.putNota');

Route::resource('user', UserController::class)->middleware('auth');
Route::resource('estudiante', StudentController::class)->middleware('auth');

require __DIR__ . '/settings.php';
