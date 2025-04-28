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
    protected $receitas;

    public function __construct(Receitas $receitas)
    {
        $this->receitas = $receitas;
    }

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

    public function create()
    {
        try {
            $categorias = Categorias::orderBy('descricao')->get();
            return view('receitas.create', compact('categorias'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Erro ao carregar o formulário de criação: ' . $e->getMessage());
        }
    }

    public function store(StoreReceitasRequest $request)
    {
        try {
            $this->receitas->create([
                'descricao' => $request->descricao,
                'valor' => $request->valor,
                'data_recebimento' => $request->data_recebimento,
                'categoria_id' => $request->categoria_id,
                'usuario_cadastrante_id' => auth()->id(),
            ]);
            return redirect()->route('receitas.index')->with('success', 'Receita cadastrada com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Erro ao cadastrar a receita: ' . $e->getMessage());
        }
    }

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
