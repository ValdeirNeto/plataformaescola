<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRaProfessor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('professor', function (Blueprint $table) {
            $table->string('ra', 128)->nullable();
            $table->string('nome')->nullable()->change();
            $table->date('data_nascimento')->nullable()->change();
            $table->string('email')->nullable()->change();
            $table->string('cpf')->nullable()->change();
            $table->string('rg')->nullable()->change();
            $table->string('genero')->nullable()->change();
            $table->string('cep')->nullable()->change();
            $table->string('rua')->nullable()->change();
            $table->string('numero')->nullable()->change();
            $table->string('cidade')->nullable()->change();
            $table->string('estado')->nullable()->change();
            $table->date('data_cadastro')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('professor', function (Blueprint $table) {
            $table->string('ra', 128);
            $table->string('nome');
            $table->date('data_nascimento');
            $table->string('email');
            $table->string('cpf');
            $table->string('rg');
            $table->string('genero');
            $table->string('cep');
            $table->string('rua');
            $table->string('numero');
            $table->string('cidade');
            $table->string('estado');
            $table->date('data_cadastro');
        });
    }
}
