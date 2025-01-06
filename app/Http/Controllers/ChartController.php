<?php

namespace App\Http\Controllers;

use App\Models\Despesas;
use App\Models\Receitas;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function index()
    {
    
        $despesas = Despesas::selectRaw('MONTH(created_at) as mes, SUM(valor) as total')
            ->groupBy('mes')
            ->orderBy('mes')
            ->pluck('total', 'mes');

        $receitas = Receitas::selectRaw('MONTH(created_at) as mes, SUM(valor) as total')
            ->groupBy('mes')
            ->orderBy('mes')
            ->pluck('total', 'mes');

        // Aqui você provavelmente já tem a lógica para calcular os totais de despesas e receitas
        $meses = ['Jan', 'Fev', 'Marc', 'Abr', 'Maio', 'Jun', 'Jul', 'Aug', 'Set', 'Out', 'Nov', 'Dez']; // Exemplo de meses
        $despesasTotais = [1000, 1200, 900, 1400, 1100, 1300, 1200, 1500, 1600, 1700, 1800, 2000]; // Exemplo de dados de despesas
        $receitasTotais = [2000, 2200, 2100, 2400, 2300, 2500, 2400, 2600, 2700, 2800, 3000, 3200]; // Exemplo de dados de receitas

        return view('charts.index', compact('despesas', 'receitas', 'meses', 'despesasTotais', 'receitasTotais'));
    }
}
