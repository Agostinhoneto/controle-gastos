<?php

namespace App\Http\Controllers;

use App\Models\Despesas;
use App\Models\Receitas;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function index()
    {
        try {
            $despesas = Despesas::selectRaw('MONTH(created_at) as mes, SUM(valor) as total')
                ->groupBy('mes')
                ->orderBy('mes')
                ->pluck('total', 'mes');

            $receitas = Receitas::selectRaw('MONTH(created_at) as mes, SUM(valor) as total')
                ->groupBy('mes')
                ->orderBy('mes')
                ->pluck('total', 'mes');

            $meses = ['Jan', 'Fev', 'Mar', 'Abr', 'Maio', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];

            $despesasTotais = array_fill(0, 12, 0);
            $receitasTotais = array_fill(0, 12, 0);

            foreach ($despesas as $mes => $total) {
                $despesasTotais[$mes - 1] = $total;
            }

            foreach ($receitas as $mes => $total) {
                $receitasTotais[$mes - 1] = $total;
            }

            return view('charts.index', compact('meses', 'despesasTotais', 'receitasTotais'));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Erro ao recuperar dados para o gráfico: ' . $e->getMessage());
            return back()->withErrors('Ocorreu um erro ao carregar os dados do gráfico. Por favor, tente novamente mais tarde.');
        }
    }
}
