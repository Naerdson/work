<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableOuvidoriaOcorrencia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ouvidoria_ocorrencia', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('protocolo');
            $table->string('nome');
            $table->string('contato');
            $table->longText('descricao');
            $table->unsignedBigInteger('categoria_id');
            $table->unsignedBigInteger('demandante_id');
            $table->unsignedBigInteger('status_id')->default(1);
            $table->unsignedBigInteger('campus_id');
            $table->unsignedBigInteger('setor_responsavel_id')->default(11);
            $table->timestamps();


            $table->foreign('categoria_id')->references('id')->on('ouvidoria_categoria');
            $table->foreign('demandante_id')->references('id')->on('ouvidoria_demandante');
            $table->foreign('status_id')->references('id')->on('ouvidoria_status');
            $table->foreign('campus_id')->references('id')->on('campus');
            $table->foreign('setor_responsavel_id')->references('id')->on('setor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ouvidoria_ocorrencia');
    }
}
