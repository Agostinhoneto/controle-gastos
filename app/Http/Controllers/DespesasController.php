<?php

namespace App\Http\Controllers;

use App\Models\Despesas;
use App\Services\DespesaService;
use Illuminate\Http\Request;

class DespesasController extends Controller
{
    protected $depesaService;

    public function __constrct(DespesaService $depesaService)
    {
        $this->depesaService = $depesaService;
    }

    public function index(Request $request)
    {
        $totalValor = Despesas::sum('valor');
        $despesas = Despesas::query()
            ->orderBy('descricao')
            ->get();

        $mensagem = $request->session()->get('mensagem');
        return view('despesas.index', compact('despesas', 'mensagem','totalValor'));
    }

    public function create()
    {
        return view('despesas.create');
    }

    public function store(Request $request, DespesaService $receitaService)
    {
        Despesas::create([
            'descricao' => $request->descricao,
            'valor' => $request->valor,
            'data_pagamento' => $request->data_pagamento,
        ]);

        $request->session()->flash('mensagem', "Despesa criada com sucesso");
        return redirect()->route('despesas.index');
    }

    public function calcularTotal()
    {
        return view('despesas.index', ['totalValor' => $totalValor]);
    }
}
