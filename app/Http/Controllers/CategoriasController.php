<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    public function index(Request $request)
    {
        $categorias = Categorias::query()->orderBy('descricao')->get();
        $mensagem = $request->session()->get('mensagem');
        return view('categorias.index', compact('categorias','mensagem'));
    }

    public function show($id)
    {
        $category = Categorias::with('metas', 'despesas')->findOrFail($id);

        $progressData = $category->goals->map(function ($goal) use ($category) {
            $totalExpenses = $category->expenses()
                ->whereBetween('data', [$goal->start_date, $goal->end_date])
                ->sum('valor');

            $progress = $totalExpenses / $goal->goal_amount * 100;

            return [
                'metas' => $goal,
                'totalExpenses' => $totalExpenses,
                'progress' => $progress,
                'status' => $progress > 100 ? 'Meta ultrapassada!' : 'Dentro do limite',
            ];
        });

        return view('categories.show', compact('category', 'progressData'));
    }
    
    public function create()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        Categorias::create([
            'descricao' => $request->descricao,
            'despesas_id' => $request->despesas_id,
            'receitas_id' => $request->receitas_id,
        ]);
        $request->session()->flash('mensagem', "Categorias criada com sucesso");
        return redirect()->route('categorias.index');
    }

    public function edit(Categorias $categorias,$id)
    {
        $categorias = Categorias::find($id);
        return view('categorias.edit', ['categorias' => $categorias]);
    }

    public function update(Request $request,$id)
    {
        $categorias = Categorias::findOrFail($id);
        $categorias->update($request->all());
        return redirect()->route('categorias.index')->with('success', 'Categorias atualizada com sucesso!');   
    }

    public function destroy(Categorias $categorias)
    {
        $categorias->delete();
        $mensagem = session()->get('mensagem');
        return redirect()->route('categorias.index')->with('success', 'Categorias excluida com sucesso!');
    }
}
