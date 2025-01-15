<?php

use App\Http\Controllers\Api\ApiDespesasController;
use App\Http\Controllers\Api\ApiReceitasController;
use App\Http\Controllers\Api\ApiUsersController;
use App\Http\Controllers\Api\DespesasApiController;
use App\Http\Controllers\Api\ReceitasApiController;
use App\Http\Controllers\Api\UsersApiController;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//testando api
Route::get('/', function () {
    return view('info');
});

Route::get('/users/login', [UsersApiController::class, 'login'])->name('users.login');

//Route::middleware('api')->group(function () {
    //Users.
    Route::post('/users/register', [UsersApiController::class, 'register'])->name('users.register');
    Route::get('/users/index', [UsersApiController::class, 'index'])->name('users.index');
    Route::post('/users/store', [UsersApiController::class, 'store'])->name('users.store');
    Route::get('/users/show/{id}', [UsersApiController::class, 'show'])->name('users.show');
    Route::put('/users/update/{id}', [UsersApiController::class, 'update'])->name('users.update');
    Route::delete('/users/destroy/{id}', [UsersApiController::class, 'destroy'])->name('users.destroy');

    //Receitas.
    Route::get('/receitas/index', [ReceitasApiController::class, 'index']);
    Route::post('/receitas/store', [ReceitasApiController::class, 'store']);
    Route::get('/receitas/show/{id}', [ReceitasApiController::class, 'show'])->name('receitas.show');
    Route::put('/receitas/update/{id}', [ReceitasApiController::class, 'update'])->name('receitas.update');
    Route::delete('/receitas/destroy/{id}', [ReceitasApiController::class, 'destroy'])->name('receitas.destroy');

    // Despesas .
    Route::get('/despesas/index', [DespesasApiController::class, 'index']);
    Route::get('/despesas/store', [DespesasApiController::class, 'store']);
    Route::get('/despesas/show/{id}', [DespesasApiController::class, 'show'])->name('despesas.show');
    Route::put('/despesas/update/{id}', [DespesasApiController::class, 'update'])->name('despesas.update');
    Route::delete('/despesas/destroy/{id}', [DespesasApiController::class, 'destroy'])->name('despesas.destroy');
//});
