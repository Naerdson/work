<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UtilController extends Controller
{
    public function run()
    {
        try {
            DB::table('campus')->insert([
                ['nome' => 'Campus Conselheiro Estelita'],
                ['nome' => 'Campus Padre Ibiapina'],
                ['nome' => 'Campus Guilherme Rocha'],
                ['nome' => 'Campus Carneiro da Cunha'],
                ['nome' => 'Campus Maracanaú'],
                ['nome' => 'Campus Cascavel'],
                ['nome' => 'Campus Aldeota'],
                ['nome' => 'Campus Messejana'],
                ['nome' => 'Clínica Escola'],
                ['nome' => 'Complexo Odontológico'],
                ['nome' => 'NPJ (Núcleo de Práticas Jurídicas)'],
            ]);

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

            DB::table('campus')->insert([
                ['nome' => 'Aluno(a)'],
                ['nome' => 'Professor(a)"'],
                ['nome' => 'Funcionário(a)'],
            ]);

            DB::table('ouvidoria_demandante')->insert([
                ['nome' => 'Aluno(a)'],
                ['nome' => 'Professor(a)'],
                ['nome' => 'Funcionário(a)'],
            ]);

            DB::table('ouvidoria_categoria')->insert([
                ['nome' => 'Reclamação'],
                ['nome' => 'Elogio'],
                ['nome' => 'Sugestão'],
                ['nome' => 'Informação'],
                ['nome' => 'Denúncia']
            ]);

            DB::table('ouvidoria_status')->insert([
                ['nome' => 'Aberto'],
                ['nome' => 'Encaminhado'],
                ['nome' => 'Respondido por email'],
                ['nome' => 'Concluido']
            ]);

            DB::table('nivel_usuario')->insert([
                ['nome' => 'Funcionário', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['nome' => 'Administrador', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['nome' => 'Super Administrador', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
            ]);

            return redirect()->route('auth.login')->with(['type' => 'success', 'message' => 'Migrations executadas com sucesso' ]);
        }
        catch (Exception $e){
            return redirect()->route('auth.login')->with(['type' => 'danger', 'message' => $e->getMessage() ]);
        }
    }
}
