<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableEscola extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('escola', function (Blueprint $table) {
            $table->string('rua')->nullable()->change();
            $table->string('cidade')->nullable()->change();
            $table->string('estado')->nullable()->change();
            $table->string('cep')->nullable()->change();
            $table->string('numero')->nullable()->change();
            $table->string('situacao')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('escola', function (Blueprint $table) {
            $table->string('rua');
            $table->string('cidade');
            $table->string('estado');
            $table->string('cep');
            $table->string('numero');
            $table->string('situacao');
        });
    }
}
