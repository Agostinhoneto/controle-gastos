<?php

namespace App\Http\Controllers;

use App\Models\Despesas;
use App\Models\Receitas;
use Illuminate\Http\Request;

class FinancasController extends Controller
{
    public function index()
    {
        // Calcula o total de receitas e despesas
        $totalDespesas = Despesas::sum('valor');
        $totalReceitas = Receitas::sum('valor');

        // Calcula o saldo final
        $saldoFinal = $totalReceitas - $totalDespesas;

        // Recupera os registros recentes
        $despesasRecentes = Despesas::with('categoria')->orderBy('created_at', 'desc')->take(5)->get();
        $receitasRecentes = Receitas::with('categoria')->orderBy('created_at', 'desc')->take(5)->get();

        return view('financas.index', compact('totalDespesas', 'totalReceitas', 'saldoFinal', 'despesasRecentes', 'receitasRecentes'));
    }
}
