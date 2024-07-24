<?php

namespace App\Http\Controllers;

use App\Exports\OrdersExport;
use App\Models\Despesas;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel as Excel;


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

}
