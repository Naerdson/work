<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSetor extends Migration
{
    // INSERT INTO setor (id, nome) VALUES (1, "DEFAULT"), (2, "TECNOLOGIA DA INFORMAÇÃO"), (3, "RH / PESSOAL"), (4, "MARKETING"), (5, "DIRETORIA"), (6, "MANUTENÇÃO"), (7, "EAD - TUTORIA"), (8, "CURSO SERVIÇO SOCIAL"), (9, "PROCURADORIA EDUCACIONAL"), (10, "PLANEJAMENTO, DESENVOLVIMENTO E AVALIAÇÃO INSTITUCIONAL"), (11, "OUVIDORIA"), (12, "NÚCLEO DE ESTÁGIO"), (13, "TESOURARIA"), (14, "RECEPÇÃO"), (15, "CLINICA ESCOLA"), (16, "FINANCEIRO"), (17, "ATENDIMENTO AO ALUNO"), (18, "BIBLIOTECA"), (19, "EAD"), (20, "SUPERVISÃO ADMINISTRATIVA"), (21, "CURSO GESTÃO HOSPITALAR"), (22, "APOIO COORDENAÇÕES"), (23, "CURSO ENFERMAGEM"), (24, "CURSO DIREITO"), (25, "CURSO CIÊNCIAS CONTÁBEIS"), (26, "CURSO GESTÃO DE RECURSOS HUMANOS");

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setor', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('setor');
    }
}
