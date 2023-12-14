<?php

namespace Database\Seeders;

use App\Models\Categorias;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categorias::create([
            'descricao' => 'Casa',
        ]);
        Categorias::create([
            'descricao' => 'Carro',
        ]);
        
        Categorias::create([
            'descricao' => 'Alimentação',
        ]);
    }
}
