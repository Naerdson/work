<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableOuvidoriaStatus extends Migration
{
    // INSERT INTO ouvidoria_status (id, nome, criado_por, created_at, updated_at) VALUES (1, "Aberto", "MOISES", "2020-05-04 19:40:31", "2020-05-04 19:40:31"), (2, "Encaminhado", "CARLOS", "2020-05-04 19:40:31", "2020-05-04 19:40:31"), (3, "Concluido",  "JOAQUIM", "2020-05-04 19:40:31", "2020-05-04 19:40:31"), (4, "Respondido por email",  "FRANCISCO", "2020-05-04 19:40:31", "2020-05-04 19:40:31");

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ouvidoria_status', function (Blueprint $table) {
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
        Schema::dropIfExists('ouvidoria_status');
    }
}
