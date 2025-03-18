<?php

namespace App\Http\Controllers;

use App\Models\MetasFinanceiras;
use App\Models\User;
use Illuminate\Http\Request;

class MetasFinanceirasController extends Controller
{
    public function index()
    {
        $metas = auth()->user()->metas;
        return view('metas.index', compact('metas'));
    }

    public function create()
    {
        return view('metas.create');
    }

    public function store(Request $request)
    {
        $user = User::find(1); 

        $user->metas()->create([
            'titulo' => 'Economizar para viagem',
            'descricao' => 'Economizar R$ 5.000 para uma viagem no final do ano.',
            'valor_alvo' => 5000,
            'valor_atual' => 0,
            'data_limite' => '2023-12-31',
        ]);

        return redirect()->route('metas.index')->with('success', 'Meta criada com sucesso!');
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
