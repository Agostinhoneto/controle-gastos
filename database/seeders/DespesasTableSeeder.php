<?php

namespace Database\Seeders;

use App\Models\Despesas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DespesasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Despesas::create([
            'descricao' => 'Aluguel',
            'valor' => 1200.00,
            'data_pagamento' => '2023-01-05',
        ]);

        Despesas::create([
            'descricao' => 'Conta de luz',
            'valor' => 150.00,
            'data_pagamento' => '2023-01-10',
        ]);
    }
}
