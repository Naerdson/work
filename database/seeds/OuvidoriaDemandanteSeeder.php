<?php

use Illuminate\Database\Seeder;

class OuvidoriaDemandanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ouvidoria_demandante')->insert([
            ['nome' => 'Aluno(a)'],
            ['nome' => 'Professor(a)'],
            ['nome' => 'Funcionário(a)'],
        ]);
    }
}
