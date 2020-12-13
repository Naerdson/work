<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnPesquisaSatisfacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pesquisa_satisfacao', function (Blueprint $table) {
            $table->dropColumn(['resposta']);
            $table->foreignId('resposta_id')->after('pergunta_id')->references('id')->on('opcoes_pesquisa_satisfacao');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
