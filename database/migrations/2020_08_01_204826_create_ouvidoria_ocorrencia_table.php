<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOuvidoriaOcorrenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ouvidorias_ocorrencias', function (Blueprint $table) {
            $table->id();
            $table->string('protocolo');
            $table->string('nome')->nullable();
            $table->string('contato');
            $table->longText('descricao');
            $table->foreignId('categoria_id')->references('id')->on('ouvidorias_categorias');
            $table->foreignId('demandante_id')->references('id')->on('ouvidorias_demandantes');
            $table->foreignId('campus_id')->references('id')->on('campus');
            $table->unsignedBigInteger('status_id')->default(1);
            $table->unsignedBigInteger('setor_responsavel_id')->default(19);

            $table->foreign('status_id')->references('id')->on('ouvidorias_status');
            $table->foreign('setor_responsavel_id')->references('id')->on('setores');
            $table->datetime('created_at', 4);
            $table->datetime('updated_at', 4);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ouvidorias_ocorrencias');
    }
}
