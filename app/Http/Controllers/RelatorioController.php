<?php

namespace App\Http\Controllers;

use App\Models\Despesas;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

class RelatorioController extends Controller
{
    public function gerarPDF()
    {

            // Use Eloquent para buscar dados
            $data = Despesas::all();
            dd($data);        

            // Carregue a visualização do relatório
            $pdf = PDF::loadView('relatorio', compact('data'));
    
            // Faça o download do PDF ou exiba na tela
            return $pdf->download('relatorio.pdf');
    }
}
