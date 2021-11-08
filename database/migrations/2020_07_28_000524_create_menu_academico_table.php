<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuAcademicoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_academico', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('filho')->nullable();
            $table->string('ordem');
            $table->string('descricao');
            $table->string('titulo');
            $table->string('route')->nullable();
            $table->string('permissao');
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
        Schema::dropIfExists('menu_academico');
    }
}
