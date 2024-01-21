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
            'valor' => 1000.00,
            'data_pagamento' => '2024-01-01',
            'status' => true,
            'categoria_id' => 1,
        ]);

        Despesas::create([
            'descricao' => 'Conta de luz',
            'valor' => 300.00,
            'data_pagamento' => '2024-01-01',
            'status' => true,
            'categoria_id' => 1,
        ]);

        Despesas::create([
            'descricao' => 'Conta de água',
            'valor' => 100.00,
            'data_pagamento' => '2024-01-01',
            'status' => true,
            'categoria_id' => 1,
        ]);

        Despesas::create([
            'descricao' => 'Cartão',
            'valor' => 2000.00,
            'data_pagamento' => '2024-01-01',
            'status' => true,
            'categoria_id' => 1,
        ]);

        Despesas::create([
            'descricao' => 'Internet',
            'valor' => 100.00,
            'data_pagamento' => '2024-01-01',
            'status' => true,
            'categoria_id' => 1,
        ]);


        Despesas::create([
            'descricao' => 'Funcionárias',
            'valor' => 1000.00,
            'data_pagamento' => '2024-01-01',
            'status' => true,
            'categoria_id' => 2,
        ]);

        Despesas::create([
            'descricao' => 'Frutas e Verduras',
            'valor' => 400.00,
            'data_pagamento' => '2024-01-01',
            'status' => true,
            'categoria_id' => 1,
        ]);

        Despesas::create([
            'descricao' => 'Carnes',
            'valor' => 400.00,
            'data_pagamento' => '2024-01-01',
            'status' => true,
            'categoria_id' => 1,
        ]);

        
        Despesas::create([
            'descricao' => 'Gás e água',
            'valor' => 250.00,
            'data_pagamento' => '2024-01-01',
            'status' => true,
            'categoria_id' => 1,

        ]);
    }
}
