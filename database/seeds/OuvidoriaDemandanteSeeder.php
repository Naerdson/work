<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OuvidoriaDemandanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ouvidorias_demandantes')->insert([
            ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'nome' => 'Aluno(a)'],
            ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'nome' => 'Professor(a)'],
            ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'nome' => 'Funcionário(a)'],
            ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'nome' => 'Publico Externo']
        ]);
    }
}
