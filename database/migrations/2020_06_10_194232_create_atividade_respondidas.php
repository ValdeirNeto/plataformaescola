<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtividadeRespondidas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atividade_respondidas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('atividade_id');
            $table->unsignedBigInteger('pergunta_id');
            $table->unsignedBigInteger('resposta_id')->nullable();
            $table->unsignedBigInteger('usuario_id');
            $table->string('resposta_dissertativa')->nullable();
            $table->foreign('atividade_id')->references('id')->on('atividades');
            $table->foreign('resposta_id')->references('id')->on('respostas');
            $table->foreign('usuario_id')->references('id')->on('users');
            $table->foreign('pergunta_id')->references('id')->on('perguntas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('atividade_respondidas');
    }
}
