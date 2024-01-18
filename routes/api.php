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

//Users.
Route::get('/users/index',[ApiUsersController::class,'index']);
Route::post('/users/store',[ApiUsersController::class,'store']);


//Receitas.
Route::get('/receitas/index',[ApiReceitasController::class,'index']);


// Receitas .
Route::get('/receitas/index',[ApiDespesasController::class,'index']);
Route::get('/receitas/store',[ApiDespesasController::class,'store']);
