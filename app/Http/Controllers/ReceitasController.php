<?php

namespace App\Http\Controllers;

use App\Http\Requests\DespesaRequest;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Despesas;
use App\Models\Receitas;
use App\Services\CriadorDeSerie;
use App\Services\ReceitaService;
use App\Services\RemovedorDeSerie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReceitasController extends Controller
{

    protected $receitaService;

    public function __construct(ReceitaService $receitaService)
    {
        $this->receitaService = $receitaService;
    }

    public function index(Request $request)
    {
        if(!Auth::check()){
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

    public function store(Request $request, ReceitaService $receitaService)
    {
        Receitas::create([
            'descricao' => $request->descricao,
            'valor' => $request->valor,
            'data_recebimento' => $request->data_recebimento,
        ]);
            
        $request->session()->flash('mensagem',"Despesa criada com sucesso");
        return redirect()->route('receitas.index');
    }
    
    /*
    public function destroy(Request $request, RemovedorDeSerie $removedorDeSerie)
    {
        $nomeSerie = $removedorDeSerie->removerSerie($request->id);
        $request->session()
            ->flash(
                'mensagem',
                "Série $nomeSerie removida com sucesso"
            );
        return redirect()->route('listar_series');
    }

    public function editaNome(int $id, Request $request)
    {
        $serie = Serie::find($id);
        $novoNome = $request->nome;
        $serie->nome = $novoNome;
        $serie->save();
    }
    */
}
