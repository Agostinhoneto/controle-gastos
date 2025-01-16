<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ProcessarRecorrencias extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'recorrencias:processar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Processa lançamentos recorrentes de despesas e receitas.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $hoje = Carbon::now()->startOfDay();

        // Busca recorrências ativas cujo próximo lançamento é hoje ou antes
        $recorrencias = DB::table('recorrencias')
            ->where('ativo', true)
            ->where('data_inicio', '<=', $hoje)
            ->where(function ($query) use ($hoje) {
                $query->whereNull('data_fim')->orWhere('data_fim', '>=', $hoje);
            })
            ->get();

        foreach ($recorrencias as $recorrencia) {
            $ultimaExecucao = DB::table('despesas_receitas')
                ->where('recorrencia_id', $recorrencia->id)
                ->latest('data')
                ->value('data');

            $proxData = $this->calcularProximaData($recorrencia->frequencia, $ultimaExecucao ?? $recorrencia->data_inicio);

            if ($proxData->isToday()) {
                // Insere o lançamento na tabela de despesas ou receitas
                DB::table('despesas_receitas')->insert([
                    'tipo' => $recorrencia->tipo,
                    'valor' => $recorrencia->valor,
                    'categoria_id' => $recorrencia->categoria_id,
                    'descricao' => $recorrencia->descricao,
                    'data' => $proxData,
                    'usuario_id' => $recorrencia->usuario_id,
                    'recorrencia_id' => $recorrencia->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $this->info("Lançamento gerado para a recorrência ID {$recorrencia->id} na data {$proxData->toDateString()}.");
            }
        }
    }

    /**
     * Calcula a próxima data do lançamento com base na frequência.
     *
     * @param string $frequencia
     * @param string $ultimaData
     * @return Carbon
     */
    private function calcularProximaData(string $frequencia, string $ultimaData): Carbon
    {
        $data = Carbon::parse($ultimaData);

        switch ($frequencia) {
            case 'diaria':
                return $data->addDay();
            case 'semanal':
                return $data->addWeek();
            case 'mensal':
                return $data->addMonth();
            case 'anual':
                return $data->addYear();
            default:
                throw new \InvalidArgumentException("Frequência desconhecida: {$frequencia}");
        }
    }
}
