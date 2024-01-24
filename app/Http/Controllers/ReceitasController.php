<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReceitasRequest;
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
        $total = $receitas->sum('valor');
        $categorias = Categorias::query()->orderBy('descricao')->get();
        $mensagem = $request->session()->get('mensagem');

        return view('receitas.index', compact('receitas', 'mensagem', 'categorias', 'total'));
    }

    public function create()
    {
        return view('receitas.create');
    }

    public function store(StoreReceitasRequest $request)
    {

        $receitas = new Receitas();
        $receitas->descricao = $request->input('descricao');
        $receitas->valor = $request->input('valor');
        $receitas->data_recebimento = $request->input('data_recebimento');
        $receitas->categoria_id = $request->input('categoria_id');
        $receitas->status = $request->input('status', 1);
        $receitas->save();
        return redirect()->route('receitas.index')->with('sucesso','Receita cadastrada com sucesso');
    }

    public function edit(Request $request,$id)
    {
        $receitas = Receitas::find($id);
        $mensagem = $request->session()->get('mensagem');
        $categorias = Categorias::query()->orderBy('descricao')->get();
       
        return view('receitas.edit', compact('receitas', 'categorias', 'mensagem'));
      /*
        $categorias = Categorias::query()->orderBy('descricao')->get();
        $receitas = Receitas::find($id);
        $mensagem = $request->session()->get('mensagem');
        */
       // return view('receitas.edit', compact('receitas', 'categorias', 'mensagem'));
    }

    public function update(Request $request,$id)
    {

        $receitas = Receitas::findOrFail($id)->first()->fill($request->all())->save();
        /*
        $receitas =  Receitas::find($receitas);
        $receitas->descricao = $request->input('descricao');
        $receitas->valor = $request->input('valor');
        $receitas->data_recebimento = $request->input('data_recebimento');
        $receitas->categoria_id = $request->input('categoria_id');
        $receitas->status = $request->input('status');
        $receitas->update();
        */
        return redirect()->route('receitas.index')->with('success', 'Receita atualizada com sucesso!');
    }

    public function destroy(Receitas $receitas)
    {
        $receitas->delete();
        $mensagem = session()->get('mensagem');
        return redirect()->route('receitas.index')->with('success', 'Receita excluida com sucesso!');
    }
}
