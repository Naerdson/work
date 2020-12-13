<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesquisaSatisfacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesquisa_satisfacao', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ocorrencia_id')->references('id')->on('ouvidorias_ocorrencias');
            $table->foreignId('pergunta_id')->references('id')->on('perguntas_pesquisas');
            $table->string('resposta');
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesquisa_satisfacao');
    }
}
