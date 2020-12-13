<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CausaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('causas')->insert([
            ['nome' => 'Atendimento'],
            ['nome' => 'Infraestrutura'],
            ['nome' => 'Manutenção e Limpeza'],
            ['nome' => 'Segurança'],
            ['nome' => 'Cobrança(financeira)'],
            ['nome' => 'Mensalidade'],
            ['nome' => 'Notas e Frequência'],
            ['nome' => 'Serviços e equipamentos de informática'],
            ['nome' => 'Telefonia'],
            ['nome' => 'Cumprimento de prazos'],
            ['nome' => 'Outros']
        ]);
    }
}
