<?php

use App\Http\Controllers\ReceitasController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/receitas', [ReceitasController::class, 'index'])->name('listar_receitas');
Route::get('/receitas/create', [ReceitasController::class, 'create']);
Route::post('/receitas/store', [ReceitasController::class, 'store'])->name('criar_receitas');

/*
Route::delete('/series/{id}', 'SeriesController@destroy');
Route::post('/series/{id}/editaNome', 'SeriesController@editaNome');
Route::get('/series/{serieId}/temporadas', 'TemporadasController@index');
Route::get('/temporadas/{temporada}/episodios', 'EpisodiosController@index');
Route::post('/temporadas/{temporada}/episodios/assistir', 'EpisodiosController@assistir');
*/