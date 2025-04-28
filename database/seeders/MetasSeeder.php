<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MetasSeeder extends Seeder
{
    public function run()
    {
        DB::table('financas_metas')->insert([
            [
                'titulo' => 'Quitar dívidas',
                'descricao' => 'Pagar todas as dívidas pendentes até o final do ano.',
                'valor' => 5000.00,  // Valor total da meta
                'valor_corrente' => 2000.00, // Valor já pago até o momento
                'data_inicio' => Carbon::now(), // Data de início da meta (data atual)
                'data_fim' => Carbon::now()->endOfYear(), // Data de fim (final do ano)
                'usuario_cadastrante_id' => 1, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Economizar R$ 10.000',
                'descricao' => 'Criar um fundo de emergência de R$ 10.000 até o final do ano.',
                'valor' => 10000.00,
                'valor_corrente' => 4000.00, // Valor já economizado até o momento
                'data_inicio' => Carbon::now(),
                'data_fim' => Carbon::now()->addMonths(12), // Meta de 1 ano
                'usuario_cadastrante_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),            
            ],
            [
                'titulo' => 'Investir R$ 500/mês',
                'descricao' => 'Investir R$ 500 por mês em investimentos de longo prazo.',
                'valor' => 6000.00, // Total do valor após 1 ano de investimentos
                'valor_corrente' => 1500.00, // Valor já investido
                'data_inicio' => Carbon::now(),
                'data_fim' => Carbon::now()->addYear(), // Prazo de 1 ano
                'usuario_cadastrante_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
