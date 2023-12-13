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
        Categorias::create(['descricao' => 'Alimentação']);
        Categorias::create(['descricao' => 'Transporte']);
        Categorias::create(['descricao' => 'Lazer']);
        Categorias::create(['descricao' => 'Lazer']);
    }
}
