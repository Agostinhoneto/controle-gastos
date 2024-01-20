<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use App\Models\Receitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReceitasController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::check()) {
            echo "Não autenticado";
            exit();
        }

        $receitas = Receitas::query()->with('categoria')->orderBy('descricao')->get();
        $categorias = Categorias::query()->orderBy('descricao')->get();
        $mensagem = $request->session()->get('mensagem');
 
        return view('receitas.index', compact('receitas', 'mensagem','categorias'));
    }

    public function create()
    {
        return view('receitas.create');
    }

    public function store(Request $request)
    {

        $receitas = new Receitas();
        $receitas->descricao = $request->input('descricao');
        $receitas->valor = $request->input('valor');
        $receitas->data_recebimento = $request->input('data_recebimento');
        $receitas->categoria_id = $request->input('categoria_id');
        $receitas->status = $request->input('status', 1);
        $receitas->save();

        $request->session()->flash('mensagem', "Receita criada com sucesso");
        return redirect()->route('receitas.index');
    }

    public function edit(Receitas $receitas,$id)
    {
        $categorias = Categorias::query()->orderBy('descricao')->get();
        $receitas = Receitas::find($id);
        return view('receitas.edit', compact('receitas','categorias'));
    }

    public function update(Request $request,Receitas $receitas)
    {
        $receitas = new Receitas();
        $receitas->descricao = $request->descricao;
        $receitas->valor = $request->valor;
        $receitas->data_recebimento = $request->data_recebimento;
        $receitas->receita_id = $request->receita_id;
        $receitas->status = $request->status;
        $receitas->save();
        return redirect()->route('receitas.index')->with('success', 'Receita atualizada com sucesso!');
    }

    public function destroy(Receitas $receitas)
    {
        $receitas->delete();
        $mensagem = session()->get('mensagem');
        return redirect()->route('receitas.index')->with('success', 'Receita excluida com sucesso!');

    }

}
