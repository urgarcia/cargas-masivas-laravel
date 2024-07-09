<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->insert([
            [
                'name' => 'Usuarios',
                'url' => '/',
            ],
            [
                'name' => 'Carga Masiva',
                'url' => '/uploadFile',
            ],
            [
                'name' => 'Perfil',
                'url' => '/profile',
            ],
        ]);
    }
}
