<?php

namespace App\Http\Controllers;

use App\Models\Despesas;
use App\Models\Relatorios;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Mpdf\Mpdf;

class RelatorioController extends Controller
{
    public function index()
    {
        $despesas = Despesas::all();
        $total = $despesas->sum('valor');
        return view('relatorios.index', compact('despesas', 'total'));
    }

    public function gerarPDF(Request $request)
    {

        $filter1 = $request->input('filter1');
        $filter2 = $request->input('filter2');

        $reports = Despesas::all();

        $data = [
            'title' => 'Relatório de Despesas',
            'date' => date('m/d/Y'),
            'depesas' => \App\Models\Despesas::all()
        ];

        $pdf = FacadePdf::loadView('relatorios.pdf', compact('data', 'reports'));
        return $pdf->download('relatorio.pdf');
    }


    public function filter(Request $request)
    {
        $query = Despesas::query();

        if ($request->has('descricao')) {
            $query->where('descricao', 'like', '%' . $request->input('descricao') . '%');
        }

        if ($request->has('valor')) {
            $query->where('valor', $request->input('valor'));
        }

        $despesas = $query->orderBy('created_at', 'desc')->get();

        return view('relatorios.pdf', compact('despesas'));
    }

    public function exportarPDF()
    {
        $dados = Relatorios::all(); // Dados do relatório
        $pdf = FacadePdf::loadView('relatorios.pdf', compact('dados'));
        return $pdf->download('relatorio-financeiro.pdf');
    }
    /*
    public function exportarExcel()
    {
        return exportarExcel::download(new RelatoriosExport, 'relatorio-financeiro.xlsx');
    }
*/
    public function comparar(Request $request)
    {
        $periodo1 = $request->input('periodo1');
        $periodo2 = $request->input('periodo2');

        // Lógica para calcular os gastos de cada período
        $gastosPeriodo1 = Despesas::whereMonth('data', date('m', strtotime($periodo1)))
            ->whereYear('data', date('Y', strtotime($periodo1)))
            ->sum('valor');

        $gastosPeriodo2 = Despesas::whereMonth('data', date('m', strtotime($periodo2)))
            ->whereYear('data', date('Y', strtotime($periodo2)))
            ->sum('valor');

        return view('relatorios.comparacao', compact('gastosPeriodo1', 'gastosPeriodo2', 'periodo1', 'periodo2'));
    }
}
