<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OuvidoriaStatus extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ouvidoria_status')->insert([
            ['nome' => 'Aberto'],
            ['nome' => 'Encaminhado'],
            ['nome' => 'Respondido por email'],
            ['nome' => 'Concluido']
        ]);
    }
}
