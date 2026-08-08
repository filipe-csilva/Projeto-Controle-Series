<?php

use \App\Http\Controllers\Api\SeriesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Suas rotas API aqui
Route::prefix('v1')->group(function () {
    Route::get('/status', function () {
        return response()->json(['message' => 'API funcionando!']);
    });
    
    //Route::get('/series', [SeriesController::class, 'index']); //Rota individual
    Route::apiResource('/series', SeriesController::class);
});