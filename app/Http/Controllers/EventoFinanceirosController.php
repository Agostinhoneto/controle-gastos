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

    public function index() {
        $eventos = EventosFinanceiro::with('categoria')->orderBy('data_inicio', 'asc')->get();
        $categorias = Categorias::all();
    
        return view('eventos.index', compact('eventos', 'categorias'));
    }
    /*
    public function index()
    {
        $eventos = EventosFinanceiro::all()->map(function ($event) {
            return [
                'titulo' => $event->titulo,
                'data_inicio' => $event->data_inicio,
                'tipo' => $event->tipo,
                'valor' => $event->valor,
                'color' => $event->type == 'receita' ? '#28a745' : '#dc3545', // Verde para receita, vermelho para despesa
            ];
        });

        return view('eventos.index', ['eventos' => $eventos]);
    }
    */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'titulo' => 'required|string|max:255',
            'data_inicio' => 'required|date',
            'valor' => 'required|numeric',
        ]);

        $evento = EventosFinanceiro::create($validatedData);

        // Verificar se o evento foi criado com sucesso
        if ($evento) {
            // Obter o usuário (por exemplo, o usuário autenticado)
            $user = auth()->user();

            // Enviar a notificação
            if ($user) {
                $user->notify(new NovoEventoFinanceiro($evento));
            } else {
                return response()->json(['message' => 'Usuário não autenticado'], 401);
            }

            // Retornar resposta após sucesso
            return redirect()->route('eventos.index')->with('success', 'Evento financeiro criado e notificação enviada.');
        } else {
            return redirect()->back()->with('error', 'Falha ao criar evento financeiro.');
        }
    }
}
