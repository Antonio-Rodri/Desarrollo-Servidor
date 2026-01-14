<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('contacto/{nombre?}/{edad?}', function ($nombre = 'Juan', $edad = 80) {
    // return view('contacto', compact('nombre', 'edad'));
    return view('contacto')->with('nom', $nombre)->with('ed', $edad);
})->where(['nombre' => '[a-zA-Z]+', 'edad' => '[0-9]+'])->name('contacto');


Route::get('datos', function () {
    return view('datos');
});

Route::get('alerta', function () {
    return view('vista_alerta');
});
