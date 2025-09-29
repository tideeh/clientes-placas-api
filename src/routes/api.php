<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;

Route::post('/cliente',[ClienteController::class,'store']);
Route::put('/cliente/{id}',[ClienteController::class,'update']);
Route::delete('/cliente/{id}',[ClienteController::class,'destroy']);
Route::get('/cliente/{id}',[ClienteController::class,'show']);
Route::get('/consulta/final-placa/{numero}',[ClienteController::class,'byUltimoDigito']);
