<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\DespesasController;
use App\Http\Controllers\EventoFinanceirosController;
use App\Http\Controllers\FinancasController;
use App\Http\Controllers\FinancialGoalController;
use App\Http\Controllers\LembretesPagamentoController;
use App\Http\Controllers\ReceitasController;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\UserController;
use App\Models\Despesas;
use App\Models\FinancialGoal;
use App\Models\Receitas;
use App\Models\User;
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

Route::get('/logout', [AuthenticatedSessionController::class, 'logout'])->name('logout');


Route::get('/dashboard', function () {
    $totalReceitas = Receitas::count('id');
    $totalDespesas = Despesas::count('id');
    $totalUsuarios = User::count('id');
    $totalMetas = FinancialGoal::count('id');
    return view('dashboard', compact('totalReceitas', 'totalDespesas', 'totalUsuarios', 'totalMetas'));
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
});

require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/users/update/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/destroy/{users}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/receitas', [ReceitasController::class, 'index'])->name('receitas.index');
    Route::get('/receitas/create', [ReceitasController::class, 'create'])->name('receitas.create');
    Route::post('/receitas/store', [ReceitasController::class, 'store'])->name('receitas.store');
    Route::get('/receitas/edit/{id}', [ReceitasController::class, 'edit'])->name('receitas.edit');
    Route::post('/receitas/update/{id}', [ReceitasController::class, 'update'])->name('receitas.update');
    Route::delete('/receitas/destroy/{receitas}', [ReceitasController::class, 'destroy'])->name('receitas.destroy');

    Route::get('/despesas', [DespesasController::class, 'index'])->name('despesas.index');
    Route::get('/despesas/create', [DespesasController::class, 'create'])->name('despesas.create');
    Route::post('/despesas/store', [DespesasController::class, 'store'])->name('despesas.store');
    Route::get('/despesas/edit/{id}', [DespesasController::class, 'edit'])->name('despesas.edit');
    Route::post('/despesas/update/{id}', [DespesasController::class, 'update'])->name('despesas.update');
    Route::delete('/despesas/destroy/{despesas}', [DespesasController::class, 'destroy'])->name('despesas.destroy');
    Route::get('/enviar-alerta/{userId}/{gastoAtual}/{limiteGastos}', [DespesasController::class, 'enviarAlertaDespesa'])->name('enviar.alerta');
    Route::get('/enviar-email', [DespesasController::class, 'enviarEmail']);
   
    //relatorios
    Route::get('/despesas/gerar-pdf-despesas', [DespesasController::class, 'gerarPdf'])->name('despesas.gerar-pdf');

    Route::get('/minhas-financas', [FinancasController::class, 'index'])->name('financas.index');

    Route::get('/categorias', [CategoriasController::class, 'index'])->name('categorias.index');
    Route::get('/categorias/show/{id}', [CategoriasController::class, 'show'])->name('categorias.show');

    Route::get('/categorias/create', [CategoriasController::class, 'create'])->name('categorias.create');
    Route::post('/categorias/store', [CategoriasController::class, 'store'])->name('categorias.store');
    Route::get('/categorias/edit/{id}', [CategoriasController::class, 'edit'])->name('categorias.edit');
    Route::post('/categorias/update/{id}', [CategoriasController::class, 'update'])->name('categorias.update');
    Route::delete('/categorias/destroy/{categorias}', [CategoriasController::class, 'destroy'])->name('categorias.destroy');
    Route::get('/contatos', [ContatoController::class, 'index'])->name('contatos.index');
    Route::post('/contatos/store', [ContatoController::class, 'store'])->name('contatos.store');
    //Eventos
    Route::get('/eventos', [EventoFinanceirosController::class, 'index'])->name('eventos.index');
    Route::post('/eventos', [EventoFinanceirosController::class, 'store'])->name('eventos.store');

    Route::get('/relatorios/exportar/pdf', [RelatorioController::class, 'exportarPDF'])->name('relatorios.exportar.pdf');
    Route::get('/relatorios/exportar/excel', [RelatorioController::class, 'exportarExcel'])->name('relatorios.exportar.excel');
    Route::get('/relatorio', [RelatorioController::class, 'index'])->name('relatorios.index');
    Route::get('/relatorio/gerar', [RelatorioController::class, 'gerarPDF'])->name('relatorios.despesas');
    Route::get('/reports', [RelatorioController::class, 'gerarPDF'])->name('report.despesas');
    Route::get('/relatorios/comparacao', [RelatorioController::class, 'comparar'])->name('relatorios.comparacao');

    Route::get('/financial/index', [FinancialGoalController::class, 'index'])->name('financial.index');
    Route::get('/financial/show/{id}', [FinancialGoalController::class, 'show'])->name('financial.show');
    Route::get('/financial/create', [FinancialGoalController::class, 'create'])->name('financial.create');
    Route::post('/financial/store', [FinancialGoalController::class, 'store'])->name('financial.store');
    Route::get('/financial/edit/{id}', [FinancialGoalController::class, 'edit'])->name('financial.edit');
    Route::post('/financial/update/{id}', [FinancialGoalController::class, 'update'])->name('financial.update');
    Route::delete('/financial/destroy/{financial}', [FinancialGoalController::class, 'destroy'])->name('financial.destroy');

    Route::get('/lembretes/index', [LembretesPagamentoController::class, 'index'])->name('lembretes.index');
    Route::get('/lembretes/show/{id}', [LembretesPagamentoController::class, 'show'])->name('lembretes.show');
    Route::get('/lembretes/create', [LembretesPagamentoController::class, 'create'])->name('lembretes.create');
    Route::post('/lembretes/store', [LembretesPagamentoController::class, 'store'])->name('lembretes.store');
    Route::get('/lembretes/edit/{id}', [LembretesPagamentoController::class, 'edit'])->name('lembretes.edit');
    Route::post('/lembretes/update/{id}', [LembretesPagamentoController::class, 'update'])->name('lembretes.update');
    Route::delete('/lembretes/destroy/{lembretes}', [LembretesPagamentoController::class, 'destroy'])->name('lembretes.destroy');

    Route::get('/charts', [ChartController::class, 'index'])->name('charts.index');
});
