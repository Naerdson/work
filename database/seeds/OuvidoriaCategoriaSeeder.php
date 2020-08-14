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
            ['nome' => 'Reclamação'],
            ['nome' => 'Elogio'],
            ['nome' => 'Sugestão'],
            ['nome' => 'Informação'],
            ['nome' => 'Denúncia']
        ]);
    }
}
