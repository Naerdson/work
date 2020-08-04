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
        DB::table('setor')->insert([
            ['nome' => 'DEFAULT'],
            ['nome' => 'TECNOLOGIA DA INFORMAÇÃO'],
            ['nome' => 'RH / PESSOAL'],
            ['nome' => 'MARKETING'],
            ['nome' => 'DIRETORIA'],
            ['nome' => 'MANUTENÇÃO'],
            ['nome' => 'EAD - TUTORIA'],
            ['nome' => 'CURSO SERVIÇO SOCIAL'],
            ['nome' => 'PROCURADORIA EDUCACIONAL'],
            ['nome' => 'PLANEJAMENTO, DESENVOLVIMENTO E AVALIAÇÃO INSTITUCIONAL'],
            ['nome' => 'OUVIDORIA'],
            ['nome' => 'NÚCLEO DE ESTÁGIO'],
            ['nome' => 'TESOURARIA'],
            ['nome' => 'RECEPÇÃO'],
            ['nome' => 'CLINICA ESCOLA'],
            ['nome' => 'FINANCEIRO'],
            ['nome' => 'ATENDIMENTO AO ALUNO'],
            ['nome' => 'BIBLIOTECA'],
            ['nome' => 'EAD'],
            ['nome' => 'SUPERVISÃO ADMINISTRATIVA'],
            ['nome' => 'CURSO GESTÃO HOSPITALAR'],
            ['nome' => 'APOIO COORDENAÇÕES'],
            ['nome' => 'CURSO ENFERMAGEM'],
            ['nome' => 'CURSO DIREITO'],
            ['nome' => 'CURSO CIÊNCIAS CONTÁBEIS'],
            ['nome' => 'CURSO GESTÃO DE RECURSOS HUMANOS'],
        ]);
    }
}
