<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Category extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catg_category', function (Blueprint $table) 
        {
            $table->id();
            $table->string('name')->unique(); //nombre de la categoria
            $table->string('department'); //si es de tipo bodegon o ferreteria u otros
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catg_categorys');
    }
}
