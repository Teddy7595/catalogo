<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Catgprods extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ctgproductos',function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->bigInteger('id_productos');
            $table->bigInteger('id_categoria');

            $table->foreign('id_productos')->references('cod')->on('productos');
            $table->foreign('id_categoria')->references('id')->on('categorias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ctgproductos');
    }
}
