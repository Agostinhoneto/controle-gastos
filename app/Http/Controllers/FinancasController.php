<?php

namespace App\Http\Controllers;

use App\Models\Despesas;
use App\Models\Receitas;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FinancasController extends Controller
{
    public function index()
    {

        $totalDespesas = Despesas::sum('valor');
        $totalReceitas = Receitas::sum('valor');

        $saldoFinal = $totalReceitas - $totalDespesas;

        $despesasRecentes = Despesas::with('categoria')->orderBy('created_at', 'desc')->take(5)->get();
        $receitasRecentes = Receitas::with('categoria')->orderBy('created_at', 'desc')->take(5)->get();

        Carbon::setLocale('pt_BR'); 
        $mesAtual = ucfirst(Carbon::now()->translatedFormat('F'));
        
        return view('financas.index', compact('totalDespesas', 'totalReceitas', 'saldoFinal', 'despesasRecentes', 'receitasRecentes','mesAtual'));
    }
}
