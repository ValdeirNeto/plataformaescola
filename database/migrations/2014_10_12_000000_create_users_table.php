<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('escola_id')->nullable();
            $table->string('name');
            $table->string('url_foto')->nullable();	
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('permissao')->nullable();
            $table->string('cep')->nullable();			
            $table->string('rua')->nullable();
            $table->string('numero')->nullable();
            $table->string('cidade')->nullable();
            $table->string('telefone')->nullable();
            $table->string('celular')->nullable();					
            $table->string('rg')->nullable();
            $table->string('cpf')->nullable();
            $table->string('data_nasc')->nullable();		
            $table->string('genero')->nullable();	
            $table->string('nome_mae')->nullable();
            $table->string('mae_email')->nullable();									
            $table->string('mae_RG')->nullable();
            $table->string('mae_CPF')->nullable();
            $table->string('mae_titulo_eleitoral')->nullable();
            $table->string('mae_data_nasc')->nullable();
            $table->string('nome_pai')->nullable();
            $table->string('pai_email')->nullable();				
            $table->string('pai_RG')->nullable();
            $table->string('pai_CPF')->nullable();
            $table->string('pai_titulo_eleitoral')->nullable();
            $table->string('pai_data_de_nasc')->nullable();		
            $table->string('situacao_civil_dos_pais')->nullable();					
            $table->string('autorizacao_de_buscar_na_escola')->nullable();
            $table->string('deficiencia')->nullable();		
            $table->string('grupo_sanguineo')->nullable();					
            $table->string('mao_boa')->nullable();			
            $table->string('cor_raça')->nullable();	
            $table->string('estado_civil')->nullable();				
            $table->string('nome_do_conjuge')->nullable();
            $table->string('nome_dos_filhos')->nullable();
            $table->foreign('escola_id')->references('id')->on('escola');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
