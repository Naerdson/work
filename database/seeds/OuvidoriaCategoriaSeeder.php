<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OuvidoriaCategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ouvidorias_categorias')->insert([
            ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'nome' => 'Reclamação'],
            ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'nome' => 'Elogio'],
            ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'nome' => 'Sugestão'],
            ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'nome' => 'Informação'],
            ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'nome' => 'Denúncia']
        ]);
    }
}
