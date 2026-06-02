<?php

use App\Http\Controllers\SeriesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('/series');
});

Route::controller(SeriesController::class)->group(function(){
    Route::get('/series', 'index');
    Route::get('/series/create', 'create');
    Route::post('/series/salvar', 'store');
});

// Route::get('/series', [SeriesController::class, 'index']);
// Route::get('/series/create', [SeriesController::class, 'create']);
// Route::post('/series/salvar', [SeriesController::class, 'store']);