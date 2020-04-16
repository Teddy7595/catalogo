<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Bancos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bancos',function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->string('create_at');
            $table->string('name_banco');
            $table->string('tipo_cuenta');
            $table->string('nro_cuenta');
            $table->string('name_titular');
            $table->string('ci_titular');
            $table->string('tlf_titular');
            $table->string('mail_titular');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::dropIfexists('bancos');
    }
}
