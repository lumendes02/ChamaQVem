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
        Schema::create('carrinhos', function (Blueprint $table) {
            $table->id('idcarrinho');
            $table->unsignedBigInteger('idusuario');
            $table->foreign('idusuario')->references('idusuario')->on('usuarios');
            $table->unsignedBigInteger('idloja');
            $table->foreign('idloja')->references('idloja')->on('lojas');
            $table->integer('idproduto');
            $table->decimal('preco',9,2);
            $table->unsignedBigInteger('idstatus');
            $table->foreign('idstatus')->references('idstatus')->on('status');
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
        Schema::dropIfExists('carrinhos');
    }
};
