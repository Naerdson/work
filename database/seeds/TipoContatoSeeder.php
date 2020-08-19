<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoContatoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipos_contato')->insert([
            ['descricao' => 'Email'],
            ['descricao' => 'Telefone/Whatsapp'],
        ]);
    }
}
