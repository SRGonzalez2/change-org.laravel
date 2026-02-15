<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PetitionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('me', [AuthController::class, 'me']);

    Route::get('mispeticiones', [\App\Http\Controllers\PetitionController::class, 'listmine']);
    Route::get('misfirmas', [PetitionController::class, 'listfirmadas']);
    Route::delete('peticiones/{id}', [\App\Http\Controllers\PetitionController::class,'delete']);
    Route::post('peticiones/firmar/{id}', [\App\Http\Controllers\PetitionController::class,'firmar']);
    Route::put('peticiones/{id}', [\App\Http\Controllers\PetitionController::class,'update']);
    Route::put('peticiones/estado/{id}', [\App\Http\Controllers\PetitionController::class,'cambiarEstado']);
    Route::post('peticiones', [\App\Http\Controllers\PetitionController::class,'store']);
});

Route::post('login', [AuthController::class, 'login'])->name("login");
Route::post('register', [AuthController::class, 'register']);
Route::get('peticiones', [\App\Http\Controllers\PetitionController::class,'index']);
Route::get('peticiones/{id}', [\App\Http\Controllers\PetitionController::class,'show']);

Route::get('categorias', [\App\Http\Controllers\CategoryController::class,'index']);

Route::middleware('api')->post('refresh', [AuthController::class, 'refresh']);
