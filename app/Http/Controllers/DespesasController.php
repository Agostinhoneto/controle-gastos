<?php

namespace App\Http\Controllers;

use App\Models\Despesas;
use App\Services\DespesaService;
use Illuminate\Http\Request;

class DespesasController extends Controller
{

    public function index(Request $request)
    {
        $totalValor = Despesas::sum('valor');
        $despesas = Despesas::query()->orderBy('descricao')
            ->get();
     
        $mensagem = $request->session()->get('mensagem');
        return view('despesas.index', compact('despesas', 'mensagem','totalValor'));
    }

    public function create()
    {
        return view('despesas.create');
    }

    public function store(Request $request)
    {
        Despesas::create([
            'descricao' => $request->descricao,
            'valor' => $request->valor,
            'data_pagamento' => $request->data_pagamento,
        ]);
        $request->session()->flash('mensagem', "Despesa criada com sucesso");
        return redirect()->route('despesas.index');
    } 
}
