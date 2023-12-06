<?php

use App\Http\Controllers\DespesasController;
use App\Http\Controllers\ReceitasController;
use App\Models\Despesas;
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


Route::get('/despesas', [DespesasController::class, 'index'])->name('listar_despesas');
Route::get('/despesas/create', [DespesasController::class, 'create']);
Route::post('/despesas/store', [DespesasController::class, 'store'])->name('criar_despesas');

/*
Route::delete('/series/{id}', 'SeriesController@destroy');
Route::post('/series/{id}/editaNome', 'SeriesController@editaNome');
Route::get('/series/{serieId}/temporadas', 'TemporadasController@index');
Route::get('/temporadas/{temporada}/episodios', 'EpisodiosController@index');
Route::post('/temporadas/{temporada}/episodios/assistir', 'EpisodiosController@assistir');
*/