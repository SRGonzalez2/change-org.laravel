<?php

use App\Http\Controllers\AdminControllers\AdminPeticionController;
use App\Http\Controllers\AdminControllers\AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PetitionController;
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

Route::middleware(['auth:api', 'is_admin'])->prefix('admin')->group(function () {

    //Peticiones
    Route::get('/peticiones', [AdminPeticionController::class, 'indexPeticiones']);
    Route::delete('/peticiones/{id}', [AdminPeticionController::class, 'destroyPeticion']);
    Route::post('/peticiones', [AdminPeticionController::class, 'storePeticion']);
    Route::get('/peticiones/{id}', [AdminPeticionController::class, 'showPeticion']);
    Route::post('/peticiones/{id}', [AdminPeticionController::class, 'updatePeticion']);

    //Usuarios
    Route::get('/users', [AdminUserController::class, 'indexUsers']);
    Route::get('/users/{id}', [AdminUserController::class, 'showUser']);
    Route::post('/users', [AdminUserController::class, 'storeUser']);
    Route::post('/users/{id}', [AdminUserController::class, 'updateUser']);
    Route::delete('/users/{id}', [AdminUserController::class, 'delete']);

});
