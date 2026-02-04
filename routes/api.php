<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::middleware('auth:api')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('me', [AuthController::class, 'me']);
});

Route::middleware('api')->post('refresh', [AuthController::class, 'refresh']);

Route::get('peticiones', [\App\Http\Controllers\PetitionController::class,'index']);
Route::get('peticiones/{id}', [\App\Http\Controllers\PetitionController::class,'show']);

Route::middleware('auth:api')->group(function () {
    Route::get('mispeticiones', [\App\Http\Controllers\PetitionController::class, 'listmine']);
    Route::get('peticiones/{id}', [\App\Http\Controllers\PetitionController::class,'show']);
    Route::delete('peticiones/{id}', [\App\Http\Controllers\PetitionController::class,'delete']);
    Route::put('peticiones/firmar/{id}', [\App\Http\Controllers\PetitionController::class,'firmar']);
    Route::put('peticiones/{id}', [\App\Http\Controllers\PetitionController::class,'update']);
    Route::put('peticiones/estado/{id}', [\App\Http\Controllers\PetitionController::class,'cambiarEstado']);
    Route::post('peticiones', [\App\Http\Controllers\PetitionController::class,'store']);
});
