<?php

namespace App\Http\Controllers;


use App\Models\Receitas;
use ConsoleTVs\Charts\Classes\Highcharts\Chart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use ConsoleTVs\Charts\Facades\Charts;
use Charts;
use ConsoleTVs\Charts\Commands\ChartsCommand;

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

    public function showChart()
    {
        // Exemplo de dados para o gráfico
        $chart = ChartsCommand::create('bar', 'highcharts')
        ->title('Meu Gráfico')
        ->elementLabel('Minha Label')
        ->labels(['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio'])
        ->values([5, 10, 15, 20, 25]);

      return view('chart', compact('chart'));
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
