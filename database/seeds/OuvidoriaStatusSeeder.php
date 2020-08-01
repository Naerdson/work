<?php

use Illuminate\Database\Seeder;

class OuvidoriaStatusSeeder extends Seeder
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
