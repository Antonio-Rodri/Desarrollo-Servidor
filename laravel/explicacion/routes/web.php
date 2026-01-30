<?php

use App\Http\Middleware\MayorEdad;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrutasController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('contacto/{nombre?}/{edad?}', function ($nombre = 'Juan', $edad = 80) {
    // return view('contacto', compact('nombre', 'edad'));
    return view('contacto')->with('nom', $nombre)->with('ed', $edad);
})->where(['nombre' => '[a-zA-Z]+', 'edad' => '[0-9]+'])->name('contacto')->middleware('mayoredad:18');

Route::prefix('fruteria')->group(function () {
    Route::get('/frutas', [FrutasController::class, 'index'])
        ->name('frutas.index');
    Route::get('/frutas/naranjas', [FrutasController::class, 'naranjas'])
        ->name('frutas.naranjas');
    Route::get('/frutas/peras', [FrutasController::class, 'peras'])
        ->name('frutas.peras');
    Route::post('/frutas', [FrutasController::class, 'recibeFrutas'])->name('frutas.recibeFrutas');
});

Route::get('datos', function () {
    return view('datos');
});

Route::get('alerta', function () {
    return view('vista_alerta');
});
