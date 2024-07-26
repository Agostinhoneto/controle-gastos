<?php

namespace App\Http\Controllers;

use App\Models\Despesas;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
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
}
