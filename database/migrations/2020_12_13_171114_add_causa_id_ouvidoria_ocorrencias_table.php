<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCausaIdOuvidoriaOcorrenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ouvidorias_ocorrencias', function (Blueprint $table) {
            $table->unsignedBigInteger('causa_id');

            $table->foreign('causa_id')->references('id')->on('causas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ouvidorias_ocorrencias', function (Blueprint $table) {
            $table->dropForeign(['causa_id']);
        });
    }
}
