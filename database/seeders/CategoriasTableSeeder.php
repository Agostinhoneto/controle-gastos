<?php

namespace Database\Seeders;

use App\Models\Categorias;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categorias::create([
            'descricao' => 'Alimentação',
            'despesas_id' => 1,
            'receitas_id' => 1,
        ]);
        Categorias::create([
            'descricao' => 'Transporte',
            'despesas_id' => 1,
            'receitas_id' => 1,
        ]);
        Categorias::create([
            'descricao' => 'Lazer',
            'despesas_id' => 1,
            'receitas_id' => 1,
        ]);
        Categorias::create([
            'descricao' => 'Lazer',
            'despesas_id' => 1,
            'receitas_id' => 1,
        ]);
    }
}
