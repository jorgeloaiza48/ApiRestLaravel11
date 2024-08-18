<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\contactosController;

Route::get('/usuarios', [contactosController::class,'index']);
    

Route::get('/usuarios/{id}', function (Request $request) {
    return "Consultando un solo usuario";
});

Route::post('/usuarios', function (Request $request) {
    return "Creando usuarios";
});

Route::put('/usuarios/{id}', function (Request $request) {
    return "Actualizando usuarios";
});

Route::delete('/usuarios/{id}', function (Request $request) {
    return "Borrando usuarios";
});


