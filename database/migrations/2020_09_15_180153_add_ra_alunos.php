<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRaAlunos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('alunos', function (Blueprint $table) {
            $table->string('telefone_pai')->nullable()->change();
            $table->string('telefone_mae')->nullable()->change();
            $table->string('telefone_responsavel')->nullable()->change();
            $table->string('celular_pai')->nullable()->change();
            $table->string('celular_mae')->nullable()->change();
            $table->string('celular_responsavel')->nullable()->change();
            $table->string('alergia')->nullable()->change();
            $table->string('deficiencia')->nullable()->change();
            $table->string('ra')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alunos', function (Blueprint $table) {
            $table->string('telefone_pai');
            $table->string('telefone_mae');
            $table->string('telefone_responsavel');
            $table->string('celular_pai');
            $table->string('celular_mae');
            $table->string('celular_responsavel');
            $table->string('alergia');
            $table->string('deficiencia');
            $table->string('ra');
        });
    }
}
