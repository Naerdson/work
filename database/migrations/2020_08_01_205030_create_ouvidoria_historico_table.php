<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOuvidoriaHistoricoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ouvidoria_historico', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ocorrencia_id')->references('id')->on('ouvidoria_ocorrencia');
            $table->foreignId('status_ocorrencia_id')->references('id')->on('ouvidoria_status');
            $table->foreignId('setor_id')->references('id')->on('setor');
            $table->foreignId('user_id')->references('id')->on('usuario');
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
        Schema::dropIfExists('ouvidoria_historico');
    }
}
