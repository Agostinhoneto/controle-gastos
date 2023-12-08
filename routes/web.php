<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DespesasController;
use App\Http\Controllers\ReceitasController;
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
    return view('welcome');
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
});

Route::middleware('auth')->group(function () {
    Route::get('/despesas', [DespesasController::class, 'index'])->name('despesas.index');
    Route::get('/despesas/create', [DespesasController::class, 'create'])->name('despesas.create');
    Route::post('/despesas/store', [DespesasController::class, 'store'])->name('despesas.store');
});
