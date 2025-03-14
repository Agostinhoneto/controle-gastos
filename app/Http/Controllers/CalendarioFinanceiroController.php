<?php

namespace App\Http\Controllers;

use App\Models\EventosFinanceiro;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CalendarioFinanceiroController extends Controller
{
    public function index()
    {
        return view('calendario.index');
    }

    public function eventos($periodo = 30)
    {
        $hoje = Carbon::today();
        $fim = $hoje->copy()->addDays($periodo);

        $lancamentos = EventosFinanceiro::all();
        $eventos = [];

        foreach ($lancamentos as $lancamento) {
            $data = Carbon::parse($lancamento->data_inicio);
            while ($data->lessThanOrEqualTo($fim)) {
                if ($data->greaterThanOrEqualTo($hoje)) {
                    $eventos[] = [
                        'title' => "{$lancamento->tipo}: {$lancamento->descricao} - R$ {$lancamento->valor}",
                        'start' => $data->toDateString(),
                        'color' => $lancamento->tipo === 'despesa' ? 'red' : 'green',
                    ];
                }
                // Avançar a data conforme a frequência
                $data = match ($lancamento->frequencia) {
                    'diaria' => $data->addDay(),
                    'semanal' => $data->addWeek(),
                    'mensal' => $data->addMonth(),
                    'anual' => $data->addYear(),
                    default => null
                };
                if (!$data) break;
            }
        }

        return $eventos;
    }
}
