<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReceitasRequest;
use App\Models\Categorias;
use App\Models\Receitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReceitasController extends Controller
{
    /**
     * Display a listing of receitas.
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index(Request $request)
    {
        try {
            if (!Auth::check()) {
                return abort(403, 'Acesso não autorizado.');
            }

            $receitas = Receitas::with('categoria')->get();
            $total = $receitas->sum('valor');
            $categorias = Categorias::orderBy('descricao')->get();
            $mensagem = $request->session()->get('mensagem');

            return view('receitas.index', compact('receitas', 'mensagem', 'categorias', 'total'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Erro ao carregar as receitas: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new receita.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        try {
            $categorias = Categorias::orderBy('descricao')->get();
            return view('receitas.create', compact('categorias'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Erro ao carregar o formulário de criação: ' . $e->getMessage());
        }
    }

    /**
     * Store a newly created receita in storage.
     *
     * @param StoreReceitasRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreReceitasRequest $request)
    {
        try {
            $data = $request->only(['descricao', 'valor', 'data_recebimento', 'categoria_id']);
            $data['status'] = $request->input('status', 1); // Valor padrão para status.

            Receitas::create($data);

            return redirect()->route('receitas.index')->with('success', 'Receita cadastrada com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Erro ao cadastrar a receita: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified receita.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit(Request $request, $id)
    {
        try {
            $receitas = Receitas::findOrFail($id);
            $mensagem = $request->session()->get('mensagem');
            $categorias = Categorias::orderBy('descricao')->get();

            return view('receitas.edit', compact('receitas', 'categorias', 'mensagem'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('receitas.index')->withErrors('Receita não encontrada.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Erro ao carregar o formulário de edição: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified receita in storage.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $receitas = Receitas::findOrFail($id);
            $receitas->update($request->only(['descricao', 'valor', 'data_recebimento', 'categoria_id', 'status']));

            return redirect()->route('receitas.index')->with('success', 'Receita atualizada com sucesso!');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('receitas.index')->withErrors('Receita não encontrada.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Erro ao atualizar a receita: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified receita from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            $receitas = Receitas::findOrFail($id);
            $receitas->delete();

            return redirect()->route('receitas.index')->with('success', 'Receita excluída com sucesso!');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('receitas.index')->withErrors('Receita não encontrada.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Erro ao excluir a receita: ' . $e->getMessage());
        }
    }
}
