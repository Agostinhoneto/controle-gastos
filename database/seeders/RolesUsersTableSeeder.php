<?php

namespace Database\Seeders;

use App\Models\RolesUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RolesUser::create([
            'id'    => 1,
            'user_id' => 1,
            'role_id' => 1,
        ]);       
    }
}
