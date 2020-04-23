<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableOcorrencia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ouvidoria_ocorrencia', function (Blueprint $table) {
            $table->string('protocolo')->unique()->change();
            $table->string('nome')->nullable()->change();
            $table->unsignedBigInteger('status_id')->default(1)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::dropIfExists('ouvidoria_ocorrencia');

    }
}
