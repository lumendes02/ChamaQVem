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
        Schema::create('lojas', function (Blueprint $table) {
            $table->id('idloja');
            $table->unsignedBigInteger('idusuario');
            $table->foreign('idusuario')->references('idusuario')->on('usuarios');
            $table->unsignedBigInteger('idcidade');
            $table->foreign('idcidade')->references('idcidade')->on('cidades');
            $table->string('fantasia')->lenght(100);
            $table->string('endereco')->lenght(100);
            $table->string('cnpj')->lenght(14);
            $table->string('cep')->lenght(10);
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
        Schema::dropIfExists('loja');
    }
};
