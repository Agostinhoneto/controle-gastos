<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use App\Models\Eventos_financeiros;
use App\Models\EventosFinanceiro;
use App\Notifications\NovoEventoFinanceiro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventoFinanceirosController extends Controller
{
    public function index()
    {
        try {
            $eventos = EventosFinanceiro::with('categoria')
                ->orderBy('data_inicio', 'asc')
                ->get();
            $categorias = Categorias::all();

            return view('eventos.index', compact('eventos', 'categorias'));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Erro ao carregar eventos financeiros: ' . $e->getMessage());
            return back()->withErrors('Erro ao carregar os eventos financeiros. Tente novamente mais tarde.');
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'titulo' => 'required|string|max:255',
            'data_inicio' => 'required|date',
            'tipo' => 'required|string|in:despesa,receita', 
            'valor' => 'required|numeric|min:0',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        try {
            $evento = new EventosFinanceiro();
            $evento->titulo = $validatedData['titulo'];
            $evento->data_inicio = $validatedData['data_inicio'];
            $evento->tipo = $validatedData['tipo'];
            $evento->valor = $validatedData['valor'];
            $evento->categoria_id = $validatedData['categoria_id'];
            $evento->save();

            auth()->user()->notify(new NovoEventoFinanceiro($evento));

            return redirect()->route('eventos.index')->with('success', 'Evento financeiro criado e notificado com sucesso!');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Erro ao criar evento financeiro: ' . $e->getMessage());
            return back()->withErrors('Erro ao criar o evento financeiro. Tente novamente mais tarde.');
        }
    }
}
