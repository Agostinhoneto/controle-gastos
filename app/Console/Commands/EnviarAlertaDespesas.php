<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\DespesaAlertaNotification;
use Illuminate\Console\Command;

class EnviarAlertaDespesas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'alerta:gastos';
    protected $description = 'Enviar alertas de gastos aos usuários quando próximos de seu limite';

    public function handle()
    {
        // Defina o limite de gastos e o gasto atual aqui, ou obtenha-os de alguma fonte dinâmica.
        $limiteGastos = 1000; // Exemplo: limite de gastos
        $usuarios = User::all();

        foreach ($usuarios as $user) {
            $gastoAtual = $user->gastosTotais(); // Supondo que você tenha um método que calcula os gastos totais do usuário
            
            if ($gastoAtual >= $limiteGastos) {
                $user->notify(new DespesaAlertaNotification($gastoAtual, $limiteGastos));
            }
        }

        $this->info('Alertas de gastos enviados com sucesso!');
    }
}
