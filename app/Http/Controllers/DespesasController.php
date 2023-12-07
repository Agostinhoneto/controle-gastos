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
        $despesas = Despesas::query()
            ->orderBy('descricao')
            ->get();
        $mensagem = $request->session()->get('mensagem');
        return view('despesas.index', compact('despesas', 'mensagem'));
    }

    public function create() 
    {
        return view('receitas.create');
    }

    public function store(Request $request, DespesaService $receitaService)
    {
        Despesas::create([
            'descricao' => $request->descricao,
            'valor' => $request->valor,
            'data_recebimento' => $request->data_recebimento,
        ]);
            
        $request->session()->$request->flash('mensagem',"Despesa criada com sucesso");
        return redirect()->route('listar_receitas');
    }
}
