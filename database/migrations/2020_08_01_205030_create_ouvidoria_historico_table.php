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
        Schema::create('ouvidorias_historicos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ocorrencia_id')->references('id')->on('ouvidorias_ocorrencias');
            $table->foreignId('status_ocorrencia_id')->references('id')->on('ouvidorias_status');
            $table->foreignId('setor_id')->references('id')->on('setores');
            $table->foreignId('user_id')->references('id')->on('usuarios');
            $table->longText('tratativa');
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
        Schema::dropIfExists('ouvidorias_historicos');
    }
}
