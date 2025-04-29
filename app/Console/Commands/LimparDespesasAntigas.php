<?php

namespace App\Console\Commands;

use App\Models\Despesas;
use Carbon\Carbon;
use Illuminate\Console\Command;

class LimparDespesasAntigas extends Command
{
    protected $signature = 'receitas:limpar-antigas';
    protected $description = 'Remove despesas com mais de 30 dias ou do mês anterior';


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $dataLimite = Carbon::now()->subDays(30);

            $despesasExcluidas = Despesas::where('data_pagamento', '<', $dataLimite)->delete();

            $this->info("Despesas antigas removidas com sucesso! Total removido: $despesasExcluidas");
        } catch (\Exception $e) {
            $this->error("Erro ao remover despesas: " . $e->getMessage());
        }
    }
}
