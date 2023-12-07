<?php

namespace Database\Seeders;

use App\Models\Receitas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReceitasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Receitas::create([
            'descricao' => 'Salário',
            'valor' => 3500.00,
            'data_recebimento' => '2024-01-01',
        ]);

        Receitas::create([
            'descricao' => 'Alugueis',
            'valor' => 1700.00,
            'data_recebimento' => '2024-01-01',
        ]);
    }
}
