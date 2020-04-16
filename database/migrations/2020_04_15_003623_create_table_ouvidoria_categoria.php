<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableOuvidoriaCategoria extends Migration
{
    // INSERT INTO ouvidoria_categoria (id, nome) VALUES (1, "Reclamação"), (2, "Elogio"), (3, "Sugestão"), (4, "Informação"), (5, "Denúncia");
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ouvidoria_categoria', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ouvidoria_categoria');
    }
}
