<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableOcorrencia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ocorrencia', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('protocolo');
            $table->string('nome');
            $table->string('contato');
            $table->longText('descricao');
            $table->unsignedBigInteger('categoria_id');
            $table->unsignedBigInteger('demandante_id');
            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('campus_id');
            $table->unsignedBigInteger('user_id');

            $table->foreign('categoria_id')->references('id')->on('cat_ocorrencia');
            $table->foreign('demandante_id')->references('id')->on('demandante');
            $table->foreign('status_id')->references('id')->on('status');
            $table->foreign('campus_id')->references('id')->on('campus');
            $table->foreign('user_id')->references('id')->on('users');

            


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
        Schema::dropIfExists('ocorrencia');
    }
}
