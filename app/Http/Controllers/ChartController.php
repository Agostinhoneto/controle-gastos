<?php

namespace App\Http\Controllers;

use App\Models\Despesas;
use App\Models\Receitas;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function index()
    {
        // Exemplo de dados: despesas e receitas por mês
        $despesas = Despesas::selectRaw('MONTH(created_at) as mes, SUM(valor) as total')
            ->groupBy('mes')
            ->orderBy('mes')
            ->pluck('total', 'mes');

        $receitas = Receitas::selectRaw('MONTH(created_at) as mes, SUM(valor) as total')
            ->groupBy('mes')
            ->orderBy('mes')
            ->pluck('total', 'mes');

        return view('charts.index', compact('despesas', 'receitas'));
    }
}
