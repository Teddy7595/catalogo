<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Quote extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catg_quotes', function (Blueprint $table) 
        {
            $table->id();
            $table->double('bsdls',10,2); //costo del bolivar por dolar
            $table->double('bseur',10,2); //costo del bolivar por euro
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
        Schema::dropIfExists('catg_quotes');
    }
}
