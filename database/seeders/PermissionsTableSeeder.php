<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        // Criar permissões
        Permission::create(['name' => 'ver_usuarios']);
        Permission::create(['name' => 'criar_usuarios']);
        Permission::create(['name' => 'editar_usuarios']);
        Permission::create(['name' => 'deletar_usuarios']);

        // Outras permissões
        Permission::create(['name' => 'ver_permissoes']);
        Permission::create(['name' => 'editar_permissoes']);
    }
}