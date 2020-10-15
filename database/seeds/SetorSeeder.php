<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SetorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('setores')->insert([
            ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'nome' => 'DEFAULT'],
            ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'nome' => 'ADE (Assessoria de Desenvolvimento Educacional)'],
            ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'nome' => 'ASA (Apoio e Suporte ao Aluno)'],
            ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'nome' => 'Atendimento ao Aluno'],
            ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'nome' => 'Atendimento Psicopedagógico'],
            ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'nome' => 'Biblioteca'],
            ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'nome' => 'Call Center'],
            ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'nome' => 'Carreiras'],
            ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'nome' => 'COOPEM (Monitoria e Iniciação Científica)'],
            ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'nome' => 'CPA (Comissão Própria de Avaliação)'],
            ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'nome' => 'Divisão Administrativa (Manutenção, compras, etc)'],
            ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'nome' => 'FIES/PROUNI'],
            ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'nome' => 'Financeiro'],
            ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'nome' => 'Marketing'],
            ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'nome' => 'NEAD (Núcleo de Educação à Distãncia)'],
            ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'nome' => 'NERS (Extensão)'],
            ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'nome' => 'Negociação (Massare)'],
            ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'nome' => 'NTI (Núcleo de Tecnologia da Informação)'],
            ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'nome' => 'Ouvidoria'],
            ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'nome' => 'Pós-Graduação'],
            ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'nome' => 'Quero ser aluno'],
            ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'nome' => 'Recepção'],
            ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'nome' => 'Reitoria'],
            ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'nome' => 'RH (Setor de Recursos Humanos)'],
            ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'nome' => 'Secretaria das Coordenações'],
            ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'nome' => 'Tesouraria'],
            ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'nome' => 'Tutoria'],
            ['created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'nome' => 'Outro (detalhar)']
        ]);
    }
}
