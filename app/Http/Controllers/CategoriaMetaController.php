<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use App\Models\MetasCategorias;
use Illuminate\Http\Request;

class CategoriaMetaController extends Controller
{
    public function index(Categorias $category)
    {
        $goals = $category->goals;
        return view('goals.index', compact('category', 'goals'));
    }

    public function create(Categorias $Categorias)
    {
        return view('goals.create', compact('Categorias'));
    }

    public function store(Request $request, Categorias $Categorias)
    {
        $request->validate([
            'goal_amount' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $Categorias->goals()->create($request->all());

        return redirect()->route('categories.goals.index', $Categorias)
                         ->with('success', 'Meta criada com sucesso!');
    }

    public function edit(Categorias $Categorias, MetasCategorias $goal)
    {
        return view('goals.edit', compact('category', 'goal'));
    }

    public function update(Request $request, Categorias $category, MetasCategorias $goal)
    {
        $request->validate([
            'goal_amount' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $goal->update($request->all());

        return redirect()->route('categories.goals.index', $category)
                         ->with('success', 'Meta atualizada com sucesso!');
    }

    public function destroy(Categorias $category, MetasCategorias $goal)
    {
        $goal->delete();

        return redirect()->route('categories.goals.index', $category)
                         ->with('success', 'Meta excluída com sucesso!');
    }
}
