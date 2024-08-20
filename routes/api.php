<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\contactosController;

Route::get('/usuarios', [contactosController::class,'index']);
    
Route::get('/usuarios/{id}',[contactosController::class,'show']);

Route::post('/usuarios', [contactosController::class,'store']);
   

Route::put('/usuarios/{id}', [contactosController::class,'actualizar']);

Route::delete('/usuarios/{id}', [contactosController::class,'eliminar']);


