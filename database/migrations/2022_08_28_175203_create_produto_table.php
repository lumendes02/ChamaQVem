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
        Schema::create('produtos', function (Blueprint $table) {
            $table->id('idproduto');
            $table->unsignedBigInteger('idcardapio');
            $table->foreign('idcardapio')->references('idcardapio')->on('cardapios');
            $table->string('descricao')->lenght(50);
            $table->decimal('preco',9,2);
            $table->decimal('desconto',9,2);
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
        Schema::dropIfExists('itens');
    }
};
