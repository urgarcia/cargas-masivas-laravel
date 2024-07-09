<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class RolesMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // Asignar todos los menús al rol 'admin'
        DB::table('role_menu')->insert([
            [
                'role_id' => 1, // ID del rol 'admin'
                'menu_id' => 1, // ID del menú 'Inicio'
            ],
            [
                'role_id' => 1,
                'menu_id' => 2, // ID del menú 'Carga masiva'
            ],
            [
                'role_id' => 1,
                'menu_id' => 3, // ID del menú 'Perfil'
            ],
        ]);

        // Asignar menús específicos al rol 'user'
        DB::table('role_menu')->insert([
            [
                'role_id' => 2, // ID del rol 'user'
                'menu_id' => 1, // ID del menú 'Inicio'
            ],
            [
                'role_id' => 2,
                'menu_id' => 3, // ID del menú 'Perfil'
            ],
        ]);

    }
}
