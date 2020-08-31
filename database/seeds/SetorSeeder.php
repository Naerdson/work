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
            ['nome' => 'DEFAULT'],
            ['nome' => 'ADE (Assessoria de Desenvolvimento Educacional)'],
            ['nome' => 'ASA (Apoio e Suporte ao Aluno)'],
            ['nome' => 'Atendimento ao Aluno'],
            ['nome' => 'Atendimento Psicopedagógico'],
            ['nome' => 'Biblioteca'],
            ['nome' => 'Call Center'],
            ['nome' => 'Carreiras'],
            ['nome' => 'COOPEM (Monitoria e Iniciação Científica)'],
            ['nome' => 'CPA (Comissão Própria de Avaliação)'],
            ['nome' => 'Divisão Administrativa (Manutenção, compras, etc)'],
            ['nome' => 'FIES/PROUNI'],
            ['nome' => 'Financeiro'],
            ['nome' => 'Marketing'],
            ['nome' => 'NEAD (Núcleo de Educação à Distãncia)'],
            ['nome' => 'NERS (Extensão)'],
            ['nome' => 'Negociação (Massare)'],
            ['nome' => 'NTI (Núcleo de Tecnologia da Informação)'],
            ['nome' => 'Ouvidoria'],
            ['nome' => 'Pós-Graduação'],
            ['nome' => 'Quero ser aluno'],
            ['nome' => 'Recepção'],
            ['nome' => 'Reitoria'],
            ['nome' => 'RH (Setor de Recursos Humanos)'],
            ['nome' => 'Secretaria das Coordenações'],
            ['nome' => 'Tesouraria'],
            ['nome' => 'Tutoria'],
            ['nome' => 'Outro (detalhar)']
        ]);
    }
}
