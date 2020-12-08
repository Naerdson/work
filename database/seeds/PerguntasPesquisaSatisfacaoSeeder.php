<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerguntasPesquisaSatisfacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('perguntas_pesquisas')->insert([
            ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'nome' => 'Qualidade das informações prestadas'],
            ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'nome' => 'Rapidez no atendimento'],
            ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'nome' => 'Quanto às instalações? a) Segurança'],
            ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'nome' => 'Quanto às instalações? b) Limpeza e Higiene'],
            ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'nome' => 'Quanto às instalações? c) Facilidade de acesso aos setores']
        ]);
    }
}
