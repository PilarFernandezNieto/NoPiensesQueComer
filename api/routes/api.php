<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoriaIngredienteController;
use App\Http\Controllers\Api\HogarController;
use App\Http\Controllers\Api\IngredienteController;
use App\Http\Controllers\Api\ListaCompraController;
use App\Http\Controllers\Api\MenuSemanalController;
use App\Http\Controllers\Api\RecetaController;
use App\Http\Controllers\Api\ReglaHogarController;
use App\Http\Controllers\Api\RestriccionIngredienteController;
use App\Http\Controllers\Api\SlotMenuController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/registro', [AuthController::class, 'registro']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('hogares', HogarController::class);
    Route::apiResource('categorias-ingredientes', CategoriaIngredienteController::class);
    Route::apiResource('ingredientes', IngredienteController::class);
    Route::apiResource('recetas', RecetaController::class);
    Route::apiResource('restricciones-ingredientes', RestriccionIngredienteController::class);
    Route::apiResource('reglas-hogar', ReglaHogarController::class);
    Route::apiResource('menus-semanales', MenuSemanalController::class);
    Route::apiResource('slots-menu', SlotMenuController::class);
    Route::apiResource('listas-compra', ListaCompraController::class);
});
