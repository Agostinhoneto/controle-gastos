<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use App\Models\Despesas;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF;
use Dompdf\Adapter\PDFLib;
use Illuminate\Http\Request;

class RelatorioController extends Controller
{

    public function index()
    {
        $categorias = Categorias::query()->orderBy('descricao')->get();

        return view('relatorios.index',compact('categorias'));
    }

    public function gerarPDF(Request $request)
    {
        // Lógica para gerar o PDF com base nos filtros do formulário
        $filter1 = $request->input('filter1');
        $filter2 = $request->input('filter2');
        // Consulta ao banco de dados com base nos filtros
        $reports = Despesas::where('descricao', $filter1)
            ->where('id', $filter2)
            ->get();
        $data = [
            'descricao' => $filter1,
            'id' => $filter2,
        ];
        $pdf = FacadePdf::loadView('relatorios.pdf', compact('data'));

        return $pdf->download('relatorio.pdf');

      
    }
}
