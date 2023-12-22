<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use App\Models\Despesas;
use App\Services\DespesaService;
use Illuminate\Http\Request;

class DespesasController extends Controller
{

    public function index(Request $request)
    {
        $totalValor = Despesas::sum('valor');
        $despesas = Despesas::query()->orderBy('descricao')->get();
        $categorias = Despesas::with('categoria')->get();

        $mensagem = $request->session()->get('mensagem');
        return view('despesas.index', compact('despesas', 'mensagem','totalValor','categorias'));
    }

    public function create()
    {
        return view('despesas.create');
    }

    public function store(Request $request)
    {
        $despesas = new Despesas();
        $despesas->descricao = $request->input('descricao');
        $despesas->valor = $request->input('valor');
        $despesas->data_pagamento = $request->input('data_pagamento');
        $despesas->categoria_id = $request->input('categoria_id');
        $despesas->status = $request->input('status', 1);
        $despesas->save();

        $request->session()->flash('mensagem', "Despesa criada com sucesso");
        return redirect()->route('despesas.index');
    }

    public function edit(Despesas $despesas,$id)
    {
        $despesas = Despesas::find($id);
        $categorias = Categorias::query()->orderBy('descricao')->get();
        return view('despesas.edit', compact('despesas','categorias'));
    }

    public function update(Request $request,Despesas $despesas)
    {
        $despesas = new Despesas();
        $despesas->descricao = $request->descricao;
        $despesas->valor = $request->valor;
        $despesas->data_pagamento = $request->data_pagamento;
        $despesas->categoria_id  = $request->categoria_id;
        $despesas->status = $request->status;
        $despesas->save();
        return redirect()->route('despesas.index')->with('success', 'Despesas atualizada com sucesso!');
    }

    public function destroy(Despesas $despesas)
    {
        $despesas->delete();
        $mensagem = session()->get('mensagem');
        return redirect()->route('despesas.index')->with('success', 'Despesa excluida com sucesso!');

    }
}
