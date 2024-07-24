<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\DespesasController;
use App\Http\Controllers\ReceitasController;
use App\Http\Controllers\RelatorioController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
});

require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/receitas', [ReceitasController::class, 'index'])->name('receitas.index');
    Route::get('/receitas/create', [ReceitasController::class, 'create'])->name('receitas.create');
    Route::post('/receitas/store', [ReceitasController::class, 'store'])->name('receitas.store');
    Route::get('/receitas/edit/{id}', [ReceitasController::class, 'edit'])->name('receitas.edit');
    Route::post('/receitas/update/{id}', [ReceitasController::class, 'update'])->name('receitas.update');
    Route::delete('/receitas/destroy/{receitas}', [ReceitasController::class, 'destroy'])->name('receitas.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/despesas', [DespesasController::class, 'index'])->name('despesas.index');
    Route::get('/despesas/create', [DespesasController::class, 'create'])->name('despesas.create');
    Route::post('/despesas/store', [DespesasController::class, 'store'])->name('despesas.store');
    Route::get('/despesas/edit/{id}', [DespesasController::class, 'edit'])->name('despesas.edit');
    Route::post('/despesas/update', [DespesasController::class, 'update'])->name('despesas.update');
    Route::delete('/despesas/destroy/{despesas}', [DespesasController::class, 'destroy'])->name('despesas.destroy');
    //relatorios
    Route::get('/despesas/gerar-pdf-despesas', [DespesasController::class, 'gerarPdf'])->name('despesas.gerar-pdf');
});

Route::middleware('auth')->group(function () {
    Route::get('/categorias', [CategoriasController::class, 'index'])->name('categorias.index');
    Route::get('/categorias/create', [CategoriasController::class, 'create'])->name('categorias.create');
    Route::post('/categorias/store', [CategoriasController::class, 'store'])->name('categorias.store');
    Route::get('/categorias/edit/{id}', [CategoriasController::class, 'edit'])->name('categorias.edit');
    Route::post('/categorias/update', [CategoriasController::class, 'update'])->name('categorias.update');
    Route::delete('/categorias/destroy/{categorias}', [CategoriasController::class, 'destroy'])->name('categorias.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/relatorio', [RelatorioController::class, 'index'])->name('relatorios.index');

    Route::get('/relatorio/gerar', [RelatorioController::class, 'gerarPDF'])->name('relatorios.despesas');


});
