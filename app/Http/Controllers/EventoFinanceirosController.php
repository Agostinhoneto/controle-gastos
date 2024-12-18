<?php

namespace App\Http\Controllers;

use App\Models\Eventos_financeiros;
use Illuminate\Http\Request;

class EventoFinanceirosController extends Controller
{
    // Exibe o calendário com eventos
    public function index()
    {
        // Recupera eventos do banco de dados
        $events = Eventos_financeiros::all()->map(function ($event) {
            return [
                'title' => $event->title,
                'start' => $event->start_date,
                'color' => $event->type == 'receita' ? '#28a745' : '#dc3545', // Verde para receita, vermelho para despesa
            ];
        });

        return view('eventos.index', ['events' => $events]);
    }

    // Salva novos eventos
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'type' => 'required|in:receita,despesa',
            'amount' => 'nullable|numeric',
        ]);

        Eventos_financeiros::create($request->all());

        return redirect()->back()->with('success', 'Evento criado com sucesso!');
    }
}
