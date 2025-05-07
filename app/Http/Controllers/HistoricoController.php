<?php

namespace App\Http\Controllers;

use App\Models\Despesas;
use App\Models\Receitas;

class HistoricoController extends Controller
{
    public function index()
    {
        $despesas = Despesas::all();
        $receitas = Receitas::all();
        $totalReceitas = (float)(Receitas::sum('valor') ?? 0);
        $totalDespesas = (float)(Despesas::sum('valor') ?? 0);
        $total = ($totalReceitas ?? 0) - ($totalDespesas ?? 0);
        return view('historico.index', compact('despesas', 'receitas', 'totalDespesas', 'totalReceitas', 'totalDespesas', 'totalReceitas', 'total'));
    }
}
