<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComunicadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comunicado', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('de');
            $table->string('para');
            $table->text('mensagem');
            $table->string('data_cadastro');
            $table->string('data_validade');
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
        Schema::dropIfExists('comunicado');
    }
}
