<?php

namespace App\Http\Controllers;

use App\Models\Despesas;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

class RelatorioController extends Controller
{

    public function index()
    {
        return view('relatorios.index');
    }

    public function gerarPDF()
    {
        $despesas = Despesas::all();
        $pdf = PDF::loadView('pdf', compact('despesas'));
        return $pdf->setPaper('a4')->stream('relatorios.despesas.pdf');
    }
}
