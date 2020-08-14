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
            ['nome' => 'Aluno(a)'],
            ['nome' => 'Professor(a)'],
            ['nome' => 'Funcionário(a)'],
            ['nome' => 'Publico Externo']
        ]);
    }
}
