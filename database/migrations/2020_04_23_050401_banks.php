<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Banks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catg_banks', function (Blueprint $table) 
        {
            $table->id();
            $table->string('prefix');//prefijo del banco
            $table->string('name'); //nombre del banco
            $table->string('cod'); //cuenta del banco
            $table->string('titular'); //nombre del titular de la cuenta
            $table->string('ci'); //cedula del titular
            $table->string('phone'); //telefono del titular
            $table->string('email'); //email del titular
            $table->string('type'); // tipo de cuenta
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
        Schema::dropIfExists('catg_banks');
    }
}
