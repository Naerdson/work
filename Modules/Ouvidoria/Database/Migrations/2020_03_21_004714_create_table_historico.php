<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableHistorico extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historico_ocorrencia', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ocorrencia_id');
            $table->unsignedBigInteger('setor_id');
            $table->unsignedBigInteger('user_id');

            $table->foreign('setor_id')->references('id')->on('users')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
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
        Schema::dropIfExists('historico_ocorrencia');
    }
}
