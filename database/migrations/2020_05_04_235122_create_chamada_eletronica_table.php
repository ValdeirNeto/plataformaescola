<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChamadaEletronicaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chamada_eletronica', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('turma_id');
            $table->string('alunos_presentes');
            $table->string('data_chamada');
            $table->foreign('turma_id')->references('id')->on('turma');
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
        Schema::dropIfExists('chamada_eletronica');
    }
}
