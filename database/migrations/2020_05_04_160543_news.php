<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class News extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catg_news', function (Blueprint $table) 
        {
            $table->id(); //id unico incremental por noticia
            $table->string('name'); //nombre de la noticia
            $table->string('img');//imagen de la noticia, si tiene una...
            $table->string('link'); //link o direccion hacia donde apuntará la noticia
            $table->text('descp'); //descripción del producto
            $table->timestamp('created_at'); //marca de tiempo
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema:dropIfExists('catg_news');
    }
}
