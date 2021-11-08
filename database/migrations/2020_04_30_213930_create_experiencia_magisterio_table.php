<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperienciaMagisterioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experiencia_magisterio', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('usuario_id');
            $table->string('descricao'); 
            $table->string('faltas')->nullable();;
            $table->string('data_faltas')->nullable();;
            $table->string('atestados')->nullable();;
            $table->string('data_atestados')->nullable();;
            $table->string('advertencias')->nullable();;
            $table->string('data_advertencias')->nullable();;
            $table->foreign('usuario_id')->references('id')->on('users');
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
        Schema::dropIfExists('experiencia_magisterio');
    }
}
