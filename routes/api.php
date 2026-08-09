<?php

use \App\Http\Controllers\Api\SeriesController;
use \App\Http\Controllers\Api\SeasonsController;
use \App\Http\Controllers\Api\EpisodesController;
use \App\Http\Controllers\Api\UserController;
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
    
    Route::middleware('auth:sanctum')->group(function(){
        Route::apiResource('/series', SeriesController::class);
        Route::get('/series/{series}/seasons', [SeasonsController::class, 'show']);
        Route::get('/series/{series}/episodes', [EpisodesController::class, 'show']);
        Route::patch('/episodes/{episodes}', [EpisodesController::class, 'update']);
        Route::post('/login',[UserController::class, 'store']);
    });
    //Route::get('/series', [SeriesController::class, 'index']); //Rota individual
    
});