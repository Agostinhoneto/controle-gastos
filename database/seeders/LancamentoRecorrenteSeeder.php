<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LancamentoRecorrenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lancamentos = [
            [
                'tipo' => 'despesa',
                'categoria_id' => 1,
                'usuario_id' => 1,
                'descricao' => 'Aluguel',
                'valor' => 1200.00,
                'data_inicio' => Carbon::today()->subMonths(6),
                'frequencia' => 'mensal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo' => 'despesa',
                'categoria_id' => 1,
                'usuario_id' => 1,
                'descricao' => 'Internet',
                'valor' => 100.00,
                'data_inicio' => Carbon::today()->subMonths(3),
                'frequencia' => 'mensal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo' => 'receita',
                'categoria_id' => 1,
                'usuario_id' => 1,
                'descricao' => 'Salário',
                'valor' => 5000.00,
                'data_inicio' => Carbon::today()->subYears(2), 
                'frequencia' => 'mensal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo' => 'receita',
                'categoria_id' => 1,
                'usuario_id' => 1,
                'descricao' => 'Freelance',
                'valor' => 800.00,
                'data_inicio' => Carbon::today()->subWeeks(2), 
                'frequencia' => 'semanal',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        DB::table('lancamento_recorrentes')->insert($lancamentos);
    }
}
