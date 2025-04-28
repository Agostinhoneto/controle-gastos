<?php

namespace Database\Seeders;

use App\Models\Cargo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CargoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cargos = ['Admin', 'Diretor', 'Usuário'];

        foreach ($cargos as $cargo) {
            Cargo::updateOrCreate(['nome' => $cargo]);
        }
    }
}
