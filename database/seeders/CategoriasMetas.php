<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriasMetas extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryGoals = [
            [
                'categoria_id' => 1, 
                'meta_valor' => 500.00, 
                'start_date' => '2024-11-01',
                'end_date' => '2024-11-30',
            ],
            [
                'categoria_id' => 2,
                'meta_valor' => 1000.00,
                'start_date' => '2024-11-01',
                'end_date' => '2024-11-30',
            ],
            [
                'categoria_id' => 3,
                'meta_valor' => 750.00,
                'start_date' => '2024-11-01',
                'end_date' => '2024-11-30',
            ],
        ];

        // Inserir no banco de dados
        foreach ($categoryGoals as $goal) {
            CategoriasMetas::create($goal);
        }
    }
}
