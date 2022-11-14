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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id('idpedido');
            $table->unsignedBigInteger('idusuario');
            $table->foreign('idusuario')->references('idusuario')->on('usuarios');
            $table->unsignedBigInteger('idloja');
            $table->foreign('idloja')->references('idloja')->on('lojas');
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
        Schema::dropIfExists('pedidos');
    }
};
