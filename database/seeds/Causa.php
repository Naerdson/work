<?php

use Illuminate\Database\Seeder;

class Causa extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('causa')->insert([
            ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'nome' => 'Atendimento'],
            ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'nome' => 'Infraestrutura'],
            ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'nome' => 'Manutenção e Limpeza'],
            ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'nome' => 'Segurança'],
            ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'nome' => 'Cobrança(financeira)'],
            ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'nome' => 'Mensalidade'],
            ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'nome' => 'Notas e Frequência'],
            ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'nome' => 'Serviços e equipamentos de informática'],
            ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'nome' => 'Telefonia'],
            ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'nome' => 'Cumprimento de Prazos'],
            ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'nome' => 'Outros']
        ]);
    }
}
