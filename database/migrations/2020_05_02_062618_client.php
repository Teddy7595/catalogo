<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Client extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catg_clients', function (Blueprint $table) 
        {
            $table->id();
            $table->foreignId('user_id')->constrained('catg_users'); //referencia de usuario
            $table->string('adress1'); //diraccion
            $table->string('adress2')->nullable(); //direccion secundaria
            $table->string('phone1');// telefeno
            $table->string('phone2')->nullable(); //telefono secundario
            $table->timestamps(); //marca de fechas
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catg_clients');
    }
}
