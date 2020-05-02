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
            $table->string('prefix');
            $table->string('name');
            $table->string('cod');
            $table->string('titular');
            $table->string('ci');
            $table->string('phone');
            $table->string('email');
            $table->string('type');
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
