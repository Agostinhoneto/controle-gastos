<?php

use App\Http\Controllers\Api\ApiDespesasController;
use App\Http\Controllers\Api\ApiReceitasController;
use App\Http\Controllers\Api\ApiUsersController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//testando api
Route::get('/', function () {
    return response()->json([
        'sucess' => true
    ]);
});


//Users.
Route::get('/users/index',[ApiUsersController::class,'index'])->name('users.index');
Route::post('/users/store',[ApiUsersController::class,'store'])->name('users.store');
Route::get('/users/show/{id}', [ApiUsersController::class, 'show'])->name('users.show');
Route::put('/users/update/{id}', [ApiUsersController::class, 'update'])->name('users.update');
Route::delete('/users/destroy/{id}', [ApiUsersController::class, 'destroy'])->name('users.destroy');

//Receitas.
Route::get('/receitas/index',[ApiReceitasController::class,'index']);
Route::post('/receitas/store',[ApiReceitasController::class,'store']);
Route::get('/receitas/show/{id}', [ApiReceitasController::class, 'show'])->name('receitas.show');
Route::put('/receitas/update/{id}', [ApiReceitasController::class, 'update'])->name('receitas.update');
Route::delete('/receitas/destroy/{id}', [ApiReceitasController::class, 'destroy'])->name('receitas.destroy');


// Despesas .
Route::get('/despesas/index',[ApiDespesasController::class,'index']);
Route::get('/despesas/store',[ApiDespesasController::class,'store']);
Route::get('/despesas/show/{id}', [ApiDespesasController::class, 'show'])->name('despesas.show');
Route::put('/despesas/update/{id}', [ApiDespesasController::class, 'update'])->name('despesas.update');
Route::delete('/despesas/destroy/{id}', [ApiDespesasController::class, 'destroy'])->name('despesas.destroy');
