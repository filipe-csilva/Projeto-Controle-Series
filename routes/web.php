<?php

use App\Http\Controllers\SeriesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/series');
});

//Rotas informadas individualmente
// Route::get('/series', [SeriesController::class, 'index']);
// Route::get('/series/create', [SeriesController::class, 'create']);
// Route::post('/series/salvar', [SeriesController::class, 'store']);

//Rotas por grupo - Rotas nomeadas
// Route::controller(SeriesController::class)->group(function(){
//     Route::get('/series', 'index')->name('series.index');
//     Route::get('/series/create', 'create')->name('series.create');
//     Route::post('/series/salvar', 'store')->name('series.store');
// });
    
    
    //Rotas padrões no Laravel
    Route::resource('/series', SeriesController::class)->except(['show']);
