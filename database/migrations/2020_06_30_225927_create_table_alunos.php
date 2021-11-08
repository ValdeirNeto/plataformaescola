<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAlunos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alunos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome');
            $table->string('nome_social')->nullable();
            $table->date('data_nascimento');
            $table->string('email');
            $table->string('cpf');
            $table->string('rg');
            $table->string('telefone')->nullable();
            $table->string('celular')->nullable();
            $table->string('genero');
            $table->string('cep');
            $table->string('rua');
            $table->string('numero');
            $table->string('cidade');
            $table->string('estado');
            $table->string('nome_mae')->nullable();
            $table->string('email_mae')->nullable();
            $table->string('cpf_mae')->nullable();
            $table->string('rg_mae')->nullable();
            $table->string('nome_pai')->nullable();
            $table->string('email_pai')->nullable();
            $table->string('cpf_pai')->nullable();
            $table->string('rg_pai')->nullable();
            $table->string('nome_responsavel');
            $table->string('email_responsavel');
            $table->string('cpf_responsavel');
            $table->string('rg_responsavel');
            $table->string('observacao')->nullable();
            $table->string('foto')->nullable();
            $table->date('data_cadastro');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alunos');
    }
}
