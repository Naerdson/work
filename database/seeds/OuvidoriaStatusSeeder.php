<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class OuvidoriaStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ouvidorias_status')->insert([
            ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'nome' => 'Aberto'],
            ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'nome' => 'Encaminhado'],
            ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'nome' => 'Respondido'],
            ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'nome' => 'Concluido'],
            ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'nome' => 'Encaminhado Para Ouvidoria']
        ]);
    }
}
