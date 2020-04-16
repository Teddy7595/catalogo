<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Compras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras',function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->string('status')->default('EN_PROCESO');
            $table->bigInteger('id_cliente');
            $table->bigInteger('id_producto');
            $table->string('referencia_bnc')->nullable();
            $table->double('monto',30,2);
            $table->string('photo')->nullable();
            $table->string('pdf_bnc')->nullable();
            $table->string('create_at')->nullable();

            $table->foreign('id_cliente')->references('ci')->on('clientes');
            $table->foreign('id_producto')->references('cod')->on('productos');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compras');
    }
}
