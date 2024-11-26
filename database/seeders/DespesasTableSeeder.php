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
            'user_id' => 1,
            'descricao' => 'Conta de luz',
            'valor' => 300.00,
            'data_pagamento' => '2024-01-01',
            'status' => true,
            'categoria_id' => 1,
        ]);

        Despesas::create([
            'user_id' => 1,
            'descricao' => 'Conta de água',
            'valor' => 100.00,
            'data_pagamento' => '2024-01-01',
            'status' => true,
            'categoria_id' => 1,
        ]);

        Despesas::create([
            'user_id' => 1,
            'descricao' => 'Cartão',
            'valor' => 2000.00,
            'data_pagamento' => '2024-01-01',
            'status' => true,
            'categoria_id' => 1,
        ]);

        Despesas::create([
            'user_id' => 1,
            'descricao' => 'Internet',
            'valor' => 100.00,
            'data_pagamento' => '2024-01-01',
            'status' => true,
            'categoria_id' => 1,
        ]);


        Despesas::create([
            'user_id' => 1,
            'descricao' => 'Funcionárias',
            'valor' => 400.00,
            'data_pagamento' => '2024-01-01',
            'status' => true,
            'categoria_id' => 2,
        ]);
    }
}
