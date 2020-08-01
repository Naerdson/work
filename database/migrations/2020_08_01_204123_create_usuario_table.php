<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('usuario');
            $table->unsignedBigInteger('setor_id')->default(1);
            $table->string('email')->nullable()->unique();
            $table->unsignedBigInteger('nivel_id')->default(1);

            $table->foreign('nivel_id')->references('id')->on('nivel_usuario');
            $table->foreign('setor_id')->references('id')->on('setor');
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
        Schema::dropIfExists('usuario');
    }
}
