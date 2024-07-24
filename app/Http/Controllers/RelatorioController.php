<?php

namespace App\Http\Controllers;

use App\Models\Despesas;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Mpdf\Mpdf;

class RelatorioController extends Controller
{
    /*
        public function index()
        {
            $categorias = Categorias::query()->orderBy('descricao')->get();

            return view('relatorios.index',compact('categorias'));
        }
    */
    public function index()
    {
        $despesas = Despesas::all(); 
        return view('relatorios.index',compact('despesas'));
    }

    public function gerarPDF(Request $request)
    {
        $filter1 = $request->input('filter1');
        $filter2 = $request->input('filter2');
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
    
    
    // outro exemplo
    public function generatePDF(Request $request)
    {

        $created_at = Carbon::parse($request->start_date)->startOfDay();
        $data_pagamento = Carbon::parse($request->end_date)->endOfDay();

        // Obter dados filtrados
        $despesas = Despesas::whereBetween('data_pagamento', [$created_at, $data_pagamento])->get();

        // Renderizar a view com os dados filtrados
        $htmlContent = view('pdf_content', compact('despesas'))->render();

        // Criar uma instância do mPDF
        $mpdf = new Mpdf();

        // Escrever o conteúdo HTML no mPDF
        $mpdf->WriteHTML($htmlContent);

        // Saída do PDF diretamente para o navegador
        return $mpdf->Output('documento.pdf', 'I');
    }

}
