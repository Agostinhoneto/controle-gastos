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
        $eventos = EventosFinanceiro::with('categoria')->orderBy('data_inicio', 'asc')->get();
        $categorias = Categorias::all();
        return view('eventos.index', compact('eventos', 'categorias'));
    }
 
    public function store(Request $request)
    {
        $eventos = new EventosFinanceiro();
        $eventos->titulo = $request->input('titulo');
        $eventos->data_inicio = $request->input('data_inicio');
        $eventos->tipo = $request->input('tipo');
        $eventos->valor = $request->input('valor');
        $eventos->categoria_id = $request->input('categoria_id');
        $eventos->save();

        if ($eventos) {
            $user = auth()->user();

            // Enviar a notificação
            if ($user) {
                $user->notify(new NovoEventoFinanceiro($eventos));
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
