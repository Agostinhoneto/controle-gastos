<?php

namespace App\Console\Commands;

use App\Mail\AlertaGastosSemana;
use App\Models\Despesas;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class EnviarAlertaDespesas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'alerta:gastos-semanais';
    protected $description = 'Envia alerta por e-mail se os gastos da semana forem maiores que R$ 1500';

    public function handle()
    {
        $inicioSemana = Carbon::now()->startOfWeek();
        $fimSemana = Carbon::now()->endOfWeek();

        $total = Despesas::whereBetween('data_pagamento', [$inicioSemana, $fimSemana])->sum('valor');

        if ($total > 1500) {
            $email = config('mail.alerta_destinatario', 'agostneto6@gmail.com');
            Mail::to($email)->send(new AlertaGastosSemana($total));
            $this->info("Alerta enviado. Total gasto: R$ $total");
        } else {
            $this->info("Nenhum alerta necessário. Total: R$ $total");
        }
    }

}
