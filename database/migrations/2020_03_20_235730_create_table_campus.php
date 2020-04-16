<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCampus extends Migration
{

    // INSERT INTO campus (id, nome) VALUES (1, "Campus Conselheiro Estelita"), (2, "Campus Padre Ibiapina"), (3, "Campus Guilherme Rocha"), (4,"Campus Carneiro da Cunha"), (5, "Campus Maracanaú"), (6, "Campus Cascavel"), (7, "Campus Aldeota"), (8, "Campus Messejana"), (9, "Clínica Escola"), (10, "Complexo Odontológico"), (11, "NPJ (Núcleo de Práticas Jurídicas)");
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campus', function (Blueprint $table) {
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
        Schema::dropIfExists('campus');
    }
}
