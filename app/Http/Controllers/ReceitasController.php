<?php

namespace App\Http\Controllers;


use App\Models\Receitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use ConsoleTVs\Charts\Classes\ChartJs\Chart;

class ReceitasController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::check()) {
            echo "Não autenticado";
            exit();
        }

        $receitas = Receitas::query()
            ->orderBy('descricao')
            ->get();
        $mensagem = $request->session()->get('mensagem');

        return view('receitas.index', compact('receitas', 'mensagem'));
    }

    public function create()
    {
        return view('receitas.create');
    }

    public function store(Request $request)
    {
        Receitas::create([
            'descricao' => $request->descricao,
            'valor' => $request->valor,
            'data_recebimento' => $request->data_recebimento,
        ]);

        $request->session()->flash('mensagem', "Despesa criada com sucesso");
        return redirect()->route('receitas.index');
    }

    public function edit(Receitas $receitas)
    {
    //    $receitas = Receitas::findOrFaril($id);
        return view('receitas.edit', ['receitas' => $receitas]);
    }

    public function update(Request $request,Receitas $receitas)
    {
        $receitas->update([
            'descricao' => $request->input('descricao'),
            'valor' => $request->input('valor'),
            'data_recebimento' => $request->input('data_recebimento'),
            'status' => $request->input('status'),
        ]);
        return redirect()->route('receitas.index')->with('success', 'Receita atualizada com sucesso!');
    }
}
