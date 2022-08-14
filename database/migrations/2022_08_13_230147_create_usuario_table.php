<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->id('idusuario');
            $table->string('nome')->length(100);
            $table->string('login')->length(25);
            $table->string('senha');
            $table->string('telefone')->length(11);
            $table->string('cpf')->length(11);
            $table->string('email')->nullable();
            $table->unsignedBigInteger('idtipousuario');
            $table->foreign('idtipousuario')->references('idtipousuario')->on('tipo_usuarios');
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
        Schema::dropIfExists('usuario');
    }
};
