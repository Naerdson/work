<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NivelUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('niveis_usuarios')->insert([
            ['nome' => 'Funcionário'],
            ['nome' => 'Administrador'],
            ['nome' => 'Super Administrador']
        ]);
    }
}
