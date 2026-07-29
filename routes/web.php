<?php

use App\Http\Controllers\EpisodesController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SeasonsController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\UsersController;
use App\Http\Middleware\Autenticador;
use App\Mail\SeriesCreated;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/series');
})->middleware(Autenticador::class);

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

    Route::middleware(Autenticador::class)->group(function () {
    Route::get('/series/{series}/seasons', [SeasonsController::class, 'index'])->name('seasons.index');
    Route::get('/seasons/{season}/episodes', [EpisodesController::class, 'index'])->name('episodes.index');
    Route::post('/seasons/{season}/episodes', [EpisodesController::class, 'update'])->name('episodes.update');
    });

    Route::get('/email', function ()
    {
        return new SeriesCreated('Série de teste', 2, 5, 10);
    });

    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class,'login'])->name('signin');
    Route::post('/logout', [LoginController::class,'destroy'])->name('logout');

    Route::get('/registrar', [UsersController::class,'create'])->name('users.create');
    Route::post('/registrar', [UsersController::class,'store'])->name('users.store');