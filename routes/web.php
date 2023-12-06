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

require __DIR__.'/auth.php';


Route::get('/receitas', [ReceitasController::class, 'index'])->name('listar_receitas');
Route::get('/receitas/create', [ReceitasController::class, 'create']);
Route::post('/receitas/store', [ReceitasController::class, 'store'])->name('criar_receitas');
Route::get('/despesas', [DespesasController::class, 'index'])->name('listar_despesas');
Route::get('/despesas/create', [DespesasController::class, 'create']);
Route::post('/despesas/store', [DespesasController::class, 'store'])->name('criar_despesas');

