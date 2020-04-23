<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableOuvidoriaHistorico extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('OUVIDORIA_HISTORICO', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ocorrencia_id');
            $table->unsignedBigInteger('status_ocorrencia_id');
            $table->unsignedBigInteger('setor_id');
            $table->unsignedBigInteger('user_id');

            $table->foreign('ocorrencia_id')->references('id')->on('ouvidoria_ocorrencia');
            $table->foreign('status_ocorrencia_id')->references('id')->on('ouvidoria_status');
            $table->foreign('setor_id')->references('id')->on('setor');
            $table->foreign('user_id')->references('id')->on('usuario');
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
        Schema::dropIfExists('OUVIDORIA_HISTORICO');
    }
}
