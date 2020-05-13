<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catg_products', function (Blueprint $table) 
        {
            $table->id(); //id unico incremental por producto
            $table->string('id_saint')->unique(); //id saint unico
            $table->string('name'); //nombre del producto
            $table->foreignId('category_id')->constrained('catg_category');//codigo de la categoria
            $table->double('price_dls',10,2)->default(1.11); //precio en dolares y euros del prodcto
            $table->double('price_eur',10,2)->default(1.11); //precio en dolares y euros del prodcto
            $table->double('offer',3,2)->default(0.00); //oferta del producto
            $table->string('present'); //presentacion del producto
            $table->string('status')->default('IN_STOCK');//estado del producto IN_STOCK, UNAVIALABLE
            $table->string('img');//imagen del producto
            $table->integer('cant'); //cantidad del producto
            $table->text('descp'); //descripción del producto
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catg_products');
    }
}
