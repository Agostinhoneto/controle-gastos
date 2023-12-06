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
            'valor' => 5000.00,
            'data_recebimento' => '2023-01-01',
        ]);

        Receitas::create([
            'descricao' => 'Freelance',
            'valor' => 1000.00,
            'data_recebimento' => '2023-01-15',
        ]);

    }
}
