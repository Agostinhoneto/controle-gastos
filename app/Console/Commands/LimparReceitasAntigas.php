<?php

namespace App\Console\Commands;

use App\Models\Receitas;
use Carbon\Carbon;
use Illuminate\Console\Command;

class LimparReceitasAntigas extends Command
{
   
    protected $signature = 'receitas:limpar-antigas';
    protected $description = 'Remove receitas com mais de 30 dias ou do mês anterior';  

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $dataLimite = Carbon::now()->subDays(30);

            $receitasExcluidas = Receitas::where('data_recebimento', '<', $dataLimite)->delete();

            $this->info("Receitas antigas removidas com sucesso! Total removido: $receitasExcluidas");
        } catch (\Exception $e) {
            $this->error("Erro ao remover receitas: " . $e->getMessage());
        }
    }
}
