<?php

use App\Http\Controllers\DespesasController;
use App\Http\Controllers\ProfileController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
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
