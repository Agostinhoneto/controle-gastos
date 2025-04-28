<?php

namespace App\Http\Controllers;

use App\Models\MetasFinanceiras;
use App\Models\User;
use Illuminate\Http\Request;

class MetasFinanceirasController extends Controller
{

    protected $metas;

    public function __construct(MetasFinanceiras $metas)
    {
        $this->metas = $metas;
    }

    public function index()
    {
        $metas = MetasFinanceiras::all();
        return view('metas.index', compact('metas'));
    }

    public function create()
    {
        return view('metas.create');
    }

    public function store(Request $request)
    {
        try {
            $this->metas->create([
                'usuario_cadastrante_id' => auth()->id(),
                'titulo' => $request->titulo,
                'descricao' => $request->descricao,
                'valor' => $request->valor,
                'valor_corrente' =>$request->valor_corrente,
                'data_inicio' => $request->data_inicio,
                'data_fim' => $request->data_fim,
            ]);
            return redirect()->route('metas.index')->with('success', 'Receita cadastrada com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Erro ao cadastrar a receita: ' . $e->getMessage());
        }
    }

    public function show(MetasFinanceiras $goal)
    {
        return view('metas.show', compact('goal'));
    }

    public function update(Request $request, MetasFinanceiras $goal)
    {
        $goal->update($request->all());

        return redirect()->route('metas.index')->with('success', 'Meta atualizada com sucesso!');
    }

    public function destroy(MetasFinanceiras $goal)
    {
        $goal->delete();
        return redirect()->route('metas.index')->with('success', 'Meta excluída com sucesso!');
    }
}
