<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObservacaoPesquisaSatisfacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('observacao_pesquisas_satisfacao', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ocorrencia_id')->references('id')->on('ouvidorias_ocorrencias');
            $table->longText('descricao');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('observacao_pesquisas_satisfacao');
    }
}
