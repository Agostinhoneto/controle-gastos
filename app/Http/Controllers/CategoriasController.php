<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    public function index(Request $request)
    {
        try {
            $categorias = Categorias::query()->orderBy('descricao')->get();
            $mensagem = $request->session()->get('mensagem');

            return view('categorias.index', compact('categorias', 'mensagem'));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Erro ao carregar categorias: ' . $e->getMessage());
            return back()->withErrors('Erro ao carregar as categorias. Tente novamente mais tarde.');
        }
    }

    public function show($id)
    {
        try {
            $categoria = Categorias::with(['categoriasmetas', 'despesas'])->findOrFail($id);

            $progressData = $categoria->categoriasmetas->map(function ($meta) use ($categoria) {
                $totalDespesas = $categoria->despesas()
                    ->whereBetween('data_pagamento', [$meta->start_date, $meta->end_date])
                    ->sum('valor');

                $progresso = $meta->meta_valor ? ($totalDespesas / $meta->meta_valor) * 100 : 0;

                return [
                    'meta' => $meta,
                    'totalDespesas' => $totalDespesas,
                    'progresso' => $progresso,
                    'status' => $progresso > 100 ? 'Meta ultrapassada!' : 'Dentro do limite',
                ];
            });

            return view('categorias.show', compact('categoria', 'progressData'));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Erro ao exibir categoria: ' . $e->getMessage());
            return back()->withErrors('Erro ao exibir a categoria. Tente novamente mais tarde.');
        }
    }

    public function create()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'descricao' => 'required|string|max:255',
            'despesas_id' => 'nullable|integer|exists:despesas,id',
            'receitas_id' => 'nullable|integer|exists:receitas,id',
        ]);

        try {
            Categorias::create($validatedData);

            $request->session()->flash('mensagem', 'Categoria criada com sucesso!');
            return redirect()->route('categorias.index');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Erro ao criar categoria: ' . $e->getMessage());
            return back()->withErrors('Erro ao criar a categoria. Tente novamente mais tarde.');
        }
    }

    public function edit($id)
    {
        try {
            $categoria = Categorias::findOrFail($id);
            return view('categorias.edit', compact('categoria'));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Erro ao editar categoria: ' . $e->getMessage());
            return back()->withErrors('Erro ao carregar os dados da categoria. Tente novamente mais tarde.');
        }
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'descricao' => 'required|string|max:255',
            'despesas_id' => 'nullable|integer|exists:despesas,id',
            'receitas_id' => 'nullable|integer|exists:receitas,id',
        ]);

        try {
            $categoria = Categorias::findOrFail($id);
            $categoria->update($validatedData);

            return redirect()->route('categorias.index')->with('success', 'Categoria atualizada com sucesso!');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Erro ao atualizar categoria: ' . $e->getMessage());
            return back()->withErrors('Erro ao atualizar a categoria. Tente novamente mais tarde.');
        }
    }

    public function destroy($id)
    {
        try {
            $categoria = Categorias::findOrFail($id);
            $categoria->delete();

            return redirect()->route('categorias.index')->with('success', 'Categoria excluída com sucesso!');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Erro ao excluir categoria: ' . $e->getMessage());
            return back()->withErrors('Erro ao excluir a categoria. Tente novamente mais tarde.');
        }
    }
}
